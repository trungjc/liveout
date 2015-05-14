<?php ?><?php /*
Plugin Name: ContestBurner
Plugin URI: http://www.contestburner.com
Description: Create viral contests on your blog that integrate with Twitter & other social networking sites. Reward your visitors with contest points for linking to you, Tweeting about you, commenting on your blog, visiting specific pages & much more. Learn more here: <a href="http://www.contestburner.com">www.contestburner.com</a>.
Version: 3.11
Author: Business Inner Circle
Author URI: http://www.businessinnercircle.com/forum/contest-burner-viral-marketing-wordpress-plugin/
Developer: Greg Wrey (gwrey)

Copyright 2009-2015 McIntosh Marketing, All rights reserved. Patent Pending.
*/
/**  * Load the ContestBurner code  */
require_once ('ContestBurner/config.php');
require_once ('ContestBurner/ContestBurner.class.php');
require_once ('ContestBurner/liveout.php');
$cb_config["basename"] = 'contestburner/contest.php';
$cb = new ContestBurner();
function contest_intercept_plugin_info_requests($result, $action = null, $args = null) {
    $cb = new ContestBurner();
    return $cb->n3a91a9a06645361e($result, $action, $args);
}
add_filter('plugins_api', 'contest_intercept_plugin_info_requests', 10, 3);
function contest_inject_update($updates) {
    $cb = new ContestBurner();
    return $cb->n60ad69bd65626312($updates);
}
add_filter('site_transient_update_plugins', 'contest_inject_update');
add_filter('transient_update_plugins', 'contest_inject_update');
function contest_test($atts, $content = null) {
    $cb = new ContestBurner();
    $contest = $cb->n86d97a521be9b5f3('2', true);
    return $cb->n259fe929a9e4f28b($contest);
}
add_shortcode('contest_test', 'contest_test');
function contest_inject_upgrade_notice($current, $update) {
    if (is_array($update->upgrade_notice)) {
        $change_list = '<ul style="margin-left:10px;list-style:none;font-weight:bold;">';
        foreach ($update->upgrade_notice as $notice_version => $changes) {
            if (strnatcmp($current['Version'], $notice_version) < 0) {
                $change_list.= '<li style="margin:0;">' . $notice_version;
                $change_list.= '<ul style="margin-left:55px;margin-top:-15px;list-style:disc;font-weight:normal;">';
                foreach ($changes as $change) $change_list.= '<li style="margin:0;">' . $change . '</li>';
                $change_list.= '</ul></li>';
            }
        }
        $change_list.= '</ul>';
        echo '<div style="color:#0000FF;">This update includes the following changes since your current ' . $current['Version'] . ' version:</div>' . '<div style="font-weight:normal;">' . $change_list . '</div>';
    }
}
add_action('in_plugin_update_message-' . $cb_config['basename'], 'contest_inject_upgrade_notice', 10, 2);
function contest_script_and_styles($posts) {
    global $cb_config;
    if (empty($posts)) return $posts;
    $contest_content = false;
    foreach ($posts as $post) {
        if (stripos($post->post_content, '[contest_') !== false || stripos($post->post_content, '[delay_display') !== false) {
            $contest_content = true;
            break;
        }
    }
    if ($contest_content) {
        wp_register_style('contest_stylesheet', $cb_config['contestburner_url'] . "/ContestBurner/css/contest.css", false, CONTESTBURNER_VERSION);
        wp_enqueue_style('contest_stylesheet');
        wp_register_style('contest_ui_stylesheet', $cb_config['contestburner_url'] . "/ContestBurner/css/jquery-ui-1.8.21.custom.css", false, CONTESTBURNER_VERSION);
        wp_enqueue_style('contest_ui_stylesheet');
        wp_register_script('contestburner-js-globals', $cb_config['ajax_url'] . '?action=contestburner_js_globals', false, CONTESTBURNER_VERSION);
        wp_enqueue_script('contestburner-js-globals');
        wp_deregister_script('jquery');
        wp_register_script('jquery', $cb_config['contestburner_url'] . '/ContestBurner/js/jquery-1.7.2.min.js', false, CONTESTBURNER_VERSION);
        wp_enqueue_script('jquery');
        wp_deregister_script('jquery-ui-core');
        wp_register_script('jquery-ui-core', $cb_config['contestburner_url'] . '/ContestBurner/js/jquery.ui.core.min.js', array('jquery'), CONTESTBURNER_VERSION);
        wp_enqueue_script('jquery-ui-core');
        wp_deregister_script('jquery-ui-widget');
        wp_register_script('jquery-ui-widget', $cb_config['contestburner_url'] . '/ContestBurner/js/jquery.ui.widget.min.js', array('jquery', 'jquery-ui-core'), CONTESTBURNER_VERSION);
        wp_enqueue_script('jquery-ui-widget');
        wp_deregister_script('jquery-ui-position');
        wp_register_script('jquery-ui-position', $cb_config['contestburner_url'] . '/ContestBurner/js/jquery.ui.position.min.js', array('jquery', 'jquery-ui-widget'), CONTESTBURNER_VERSION);
        wp_enqueue_script('jquery-ui-position');
        wp_deregister_script('jquery-ui-mouse');
        wp_register_script('jquery-ui-mouse', $cb_config['contestburner_url'] . '/ContestBurner/js/jquery.ui.mouse.min.js', array('jquery', 'jquery-ui-widget'), CONTESTBURNER_VERSION);
        wp_enqueue_script('jquery-ui-mouse');
        wp_deregister_script('jquery-ui-draggable');
        wp_register_script('jquery-ui-draggable', $cb_config['contestburner_url'] . '/ContestBurner/js/jquery.ui.draggable.min.js', array('jquery', 'jquery-ui-widget'), CONTESTBURNER_VERSION);
        wp_enqueue_script('jquery-ui-draggable');
        wp_deregister_script('jquery-ui-resizable');
        wp_register_script('jquery-ui-resizable', $cb_config['contestburner_url'] . '/ContestBurner/js/jquery.ui.resizable.min.js', array('jquery', 'jquery-ui-widget'), CONTESTBURNER_VERSION);
        wp_enqueue_script('jquery-ui-resizable');
        wp_deregister_script('jquery-ui-dialog');
        wp_register_script('jquery-ui-dialog', $cb_config['contestburner_url'] . '/ContestBurner/js/jquery.ui.dialog.min.js', array('jquery', 'jquery-ui-resizable'), CONTESTBURNER_VERSION);
        wp_enqueue_script('jquery-ui-dialog');
        wp_register_script('jquery-smart-autocomplete', $cb_config['contestburner_url'] . '/ContestBurner/js/jquery.smart_autocomplete.js', array('jquery'), CONTESTBURNER_VERSION);
        wp_enqueue_script('jquery-smart-autocomplete');
        wp_register_script('contestburner-js', $cb_config['contestburner_url'] . '/ContestBurner/js/contest.js', array('jquery'), CONTESTBURNER_VERSION);
        wp_enqueue_script('contestburner-js');
    }
    return $posts;
}
add_filter('the_posts', 'contest_script_and_styles');
/**  * contest_styles()  *  * Include ContestBurner stylesheets in the header  *  * @package ContestBurner  * @global string $contestburner_url URL to ContestBurner  */
/**  * contest_scripts()  *  * Include ContestBurner required javascript in the header  *  * @package ContestBurner  */
/**  * contest_init()  *  * Include ContestBurner required javascript in the header  *  * @package ContestBurner  * @global string $contestburner_url URL to ContestBurner  */
function contest_init() {
    global $cb_config;
    if (isset($_GET['page']) && preg_match('/^contest_/', $_GET['page'])) {
        wp_register_script('contestburner-js-globals', $cb_config['ajax_url'] . '?action=contestburner_js_globals', false, CONTESTBURNER_VERSION);
        wp_enqueue_script('contestburner-js-globals');
        wp_deregister_script('jquery');
        wp_register_script('jquery', $cb_config['contestburner_url'] . '/ContestBurner/js/jquery-1.7.2.min.js', false, CONTESTBURNER_VERSION);
        wp_enqueue_script('jquery');
        wp_deregister_script('jquery-ui-core');
        wp_register_script('jquery-ui-core', $cb_config['contestburner_url'] . '/ContestBurner/js/jquery.ui.core.min.js', array('jquery'), CONTESTBURNER_VERSION);
        wp_deregister_script('jquery-ui-widget');
        wp_register_script('jquery-ui-widget', $cb_config['contestburner_url'] . '/ContestBurner/js/jquery.ui.widget.min.js', array('jquery', 'jquery-ui-core'), CONTESTBURNER_VERSION);
        wp_deregister_script('jquery-ui-tabs');
        wp_register_script('jquery-ui-tabs', $cb_config['contestburner_url'] . '/ContestBurner/js/jquery.ui.tabs.min.js', array('jquery', 'jquery-ui-widget'), CONTESTBURNER_VERSION);
        wp_enqueue_script('jquery-ui-tabs');
        wp_register_script('jquery-smart-autocomplete', $cb_config['contestburner_url'] . '/ContestBurner/js/jquery.smart_autocomplete.js', array('jquery'), CONTESTBURNER_VERSION);
        wp_enqueue_script('jquery-smart-autocomplete');
        wp_register_script('contestburner-admin', $cb_config['contestburner_url'] . '/ContestBurner/js/contestburner-admin.js', array('jquery'), CONTESTBURNER_VERSION);
        wp_enqueue_script('contestburner-admin');
    }
}
add_action('admin_init', 'contest_init');
add_action('admin_enqueue_scripts', 'contest_init');
function contest_ajax_get_points() {
    $source = empty($_POST['source']) ? null : $_POST['source'];
    $contest_id = empty($_POST['contest_id']) ? null : $_POST['contest_id'];
    $user_id = empty($_POST['user_id']) ? null : $_POST['user_id'];
    $points = 0;
    $cb = new ContestBurner($contest_id);
    $excluded_users = $cb->nd3215d01305eb544();
    if (!in_array($user_id, $excluded_users)) {
        $period = null;
        if (!empty($_POST['period'])) {
            $period = $_POST['period'];
        } elseif (!empty($_POST['start_date']) && !empty($_POST['end_date'])) {
            $period = array($_POST['start_date'], $_POST['end_date']);
        }
        if ($period !== null) {
            $points = $cb->n719ead823d1e298f($source, $user_id, $period);
        }
    }
    echo $points ? $points : 0;
    die();
}
add_action('wp_ajax_contest_ajax_get_points', 'contest_ajax_get_points');
add_action('wp_ajax_nopriv_contest_ajax_get_points', 'contest_ajax_get_points');
function contest_ajax_contestants_csv() {
    header('Content-type: application/csv');
    header('Content-Disposition: attachment; filename="' . $_POST['filename'] . '.csv"');
    die(stripslashes($_POST['csv']));
}
add_action('wp_ajax_contest_ajax_contestants_csv', 'contest_ajax_contestants_csv');
function contest_ajax_show_category_list() {
    $type = $_POST['type'];
    $selected = explode(",", $_POST['selected']);
    $form = $_POST['form'] ? true : false;
    $cb = new ContestBurner();
    $cb->n8ae684170087df70($type, $selected, $form);
    die();
}
add_action('wp_ajax_contest_ajax_show_category_list', 'contest_ajax_show_category_list');
function contest_ajax_get_contestants() {
    $contest_id = $_POST['contest_id'];
    $data_type = $_POST['data_type'];
    $cb = new ContestBurner();
    echo $cb->n53ccdebb073ae6ec($contest_id, true, $data_type);
    die();
}
add_action('wp_ajax_contest_ajax_get_contestants', 'contest_ajax_get_contestants');
add_action('wp_ajax_nopriv_contest_ajax_get_contestants', 'contest_ajax_get_contestants');
function n4fc8845aff1310d2() {
    $contest_id = $_GET['contest_id'];
    $cb = new ContestBurner($contest_id);
    $cb->n9d3f8559b8b6ccf3($cb->contest, true);
}
add_action('wp_ajax_contestburner_contestants_tab', 'n4fc8845aff1310d2');
add_action('wp_ajax_nopriv_contestburner_contestants_tab', 'n4fc8845aff1310d2');
function contest_filter($content) {
    $cb = new ContestBurner();
    return $cb->n24f1b69716ff3711($content);
}
add_filter('the_content', 'contest_filter', 99);
function contest_comment_post($comment_ID, $comment_status) {
    global $wpdb, $cb_config;
    if (empty($_POST['contest_id'])) return;
    if ($comment_ID > 0) {
        $cb = new ContestBurner();
        $usernames = null;
        $email = null;
        $name = null;
        if (!empty($_POST['contest_user_id'])) {
            $user_id = trim($_POST['contest_user_id']);
            $usernames = $cb->n800b0ab5ba2cb80e($user_id, 'user_id');
        } else if (!empty($_POST['contest_email'])) {
            $email = trim($_POST['contest_email']);
            $usernames = $cb->n800b0ab5ba2cb80e($email, 'email');
            $user_id = $usernames['user_id'];
        }
        if ($usernames) {
            $name = $usernames['display_name'] ? $usernames['display_name'] : ($usernames['contest'] ? $usernames['contest'] : $usernames['email']);
            $contest = $cb->n86d97a521be9b5f3($_POST['contest_id'], true);
            if ($contest) {
                $comment = get_comment($comment_ID);
                $comment_date = date("Y-m-d H:i:s", (strtotime($comment->comment_date) - ($cb_config['gmt_offset'] * 3600)));
                if (function_exists('add_comment_meta')) {
                    $contest_point = array('user_id' => $user_id, 'name' => $name, 'points' => $contest->options['comment_points'], 'contest_id' => $contest->contest_id, 'contest_cbdb_id' => $contest->contest_cbdb_id);
                    add_comment_meta($comment_ID, '_contest_points', $contest_point);
                    $click_link_id = 'C:' . $comment_ID . ';';
                } else {
                    $click_link_id = 'C:' . $comment_ID . ';P:' . $contest->options['comment_points'] . ';';
                    if ($comment_status != 1) {
                        $contest->options['comment_points'] = 0;
                    }
                }
                if (($comment_status == 1 || !function_exists('add_comment_meta'))) {
                    $recorded = $cb->n9233aa5d73a7536c($user_id, $click_link_id, $contest->options['comment_points'], $contest->contest_id, $contest->contest_cbdb_id, $comment_date, $contest->contest_startdate, $contest->contest_enddate, $comment->comment_author_IP, $contest->options['comment_max_points']);
                }
            }
        }
    }
}
add_action('comment_post', 'contest_comment_post', 50, 2);
function contest_comment_author($author) {
    global $cbdb, $comment, $cb_config;
    if (function_exists('get_comment_meta')) {
        $points = get_comment_meta($comment->comment_ID, '_contest_points', true);
        $name = isset($points['name']) ? $points['name'] : '';
    } else {
        $user_id = $cbdb->get_var("SELECT click_user_id FROM " . $cb_config['prefix'] . "clicks WHERE click_link_id LIKE 'C:" . $comment->comment_ID . ";%'");
        if ($user_id) {
            $cb = new ContestBurner();
            $usernames = $cb->n800b0ab5ba2cb80e($user_id, 'user_id');
            $name = $usernames['display_name'] ? $usernames['display_name'] : ($usernames['contest'] ? $usernames['contest'] : $usernames['email']);
        }
    }
    if (!empty($name)) {
        $author.= ' (' . $name . ')';
    }
    return $author;
}
add_filter('get_comment_author', 'contest_comment_author');
function contest_comment_status($comment_ID, $comment_status) {
    global $cbdb, $cb_config;
    if ($comment_ID > 0) {
        $comment = get_comment($comment_ID);
        if (($comment->comment_type == '') && (($comment_status == 1) || ($comment_status === "approve"))) {
            $cb = new ContestBurner();
            if (function_exists('get_comment_meta')) {
                $points = get_comment_meta($comment->comment_ID, '_contest_points');
            }
            if (!function_exists('get_comment_meta') || !is_array($points)) {
                $click_link_LIKE = 'C:' . $comment_ID . ';P:%';
                $clicks = $cbdb->get_results("SELECT * FROM " . $cb_config['prefix'] . "clicks WHERE click_link_id LIKE '" . $click_link_LIKE . "'");
                if ($clicks) {
                    $points = array();
                    foreach ($clicks as $click) {
                        if ($click->click_id > 0) {
                            $comment_points = preg_replace("/.*P:(\d+).*/", "$1", $click->click_link_id);
                            $points[] = array('user_id' => $click->click_user_id, 'points' => $comment_points, 'contest_id' => $click->click_contest_id, 'contest_cbdb_id' => $contest->contest_cbdb_id);
                        }
                    }
                }
            }
            if (is_array($points)) {
                $comment_date = date("Y-m-d H:i:s", (strtotime($comment->comment_date) - ($cb_config['gmt_offset'] * 3600)));
                $click_link_id = 'C:' . $comment->comment_ID . ';';
                foreach ($points as $point) {
                    $contest = $cb->n86d97a521be9b5f3($point['contest_id'], true);
                    $recorded = $cb->n9233aa5d73a7536c($point['user_id'], $click_link_id, $point['points'], $point['contest_id'], $point['contest_cbdb_id'], $comment_date, $contest->contest_startdate, $contest->contest_enddate, $comment->comment_author_IP, $contest->options['comment_max_points']);
                }
            }
        }
    }
}
add_action('wp_set_comment_status', 'contest_comment_status', 10, 2);
function contest_get_comment_username() {
    global $wpdb, $cb_user;
    $cb_user = null;
    $cb = new ContestBurner();
    $contests = $cb->n86d97a521be9b5f3(null, true);
    if (false !== $contests) {
        $current_date = gmdate("Y-m-d H:i:s");
        foreach ($contests as $contest) {
            if ($contest->options['points_for_comments'] == "1" && (($contest->contest_startdate < $current_date) && ($contest->contest_enddate > $current_date))) {
                $cb_user = isset($_COOKIE['cb_user_' . $contest->contest_id]) ? $_COOKIE['cb_user_' . $contest->contest_id] : null;
                if (!empty($cb_user)) $cb_user = unserialize(base64_decode($cb_user));
                if (isset($cb_user['user_id'])) {
                    $usernames = $cb->n800b0ab5ba2cb80e($cb_user['user_id'], 'user_id');
                    if ($usernames) {
                        $name = $usernames['display_name'] ? $usernames['display_name'] : ($usernames['contest'] ? $usernames['contest'] : $usernames['email']);
                        if ($name) { ?>        <div class="cb_user_div">         <?=CB_text('COMMENTING_AS', array($name, $usernames['email'])) ?><br/>         [&nbsp;<a href="" onClick="javascript:clear_cb_user();"><?=CB_text('IM_NOT_USERNAME', array($name)) ?></a>&nbsp;]         <input type="hidden" name="contest_user_id" id="contest_user_id" value="<?=$cb_user['user_id'] ?>">         <input type="hidden" name="contest_id" id="contest_id" value="<?=$contest->contest_id ?>">        </div>                             <script type="text/javascript">                                 function clear_cb_user(){                                     var expires = new Date();                                     expires.setTime(expires.getTime()-1);                                     document.cookie = "cb_user_<?=$contest->contest_id ?>=; expires='" + expires.toGMTString() + "'; path=/";                                 }                                 // var name =                                  document.getElementById("author").value = '<?=$name ?>';                                 document.getElementById("email").value = '<?=$usernames['email'] ?>';                             </script>        <?php break;
                        }
                    }
                } else { ?>      <div class="cb_user_form_div">       <p style="margin-top:-5px;" class="contest_username">        <label for="contest_email"><?php echo CB_text('CONTEST_EMAIL_LABEL'); ?> </label>         <input type="text" name="contest_email" id="contest_email" style="width:120px" value="">         <input type="hidden" name="contest_id" id="contest_id" value="<?=$contest->contest_id ?>">       </p>      </div>      <?php break;
                }
            }
        }
    }
}
add_action('comment_form', 'contest_get_comment_username', 0);
function contest_redirect($url = null) {
    global $cbdb, $post, $cb_config;
    $gmt_offset = $cb_config['gmt_offset'];
    $cb = new ContestBurner();
    $current_date = gmdate("Y-m-d H:i:s");
    if ($post && $post->ID > 0) {
        $award_points = get_post_meta($post->ID, "_award_points", true);
        if ($award_points == '1') {
            $link = $cbdb->get_row("SELECT * FROM " . $cb_config['prefix'] . "links WHERE link_post_id = " . $post->ID);
            if ($link->link_points > 0) {
                if (isset($_COOKIE['cb_user_' . $link->link_contest_id])) {
                    $contest = $cb->n86d97a521be9b5f3($link->link_contest_id);
                    $cb_user = unserialize(base64_decode($_COOKIE['cb_user_' . $contest->contest_id]));
                    if ((($contest->contest_startdate < $current_date) && ($contest->contest_enddate > $current_date)) || ($contest->contest_startdate == '0000-00-00 00:00:00')) {
                        if (strlen($cb_user['user_id']) > 0) {
                            $ip_address = CB_get_ip();
                            $cb->n9233aa5d73a7536c($cb_user['user_id'], $link->link_id, $link->link_points, $contest->contest_id, $contest->contest_cbdb_id, $current_date, $contest->contest_startdate, $contest->contest_enddate, $ip_address);
                            setcookie("cb_post_points", $cb_user['user_id'] . ':' . $link->link_points, time() + 3600 * 24 * 365, "/");
                        }
                    }
                }
            }
        }
    }
    $cb->nf17ca2c829680ada();
    return $url;
}
add_filter('wp_redirect', 'contest_redirect');
add_action('template_redirect', 'contest_redirect');
function contest_ajax_has_post_points() {
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : null;
    $key = '_award_points';
    $award_points = get_post_meta($post_id, $key, true);
    echo empty($award_points) ? '0' : $award_points;
    die();
}
add_action('wp_ajax_contest_ajax_has_post_points', 'contest_ajax_has_post_points');
function contest_points_meta_box() {
    global $cbdb, $cb_config, $post, $premium_msg;
    $key = '_award_points';
    $award_points = get_post_meta($post->ID, $key, true);
    $cb = new ContestBurner();
    $cb->n2e1ab4adfc051de5($post->ID, $award_points);
}
function contest_add_points_box() {
    add_meta_box('contest_points', __('Contest Points', 'contest'), 'contest_points_meta_box', 'post', 'side');
    add_meta_box('contest_points', __('Contest Points', 'contest'), 'contest_points_meta_box', 'page', 'side');
}
add_action('admin_menu', 'contest_add_points_box');
function contest_save_post($post_id, $post) {
    global $wpdb, $cb_config;
    if ($post->post_type == 'revision') {
        return;
    }
    if (!$post_id) $post_id = $post->ID;
    if (!$post_id) return $post;
    $key = '_award_points';
    $award_points_meta = get_post_meta($post_id, $key, true);
    if (isset($_POST['award_points'])) {
        $cb = new ContestBurner();
        $award_points = stripslashes($_POST['award_points']);
        $contest = stripslashes($_POST['link_contest_id']);
        $points = stripslashes($_POST['link_points']);
        if ($award_points_meta) {
            update_post_meta($post_id, $key, $award_points);
        } else {
            add_post_meta($post_id, $key, $award_points, true);
        }
        $_POST['link_path'] = ucfirst($post->post_type);
        $_POST['link_description'] = _('Points for Viewing') . ' ' . ucfirst($post->post_type) . ':<br/>"' . $post->post_title . '"';
        $msg = $cb->n79511abf76b1c0bf($post);
    } elseif ($award_points_meta != '') {
        delete_post_meta($post_id, $key);
        $wpdb->query($wpdb->prepare("DELETE FROM " . $cb_config['prefix'] . "links WHERE link_id = %d", $_POST['link_id']));
    }
    return $post;
}
add_action('save_post', 'contest_save_post', 11, 2);
function contest_delete_post($post_id) {
    global $wpdb, $cb_config;
    if ($post_id > 0) {
        $wpdb->query("DELETE FROM " . $cb_config['prefix'] . "links WHERE link_post_id = " . $post_id);
    }
    return true;
}
add_action('delete_post', 'contest_delete_post');
function contest_select_winners() {
    $cb = new ContestBurner();
    $cb->n1eadea7e5c317f77();
    die();
}
add_action('wp_ajax_contest_select_winners', 'contest_select_winners');
function contest_ajax_email_form() {
    $cb = new ContestBurner();
    $cb->n4b657d29316b846d();
    die();
}
add_action('wp_ajax_contest_ajax_email_form', 'contest_ajax_email_form');
add_action('wp_ajax_nopriv_contest_ajax_email_form', 'contest_ajax_email_form');
function contest_ajax_contestant_point_summary() {
    $cb = new ContestBurner();
    $cb->ne904226c05dd7159();
    die();
}
add_action('wp_ajax_contestant_point_summary', 'contest_ajax_contestant_point_summary');
add_action('wp_ajax_nopriv_contestant_point_summary', 'contest_ajax_contestant_point_summary');
function contest_ajax_change_page() {
    $cb = new ContestBurner();
    $cb->n7f16e83c58d0a591();
    die();
}
add_action('wp_ajax_contest_change_page', 'contest_ajax_change_page');
add_action('wp_ajax_nopriv_contest_change_page', 'contest_ajax_change_page');
function contest_ajax_contestant_point_detail() {
    $cb = new ContestBurner();
    $cb->n588acae7b80b3f3d();
    die();
}
add_action('wp_ajax_contestant_point_detail', 'contest_ajax_contestant_point_detail');
add_action('wp_ajax_nopriv_contestant_point_detail', 'contest_ajax_contestant_point_detail');
function contest_winners_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array('contest' => ''), $atts);
    $contest_winners_html = '';
    $cb = new ContestBurner($atts['contest']);
    $contest_winners_html = $cb->n2f508ec83926dfa1($cb->contest);
    return $contest_winners_html;
}
add_shortcode('contest_winners', 'contest_winners_shortcode');
function contest_delay_display_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array('id' => 'contest_delay_display', 'delay' => 1000), $atts);
    $delay_content = do_shortcode($content);
    $cb = new ContestBurner();
    $delay_content = $cb->n3b6b086f1e4c2979($atts, $delay_content);
    return $delay_content;
}
add_shortcode('delay_display', 'contest_delay_display_shortcode');
function contest_leaders_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array('contest' => '', 'winners' => false, 'limit' => '', 'per_page' => 50, 'min_points' => 1), $atts);
    $cb = new ContestBurner();
    $contest_leaders_html = contest_leaders($cb, $atts['contest'], $atts['winners'], $atts['limit'], $atts['per_page'], $atts['min_points'], current_user_can('administrator'));
    return $contest_leaders_html;
}
add_shortcode('contest_leaders', 'contest_leaders_shortcode');
function contest_fb_comments_shortcode($atts) {
    global $post;
    $atts = shortcode_atts(array('contest' => '', 'width' => '100%', 'numposts' => '5', 'ajax' => '0'), $atts);
    $cb = new ContestBurner();
    $html = contest_fb_comments($cb, $atts['contest'], $atts['width'], $atts['numposts'], $atts['ajax']);
    return $html;
}
add_shortcode('contest_fb_comments', 'contest_fb_comments_shortcode');
function contest_fb_comments_box($contest_slug = null, $width = "500", $numposts = "5") {
    $html = do_shortcode('[contest_fb_comments contest="' . $contest_slug . '" width="' . $width . '" numposts="' . $numposts . '"]');
    echo $html;
}
function contest_ajax_fb_comments_box() {
    $atts = $_REQUEST;
    $cb = new ContestBurner();
    $cb->n4d1da26755f0ec9d($atts['contest'], $atts['width'], $atts['numposts'], true);
}
add_action('wp_ajax_contest_ajax_fb_comments_box', 'contest_ajax_fb_comments_box');
add_action('wp_ajax_nopriv_contest_ajax_fb_comments_box', 'contest_ajax_fb_comments_box');
function contest_ajax_fb_comments_widget() {
    $cb = new ContestBurner();
    fb_comments_widget($cb);
    die();
}
add_action('wp_ajax_contest_ajax_fb_comments_widget', 'contest_ajax_fb_comments_widget');
add_action('wp_ajax_nopriv_contest_ajax_fb_comments_widget', 'contest_ajax_fb_comments_widget');
function contest_ajax_do_events() {
    $cb = new ContestBurner();
    if (!empty($_GET['c'])) {
        $cb->na4bbd016034e6493($_GET['c']);
    }
    die();
}
add_action('wp_ajax_contest_ajax_do_events', 'contest_ajax_do_events');
add_action('wp_ajax_nopriv_contest_ajax_do_events', 'contest_ajax_do_events');
function nb1544a6de0e22df5() {
    echo ContestBurner::content_type('js');
    echo ContestBurner::cache_control();
    echo ContestBurner::javascript_globals();
    die();
}
add_action('wp_ajax_contestburner_js_globals', 'nb1544a6de0e22df5');
add_action('wp_ajax_nopriv_contestburner_js_globals', 'nb1544a6de0e22df5');
function contest_restrict_content_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array('contest' => '', 'min_points' => 0), $atts);
    $cb = new ContestBurner();
    $html = $cb->n95563a0d8f871d42($atts['contest'], $atts['min_points'], $content);
    $html = do_shortcode($html);
    return $html;
}
add_shortcode('contest_restrict_content', 'contest_restrict_content_shortcode');
function ne30ae7e4d32f4628($atts, $content = null) {
    $atts = shortcode_atts(array('contest' => '', 'redirect_on_entry' => '', 'affiliate_url' => '', 'show_status' => 0, 'enter_with_facebook' => 1, 'enter_with_email' => 1), $atts);
    $entry_methods = array('enter_with_facebook' => $atts['enter_with_facebook'], 'enter_with_email' => $atts['enter_with_email'],);
    $show_affurl = false;
    if (strtolower($atts['affiliate_url']) == 'yes') {
        $show_affurl = true;
    }
    $cb = new ContestBurner();
    $html = $cb->nc1bd2db5fed045ef($atts['contest'], $atts['redirect_on_entry'], $show_affurl, current_user_can('administrator'), $entry_methods);
    return $html;
}
add_shortcode('contestburner_entry_form', 'ne30ae7e4d32f4628');
function ne4078bde936acc83() {
    $redirect_on_entry = $_GET['redirect_on_entry'] ? urldecode($_GET['redirect_on_entry']) : 0;
    $post_id = $_GET['post_id'] ? $_GET['post_id'] : 0;
    $tracking_id = $_GET['tid'] ? $_GET['tid'] : '';
    $entry_methods = array('enter_with_facebook' => $_GET['enter_with_facebook'], 'enter_with_email' => $_GET['enter_with_email'],);
    $cb = new ContestBurner();
    contestburner_entry_form($cb, $_GET['contest'], $_GET['show_affurl'], current_user_can('administrator'), $redirect_on_entry, $post_id, $entry_methods, $tracking_id);
    die();
}
add_action('wp_ajax_contestburner_entry_form', 'ne4078bde936acc83');
add_action('wp_ajax_nopriv_contestburner_entry_form', 'ne4078bde936acc83');
function n8176b7afc5fc5271() {
    $cb = new ContestBurner();
    $cb->n3cfbc7967abc50c5(current_user_can('administrator'));
    die();
}
add_action('wp_ajax_contestburner_enter_contest', 'n8176b7afc5fc5271');
add_action('wp_ajax_nopriv_contestburner_enter_contest', 'n8176b7afc5fc5271');
function contest_save_affurl() {
    global $wpdb, $contest_cbdb_url;
    $cb = new ContestBurner();
    $cb->ne47a5d5f66c9ca44();
    die();
}
add_action('wp_ajax_contest_save_affurl', 'contest_save_affurl');
add_action('wp_ajax_nopriv_contest_save_affurl', 'contest_save_affurl');
function contest_save_youtube_username() {
    global $wpdb, $contest_cbdb_url;
    $cb = new ContestBurner();
    echo $cb->n759c7858448bd941($_POST['user_id'], 'youtube', $_POST['youtube_username']);
    die();
}
add_action('wp_ajax_contest_save_youtube_username', 'contest_save_youtube_username');
add_action('wp_ajax_nopriv_contest_save_youtube_username', 'contest_save_youtube_username');
function contest_save_pinterest_username() {
    global $wpdb, $contest_cbdb_url;
    $cb = new ContestBurner();
    echo $cb->n759c7858448bd941($_POST['user_id'], 'pinterest', $_POST['pinterest_username']);
    die();
}
add_action('wp_ajax_contest_save_pinterest_username', 'contest_save_pinterest_username');
add_action('wp_ajax_nopriv_contest_save_pinterest_username', 'contest_save_pinterest_username');
function contest_ajax_record_points() {
    $cb = new ContestBurner();
    $user_id = $_POST['user_id'];
    $click_cbdb_id = $_POST['point_cbdb_id'];
    $click_link_id = $_POST['link_id'];
    $points = $_POST['points'];
    $contest_id = $_POST['site_contest_id'];
    $contest_cbdb_id = $_POST['cbdb_contest_id'];
    $published = $_POST['date'];
    $contest_startdate = empty($_POST['contest_startdate']) ? null : $_POST['contest_startdate'];
    $contest_enddate = empty($_POST['contest_enddate']) ? null : $_POST['contest_enddate'];
    $ipaddress = empty($_POST['ip']) ? null : $_POST['ip'];
    $max_points = empty($_POST['max_points']) ? null : $_POST['max_points'];
    $click_id = $cb->n9233aa5d73a7536c($user_id, $click_link_id, $points, $contest_id, $contest_cbdb_id, $published, $contest_startdate, $contest_enddate, $ipaddress, $max_points, $click_cbdb_id);
    echo $click_id;
    die();
}
add_action('wp_ajax_contest_record_points', 'contest_ajax_record_points');
add_action('wp_ajax_nopriv_contest_record_points', 'contest_ajax_record_points');
function contest_manual_points() {
    $cb = new ContestBurner();
    $cb->nfad17fb778e6177a();
    die();
}
add_action('wp_ajax_contest_manual_points', 'contest_manual_points');
function contest_display_selected_categories() {
    $cb = new ContestBurner();
    $cb->n364d818423905e5c();
    die();
}
add_action('wp_ajax_contest_display_selected_categories', 'contest_display_selected_categories');
function contest_select_a_winner() {
    $cb = new ContestBurner();
    $cb->nf17fd640d54f6941();
    die();
}
add_action('wp_ajax_select_a_winner', 'contest_select_a_winner');
function contest_get_contest_post_urls() {
    if (isset($_POST['start'])) {
        if ($_POST['contest_links_post_id'] > 0) {
            $post_title = get_post_field('post_title', $_POST['contest_links_post_id']);
            $contest_links_post_updated = wp_update_post(array('ID' => $_POST['contest_links_post_id'], 'post_status' => 'publish'));
        }
        if ($_POST['contest_leaders_post_id'] > 0) {
            $post_title = get_post_field('post_title', $_POST['contest_leaders_post_id']);
            $contest_leaders_post_updated = wp_update_post(array('ID' => $_POST['contest_leaders_post_id'], 'post_status' => 'publish'));
        }
    }
    if (!empty($_POST['contest_name'])) {
        $_POST['contest_slug'] = (isset($_POST['contest_slug'])) ? strtolower(trim($_POST['contest_slug'])) : strtolower(trim($_POST['contest_name']));
        $_POST['contest_slug'] = preg_replace(array('/\W/', '/\_+/'), array("_", "_"), $_POST['contest_slug']);
        if ($_POST['contest_leaders_post_id'] == 'C') {
            $_POST['contest_leaders_post_id'] = wp_insert_post(array('post_status' => 'draft', 'post_type' => 'page', 'post_title' => $_POST['contest_name'] . ' Leaders', 'post_content' => '[contest_leaders contest="' . $_POST['contest_slug'] . '"]'));
        }
        if ($_POST['contest_links_post_id'] == 'C') {
            $_POST['contest_links_post_id'] = wp_insert_post(array('post_status' => 'draft', 'post_type' => 'page', 'post_title' => $_POST['contest_name'], 'post_content' => '[contestburner_entry_form contest="' . $_POST['contest_slug'] . '"]'));
        }
    }
    $_POST['contest_links_url'] = get_permalink($_POST['contest_links_post_id']);
    $_POST['contest_leaders_url'] = get_permalink($_POST['contest_leaders_post_id']);
}
function contest_create_pages($contest_links_post_id, $contest_leaders_post_id) {
    global $post; ?>  <div id="contest_create_pages">   <table class="form-table cb-table">    <tr>     <th scope="row"><?php echo _('Contest Links Page') ?>:</th>     <td>      <select name="contest_links_post_id">      <option value="C">Create a Contest Links page for me</option>      <?php $args = array('post_type' => 'page', 'numberposts' => - 1, 'post_status' => 'draft, publish, future');
    $pages = get_posts($args);
    if ($pages) {
        foreach ($pages as $post) {
            echo '<option value="' . $post->ID . '" ' . ($contest_links_post_id == $post->ID ? 'selected="selected"' : '') . '>(' . $post->ID . ') ' . $post->post_title . '</option>';
        }
    } ?>      </select>      <br/>This is the page your users will visit to join your contest.     </td>    </tr>    <tr>     <th scope="row"><?php echo _('Contest Leaders Page') ?>:</th>     <td>      <select name="contest_leaders_post_id">      <option value="C">Create a Contest Leaders page for me</option>      <?php $args = array('post_type' => 'page', 'numberposts' => - 1, 'post_status' => 'draft, publish, future');
    $pages = get_posts($args);
    if ($pages) {
        foreach ($pages as $post) {
            echo '<option value="' . $post->ID . '" ' . ($contest_leaders_post_id == $post->ID ? 'selected="selected"' : '') . '>(' . $post->ID . ') ' . $post->post_title . '</option>';
        }
    } ?>      </select>      <br/>This is the page to display the contest points leaders.     </td>    </tr>   </table>   <br/>  </div>  <?php
}
function contest_save_contest() {
    global $cbdb;
    $cb = new ContestBurner();
    contest_get_contest_post_urls();
    $cb->n12a9efd0d4841055();
    die();
}
add_action('wp_ajax_contest_save_contest', 'contest_save_contest');
function contest_get_fbpage_id() {
    $cb = new ContestBurner();
    $cb->n4359e09a3539e917();
    die();
}
add_action('wp_ajax_contest_get_fbpage_id', 'contest_get_fbpage_id');
function contest_winners_list() {
    $cb = new ContestBurner();
    echo $cb->n02279f3542f4dd9b();
    die();
}
add_action('wp_ajax_contest_winners_list', 'contest_winners_list');
function contest_add_link($contest_id = 0, $wrapit = true) {
    global $wp_rewrite;
    $htaccess = false;
    if (is_object($wp_rewrite) && $wp_rewrite->using_permalinks() === true) {
        $htaccess = true;
    }
    $cb = new ContestBurner();
    if ($wrapit) { ?>   <div class="contestburner_admin_wrapper">    <?php screen_icon('contest'); ?>    <h2><?php _e('Add a New Contest Link', 'contest') ?></h2>     <?php
    }
    $cb->n59ad11d871012061($contest_id, $wrapit, $htaccess);
    if ($wrapit) {
        $cb->n9ac7d2a38f768b52(); ?>   </div>   <?php
    }
}
function contest_edit() {
    global $cb_config;
    $cb = new ContestBurner(); ?>  <div class="contestburner_admin_wrapper">   <link type="text/css" href="<?php echo $cb_config['contestburner_url']; ?>/ContestBurner/css/smoothness/jquery-ui-1.8.1.custom.css" rel="stylesheet" />   <!-- script type="text/javascript" src="<?php echo $cb_config['contestburner_url']; ?>/js/jquery-ui-1.8.1.custom.min.js"></script -->    <?php screen_icon('contest'); ?>   <h2><?php _e('Contests', 'contest') ?></h2>   <?php $cb->n76dbe2c7d6bda3c0(); ?>  </div>  <?php
}
function contest_settings() {
    $cb = new ContestBurner();
    echo '<div class="contestburner_admin_wrapper">';
    screen_icon('contest');
    $cb->n7080713e93d3da17();
    echo '</div>';
}
function contest_edit_contest() {
    $cb = new ContestBurner();
    if (isset($_POST['contest_add_contest_submit'])) {
        contest_get_contest_post_urls();
    }
    echo '<div class="contestburner_admin_wrapper">';
    screen_icon('contest');
    $cb->nf4f4859ef77218b9(true);
    echo '</div>';
}
add_action('wp_ajax_contest_edit_contest', 'contest_edit_contest');
function contest_widget_foot() {
    echo base64_decode('PHAgc3R5bGU9InRleHQtYWxpZ246Y2VudGVyO21hcmdpbi10b3A6MTBweDsiPkNvbnRlc3QgcG93ZXJlZCBieTo8YnIvPjxhIGhyZWY9Imh0dHA6Ly93d3cuY29udGVzdGJ1cm5lci5jb20iPkNvbnRlc3QgQnVybmVyPC9hPjwvcD4');
}
function contest_sidebar($sidebars_widgets) {
    global $contest_options;
    $cb = new ContestBurner();
    $sidebar_contest_key = $cb->n1ed3f25239713ac7();
    if (!is_admin()) {
        if (!$sidebar_contest_key || (isset($contest_options['contest_footer']) && $contest_options['contest_footer'])) {
            $added = false;
            if (is_array($sidebars_widgets)) {
                foreach ($sidebars_widgets as $key => $value) {
                    if ('wp_inactive_widgets' == $key) continue;
                    if (count($sidebars_widgets[$key]) > 0) {
                        register_sidebar_widget('ContestBurner', 'contest_widget_foot');
                        $sidebars_widgets[$key][] = 'contestburner';
                        $added = true;
                        break;
                    }
                }
            }
            if (!$added) {
                add_filter('wp_meta', 'contest_widget_foot');
            }
        }
    }
    return $sidebars_widgets;
}
add_filter('sidebars_widgets', 'contest_sidebar');
function contest_add_menus() {
    global $cb_config, $settings;
    $cb = new ContestBurner();
    $settings = $cb->ncb935a48ba69e62d();
    if (isset($settings['contest_version'])) {
        if (strnatcmp($settings['contest_version'], CONTESTBURNER_VERSION) < 0) {
            $cb->install();
        }
        add_menu_page(__('Contests', 'contest'), __('ContestBurner', 'contest'), 'edit_pages', 'contest_menu', 'contest_edit', $cb_config['contestburner_url'] . '/ContestBurner/images/contest_16.gif');
        add_submenu_page('contest_menu', __("ContestBurner : Contests", 'contest'), __("Contests", 'contest'), 'edit_pages', 'contest_menu', 'contest_edit');
        add_submenu_page('contest_menu', __("ContestBurner : Add Contest", 'contest'), __("Add Contest", 'contest'), 'edit_pages', 'contest_add_contest_menu', 'contest_edit_contest');
        add_submenu_page('contest_menu', __("ContestBurner : Add Link", 'contest'), __("Add Link", 'contest'), 'edit_pages', 'contest_add_link_menu', 'contest_add_link');
        add_submenu_page('contest_menu', __("ContestBurner : Settings", 'contest'), __("Settings", 'contest'), 'edit_pages', 'contest_settings_menu', 'contest_settings');
        if (isset($_GET['page']) && preg_match('/^contest_/', $_GET['page'])) {
            wp_register_style('contest_admin_stylesheet', $cb_config['contestburner_url'] . "/ContestBurner/css/contest-admin.css", false, CONTESTBURNER_VERSION);
            wp_enqueue_style('contest_admin_stylesheet');
        }
    }
}
add_action('admin_menu', 'contest_add_menus');
function contest_install($networkwide) {
    global $wpdb, $cb_config;
    $cb = new ContestBurner();
    if (function_exists('is_multisite') && is_multisite()) {
        if ($networkwide) {
            $blogids = $wpdb->n9fa3a00b933cb236("SELECT blog_id FROM $wpdb->blogs");
            foreach ($blogids as $blog_id) {
                switch_to_blog($blog_id);
                $cb_config['prefix'] = $wpdb->prefix . "cb3_";
                $cb->install();
                restore_current_blog();
            }
            return;
        }
    }
    $cb->install();
}
register_activation_hook('index.php', 'contest_install');
function contest_newblog($blog_id, $user_id, $domain, $path, $site_id, $meta) {
    global $wpdb, $cb_config;
    if (is_plugin_active_for_network($cb_config["basename"])) {
        switch_to_blog($blog_id);
        $cb = new ContestBurner();
        $cb->install();
        restore_current_blog();
    }
}
add_action('wpmu_new_blog', 'contest_newblog', 10, 6); ?>