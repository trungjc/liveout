<?php

global $cb_config, $wpdb, $cbdb;

if(function_exists('get_bloginfo')) {
$cb_config=array(
    "db_user"               => DB_USER,
    "db_pass"               => DB_PASSWORD,
    "db_name"               => DB_NAME,
    "db_host"               => DB_HOST,
    "prefix"                => $wpdb->prefix."cb3_",
    "product"               => "ContestBurner3",
    "site_url"              => site_url(),
    "date_format"           => get_option('date_format'),
    "time_format"           => get_option('time_format'),
    "gmt_offset"            => get_option('gmt_offset'),
    "lang"                  => "default",
    "contestburner_url"     => plugins_url().'/'. preg_replace('/\/ContestBurner/', "", dirname( plugin_basename(__FILE__) )),
    "contestburner_path"    => dirname(__FILE__),
    "ajax_url"              => get_bloginfo('wpurl')."/wp-admin/admin-ajax.php"
);
}
?>