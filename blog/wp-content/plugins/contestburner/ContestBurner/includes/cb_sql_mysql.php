<?php

/*
* Original code from {@link http://justinvincent.com Justin Vincent (justin@visunet.ie)}
*/


	$cbsql_mysql_str = array
	(
		1 => 'Require $dbuser and $dbpassword to connect to a database server',
		2 => 'Error establishing mySQL database connection. Correct user/password? Correct hostname? Database server running?',
		3 => 'Require $dbname to select a database',
		4 => 'mySQL database connection is not active',
		5 => 'Unexpected error while trying to select database'
	);

	/**********************************************************************
	*  ezSQL Database specific class - mySQL
	*/

	if ( ! function_exists ('mysql_connect') ) die('<b>Fatal Error:</b> cbdb_mysql requires mySQL Lib to be compiled and or linked in to the PHP engine');
	if ( ! class_exists ('cbdb') ) die('<b>Fatal Error:</b> cbdb_mysql requires cbdb (ez_sql_core.php) to be included/loaded before it can be used');

	class cbdb_mysql extends cbdb
	{

		var $dbuser = false;
		var $dbpassword = false;
		var $dbname = false;
		var $dbhost = false;
		var $prefix = false;

		/**********************************************************************
		*  Constructor - allow the user to perform a qucik connect at the
		*  same time as initialising the cbdb_mysql class
		*/

		function cbdb_mysql($dbuser='', $dbpassword='', $dbname='', $dbhost='localhost', $prefix='')
		{
			$this->dbuser = $dbuser;
			$this->dbpassword = $dbpassword;
			$this->dbname = $dbname;
			$this->dbhost = $dbhost;
			$this->prefix = $prefix;
		}

		/**********************************************************************
		*  Short hand way to connect to mySQL database server
		*  and select a mySQL database at the same time
		*/

		function quick_connect($dbuser='', $dbpassword='', $dbname='', $dbhost='localhost')
		{
			$return_val = false;
			if ( ! $this->connect($dbuser, $dbpassword, $dbhost,true) ) ;
			else if ( ! $this->select($dbname) ) ;
			else $return_val = true;
			return $return_val;
		}

		/**********************************************************************
		*  Try to connect to mySQL database server
		*/

		function connect($dbuser='', $dbpassword='', $dbhost='localhost')
		{
			global $cbsql_mysql_str; $return_val = false;

			// Must have a user and a password
			if ( ! $dbuser )
			{
				$this->register_error($cbsql_mysql_str[1].' in '.__FILE__.' on line '.__LINE__);
				$this->show_errors ? trigger_error($cbsql_mysql_str[1],E_USER_WARNING) : null;
			}
			// Try to establish the server database handle
			else if ( ! $this->dbh = @mysql_connect($dbhost,$dbuser,$dbpassword,true) )
			{
				$this->register_error($cbsql_mysql_str[2].' in '.__FILE__.' on line '.__LINE__);
				$this->show_errors ? trigger_error($cbsql_mysql_str[2],E_USER_WARNING) : null;
			}
			else
			{
				$this->dbuser = $dbuser;
				$this->dbpassword = $dbpassword;
				$this->dbhost = $dbhost;
				$return_val = true;
			}

			return $return_val;
		}

		/**********************************************************************
		*  Try to select a mySQL database
		*/

		function select($dbname='')
		{
			global $cbsql_mysql_str; $return_val = false;

			// Must have a database name
			if ( ! $dbname )
			{
				$this->register_error($cbsql_mysql_str[3].' in '.__FILE__.' on line '.__LINE__);
				$this->show_errors ? trigger_error($cbsql_mysql_str[3],E_USER_WARNING) : null;
			}

			// Must have an active database connection
			else if ( ! $this->dbh )
			{
				$this->register_error($cbsql_mysql_str[4].' in '.__FILE__.' on line '.__LINE__);
				$this->show_errors ? trigger_error($cbsql_mysql_str[4],E_USER_WARNING) : null;
			}

			// Try to connect to the database
			else if ( !@mysql_select_db($dbname,$this->dbh) )
			{
				// Try to get error supplied by mysql if not use our own
				if ( !$str = @mysql_error($this->dbh))
					  $str = $cbsql_mysql_str[5];

				$this->register_error($str.' in '.__FILE__.' on line '.__LINE__);
				$this->show_errors ? trigger_error($str,E_USER_WARNING) : null;
			}
			else
			{
				$this->dbname = $dbname;
				$return_val = true;
			}

			return $return_val;
		}

		/**********************************************************************
		*  Format a mySQL string correctly for safe mySQL insert
		*  (no mater if magic quotes are on or not)
		*/

		function escape($str)
		{
			// If there is no existing database connection then try to connect
			if ( ! isset($this->dbh) || ! $this->dbh )
			{
				$this->connect($this->dbuser, $this->dbpassword, $this->dbhost);
				$this->select($this->dbname);
			}

			return mysql_real_escape_string(stripslashes($str));
		}

		/**********************************************************************
		*  Return mySQL specific system date syntax
		*  i.e. Oracle: SYSDATE Mysql: NOW()
		*/

		function sysdate()
		{
			return 'NOW()';
		}

		/**********************************************************************
		*  Perform mySQL query and try to detirmin result value
		*/

		function query($query)
		{

			// Initialise return
			$return_val = 0;

			// Flush cached values..
			$this->flush();

			// For reg expressions
			$query = trim($query);

			// Log how the function was called
			$this->func_call = "\$db->query(\"$query\")";

			// Keep track of the last query for debug..
			$this->last_query = $query;

			// Count how many queries there have been
			$this->num_queries++;

			// Use core file cache function
			if ( $cache = $this->get_cache($query) )
			{
				return $cache;
			}

			// If there is no existing database connection then try to connect
			if ( ! isset($this->dbh) || ! $this->dbh )
			{
				$this->connect($this->dbuser, $this->dbpassword, $this->dbhost);
				$this->select($this->dbname);
			}

			// Perform the query via std mysql_query function..
			$this->result = @mysql_query($query,$this->dbh);

			// If there is an error then take note of it..
			if ( $str = @mysql_error($this->dbh) )
			{
				$is_insert = true;
				$this->register_error($str);
				$this->show_errors ? trigger_error($this->last_query.'<br/>'.$str,E_USER_WARNING) : null;
				return false;
			}

			// Query was an insert, delete, update, replace
			$is_insert = false;
			if ( preg_match("/^(insert|delete|update|replace)\s+/i",$query) )
			{
				$this->rows_affected = @mysql_affected_rows();

				// Take note of the insert_id
				if ( preg_match("/^(insert|replace)\s+/i",$query) )
				{
					$this->insert_id = @mysql_insert_id($this->dbh);
				}

				// Return number fo rows affected
				$return_val = $this->rows_affected;
			}
			// Query was a select
			else
			{

				// Take note of column info
				$i=0;
				while ($i < @mysql_num_fields($this->result))
				{
					$this->col_info[$i] = @mysql_fetch_field($this->result);
					$i++;
				}

				// Store Query Results
				$num_rows=0;
				while ( $row = @mysql_fetch_object($this->result) )
				{
					// Store relults as an objects within main array
					$this->last_result[$num_rows] = $row;
					$num_rows++;
				}

				@mysql_free_result($this->result);

				// Log number of rows the query returned
				$this->num_rows = $num_rows;

				// Return number of rows selected
				$return_val = $this->num_rows;
			}

			// disk caching of queries
			$this->store_cache($query,$is_insert);

			// If debug ALL queries
			$this->trace || $this->debug_all ? $this->debug() : null ;

			return $return_val;

		}

	}

	// dbDelta - borrowed from WordPress
	function CBdbDelta($queries, $execute = true) {
		global $cbdb;
	
		// Separate individual queries into an array
		if( !is_array($queries) ) {
			$queries = explode( ';', $queries );
			if('' == $queries[count($queries) - 1]) array_pop($queries);
		}
	
		$cqueries = array(); // Creation Queries
		$iqueries = array(); // Insertion Queries
		$for_update = array();
	
		// Create a tablename index for an array ($cqueries) of queries
		foreach($queries as $qry) {
			if(preg_match("|CREATE TABLE ([^ ]*)|", $qry, $matches)) {
				$cqueries[trim( strtolower($matches[1]), '`' )] = $qry;
				$for_update[$matches[1]] = 'Created table '.$matches[1];
			}
			else if(preg_match("|CREATE DATABASE ([^ ]*)|", $qry, $matches)) {
				array_unshift($cqueries, $qry);
			}
			else if(preg_match("|INSERT INTO ([^ ]*)|", $qry, $matches)) {
				$iqueries[] = $qry;
			}
			else if(preg_match("|UPDATE ([^ ]*)|", $qry, $matches)) {
				$iqueries[] = $qry;
			}
			else {
				// Unrecognized query type
			}
		}
	
		// Check to see which tables and fields exist
		if($tables = $cbdb->get_col('SHOW TABLES;')) {
			// For every table in the database
			foreach($tables as $table) {
				// If a table query exists for the database table...
				if( array_key_exists(strtolower($table), $cqueries) ) {
					// Clear the field and index arrays
					unset($cfields);
					unset($indices);
					// Get all of the field names in the query from between the parens
					preg_match("|\((.*)\)|ms", $cqueries[strtolower($table)], $match2);
					$qryline = trim($match2[1]);
	
					// Separate field lines into an array
					$flds = explode("\n", $qryline);
	
					//echo "<hr/><pre>\n".print_r(strtolower($table), true).":\n".print_r($cqueries, true)."</pre><hr/>";
	
					// For every field line specified in the query
					foreach($flds as $fld) {
						// Extract the field name
						preg_match("|^([^ ]*)|", trim($fld), $fvals);
						$fieldname = trim( $fvals[1], '`' );
	
						// Verify the found field name
						$validfield = true;
						switch(strtolower($fieldname))
						{
						case '':
						case 'primary':
						case 'index':
						case 'fulltext':
						case 'unique':
						case 'key':
							$validfield = false;
							$indices[] = trim(trim($fld), ", \n");
							break;
						}
						$fld = trim($fld);
	
						// If it's a valid field, add it to the field array
						if($validfield) {
							$cfields[strtolower($fieldname)] = trim($fld, ", \n");
						}
					}
	
					// Fetch the table column structure from the database
					$tablefields = $cbdb->get_results("DESCRIBE {$table};");
	
					// For every field in the table
					foreach($tablefields as $tablefield) {
						// If the table field exists in the field array...
						if(array_key_exists(strtolower($tablefield->Field), $cfields)) {
							// Get the field type from the query
							preg_match("|".$tablefield->Field." ([^ ]*( unsigned)?)|i", $cfields[strtolower($tablefield->Field)], $matches);
							$fieldtype = $matches[1];
	
							// Is actual field type different from the field type in query?
							if($tablefield->Type != $fieldtype) {
								// Add a query to change the column type
								$cqueries[] = "ALTER TABLE {$table} CHANGE COLUMN {$tablefield->Field} " . $cfields[strtolower($tablefield->Field)];
								$for_update[$table.'.'.$tablefield->Field] = "Changed type of {$table}.{$tablefield->Field} from {$tablefield->Type} to {$fieldtype}";
							}
	
							// Get the default value from the array
								//echo "{$cfields[strtolower($tablefield->Field)]}<br>";
							if(preg_match("| DEFAULT '(.*)'|i", $cfields[strtolower($tablefield->Field)], $matches)) {
								$default_value = $matches[1];
								if($tablefield->Default != $default_value)
								{
									// Add a query to change the column's default value
									$cqueries[] = "ALTER TABLE {$table} ALTER COLUMN {$tablefield->Field} SET DEFAULT '{$default_value}'";
									$for_update[$table.'.'.$tablefield->Field] = "Changed default value of {$table}.{$tablefield->Field} from {$tablefield->Default} to {$default_value}";
								}
							}
	
							// Remove the field from the array (so it's not added)
							unset($cfields[strtolower($tablefield->Field)]);
						}
						else {
							// This field exists in the table, but not in the creation queries?
						}
					}
	
					// For every remaining field specified for the table
					foreach($cfields as $fieldname => $fielddef) {
						// Push a query line into $cqueries that adds the field to that table
						$cqueries[] = "ALTER TABLE {$table} ADD COLUMN $fielddef";
						$for_update[$table.'.'.$fieldname] = 'Added column '.$table.'.'.$fieldname;
					}
	
					// Index stuff goes here
					// Fetch the table index structure from the database
					$tableindices = $cbdb->get_results("SHOW INDEX FROM {$table};");
	
					if($tableindices) {
						// Clear the index array
						unset($index_ary);
	
						// For every index in the table
						foreach($tableindices as $tableindex) {
							// Add the index to the index data array
							$keyname = $tableindex->Key_name;
							$index_ary[$keyname]['columns'][] = array('fieldname' => $tableindex->Column_name, 'subpart' => $tableindex->Sub_part);
							$index_ary[$keyname]['unique'] = ($tableindex->Non_unique == 0)?true:false;
						}
	
						// For each actual index in the index array
						foreach($index_ary as $index_name => $index_data) {
							// Build a create string to compare to the query
							$index_string = '';
							if($index_name == 'PRIMARY') {
								$index_string .= 'PRIMARY ';
							}
							else if($index_data['unique']) {
								$index_string .= 'UNIQUE ';
							}
							$index_string .= 'KEY ';
							if($index_name != 'PRIMARY') {
								$index_string .= $index_name;
							}
							$index_columns = '';
							// For each column in the index
							foreach($index_data['columns'] as $column_data) {
								if($index_columns != '') $index_columns .= ',';
								// Add the field to the column list string
								$index_columns .= $column_data['fieldname'];
								if($column_data['subpart'] != '') {
									$index_columns .= '('.$column_data['subpart'].')';
								}
							}
							// Add the column list to the index create string
							$index_string .= ' ('.$index_columns.')';
							if(!(($aindex = array_search($index_string, $indices)) === false)) {
								unset($indices[$aindex]);
								//echo "<pre style=\"border:1px solid #ccc;margin-top:5px;\">{$table}:<br />Found index:".$index_string."</pre>\n";
							}
							//else echo "<pre style=\"border:1px solid #ccc;margin-top:5px;\">{$table}:<br /><b>Did not find index:</b>".$index_string."<br />".print_r($indices, true)."</pre>\n";
						}
					}
	
					// For every remaining index specified for the table
					foreach ( (array) $indices as $index ) {
						// Push a query line into $cqueries that adds the index to that table
						$cqueries[] = "ALTER TABLE {$table} ADD $index";
						$for_update[$table.'.'.$fieldname] = 'Added index '.$table.' '.$index;
					}
	
					// Remove the original table creation query from processing
					unset($cqueries[strtolower($table)]);
					unset($for_update[strtolower($table)]);
				} else {
					// This table exists in the database, but not in the creation queries?
				}
			}
		}
	
		$allqueries = array_merge($cqueries, $iqueries);
		if($execute) {
			foreach($allqueries as $query) {
				//echo "<pre style=\"border:1px solid #ccc;margin-top:5px;\">".print_r($query, true)."</pre>\n";
				$cbdb->query($query);
			}
		}
	
		return $for_update;
	}
?>
