<?php
function contestburner_entry_form($cb, $contest, $vcff577693aa045d8 = false, $vc60879c6b4132170 = false, $v385d501a12b82991 = 0, $vf3aa1999beeda723 = 0, $v29282f542d364094, $tracking_id = '') {
	global $cb_config, $contest_cbdb_url, $v0351a5492ac59281, $v6cde605610904286, $v08375901adb5fcc7;
	$vdad21ebc5881aa41 = '';
	foreach ( $v29282f542d364094 as $v3c6e0b8a9c15224a => $v2063c1608d6e0baf ) {
		$vdad21ebc5881aa41 .= '&' . $v3c6e0b8a9c15224a . '=' . $v2063c1608d6e0baf;
	}
	if (isset ( $_GET ['fb'] )) {
		$vd5189de027922f81 = $cb_config ["ajax_url"] . "?action=contestburner_entry_form&email=" . $_GET ['email'] . (isset ( $_GET ['first_name'] ) ? '&first_name=' . $_GET ['first_name'] : '') . (isset ( $_GET ['last_name'] ) ? '&last_name=' . $_GET ['last_name'] : '') . (isset ( $_GET ['tid'] ) ? '&tid=' . $_GET ['tid'] : '') . "&contest=" . $_GET ['contest'] . "&show_affurl=" . $_GET ['show_affurl'] . '&fbenter=1' . '&redirect_on_entry=' . urlencode ( $v385d501a12b82991 ) . '&post_id=' . $vf3aa1999beeda723 . $vdad21ebc5881aa41;
		$cb->n76747eafecabc5a2 ( $vd5189de027922f81 );
	}
	$v6e2baaf3b97dbeef = '';
	$vd611c46f8e65d9e0 = gmdate ( "Y-m-d H:i:s" );
	$contest_email = null;
	$contest_email_src = null;
	$contest_firstname = null;
	$contest_lastname = null;
	$v931812c3a2642304 = null;
	if (! is_object ( $contest )) {
		$contest = $cb->n86d97a521be9b5f3 ( $contest, true );
	}
	if (false === $contest) {
		die ( '<p class="contest_not_found">' . CB_text ( 'GET_LINKS_CONTEST_NOT_FOUND' ) . '</p>' );
	}
	if (! (($contest->contest_startdate <= $vd611c46f8e65d9e0) && ($vd611c46f8e65d9e0 <= $contest->contest_enddate))) {
		if ($contest->contest_startdate > $vd611c46f8e65d9e0) {
			$v6e2baaf3b97dbeef .= '<p class="contest_not_running">' . CB_text ( 'CONTEST_STARTS_ON', array (
					date ( "M jS @ g:ia ", strtotime ( $contest->contest_startdate ) + ($cb_config ['gmt_offset'] * 3600) ) . ' GMT' . $cb_config ['gmt_offset_string'] 
			) ) . '</p>';
		} elseif ($contest->contest_enddate < $vd611c46f8e65d9e0) {
			$v6e2baaf3b97dbeef .= '<p class="contest_not_running">' . CB_text ( 'CONTEST_ENDED_ON', array (
					date ( "M jS @ g:ia ", strtotime ( $contest->contest_enddate ) + ($cb_config ['gmt_offset'] * 3600) ) . ' GMT' . $cb_config ['gmt_offset_string'] 
			) ) . '</p>';
		}
		if (($contest->contest_startdate == '0000-00-00 00:00:00') && $vc60879c6b4132170) {
			$v6e2baaf3b97dbeef .= CB_contest_not_started_msg ();
		}
		if (! empty ( $v6e2baaf3b97dbeef ))
			die ( $v6e2baaf3b97dbeef );
	}
	if (! isset ( $v2abca5d8e922fd29 ) || ! is_array ( $v2abca5d8e922fd29 )) {
		$v2abca5d8e922fd29 = isset ( $_COOKIE ['cb_user_' . $contest->contest_id] ) ? $_COOKIE ['cb_user_' . $contest->contest_id] : null;
		if (! empty ( $v2abca5d8e922fd29 )) {
			$v2abca5d8e922fd29 = unserialize ( base64_decode ( $v2abca5d8e922fd29 ) );
		}
	}
	if (isset ( $_POST ['contest_email'] ) && ! empty ( $_POST ['contest_email'] )) {
		$contest_email = $_POST ['contest_email'];
		$contest_email_src = 'post';
	} elseif (isset ( $_GET ['email'] ) && ! empty ( $_GET ['email'] )) {
		$contest_email = $_GET ['email'];
		$contest_email_src = 'get';
	} elseif (isset ( $v2abca5d8e922fd29 ['email'] ) && ! empty ( $v2abca5d8e922fd29 ['email'] )) {
		$contest_email = $v2abca5d8e922fd29 ['email'];
		$contest_email_src = 'cookie';
	}
	if (isset ( $_GET ['first_name'] ) && ! empty ( $_GET ['first_name'] )) {
		$contest_firstname = $_GET ['first_name'];
	}
	if (isset ( $_GET ['last_name'] ) && ! empty ( $_GET ['last_name'] )) {
		$contest_lastname = $_GET ['last_name'];
	}
	if (! empty ( $v385d501a12b82991 )) {
		if (ctype_digit ( $v385d501a12b82991 )) {
			$v931812c3a2642304 = get_permalink ( $v385d501a12b82991 );
		} else {
			$v931812c3a2642304 = $v385d501a12b82991;
		}
	}
	$v2764ca9d34e90313 = 1;
	?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#"
	xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
<link rel="stylesheet" id="contestburner_stylesheet"
	href="<?php echo $cb_config['contestburner_url']; ?>/ContestBurner/css/contest.css?ver=<?php echo CONTESTBURNER_VERSION; ?>"
	type="text/css" media="all" />
<link rel="stylesheet"
	href="<?php echo $cb_config['site_url']; ?>/wp-content/themes/liveout/css/webflow.css"
	type="text/css" media="all" />
<link rel="stylesheet"
	href="<?php echo $cb_config['site_url']; ?>/wp-content/themes/liveout/css/live-out-3.webflow.css"
	type="text/css" media="all" />
<style>
body {
	margin: 0;
	padding: 0;
}
</style>                 
<?php $cb->nca56715ee16643bb(); ?>             </head>
<body>
	<div class="contest_links w-clearfix contest-burner">
		<script>                     
		var loading_bar     = new Image();                     
		loading_bar.src     = "<?php echo $cb_config['contestburner_url']; ?>/ContestBurner/images/loadingAnimation.gif";                     
		var cb_user         = <?php echo empty($contest_email)?'false':'true'; ?>;                     
		var fb_uid          = null;                     
		var username        = null;                     
		var facebookEnter   = <?php echo isset($_GET['fbenter']) ? 'true' : 'false'; ?>;                     
		var redirect        = <?php echo !empty($v931812c3a2642304) ? 'true' : 'false'; ?>;                     
		var redirect_url    = '<?php echo $v931812c3a2642304; ?>';                      
		function getlinks_submit() {                         
			jQuery("input[name='force_cbdb']").val("1");                         
			jQuery("#email_enter_form").submit();                     
		}                      
		function reloadPage() {                         
			if (typeof isBustingOut !== 'undefined') {                             
				clearInterval(isBustingOut);                             
				window.onbeforeunload = function(){ 
					prevent_bust = 0; };                         
				}                         
			getlinks_submit();                     
		}                      
		function popupWin(pageUrl, reload, width, height) {                         
			if (!width && !height) {                             
				if (width = /[\\?&]CBPOP_width=([^&#]*)/.exec(pageUrl)) {                                 
					width = width[1];                                 
					pageUrl = pageUrl.replace(/^(.*?)[\\?&]CBPOP_width=[^&#]+(.*?)$/, "$1$2");                             
				}                             
				if (height = /[\\?&]CBPOP_height=([^&#]*)/.exec(pageUrl)) {                                 
					height = height[1];                                 
					pageUrl = pageUrl.replace(/^(.*?)[\\?&]CBPOP_height=[^&#]+(.*?)$/, "$1$2");                             
				}                         
			}                         
			width = width ? width : 620;                         
			height = height ? height : 400;                         
			var cbPopup = window.open(pageUrl, "cb_popup", "scrollbars=no,location=no,address=no,menubar=no,status=no,toolbar=no,width="+width+",height="+height);                          
			if (reload) {                             
				var isPopupClosed = setInterval(function() {                                 
					if (cbPopup.closed) {                                     
						clearInterval(isPopupClosed);                                     
						reloadPage();                                 }                             }, 100);                         }                          
				return false;                     
				}                      
			function updateFrameHeight() {                         
				if (redirect == false)                             
					$(".links_div").css('height', 'auto');
				$(".contest_links_frame", parent.document).height($(document.body).height());                     
				}                      
			function setupPage(){                         
				updateFrameHeight();                          
				$("#Y2JfYWZmaWxpYXRlX").load(function() {                             
					$("#Y2JfYWZmaWxpYXRlX").remove();                         
					});                         
				setTimeout( function() {                             
					$("#Y2JfYWZmaWxpYXRlX").remove();                         }, 1000);                          
				$("#email_enter_form").submit(function(){                             var msg = "";                             
				var user_id = $("input[name='user_id']").val();                             
				var ce = $("input[name='contest_email']").val();                             
				var firstname = $("input[name='contest_firstname']").val();                             
				var lastname = $("input[name='contest_lastname']").val();                             
				if( cb_user || facebookEnter || (ce!="" && firstname!="" && lastname!="") ) {                                 
					if ( cb_user || facebookEnter || ce.match(/^.*?@.*?\..{1,6}$/) ) {                                     
						$(".cb_user_form_div").hide();                                     
						$(".enter_loading").hide();                                     
						$(".fb_links_div").hide();                                     $(".get_links_div").hide();                                     $(".loading_bar").show();                                     
						$.ajax({                                         
							url: "<?php echo $cb_config['ajax_url']; ?>",                                         
							cache: false,                                         
							type: "POST",                                         
							data: $(this).serialize(),                                         
							success: function(html) {                                             
								$(".cb_user_form_div").hide();                                             
								$(".get_links_div").html(html);                                             
								$(".get_links_div").show();                                             
								$(".enter_loading").hide();                                             
								$(".loading_bar").hide();                                             
								$("input[name='force_cbdb']").val("0");                                             
								updateFrameHeight();                                             
								setTimeout(updateFrameHeight, 350);                                         }                                     });                                 
						} else {                                     
							msg = "<?php echo CB_text('INVALID_EMAIL'); ?>";                                 }                             
					} else {                                 
						msg = "<?php echo CB_text('ALL_FIELDS_ARE_REQUIRED'); ?>";                             
						}                             
				if (msg) { alert(msg) };                             return false;                         });                          
				$(".a2a_dd").live("mouseover", function(e){                             $("#a2apage_powered_by").hide();                             $("#a2apage_facebook").hide();                             $("#a2apage_twitter").hide();                         });                          <?php if ( empty($contest_email_src) ) { ?>                             $(".cb_user_form_div").show();                             updateFrameHeight();                         <?php } ?>                          <?php if ( empty($v6e2baaf3b97dbeef) && ($contest_email_src == 'get' || $contest_email_src == 'cookie') ) { ?>                         if( typeof(getlinks_submitted) == "undefined" ) {                             /* $("#email_enter span.enter_loading").show(); */                             var getlinks_submitted = true;                             $("#email_enter_form").submit();                         }                         <?php } ?>                          $(".clear_cb_user").live("click", function(){                             cb_user         = false;                             facebookEnter   = false;                             var $ckframe = $('<iframe width="1" height="1" frameborder="no"></iframe>');                             $("body").append($ckframe);                             setTimeout( function() {                                 var ckdoc = $ckframe[0].contentWindow.document;                                 var $ckbody = $("body", ckdoc);                                 var expires = new Date();                                 expires.setTime(expires.getTime()-1);                                 $ckbody.html('<scr' + 'ipt type="text/javascript">document.cookie = "cb_user_<?php echo $contest->contest_id; ?>=; expires=' + expires.toGMTString() + '; path=/";</scr' + 'ipt>');                                 setTimeout(function(){                                     $(".cb_username").html("");                                     $(".cb_user_div").hide();                                     $(".cb_user_form_div").show();                                     $("input[name='contest_email']").val("");                                     $(".get_links_div").hide();                                     $(".get_links_div").html("");                                     updateFrameHeight();                                     cb_updateFBCommentsBox();                                 }, 1);                             }, 1);                             return false;                         });                         <?php if (!empty($_GET['cbtb'])) { ?>                         setTimeout( function() {                             popupWin("http://www.contestburner.com/users/activate.php<?php echo base64_decode($_GET['cbtb']); ?>",false, 700, 500);                         }, 250);                         <?php } ?>                          $("#enter_with_facebook").click(function(){                             facebookEnter = true;                             var enterUrl = '<?php echo $v6cde605610904286; ?>connect.php'                                 +'?user_id=enter'                                 +'<?php echo isset($_GET["tid"])?"&tid=".$_GET["tid"]:""; ?>'                                 +'&next=<?php echo rawurlencode($cb_config["ajax_url"]."?action=contestburner_entry_form&contest=".$contest->contest_id."&fb=1&show_affurl=".$vcff577693aa045d8."&redirect_on_entry=".$v385d501a12b82991."&post_id=".$vf3aa1999beeda723.(isset($_GET["tid"])?"&tid=".$_GET["tid"]:"").$vdad21ebc5881aa41); ?>'                                 +"&CBPOP_width=990&CBPOP_height=560";                             return popupWin(enterUrl, false);                         });                          $(".cb_pop").live('click', function() {                             return popupWin($(this).attr('href'), false);                         });                         $(".cb_pop_reload").live('click', function() {                             return popupWin($(this).attr('href'), true);                         });                          $(".cbtb").live('click', function(){                             top.cbtb_show("",$(this).attr('href'),"");                             var isPopupClosed = setInterval(function() {                                 if ($("#CBTB_window", top.document).length < 1) {                                     clearInterval(isPopupClosed);                                     reloadPage();                                 }                             }, 100);                             return false;                         });                         
				$("#enter_with_google").click(function(){                             
						facebookEnter = true;                             var enterUrl = '<?php echo $contest_cbdb_url; ?>google/google.php'                                 +'?user_id=enter'                                 +'&contest=<?php echo $contest->contest_id; ?>'                                 +'&cid=<?php echo $contest->contest_cbdb_id; ?>'                                 +'<?php echo isset($_GET["tid"])?"&tid=".$_GET["tid"]:""; ?>'                                 +'&next=<?php echo rawurlencode($cb_config["ajax_url"]."?action=contestburner_entry_form&contest=".$contest->contest_id."&fb=1&show_affurl=".$vcff577693aa045d8."&redirect_on_entry=".$v385d501a12b82991."&post_id=".$vf3aa1999beeda723.(isset($_GET["tid"])?"&tid=".$_GET["tid"]:"").$vdad21ebc5881aa41); ?>'                                 +"&CBPOP_width=990&CBPOP_height=560";                             
					return popupWin(enterUrl, false);                         });                     
				}                 
			</script>
		<div class="loading_bar" style="display: none;">
			<img
				src="<?php echo $cb_config['contestburner_url']; ?>/ContestBurner/images/loadingAnimation.gif"
				align="center" /><br />
		</div>
		<div class="cb_user_div" style="display: none;">                     
			<?php echo CB_text('THANKS_FOR_ENTERING', array($v2abca5d8e922fd29['username'])); ?><br />
			<span id="contest_user_actions"> [&nbsp;<a href=""
				class="clear_cb_user"><?php echo CB_text('IM_NOT_USERNAME', array($v2abca5d8e922fd29['username'])); ?></a>&nbsp;]
			</span><br /> <span class="enter_loading"
				style="width: 250px; margin: 20px 0px 80px 0px;"><span
				style="float: left;"><?php echo CB_text('LOADING_CONTEST_LINKS'); ?>&nbsp;</span><img
				src="<?php echo $cb_config['contestburner_url']; ?>/ContestBurner/images/loading_sm.gif"
				align="absbottom" style="float: left; margin-left: 10px;" /></span>
		</div>                 
		<?php
	
$v8d2495ce81081887 = true;
	if ($v29282f542d364094 ['enter_with_email'] == 0 || $v29282f542d364094 ['enter_with_facebook'] == 0) {
		$v8d2495ce81081887 = false;
	}
	?>                 
		<div class="cb_user_form_div" style="display: none;">
			<div class="form-header"><?php echo CB_text('ENTER_THE_CONTEST'); ?>:</div>
			<div class="form-text"><?php echo $contest->contest_name; ?></div>
			<div class="content">
				<div
					<?php
	
if (! $v8d2495ce81081887) {
		echo $v29282f542d364094 ['enter_with_facebook'] ? 'style="width:100%;"' : 'style="display:none;"';
	}
	?>>
					<p><?php echo CB_text('ENTER_WITH_OAUTH_DESCRIPTION'); ?></p>
					<a id="enter_with_facebook"
						class="buttons facebook-button facebook" href="#"
						data-ix="show-temporarily-offline-message">
		      			<?php echo CB_text('ENTER_WITH_FACEBOOK_BUTTON'); ?></a> <a
						id="enter_with_google" class="buttons google-button googleplus"
						href="#" data-ix="show-temporarily-offline-message">
		      			<?= CB_text('ENTER_WITH_GOOGLE_BUTTON'); ?></a>
				</div>

				<div class="w-form"
					<?php if (!$v8d2495ce81081887) { echo $v29282f542d364094['enter_with_email'] ? 'style="width:100%;"' : 'style="display:none;"'; } ?>>
					<form class="w-clearfix email_enter_form" id="email_enter_form"
						name="email_enter_form" data-name="Email Form" action=""
						method="POST">
						<div class="form-text"
							<?php if (!$v8d2495ce81081887) { echo 'style="display:none;"'; } ?>>
						 	<?php echo CB_text('OR_ENTER_EMAIL'); ?>
						 </div>
						<input class="w-input input-field" id="contest_firstname"
							value="<?php echo $contest_firstname; ?>" type="text"
							placeholder="<?php echo CB_text('FIRSTNAME_LABEL'); ?>"
							name="contest_firstname" data-name="First name"> <input
							class="w-input input-field"
							value="<?php echo $contest_lastname; ?>" name="contest_lastname"
							id="contest_lastname" type="text"
							placeholder="<?php echo CB_text('LASTNAME_LABEL'); ?>"
							data-name="Last name"> <input class="w-input input-field"
							name="contest_email" id="contest_email" type="text"
							value="<?php echo $contest_email; ?>"
							placeholder="<?php echo CB_text('EMAIL_ADDRESS_LABEL'); ?>"
							data-name="Email"> <input type="hidden" name="action"
							value="contestburner_enter_contest" /> <input type="hidden"
							name="post_id" value="<?php echo $vf3aa1999beeda723; ?>" /> <input
							type="hidden" name="tracking_id"
							value="<?php echo $tracking_id; ?>" /> <input type="hidden"
							name="redirect_on_entry"
							value="<?php echo $v385d501a12b82991; ?>" /> <input type="hidden"
							name="contest_id" value="<?php echo $contest->contest_id; ?>" />
						<input type="hidden" name="points_for_signups"
							value="<?php echo $contest->options['points_for_signups']; ?>" />
						<input type="hidden" name="points_for_entering"
							value="<?php echo $contest->options['points_for_entering']; ?>" />
						<input type="hidden" name="force_cbdb" id="force_cbdb" value="0" />
						<input type="hidden" name="get_affiliate_link"
							value="<?php echo ($contest->options['load_affiliate_link'] == 1 && $vcff577693aa045d8) ? 1 : 0; ?>" />
						<input type="hidden" name="cbtb"
							value="<?php echo !empty($_GET['cbtb']) ? 1 : 0; ?>" />                                     <?php if ( empty($v6e2baaf3b97dbeef) && ($contest_email_src == 'cookie') ) : ?>                                         <input
							type="hidden" name="user_id"
							value="<?php echo $v2abca5d8e922fd29['user_id']; ?>" />                                     <?php endif; ?>                                     <input
							type="hidden" name="step"
							value="<?php echo $v2764ca9d34e90313; ?>" /> <input type="submit"
							style="width: auto" name="submit" class="buttons wp-form-buttons"
							id="email_enter_button"
							value="<?php echo CB_text('ENTER_WITH_EMAIL_BUTTON'); ?>"
							data-ix="show-temporarily-offline-message" /> <a
							class="contest-rules"
							href="<?php echo $cb_config['site_url']; ?>/contest-info">Contest
							Info</a> <span class="enter_loading"><img
							src="<?php echo $cb_config['contestburner_url']; ?>/ContestBurner/images/loading_sm.gif"
							align="absbottom" /> </span>
					</form>
					<div class="w-form-done">
						<p>Thank you! Your submission has been received!</p>
					</div>
					<div class="w-form-fail">
						<p>Oops! Something went wrong while submitting the form :(</p>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="links_div" style="height: 0px; overflow: hidden;">                     <?php if (!is_numeric($contest->options['fbpage_id'])) : ?>                     <div
			class="fb_links_div" style="display: none;"></div>                     <?php endif; ?>                     <div
			class="get_links_div"></div>                     <?php $va9464c72c1e48b5d = ''; if ( !isset($_SESSION['affurl_loaded']) && ( !empty($v08375901adb5fcc7) || $contest->options['load_affiliate_link'] == '1') ) { $v78356a175ddeba6d = ''; if (strlen($_COOKIE['contest_click_referrer']) > 0) { $v41e0967ee91deef8 = 0; if ($contest->options['affiliate_upline'] == '1') { $v41e0967ee91deef8 = (!empty($contest->options['affiliate_upline_levels'])?$contest->options['affiliate_upline_levels']:0); } $v78356a175ddeba6d = $cb->nc6a90547f633238d($_COOKIE['contest_click_referrer'], $v41e0967ee91deef8); if ( empty($v78356a175ddeba6d) && !empty($v08375901adb5fcc7) ) { $v78356a175ddeba6d = $v08375901adb5fcc7; } if (!empty($v78356a175ddeba6d)) { $_SESSION['affurl_loaded'] = 1; ?>                                 <iframe
			id="Y2JfYWZmaWxpYXRlX" src="<?php echo $v78356a175ddeba6d; ?>"
			width="1" height="1"></iframe>                                 <?php } } } ?>                 </div>
	</div>
	<div style="clear: both;"></div>
	<script>$(document).ready(setupPage());</script>
	<?php echo $cb->n39d1e94bcb23e5b2($contest); ?>
	<!-- ContestBurner END -->
</body>
</html>
<?php
}
function contest_fb_comments($cb, $contest = '', $veaae26a6fb20ed3e = "100%", $v03f775e113bbfe75 = 5, $v2705a83a5a0659cc = 0) {
	global $cbdb, $cb_config, $vf382adfe6c68d1ae, $v2abca5d8e922fd29, $contest_cbdb_url, $v6cde605610904286;
	if (! is_object ( $contest )) {
		$cb->ContestBurner ( $contest, true );
		$contest = $cb->contest;
	}
	$vfc35fdc70d5fc69d = '';
	if (false !== $contest) {
		if (! is_array ( $v2abca5d8e922fd29 )) {
			$v2abca5d8e922fd29 = $_COOKIE ['cb_user_' . $contest->contest_id];
			if (! empty ( $v2abca5d8e922fd29 )) {
				$v2abca5d8e922fd29 = unserialize ( base64_decode ( $v2abca5d8e922fd29 ) );
			}
		} /*
		   * if (!empty($cb_user['username'])) {
		   * $title = CB_text('FB_COMMENT_WIDGET_TITLE_JOINED', array($contest->contest_name));
		   * } else {
		   * $title = '<a href="'.$link_url.'">'.CB_text('FB_COMMENT_WIDGET_TITLE_NOTJOINED').'</a>';
		   * }
		   * $link_url = $contest->contest_links_url;
		   */
		if (empty ( $v2abca5d8e922fd29 ['user_id'] )) {
			$v2abca5d8e922fd29 ['user_id'] = $cb->n8c0d561d3cf7e867 ( $v2abca5d8e922fd29 ['email'], 'email' );
		}
		if (! $v2705a83a5a0659cc)
			$vfc35fdc70d5fc69d .= '<div class="contest_fb_comments_box" style="width:' . $veaae26a6fb20ed3e . 'px;" u="' . $v14c4b06b824ec593 . '" w="' . $veaae26a6fb20ed3e . '" c="' . $contest->contest_slug . '" n="' . $v03f775e113bbfe75 . '">';
		$vfc35fdc70d5fc69d .= '<iframe class="fb_comments_frame" ' . 'src="' . $cb_config ['ajax_url'] . '?action=contest_ajax_fb_comments_widget&contest_id=' . $contest->contest_id . '&user_id=' . $v2abca5d8e922fd29 ['user_id'] . '&width=' . $veaae26a6fb20ed3e . '&numposts=' . $v03f775e113bbfe75 . '" ' . 'width="' . $veaae26a6fb20ed3e . '" ' . 'frameborder="0" ' . 'scrolling="no" ' . 'style="border:none;height:74px;overflow:hidden;width:' . $veaae26a6fb20ed3e . '" ' . 'allowTransparency="true">' . '</iframe>';
		if (! $v2705a83a5a0659cc)
			$vfc35fdc70d5fc69d .= '</div>';
	}
	if ($v2705a83a5a0659cc)
		die ( $vfc35fdc70d5fc69d );
	else
		return $vfc35fdc70d5fc69d;
}
function fb_comments_widget($cb) {
	global $cbdb, $cb_config, $vf382adfe6c68d1ae, $v2abca5d8e922fd29, $contest_cbdb_url, $v6cde605610904286;
	if (! empty ( $_POST ['comment_id'] )) {
		$contest_id = $_POST ['contest_id'];
		$v69b97d17cf3cd0db = $_POST ['comment_id'];
		$user_id = $_POST ['user_id'];
		if (! empty ( $user_id )) {
			$contest = $cb->n86d97a521be9b5f3 ( $contest_id, true );
			if ($contest && is_array ( $contest->options )) {
				$ve7d37718e184e9b0 = $cb->n800b0ab5ba2cb80e ( $user_id, 'user_id' );
				if (! empty ( $ve7d37718e184e9b0 ['user_id'] )) {
					$v83878c9117133890 = $cb->n9233aa5d73a7536c ( $user_id, 'FC:' . $v69b97d17cf3cd0db . ';FU:' . $ve7d37718e184e9b0 ['facebook'] . ';', $contest->options ['fbcomment_points'], $contest->contest_id, $contest->contest_cbdb_id, gmdate ( "Y-m-d H:i:s" ), $contest->contest_startdate, $contest->contest_enddate, CB_get_ip (), $contest->options ['fbcomment_max_points'] );
					die ( '{ "point" : ' . $v83878c9117133890 . ' }' );
				}
			} else {
				die ( '{ "error" : "Error loading contest."}' );
			}
		}
	} /*
	   * if (empty($_GET['data']))
	   * die(0);
	   *
	   * $_GET['data'] = preg_replace('/\s/', '+', $_GET['data']);
	   *
	   * $parms = unserialize(base64_decode(rawurldecode($_GET['data'])));
	   *
	   *
	   * if (!is_array($parms))
	   * die(0);
	   */
	$contest_id = $_GET ['contest_id'];
	if (empty ( $contest_id ))
		die ( 0 );
	$user_id = $_GET ['user_id'];
	$veaae26a6fb20ed3e = $_GET ['width'] ? $_GET ['width'] : '100%';
	$v03f775e113bbfe75 = $_GET ['numposts'] ? $_GET ['numposts'] : 5;
	$contest = $cb->n86d97a521be9b5f3 ( $contest_id, true );
	if ($contest && is_array ( $contest->options )) {
		$link_url = $contest->contest_links_url;
		$contest_url = $contest->contest_links_url;
		$contest_name = $contest->contest_name;
		$vdc9da5e6f55f2111 = $contest->options ['fbpage_url'];
		if (! empty ( $user_id )) {
			$vd5d3db1765287eef = CB_text ( 'FB_COMMENT_WIDGET_TITLE_JOINED', array (
					$contest->contest_name 
			) );
		} else {
			$vd5d3db1765287eef = '<a class= "sign-up-on-facebook" href="' . $link_url . '" target="_top">' . CB_text ( 'FB_COMMENT_WIDGET_TITLE_NOTJOINED' ) . '</a>';
		}
	} else {
		die ( 0 );
	}
	?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#"
	xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
<style>
body {
	margin: 0;
	padding: 0;
}
</style>
<link rel="stylesheet"
	href="<?php echo $cb_config['site_url']; ?>/wp-content/themes/liveout/css/webflow.css"
	type="text/css" media="all" />
<link rel="stylesheet"
	href="<?php echo $cb_config['site_url']; ?>/wp-content/themes/liveout/css/live-out-3.webflow.css"
	type="text/css" media="all" />
<script type="text/javascript"
	src="<?php echo $cb_config['contestburner_url']; ?>/ContestBurner/js/jquery-1.7.2.min.js"></script>
</head>
<body>
	<div id="fb-root"></div>


	<div class="w-clearfix contest-burner">
		<div class="form-header">Facebook Plugin</div>
      <?php echo stripslashes($vd5d3db1765287eef); ?>
    </div>
	<script> var cb_user = <?php echo empty($user_id)?'false':'true'; ?>; </script>
	<script>                         
	window.fbAsyncInit = function() {                             FB.init({                                 xfbml: true,                                 channelUrl: '<?php echo $v6cde605610904286; ?>widgets/channel.php'                             });                              if(cb_user)                                 FB.Event.subscribe("comment.create", recordPoints);                          };                          function recordPoints(response) {                             if (response.commentID) {                                 jQuery.ajax({                                     url: '<?php echo $cb_config['ajax_url']; ?>',                                     type: "POST",                                     dataType: "json",                                     data: ({                                         action              : 'contest_ajax_fb_comments_widget',                                         user_id             : '<?php echo $user_id; ?>',                                         contest_id          : '<?php echo $contest_id; ?>',                                         comment_id          : response.commentID                                     }),                                     success: function(response) {                                         if (response.error) {                                             alert(response.error);                                         } else {                                         }                                     }                                 });                             }                         }                          function adjustCommentFrameHeight() {                             $(".fb_comments_frame", parent.document).height($(document.body).height());                             /* setTimeout(adjustCommentFrameHeight, 1500); */                             if ( typeof parent.updateFrameHeight != 'undefined' ) {                                 parent.updateFrameHeight();                             }                         }                          jQuery(document).ready(function($){                             setTimeout(adjustCommentFrameHeight, 1500);                             setTimeout(adjustCommentFrameHeight, 3000);                             setTimeout(adjustCommentFrameHeight, 4500);                         });                           (function() {                           var e = document.createElement('script'); e.async = true;                           e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';                           document.getElementById('fb-root').appendChild(e);                         }());                      
	</script>
</body>
</html>
<?php
}

function contest_leaders($cb, $contest, $vaf07d66895fce93f = true, $vaa9f73eea60a0068 = '', 
		$v9d85c254b5062e51 = 50, $v1e1a420c5bae386a = 1, $vc60879c6b4132170 = false) {
	global $cbdb, $cb_config, $contest_cbdb_url;
	$contest_leaders_html = '';
	if (! is_object ( $contest )) {
		$cb->ContestBurner ( $contest, true );
		$contest = $cb->contest;
	}
	if (false !== $contest) {
		$v0c9aaaf8b29d5a07 = $cb->n6fa7ef5e91d97daa ( $contest->contest_cbdb_id, $vaf07d66895fce93f, $vaa9f73eea60a0068, $v9d85c254b5062e51, $v1e1a420c5bae386a );
		if (count ( $v0c9aaaf8b29d5a07 ) > 0) {
			if ($vaf07d66895fce93f) {
				$contest_leaders_html .= $cb->n2f508ec83926dfa1 ( $contest );
			}
			$vf367703e108b5427 = isset ( $_REQUEST ['pg'] ) ? abs ( intval ( $_REQUEST ['pg'] ) ) : 0;
			if (empty ( $vf367703e108b5427 ))
				$vf367703e108b5427 = 1;
			$vea2b2676c28c0db2 = (($vf367703e108b5427 - 1) * $v9d85c254b5062e51);
			$v7f021a1415b86f2d = ($vea2b2676c28c0db2 + $v9d85c254b5062e51);
			if (! isset ( $v2abca5d8e922fd29 ) || ! is_array ( $v2abca5d8e922fd29 )) {
				$v2abca5d8e922fd29 = $_COOKIE ['cb_user_' . $contest->contest_id];
				if (! empty ( $v2abca5d8e922fd29 )) {
					$v2abca5d8e922fd29 = unserialize ( base64_decode ( $v2abca5d8e922fd29 ) );
				}
			}
			$contest_leaders_html .= '                     <script src="' . $cb_config ['contestburner_url'] . '/ContestBurner/js/jquery.smart_autocomplete.js"></script>                     <script type="text/javascript">                         var spinner = new Image();                         spinner.src = "' . $cb_config ['contestburner_url'] . '/ContestBurner/images/loading_sm.gif";                         jQuery(document).ready(function($) {                             $pointSearchInput = $("#contest_get_points_username");                             $loadingNamesSpinner = $("#get_points_names_loading");                             $pointSearchInput.smartAutoComplete({                                 source: "",                                 forceSelect: true,                                 filter: function(term, source){                                     var matches = new Array();                                     for (user_id in source) {                                         if (source[user_id].display_name.toLowerCase().indexOf(term.toLowerCase()) != -1)                                             matches.push( { "user_id":user_id, "name":source[user_id].display_name, "points": source[user_id].points } );                                     }                                     return matches;                                 },                                 resultFormatter: function(item){                                     return ("<li id=\'" + item.user_id + "\' data-points=\'" + item.points + "\'>" + item.name.replace(new RegExp($(this.context).val(),"gi"), "<strong>$&</strong>") + "</li>");                                 }                             });                             $pointSearchInput.bind({                                 keyIn: function(){                                    if ($pointSearchInput.smartAutoComplete().source == "") {                                         $loadingNamesSpinner.attr("src", "' . $cb_config ['contestburner_url'] . '/ContestBurner/images/loading_sm.gif");                                         $.ajax({                                             url: "' . $cb_config ['ajax_url'] . '",                                             type: "POST",                                             dataType: "json",                                             async: false,                                             data: {                                                 "action": "contest_ajax_get_contestants",                                                 "contest_id": "' . $contest->contest_cbdb_id . '",                                                 "data_type": "json"                                             },                                             success: function(json){                                                 $pointSearchInput.smartAutoComplete().source = json;                                                 $loadingNamesSpinner.attr("src", "' . $cb_config ['contestburner_url'] . '/ContestBurner/images/blank_16x16.gif");                                             }                                         });                                     }                                 },                                 itemSelect: function(ev, selected_item){                                     var options = $(this).smartAutoComplete();                                     $(this).val($(selected_item).text());                                     $("#contest_get_points_user_id").val($(selected_item).attr("id"));                                     $("#cb_leaders_search_results span.cb_username").html($("#contest_get_points_username").val());                                     $("#cb_leaders_search_results span.cb_my_points").html($(selected_item).attr("data-points"));                                     options.setItemSelected(true);                                     $(this).trigger("lostFocus");                                     ev.preventDefault();                                 }                             });                             $("#get_my_points").submit(function(){                                 $("#cb_leaders_search_form").hide();                                 $("#cb_leaders_search_results").show();                                 return false;                             });                             $("#cb_leaders_new_search").click(function(){                                 $("#contest_get_points_user_id").val("");                                 $("#contest_get_points_username").val("");                                 $("#cb_leaders_search_results span.cb_username").html("");                                 $("#cb_leaders_search_results span.cb_my_points").html("");                                 $("#cb_leaders_search_results").hide();                                 $("#cb_leaders_search_form").show();                                 $("#contest_get_points_username").focus();                                 return false;                             });                         });                     </script>';
			$user_points = 0;
			$v2db95e8e1a9267b7 = 1;
			$v9dd4e461268c8034 = $vea2b2676c28c0db2 + 1;
			$v9fd0b8a973926110 = '';
			$vafd9e28fd86c391f = '';
			foreach ( $v0c9aaaf8b29d5a07 as $vc444858e0aaeb727 ) {
				$vb068931cc450442b = $vc444858e0aaeb727->display_name ? $vc444858e0aaeb727->display_name : ($vc444858e0aaeb727->contest ? $vc444858e0aaeb727->contest : $vc444858e0aaeb727->twitter);
				if ($vc444858e0aaeb727->points > 0 || ($vc444858e0aaeb727->user_id == $v2abca5d8e922fd29 ['user_id'])) {
					if (empty ( $vb068931cc450442b ) && ! empty ( $vc444858e0aaeb727->facebook )) {
						$v466deec76ecdf5fc = $cb->http ( "http://graph.facebook.com/" . $vc444858e0aaeb727->facebook );
						if (preg_match ( '/^.*?"name"\:"(.*?)".*?$/', $v466deec76ecdf5fc, $v9c28d32df2340377 )) {
							$vb068931cc450442b = $v9c28d32df2340377 [1];
						}
					}
				}
				if (($vc444858e0aaeb727->user_id == $v2abca5d8e922fd29 ['user_id'])) {
					$v9fd0b8a973926110 .= '                             <script type="text/javascript">                                 jQuery(document).ready(function($) {                                     $(".clear_cb_user").live("click", function(){                                         var $ckframe = $(\'<iframe width="1" height="1" frameborder="no"></iframe>\');                                         $("body").append($ckframe);                                         setTimeout( function() {                                             var ckdoc = $ckframe[0].contentWindow.document;                                             var $ckbody = $("body", ckdoc);                                             var expires = new Date();                                             expires.setTime(expires.getTime()-1);                                             $ckbody.html(\'<scr\' + \'ipt type="text/javascript">document.cookie = "cb_user_' . $contest->contest_id . '=; expires=\'+expires.toGMTString()+\'; path=/";</scr\'+\'ipt>\');                                             setTimeout(function(){                                                 $(".cb_username").html("");                                                 $(".cb_user_div").hide();                                                 cb_updateFBCommentsBox();                                             }, 1);                                         }, 1);                                         return false;                                     });                                 });                             
						</script>' 
						. '<div class="cb_user_div" style="display:block">' 
								. CB_text ( 'HI_YOU_HAVE_POINTS', array (
							($vb068931cc450442b ? $vb068931cc450442b : $v2abca5d8e922fd29 ['username']),
							$vc444858e0aaeb727->points 
					) ) . '<br/>' . '<span class="cb_small">[&nbsp;<a href="" class="clear_cb_user">' . CB_text ( 'IM_NOT_USERNAME', array (
							$vb068931cc450442b ? $vb068931cc450442b : $v2abca5d8e922fd29 ['username'] 
					) ) . '</a>&nbsp;]</span><br/>' . '</div>';
				}
				if ($vc444858e0aaeb727->points > 0) {
					if ($v2db95e8e1a9267b7 > $vea2b2676c28c0db2 && $v2db95e8e1a9267b7 <= $v7f021a1415b86f2d) {
						if ($vc444858e0aaeb727->user_id) {
							$v783edc2ed8ad2c0f = '';
							$v0d69194db4535406 = '';
							$vcc634e79cda0d59e = '';
							if (! empty ( $vc444858e0aaeb727->twitter ))
								$v783edc2ed8ad2c0f = '<a target="_blank" rel="nofollow" href="http://twitter.com/' . $vc444858e0aaeb727->twitter . '"><img src="' . $cb_config ['contestburner_url'] . '/ContestBurner/images/twitter_16x16.png"/></a>';
							if (! empty ( $vc444858e0aaeb727->facebook )) {
								if ($vb068931cc450442b) {
									$vb068931cc450442b = '<a href="http://www.facebook.com/profile.php?id=' . $vc444858e0aaeb727->facebook . '" target="_blank"><img src="http://graph.facebook.com/' . $vc444858e0aaeb727->facebook . '/picture" class="profile_picture_small" />' . '<span class="facebook_user_name">' . $vb068931cc450442b . '</span></a>';
								} else {
									$v0d69194db4535406 = '<a target="_blank" rel="nofollow" href="http://www.facebook.com/profile.php?id=' . $vc444858e0aaeb727->facebook . '"><img src="' . $cb_config ['contestburner_url'] . '/ContestBurner/images/facebook_16x16.png"/></a>';
								}
							}
							if (! empty ( $vc444858e0aaeb727->vba9bf05693b9fa20 )) {
								if (strlen ( $vc444858e0aaeb727->vba9bf05693b9fa20 ) == 22)
									$vfb9aea024026388f = "http://www.youtube.com/feed/UC" . $vc444858e0aaeb727->vba9bf05693b9fa20;
								else
									$vfb9aea024026388f = "http://www.youtube.com/" . $vc444858e0aaeb727->vba9bf05693b9fa20;
								$vcc634e79cda0d59e = '<a target="_blank" rel="nofollow" href="' . $vfb9aea024026388f . '"><img src="' . $cb_config ['contestburner_url'] . '/ContestBurner/images/youtube_16x16.png"/></a>';
							}
							$vafd9e28fd86c391f .= '<div class="w-clearfix list-div"><div class="w-clearfix number-rank">' 
							. '<div class="rank">' . $v9dd4e461268c8034 . '.</div></div>'  
							. $vb068931cc450442b . '&nbsp;&nbsp;' . $v783edc2ed8ad2c0f . $v0d69194db4535406 . $vcc634e79cda0d59e 
							. '<div class="leader-points">' . CB_text ( 'POINT_PLURAL', array (
									$vc444858e0aaeb727->points 
							) ) . "</div></div>";
							$v9dd4e461268c8034 ++;
						}
					}
					$v2db95e8e1a9267b7 ++;
				}
			}			
			$contest_leaders_html .= $v9fd0b8a973926110 
			. '<div class="h3">Not at the top of the leaderboard? No worries.</div>'
			. '<div class="normal-text">Each week, a winner will be selected for our weekly Giveaway <span class="points">based on points, creativity, engagement, and overall effort.</span> Winners will be announced every Sunday on Facebook.</div>'
			. '<div class="w-clearfix contest-burner">'
			. $vafd9e28fd86c391f 
			. '</div>' 

			. '<div class="w-form contest-burner">'						
			. '<form action="" name="get_my_points" class="w-clearfix" id="get_my_points">'
			. '<div class="form-header">'. CB_text ( 'FIND_YOUR_POINTS' ) .'</div>'
			. '<input autocomplete="off" class="w-input input-field" id="contest_get_points_username" type="text" placeholder="Enter your name" name="contest_get_points_username">'																
			. '<input type="hidden" id="contest_get_points_user_id" name="contest_get_points_user_id" value="" />'										
			. '<img id="get_points_names_loading" src="' . $cb_config ['contestburner_url'] 
			. '/ContestBurner/images/blank_16x16.gif" width="16" height="16"/>' 
						
			. '<div class="normal-text name-s-points" id="cb_leaders_search_results">' . CB_text ( 'POINT_SEARCH_RESULT' ) 
			. '[<a href="#" id="cb_leaders_new_search">' . CB_text ( 'NEW_SEARCH' ) . '</a>]</div>'
			. '<input class="button w-button buttons wp-form-buttons" type="submit" value="' . CB_text ( 'SEARCH' ) . '" data-wait="Please wait..."/>'
 
			. '<div id="cb_leaders_search_loading">' . CB_text ( 'SEARCHING' ) 
			. ' <img src="' . $cb_config ['contestburner_url'] . '/ContestBurner/images/loading_sm.gif" /></div>';
			$v76e0753b45368734 = ceil ( count ( $v0c9aaaf8b29d5a07 ) / $v9d85c254b5062e51 );
			$v901fec4a85d13f6a = n789e4a5aa325b523 ( $v76e0753b45368734, $vf367703e108b5427 );
			if ($v901fec4a85d13f6a) {
				$contest_leaders_html .= '<div class="tablenav-pages">';
				$contest_leaders_html .= sprintf ( '<span class="displaying-num">' . CB_text ( 'PAGINATE' ) . '</span>%4$s', (($vf367703e108b5427 - 1) * $v9d85c254b5062e51 + 1), (min ( $vf367703e108b5427 * $v9d85c254b5062e51, count ( $v0c9aaaf8b29d5a07 ) )), (count ( $v0c9aaaf8b29d5a07 )), $v901fec4a85d13f6a );
				$contest_leaders_html .= '</div>';
			}
			$contest_leaders_html .= '<br class="clear" />' . '</form>';
			$contest_leaders_html .= '</div>';
			$contest_leaders_html .= '<br class="clear" />';
		}
		$contest_leaders_html .= $cb->n39d1e94bcb23e5b2 ( $contest );
	}
	if ($contest_leaders_html == '') {
		$contest_leaders_html .= '<p>' . CB_text ( 'NO_POINTS_AWARDED' ) . '</p>';
	}
	return $cb->n7d4b3bdc7f1168f5 ( $contest_leaders_html );
}
?>