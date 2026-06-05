<?php
/*
Plugin Name: CountDown With Image or Video Background
Description: You can use it as CountDown for: websites under construction, last minute offers, coming events, launching a new product, discounts interval… and much more
Version: 1.3.6
Author: Lambert Group
Author URI: https://codecanyon.net/user/LambertGroup/portfolio?ref=LambertGroup
*/

$countdown_with_background_path = trailingslashit(dirname(__FILE__));  //empty

//all the messages
$countdown_with_background_messages = array(
		'version' => '<div class="error">WordPress WordPress CountDown With Image or Video Background  plugin requires WordPress 3.0 or newer. <a href="https://codex.wordpress.org/Upgrading_WordPress">Please update!</a></div>',
		'empty_img' => 'Image - required',
		'empty_name' => 'Name - required',
		'invalid_request' => 'Invalid Request!',
		'generate_for_this_countdown' => 'You can start customizing this CountDown.',
		'data_saved' => 'Data Saved!'
	);


global $wp_version;

if ( !version_compare($wp_version,"3.0",">=")) {
	die ($countdown_with_background_messages['version']);
}




function countdown_with_background_activate() {
	//db creation, create admin options etc.
	global $wpdb;

	$currentY=date("Y");
	$currentM=date("n");
	$currentD=date("j");
	$currentH=date("H");
	$currentMin=date("i");
	$currentS=date("s");

	//$wpdb->show_errors();

	$countdown_with_background_collate = ' COLLATE utf8_general_ci';

	$sql0 = "CREATE TABLE `" . $wpdb->prefix . "countdown_with_background_countdowns` (
			`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
			`name` VARCHAR( 255 ) NOT NULL ,
			PRIMARY KEY ( `id` )
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sql1 = "CREATE TABLE `" . $wpdb->prefix . "countdown_with_background_settings` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `beginDate_date` varchar(255) NOT NULL DEFAULT '".($currentY-1).','.$currentM.','.$currentD."',
  `beginDate_hours` smallint(5) unsigned NOT NULL DEFAULT '".$currentH."',
  `beginDate_minutes` smallint(5) unsigned NOT NULL DEFAULT '".$currentMin."',
  `beginDate_seconds` smallint(5) unsigned NOT NULL DEFAULT '".$currentS."',
  `endDate_date` varchar(255) NOT NULL DEFAULT '".($currentY+1).','.$currentM.','.$currentD."',
  `endDate_hours` smallint(5) unsigned NOT NULL DEFAULT '".$currentH."',
  `endDate_minutes` smallint(5) unsigned NOT NULL DEFAULT '".$currentMin."',
  `endDate_seconds` smallint(5) unsigned NOT NULL DEFAULT '".$currentS."',
  `servertime` varchar(8) NOT NULL DEFAULT 'true',
  `responsive` varchar(8) NOT NULL DEFAULT 'true',
  `enableMaintenanceMode` varchar(8) NOT NULL DEFAULT 'true',
  `pageBg` text,
  `pageBgHexa` varchar(8) NOT NULL DEFAULT '',
  `pageBgAdditionalCss` varchar(255) NOT NULL DEFAULT '',
  `pluginFontFamily` varchar(255) NOT NULL DEFAULT 'PT Serif, serif',
  `pluginFontFamilyGoogleLink` varchar(255) NOT NULL DEFAULT 'https://fonts.googleapis.com/css?family=PT+Serif:400,700',
  `circleRadius` smallint(5) unsigned NOT NULL DEFAULT '108',
  `circleLineWidth` smallint(5) unsigned NOT NULL DEFAULT '14',
  `behindCircleLineWidthExpand` smallint(5) unsigned NOT NULL DEFAULT '0',
  `circleTopBottomPadding` smallint(5) unsigned NOT NULL DEFAULT '20',
  `circleLeftRightPadding` smallint(5) unsigned NOT NULL DEFAULT '30',
  `numberSize` smallint(5) unsigned NOT NULL DEFAULT '60',
  `numberAdditionalTopPadding` smallint(5) NOT NULL DEFAULT '2',
  `textSize` smallint(5) unsigned NOT NULL DEFAULT '24',
  `textMarginTop` smallint(5) NOT NULL DEFAULT '18',
  `textPadding` smallint(5) NOT NULL DEFAULT '15',
  `lineSeparatorImg` text,
  `logo` text,
  `logoLink` text,
  `logoTarget` varchar(8) NOT NULL DEFAULT '_blank',
  `allCirclesTopMargin` smallint(5) NOT NULL DEFAULT '0',
  `allCirclesBottomMargin` smallint(5) NOT NULL DEFAULT '80',
  `divBackgroundDaysHexa` varchar(8) NOT NULL DEFAULT '',
  `divBackgroundDaysImg` text,
  `borderTopColorDays` varchar(8) NOT NULL DEFAULT '',
  `borderRightColorDays` varchar(8) NOT NULL DEFAULT '',
  `borderBottomColorDays` varchar(8) NOT NULL DEFAULT '',
  `borderLeftColorDays` varchar(8) NOT NULL DEFAULT '',
  `circleColorDays` varchar(8) NOT NULL DEFAULT 'dd1e2f',
  `circleAlphaDays` smallint(5) unsigned NOT NULL DEFAULT '100',
  `behindCircleColorDays` varchar(8) NOT NULL DEFAULT '000000',
  `behindCircleAlphaDays` smallint(5) unsigned NOT NULL DEFAULT '50',
  `numberColorDays` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `textColorDays` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `textBackgroundDaysHexa` varchar(8) NOT NULL DEFAULT '',
  `textBackgroundDaysImg` text,
  `translateDays` varchar(255) DEFAULT 'DAYS',
  `divBackgroundHoursHexa` varchar(8) NOT NULL DEFAULT '',
  `divBackgroundHoursImg` text,
  `borderTopColorHours` varchar(8) NOT NULL DEFAULT '',
  `borderRightColorHours` varchar(8) NOT NULL DEFAULT '',
  `borderBottomColorHours` varchar(8) NOT NULL DEFAULT '',
  `borderLeftColorHours` varchar(8) NOT NULL DEFAULT '',
  `circleColorHours` varchar(8) NOT NULL DEFAULT 'ebb035',
  `circleAlphaHours` smallint(5) unsigned NOT NULL DEFAULT '100',
  `behindCircleColorHours` varchar(8) NOT NULL DEFAULT '000000',
  `behindCircleAlphaHours` smallint(5) unsigned NOT NULL DEFAULT '50',
  `numberColorHours` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `textColorHours` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `textBackgroundHoursHexa` varchar(8) NOT NULL DEFAULT '',
  `textBackgroundHoursImg` text,
  `translateHours` varchar(255) DEFAULT 'HOURS',
  `divBackgroundMinutesHexa` varchar(8) NOT NULL DEFAULT '',
  `divBackgroundMinutesImg` text,
  `borderTopColorMinutes` varchar(8) NOT NULL DEFAULT '',
  `borderRightColorMinutes` varchar(8) NOT NULL DEFAULT '',
  `borderBottomColorMinutes` varchar(8) NOT NULL DEFAULT '',
  `borderLeftColorMinutes` varchar(8) NOT NULL DEFAULT '',
  `circleColorMinutes` varchar(8) NOT NULL DEFAULT '06a2cb',
  `circleAlphaMinutes` smallint(5) unsigned NOT NULL DEFAULT '100',
  `behindCircleColorMinutes` varchar(8) NOT NULL DEFAULT '000000',
  `behindCircleAlphaMinutes` smallint(5) unsigned NOT NULL DEFAULT '50',
  `numberColorMinutes` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `textColorMinutes` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `textBackgroundMinutesHexa` varchar(8) NOT NULL DEFAULT '',
  `textBackgroundMinutesImg` text,
  `translateMinutes` varchar(255) DEFAULT 'MINUTES',
  `divBackgroundSecondsHexa` varchar(8) NOT NULL DEFAULT '',
  `divBackgroundSecondsImg` text,
  `borderTopColorSeconds` varchar(8) NOT NULL DEFAULT '',
  `borderRightColorSeconds` varchar(8) NOT NULL DEFAULT '',
  `borderBottomColorSeconds` varchar(8) NOT NULL DEFAULT '',
  `borderLeftColorSeconds` varchar(8) NOT NULL DEFAULT '',
  `circleColorSeconds` varchar(8) NOT NULL DEFAULT '218559',
  `circleAlphaSeconds` smallint(5) unsigned NOT NULL DEFAULT '100',
  `behindCircleColorSeconds` varchar(8) NOT NULL DEFAULT '000000',
  `behindCircleAlphaSeconds` smallint(5) unsigned NOT NULL DEFAULT '50',
  `numberColorSeconds` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `textColorSeconds` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `textBackgroundSecondsHexa` varchar(8) NOT NULL DEFAULT '',
  `textBackgroundSecondsImg` text,
  `translateSeconds` varchar(255) DEFAULT 'SECONDS',
  `socialBgOFF` text,
  `socialBgON` text,
  `complete` text,
  `autoReset24h` varchar(8) NOT NULL DEFAULT 'false',
  `h2Text` text,
  `h2Size` smallint(5) unsigned NOT NULL DEFAULT '36',
  `h2Color` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `h2Weight` varchar(255) NOT NULL DEFAULT 'bold',
  `h2TopMargin` smallint(5) NOT NULL DEFAULT '60',
  `h3Text` text,
  `h3Size` smallint(5) unsigned NOT NULL DEFAULT '24',
  `h3Color` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `h3Weight` varchar(255) NOT NULL DEFAULT 'normal',
  `h3TopMargin` smallint(5) NOT NULL DEFAULT '0',
  `h4Text` text,
  `h4Size` smallint(5) unsigned NOT NULL DEFAULT '16',
  `h4Color` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `h4Weight` varchar(255) NOT NULL DEFAULT 'normal',
  `h4TopMargin` smallint(5) NOT NULL DEFAULT '15',
  `p_tag_content` text,
  `defaultTextSize` smallint(5) unsigned NOT NULL DEFAULT '14',
  `defaultTextColor` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `defaultTextWeight` varchar(255) NOT NULL DEFAULT 'normal',
  `defaultTextTopMargin` smallint(5) NOT NULL DEFAULT '0',
  `defaultTextLinkSize` smallint(5) unsigned NOT NULL DEFAULT '14',
  `defaultTextLinkColor` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `defaultTextLinkWeight` varchar(255) NOT NULL DEFAULT 'normal',
  `autoPlay` smallint(5) unsigned NOT NULL DEFAULT '6',
  `loop` varchar(8) NOT NULL DEFAULT 'true',
  `fadeSlides` varchar(8) NOT NULL DEFAULT 'true',
  `texturePath` text,
  `initialOpacity` smallint(5) unsigned NOT NULL DEFAULT '1',
  `target` varchar(8) NOT NULL DEFAULT '_blank',
  `enableTouchScreen` varchar(8) NOT NULL DEFAULT 'true',
  `videoProportionWidth` smallint(5) unsigned NOT NULL DEFAULT '16',
  `showLineTimer` varchar(8) NOT NULL DEFAULT 'true',
  `lineTimerHeight` smallint(5) unsigned NOT NULL DEFAULT '6',
  `lineTimerColor` varchar(8) NOT NULL DEFAULT 'ffffff',
  `lineTimerAlpha` smallint(5) unsigned NOT NULL DEFAULT '40',
  `bottomNavPos` varchar(8) NOT NULL DEFAULT 'right',
  `bottomNavLateralMargin` smallint(5) unsigned NOT NULL DEFAULT '30',
  `thumbsWrapperMarginTop` smallint(5) NOT NULL DEFAULT '-55',
  `thumbsWrapperBgImage` text,
  `thumbsWrapperBgHexa` varchar(8),
  `thumbsBorderColorON` varchar(8) NOT NULL DEFAULT '000000',
  `thumbsBorderColorOFF` varchar(8) NOT NULL DEFAULT '7a7a7a',
  `showAllControllers` varchar(8) NOT NULL DEFAULT 'true',
  `showNavArrows` varchar(8) NOT NULL DEFAULT 'false',
  `showOnInitNavArrows` varchar(8) NOT NULL DEFAULT 'false',
  `autoHideNavArrows` varchar(8) NOT NULL DEFAULT 'false',
  `showBottomNav` varchar(8) NOT NULL DEFAULT 'true',
  `showOnInitBottomNav` varchar(8) NOT NULL DEFAULT 'true',
  `autoHideBottomNav` varchar(8) NOT NULL DEFAULT 'true',
  `showPreviewThumbs` varchar(8) NOT NULL DEFAULT 'false',
	`useTheseSettingsForAll` varchar(8) NOT NULL DEFAULT 'all',
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	$sql2 = "CREATE TABLE `". $wpdb->prefix . "countdown_with_background_playlist` (
	  `id` int(10) unsigned NOT NULL auto_increment,
	  `countdownid` int(10) unsigned NOT NULL,
	  `img` text,
	  `title` text,
	  `data-link` text,
	  `data-target` varchar(8),
	  `ord` int(10) unsigned NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";


	$sql3 = "CREATE TABLE `". $wpdb->prefix . "countdown_with_background_bg_playlist` (
	  `id` int(10) unsigned NOT NULL auto_increment,
	  `countdownid` int(10) unsigned NOT NULL,
	  `img` text,
	  `thumbnail` text,
	  `alt_text` text,
	  `content` text,
	  `data-video` varchar(8),
	  `data-link` text,
	  `data-target` varchar(8),
	  `ord` int(10) unsigned NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql0.$countdown_with_background_collate);
	dbDelta($sql1.$countdown_with_background_collate);
	//echo $wpdb->last_query;
	dbDelta($sql2.$countdown_with_background_collate);
	dbDelta($sql3.$countdown_with_background_collate);



	//initialize the countdowns table with the first countdown type
	$rows_count = $wpdb->get_var( "SELECT COUNT(*) FROM ". $wpdb->prefix ."countdown_with_background_countdowns;" );
	if (!$rows_count) {
		$wpdb->insert(
			$wpdb->prefix . "countdown_with_background_countdowns",
			array(
				'name' => 'First CountDown'
			),
			array(
				'%s'
			)
		);
	}

	// initialize the settings
	$rows_count = $wpdb->get_var( "SELECT COUNT(*) FROM ". $wpdb->prefix ."countdown_with_background_settings;" );
	if (!$rows_count) {
		countdown_with_background_insert_settings_record(1);
	}


	// initialize the playlist/ social channels
	/*$rows_count = $wpdb->get_var( "SELECT COUNT(*) FROM ". $wpdb->prefix ."countdown_with_background_settings;" );
	if (!$rows_count) {
		countdown_with_background_insert_settings_record(1);
	}*/
	//echo $wpdb->last_query;

}


function countdown_with_background_uninstall() {
	global $wpdb;
	/*mysql_query("DROP TABLE `" . $wpdb->prefix . "countdown_with_background_settings`" );
	mysql_query("DROP TABLE `" . $wpdb->prefix . "countdown_with_background_playlist`" );
	mysql_query("DROP TABLE `" . $wpdb->prefix . "countdown_with_background_bg_playlist`" );
	mysql_query("DROP TABLE `" . $wpdb->prefix . "countdown_with_background_countdowns`" );*/

	$sql = "DROP TABLE IF EXISTS `" . $wpdb->prefix . "countdown_with_background_settings`";
	$wpdb->query($sql);

	$sql1 = "DROP TABLE IF EXISTS `" . $wpdb->prefix . "countdown_with_background_playlist`";
	$wpdb->query($sql1);

	$sql2 = "DROP TABLE IF EXISTS `" . $wpdb->prefix . "countdown_with_background_bg_playlist`";
	$wpdb->query($sql2);

	$sql3 = "DROP TABLE IF EXISTS `" . $wpdb->prefix . "countdown_with_background_countdowns`";
	$wpdb->query($sql3);
}

function countdown_with_background_insert_settings_record($countdown_id) {
	global $wpdb;
	$wpdb->insert(
			$wpdb->prefix . "countdown_with_background_settings",
			array(
				'socialBgOFF' => plugins_url() . '/countdown_with_background/countdown_with_background/countdown_images/social_icons/socialCircleOFF.png',
				'socialBgON' => plugins_url() . '/countdown_with_background/countdown_with_background/countdown_images/social_icons/socialCircleON.png',
				'lineSeparatorImg' => plugins_url() . '/countdown_with_background/countdown_with_background/countdown_images/line.png',
				'h2Text' => 'UNDER CONSTRUCTION!',
				'h3Text' => 'Let\'s meet in:',
				'h4Text' => 'Until then, enjoy our social channels',
				'pluginFontFamily' => '\'PT Serif\', serif'
			),
			array(
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s'
			)
		);
}


function countdown_with_background_init_sessions() {
	global $wpdb;
	if (is_admin()) {
		if (!session_id()) {
			session_start();

			//initialize the session
			if (!isset($_SESSION['xid'])) {
				$safe_sql="SELECT * FROM (".$wpdb->prefix ."countdown_with_background_countdowns) LIMIT 0, 1";
				$row = $wpdb->get_row($safe_sql,ARRAY_A);
				//$row=countdown_with_background_unstrip_array($row);
				$_SESSION['xid'] = $row['id'];
				$_SESSION['xname'] = $row['name'];
			}
		}
	}
}


function countdown_with_background_end_sessions() {
		if (is_admin()) {
			session_destroy();
		}
}


function countdown_with_background_load_styles() {
	global $wpdb;
	if(strpos($_SERVER['PHP_SELF'], 'wp-admin') !== false) {
		$page = (isset($_GET['page'])) ? $_GET['page'] : '';
		if(preg_match('/countdown_with_background/i', $page)) {

			/*wp_enqueue_style('countdown_with_background_jquery-custom_css', plugins_url('css/custom-theme/jquery-ui-1.8.10.custom.css', __FILE__));*/
			wp_enqueue_style('lbg-jquery-ui-custom_css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/pepper-grinder/jquery-ui.min.css');
			wp_enqueue_style('countdown_with_background_css', plugins_url('css/styles.css', __FILE__));
			wp_enqueue_style('countdown_with_background_colorpicker_css', plugins_url('css/colorpicker/colorpicker.css', __FILE__));


			wp_enqueue_style('thickbox');

		}
	} else if (!is_admin()) { //loads css in front-end
		wp_enqueue_style('countdown_with_background_site_css', plugins_url('countdown_with_background/countdown_with_background.css', __FILE__));
	}
}

function countdown_with_background_load_scripts() {
	global $is_IE;
	$page = (isset($_GET['page'])) ? $_GET['page'] : '';
	if(preg_match('/countdown_with_background/i', $page)) {
		//loads scripts in admin
		//if (is_admin()) {
			//wp_deregister_script('jquery');
			/*wp_register_script('lbg-admin-jquery', plugins_url('js/jquery-1.5.1.js', __FILE__));
			wp_enqueue_script('lbg-admin-jquery');*/
			/*wp_deregister_script('jquery-ui-core');
			wp_deregister_script('jquery-ui-widget');
			wp_deregister_script('jquery-ui-countdown_with_background');
			wp_deregister_script('jquery-ui-accordion');
			wp_deregister_script('jquery-ui-autocomplete');
			wp_deregister_script('jquery-ui-slider');
			wp_deregister_script('jquery-ui-tabs');
			wp_deregister_script('jquery-ui-sortable');
			wp_deregister_script('jquery-ui-draggable');
			wp_deregister_script('jquery-ui-droppable');
			wp_deregister_script('jquery-ui-selectable');
			wp_deregister_script('jquery-ui-position');
			wp_deregister_script('jquery-ui-datepicker');
			wp_deregister_script('jquery-ui-resizable');
			wp_deregister_script('jquery-ui-dialog');
			wp_deregister_script('jquery-ui-button');	*/

			wp_enqueue_script('jquery');

			//wp_register_script('lbg-admin-jquery-ui-min', plugins_url('js/jquery-ui-1.8.10.custom.min.js', __FILE__));
			//wp_register_script('lbg-admin-jquery-ui-min', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js');
			/*wp_register_script('lbg-admin-jquery-ui-min', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
			wp_enqueue_script('lbg-admin-jquery-ui-min');*/

			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-widget');
			wp_enqueue_script('jquery-ui-mouse');
			wp_enqueue_script('jquery-ui-accordion');
			wp_enqueue_script('jquery-ui-autocomplete');
			wp_enqueue_script('jquery-ui-slider');
			wp_enqueue_script('jquery-ui-tabs');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-droppable');
			wp_enqueue_script('jquery-ui-selectable');
			wp_enqueue_script('jquery-ui-position');
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_script('jquery-ui-resizable');
			wp_enqueue_script('jquery-ui-dialog');
			wp_enqueue_script('jquery-ui-button');/***************************/

			wp_enqueue_script('jquery-form');
			wp_enqueue_script('jquery-color');
			wp_enqueue_script('jquery-masonry');
			wp_enqueue_script('jquery-ui-progressbar');
			wp_enqueue_script('jquery-ui-tooltip');

			wp_enqueue_script('jquery-effects-core');
			wp_enqueue_script('jquery-effects-blind');
			wp_enqueue_script('jquery-effects-bounce');
			wp_enqueue_script('jquery-effects-clip');
			wp_enqueue_script('jquery-effects-drop');
			wp_enqueue_script('jquery-effects-explode');
			wp_enqueue_script('jquery-effects-fade');
			wp_enqueue_script('jquery-effects-fold');
			wp_enqueue_script('jquery-effects-highlight');
			wp_enqueue_script('jquery-effects-pulsate');
			wp_enqueue_script('jquery-effects-scale');
			wp_enqueue_script('jquery-effects-shake');
			wp_enqueue_script('jquery-effects-slide');
			wp_enqueue_script('jquery-effects-transfer');

			wp_register_script('my-colorpicker', plugins_url('js/colorpicker/colorpicker.js', __FILE__));
			wp_enqueue_script('my-colorpicker');

			wp_register_script('lbg-admin-toggle', plugins_url('js/myToggle.js', __FILE__));
			wp_enqueue_script('lbg-admin-toggle');


			/*wp_enqueue_script('media-upload');*/   //old
			wp_enqueue_script('media-upload'); // before w.p 3.5
			wp_enqueue_media();// from w.p 3.5
			wp_enqueue_script('thickbox');

			/*wp_register_script('lbg-touch', plugins_url('classic/js/jquery.ui.touch-punch.min.js', __FILE__));
			wp_enqueue_script('lbg-touch');

			wp_register_script('lbg-countdown_with_background', plugins_url('classic\js\parallax_classic.js', __FILE__));
			wp_enqueue_script('lbg-countdown_with_background');	*/


		//}

		//wp_enqueue_script('jquery');
		//wp_enqueue_script('jquery-ui-core');
		//wp_enqueue_script('jquery-ui-sortable');
		//wp_enqueue_script('thickbox');
		//wp_enqueue_script('media-upload');
		//wp_enqueue_script('farbtastic');
	} else if (!is_admin()) { //loads scripts in front-end
			/*wp_deregister_script('jquery-ui-core');
			wp_deregister_script('jquery-ui-widget');
			wp_deregister_script('jquery-ui-countdown_with_background');
			wp_deregister_script('jquery-ui-accordion');
			wp_deregister_script('jquery-ui-autocomplete');
			wp_deregister_script('jquery-ui-slider');
			wp_deregister_script('jquery-ui-tabs');
			wp_deregister_script('jquery-ui-sortable');
			wp_deregister_script('jquery-ui-draggable');
			wp_deregister_script('jquery-ui-droppable');
			wp_deregister_script('jquery-ui-selectable');
			wp_deregister_script('jquery-ui-position');
			wp_deregister_script('jquery-ui-datepicker');
			wp_deregister_script('jquery-ui-resizable');
			wp_deregister_script('jquery-ui-dialog');
			wp_deregister_script('jquery-ui-button');
			wp_deregister_script('jquery-effects-core');*/

		wp_enqueue_script('jquery');

		//wp_enqueue_script('jquery-ui-core');

		//wp_register_script('lbg-jquery-ui-min', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js');
		/*wp_register_script('lbg-jquery-ui-min', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
		wp_enqueue_script('lbg-jquery-ui-min');*/

			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-widget');
			/*wp_enqueue_script('jquery-ui-mouse');
			wp_enqueue_script('jquery-ui-accordion');
			wp_enqueue_script('jquery-ui-autocomplete');
			wp_enqueue_script('jquery-ui-slider');
			wp_enqueue_script('jquery-ui-tabs');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-droppable');
			wp_enqueue_script('jquery-ui-selectable');
			wp_enqueue_script('jquery-ui-position');
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_script('jquery-ui-resizable');
			wp_enqueue_script('jquery-ui-dialog');
			wp_enqueue_script('jquery-ui-button');

			wp_enqueue_script('jquery-form');
			wp_enqueue_script('jquery-color');
			wp_enqueue_script('jquery-masonry');
			wp_enqueue_script('jquery-ui-progressbar');
			wp_enqueue_script('jquery-ui-tooltip');*/

			wp_enqueue_script('jquery-effects-core');
			/*wp_enqueue_script('jquery-effects-blind');
			wp_enqueue_script('jquery-effects-bounce');
			wp_enqueue_script('jquery-effects-clip');
			wp_enqueue_script('jquery-effects-drop');
			wp_enqueue_script('jquery-effects-explode');
			wp_enqueue_script('jquery-effects-fade');
			wp_enqueue_script('jquery-effects-fold');
			wp_enqueue_script('jquery-effects-highlight');
			wp_enqueue_script('jquery-effects-pulsate');
			wp_enqueue_script('jquery-effects-scale');
			wp_enqueue_script('jquery-effects-shake');
			wp_enqueue_script('jquery-effects-slide');	*/
			wp_enqueue_script('jquery-effects-transfer');


		wp_register_script('lbg-logocountdown', plugins_url('countdown_with_background\js\countdown_with_background.js', __FILE__));
		wp_enqueue_script('lbg-logocountdown');

		wp_register_script('lbg-touchSwipe', plugins_url('countdown_with_background/js/jquery.touchSwipe.min.js', __FILE__));
		wp_enqueue_script('lbg-touchSwipe');


	}




}



// adds the menu pages
function countdown_with_background_plugin_menu() {
	add_menu_page('COUNTDOWN-WITH-BACKGROUND Admin Interface', 'COUNTDOWN WITH BACKGROUND', 'edit_posts', 'countdown_with_background', 'countdown_with_background_overview_page',
	plugins_url('images/plg_icon.png', __FILE__));
	add_submenu_page( 'countdown_with_background', 'COUNTDOWN-WITH-BACKGROUND Overview', 'Overview', 'edit_posts', 'countdown_with_background', 'countdown_with_background_overview_page');
	add_submenu_page( 'countdown_with_background', 'COUNTDOWN-WITH-BACKGROUND Manage CountDowns', 'Manage CountDowns', 'edit_posts', 'countdown_with_background_Manage_CountDowns', 'countdown_with_background_manage_countdowns_page');
	add_submenu_page( 'countdown_with_background', 'COUNTDOWN-WITH-BACKGROUND Manage CountDowns Add New', 'Add New', 'edit_posts', 'countdown_with_background_Add_New', 'countdown_with_background_manage_countdowns_add_new_page');
	add_submenu_page( 'countdown_with_background_Manage_CountDowns', 'COUNTDOWN-WITH-BACKGROUND CountDown Settings', 'CountDown Settings', 'edit_posts', 'countdown_with_background_Settings', 'countdown_with_background_settings_page');
	add_submenu_page( 'countdown_with_background_Manage_CountDowns', 'COUNTDOWN-WITH-BACKGROUND CountDown Bg Playlist', 'Bg Playlist', 'edit_posts', 'countdown_with_background_bg_Playlist', 'countdown_with_background_bg_playlist_page');
	add_submenu_page( 'countdown_with_background_Manage_CountDowns', 'COUNTDOWN-WITH-BACKGROUND CountDown Playlist', 'Playlist', 'edit_posts', 'countdown_with_background_Playlist', 'countdown_with_background_playlist_page');
	add_submenu_page( 'countdown_with_background', 'COUNTDOWN-WITH-BACKGROUND Help', 'Help', 'edit_posts', 'countdown_with_background_Help', 'countdown_with_background_help_page');
}


//HTML content for overview page
function countdown_with_background_overview_page()
{
	global $countdown_with_background_path;
	include_once($countdown_with_background_path . 'tpl/overview.php');
}

//HTML content for Manage Banners
function countdown_with_background_manage_countdowns_page()
{
	global $wpdb;
	global $countdown_with_background_messages;
	global $countdown_with_background_path;

	//delete countdown
	if (isset($_GET['id'])) {




		//delete from wp_countdown_with_background_countdowns
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."countdown_with_background_countdowns WHERE id = %d",$_GET['id']));

		//delete from wp_countdown_with_background_settings
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."countdown_with_background_settings WHERE id = %d",$_GET['id']));


		//delete from wp_countdown_with_background_playlist
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."countdown_with_background_playlist WHERE countdownid = %d",$_GET['id']));

		//delete from wp_countdown_with_background_bg_playlist
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."countdown_with_background_bg_playlist WHERE countdownid = %d",$_GET['id']));

		//initialize the session
		$safe_sql="SELECT * FROM (".$wpdb->prefix ."countdown_with_background_countdowns) ORDER BY id";
		$row = $wpdb->get_row($safe_sql,ARRAY_A);
		$row=countdown_with_background_unstrip_array($row);
		if ($row['id']) {
			$_SESSION['xid']=$row['id'];
			$_SESSION['xname']=$row['name'];
		}
	}


	//if ($_GET['duplicate_id']!='') {
	if (array_key_exists('duplicate_id', $_GET) && $_GET['duplicate_id']!='') {
			//countdowns
			$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."countdown_with_background_countdowns ( `name` ) SELECT `name` FROM (".$wpdb->prefix ."countdown_with_background_countdowns) WHERE id = %d",$_GET['duplicate_id'] );
			$wpdb->query($safe_sql);
			$countdownid=$wpdb->insert_id;




			//settings
			$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."countdown_with_background_settings (`beginDate_date`, `beginDate_hours`, `beginDate_minutes`, `beginDate_seconds`, `endDate_date`, `endDate_hours`, `endDate_minutes`, `endDate_seconds`, `servertime`, `responsive`, `enableMaintenanceMode`, `pageBg`, `pageBgHexa`, `pageBgAdditionalCss`, `pluginFontFamily`, `pluginFontFamilyGoogleLink`, `circleRadius`, `circleLineWidth`, `behindCircleLineWidthExpand`, `circleTopBottomPadding`, `circleLeftRightPadding`, `numberSize`, `numberAdditionalTopPadding`, `textSize`, `textMarginTop`, `textPadding`, `lineSeparatorImg`, `logo`, `logoLink`, `logoTarget`, `allCirclesTopMargin`, `allCirclesBottomMargin`, `divBackgroundDaysHexa`, `divBackgroundDaysImg`, `borderTopColorDays`, `borderRightColorDays`, `borderBottomColorDays`, `borderLeftColorDays`, `circleColorDays`, `circleAlphaDays`, `behindCircleColorDays`, `behindCircleAlphaDays`, `numberColorDays`, `textColorDays`, `textBackgroundDaysHexa`, `textBackgroundDaysImg`, `translateDays`, `divBackgroundHoursHexa`, `divBackgroundHoursImg`, `borderTopColorHours`, `borderRightColorHours`, `borderBottomColorHours`, `borderLeftColorHours`, `circleColorHours`, `circleAlphaHours`, `behindCircleColorHours`, `behindCircleAlphaHours`, `numberColorHours`, `textColorHours`, `textBackgroundHoursHexa`, `textBackgroundHoursImg`, `translateHours`, `divBackgroundMinutesHexa`, `divBackgroundMinutesImg`, `borderTopColorMinutes`, `borderRightColorMinutes`, `borderBottomColorMinutes`, `borderLeftColorMinutes`, `circleColorMinutes`, `circleAlphaMinutes`, `behindCircleColorMinutes`, `behindCircleAlphaMinutes`, `numberColorMinutes`, `textColorMinutes`, `textBackgroundMinutesHexa`, `textBackgroundMinutesImg`, `translateMinutes`, `divBackgroundSecondsHexa`, `divBackgroundSecondsImg`, `borderTopColorSeconds`, `borderRightColorSeconds`, `borderBottomColorSeconds`, `borderLeftColorSeconds`, `circleColorSeconds`, `circleAlphaSeconds`, `behindCircleColorSeconds`, `behindCircleAlphaSeconds`, `numberColorSeconds`, `textColorSeconds`, `textBackgroundSecondsHexa`, `textBackgroundSecondsImg`, `translateSeconds`, `socialBgOFF`, `socialBgON`, `complete`, `autoReset24h`, `h2Text`, `h2Size`, `h2Color`, `h2Weight`, `h2TopMargin`, `h3Text`, `h3Size`, `h3Color`, `h3Weight`, `h3TopMargin`, `h4Text`, `h4Size`, `h4Color`, `h4Weight`, `h4TopMargin`, `defaultTextSize`, `defaultTextColor`, `defaultTextWeight`, `defaultTextTopMargin`, `defaultTextLinkSize`, `defaultTextLinkColor`, `defaultTextLinkWeight`, `autoPlay`, `loop`, `fadeSlides`, `texturePath`, `initialOpacity`, `target`, `enableTouchScreen`, `videoProportionWidth`, `showLineTimer`, `lineTimerHeight`, `lineTimerColor`, `lineTimerAlpha`, `bottomNavPos`, `bottomNavLateralMargin`, `thumbsWrapperMarginTop`, `thumbsWrapperBgImage`, `thumbsWrapperBgHexa`, `thumbsBorderColorON`, `thumbsBorderColorOFF`, `showAllControllers`, `showNavArrows`, `showOnInitNavArrows`, `autoHideNavArrows`, `showBottomNav`, `showOnInitBottomNav`, `autoHideBottomNav`, `showPreviewThumbs`, `p_tag_content`, `useTheseSettingsForAll` ) SELECT `beginDate_date`, `beginDate_hours`, `beginDate_minutes`, `beginDate_seconds`, `endDate_date`, `endDate_hours`, `endDate_minutes`, `endDate_seconds`, `servertime`, `responsive`, `enableMaintenanceMode`, `pageBg`, `pageBgHexa`, `pageBgAdditionalCss`, `pluginFontFamily`, `pluginFontFamilyGoogleLink`, `circleRadius`, `circleLineWidth`, `behindCircleLineWidthExpand`, `circleTopBottomPadding`, `circleLeftRightPadding`, `numberSize`, `numberAdditionalTopPadding`, `textSize`, `textMarginTop`, `textPadding`, `lineSeparatorImg`, `logo`, `logoLink`, `logoTarget`, `allCirclesTopMargin`, `allCirclesBottomMargin`, `divBackgroundDaysHexa`, `divBackgroundDaysImg`, `borderTopColorDays`, `borderRightColorDays`, `borderBottomColorDays`, `borderLeftColorDays`, `circleColorDays`, `circleAlphaDays`, `behindCircleColorDays`, `behindCircleAlphaDays`, `numberColorDays`, `textColorDays`, `textBackgroundDaysHexa`, `textBackgroundDaysImg`, `translateDays`, `divBackgroundHoursHexa`, `divBackgroundHoursImg`, `borderTopColorHours`, `borderRightColorHours`, `borderBottomColorHours`, `borderLeftColorHours`, `circleColorHours`, `circleAlphaHours`, `behindCircleColorHours`, `behindCircleAlphaHours`, `numberColorHours`, `textColorHours`, `textBackgroundHoursHexa`, `textBackgroundHoursImg`, `translateHours`, `divBackgroundMinutesHexa`, `divBackgroundMinutesImg`, `borderTopColorMinutes`, `borderRightColorMinutes`, `borderBottomColorMinutes`, `borderLeftColorMinutes`, `circleColorMinutes`, `circleAlphaMinutes`, `behindCircleColorMinutes`, `behindCircleAlphaMinutes`, `numberColorMinutes`, `textColorMinutes`, `textBackgroundMinutesHexa`, `textBackgroundMinutesImg`, `translateMinutes`, `divBackgroundSecondsHexa`, `divBackgroundSecondsImg`, `borderTopColorSeconds`, `borderRightColorSeconds`, `borderBottomColorSeconds`, `borderLeftColorSeconds`, `circleColorSeconds`, `circleAlphaSeconds`, `behindCircleColorSeconds`, `behindCircleAlphaSeconds`, `numberColorSeconds`, `textColorSeconds`, `textBackgroundSecondsHexa`, `textBackgroundSecondsImg`, `translateSeconds`, `socialBgOFF`, `socialBgON`, `complete`, `autoReset24h`, `h2Text`, `h2Size`, `h2Color`, `h2Weight`, `h2TopMargin`, `h3Text`, `h3Size`, `h3Color`, `h3Weight`, `h3TopMargin`, `h4Text`, `h4Size`, `h4Color`, `h4Weight`, `h4TopMargin`, `defaultTextSize`, `defaultTextColor`, `defaultTextWeight`, `defaultTextTopMargin`, `defaultTextLinkSize`, `defaultTextLinkColor`, `defaultTextLinkWeight`, `autoPlay`, `loop`, `fadeSlides`, `texturePath`, `initialOpacity`, `target`, `enableTouchScreen`, `videoProportionWidth`, `showLineTimer`, `lineTimerHeight`, `lineTimerColor`, `lineTimerAlpha`, `bottomNavPos`, `bottomNavLateralMargin`, `thumbsWrapperMarginTop`, `thumbsWrapperBgImage`, `thumbsWrapperBgHexa`, `thumbsBorderColorON`, `thumbsBorderColorOFF`, `showAllControllers`, `showNavArrows`, `showOnInitNavArrows`, `autoHideNavArrows`, `showBottomNav`, `showOnInitBottomNav`, `autoHideBottomNav`, `showPreviewThumbs`, `p_tag_content`, `useTheseSettingsForAll`  FROM (".$wpdb->prefix ."countdown_with_background_settings) WHERE id = %d",$_GET['duplicate_id'] );
			$wpdb->query($safe_sql);

			//playlist social
			$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."countdown_with_background_playlist) WHERE countdownid = %d",$_GET['duplicate_id'] );
			$result = $wpdb->get_results($safe_sql,ARRAY_A);
			foreach ( $result as $row_playlist ) {
				$row_playlist=countdown_with_background_unstrip_array($row_playlist);

				$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."countdown_with_background_playlist ( `countdownid` ,`img` ,`title` ,`data-link` ,`data-target` ,`ord` ) SELECT ".$countdownid." ,`img` ,`title` ,`data-link` ,`data-target` ,`ord` FROM (".$wpdb->prefix ."countdown_with_background_playlist) WHERE id = %d",$row_playlist['id'] );
				$wpdb->query($safe_sql);
				$photoid=$wpdb->insert_id;
				//echo $wpdb->last_query;

			}


			//playlist background
			$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."countdown_with_background_bg_playlist) WHERE countdownid = %d",$_GET['duplicate_id'] );
			$result_bg = $wpdb->get_results($safe_sql,ARRAY_A);
			foreach ( $result_bg as $row_playlist_bg ) {
				$row_playlist_bg=countdown_with_background_unstrip_array($row_playlist_bg);

				$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."countdown_with_background_bg_playlist ( `countdownid` ,`img` ,`thumbnail`, `alt_text`, `content`, `data-video` ,`data-link` ,`data-target` ,`ord` ) SELECT ".$countdownid." ,`img` ,`thumbnail`, `alt_text`, `content`, `data-video` ,`data-link` ,`data-target` ,`ord` FROM (".$wpdb->prefix ."countdown_with_background_bg_playlist) WHERE id = %d",$row_playlist_bg['id'] );
				$wpdb->query($safe_sql);
				$photoid=$wpdb->insert_id;
				//echo $wpdb->last_query;
			}




			//maintenance mode
			$safe_sql=$wpdb->prepare( "SELECT enableMaintenanceMode FROM (".$wpdb->prefix ."countdown_with_background_settings) WHERE id = %d",$_GET['duplicate_id'] );
			$row = $wpdb->get_row($safe_sql,ARRAY_A);
			$row=countdown_with_background_unstrip_array($row);
			if ($row['enableMaintenanceMode']=='true') {
				$wpdb->update(
					$wpdb->prefix .'countdown_with_background_settings',
					array( 'enableMaintenanceMode' => 'false' ),
					array( 'id' => $_GET['duplicate_id'] ),
					array( '%s' ),
					array( '%d' )
				);
				//$wpdb->query( $wpdb->prepare(" UPDATE ".$wpdb->prefix ."countdown_with_background_settings SET enableMaintenanceMode='false' WHERE 1 = 1") );
			}

	}

	$safe_sql="SELECT * FROM (".$wpdb->prefix ."countdown_with_background_countdowns) ORDER BY id";
	$result = $wpdb->get_results($safe_sql,ARRAY_A);
	include_once($countdown_with_background_path . 'tpl/countdowns.php');

}


//HTML content for Manage Banners - Add New
function countdown_with_background_manage_countdowns_add_new_page()
{
	global $wpdb;
	global $countdown_with_background_messages;
	global $countdown_with_background_path;

	//if($_POST['Submit'] == 'Add New') {
	if(array_key_exists('Submit', $_POST) && $_POST['Submit'] == 'Add New') {
		$errors_arr=array();
		if (empty($_POST['name']))
			$errors_arr[]=$countdown_with_background_messages['empty_name'];

		if (count($errors_arr)) {
				include_once($countdown_with_background_path . 'tpl/add_countdown.php'); ?>
				<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
		  	<?php } else { // no errors
					$wpdb->insert(
						$wpdb->prefix . "countdown_with_background_countdowns",
						array(
							'name' => $_POST['name']
						),
						array(
							'%s'
						)
					);
					//insert default CountDown Settings for this new CountDown
					countdown_with_background_insert_settings_record($wpdb->insert_id);
					?>
						<div class="wrap">
							<div id="lbg_logo">
								<h2>Manage CountDowns - Add New CountDown</h2>
				 			</div>
							<div id="message" class="updated"><p><?php echo $countdown_with_background_messages['data_saved'];?></p><p><?php echo $countdown_with_background_messages['generate_for_this_countdown'];?></p></div>
							<div>
								<p>&raquo; <a href="?page=countdown_with_background_Add_New">Add New (CountDown)</a></p>
								<p>&raquo; <a href="?page=countdown_with_background_Manage_CountDowns">Back to Manage CountDowns</a></p>
							</div>
						</div>
		  	<?php }
	} else {
		include_once($countdown_with_background_path . 'tpl/add_countdown.php');
	}

}


//HTML content for countdownsettings
function countdown_with_background_settings_page()
{
	global $wpdb;
	global $countdown_with_background_messages;
	global $countdown_with_background_path;

	if (isset($_GET['id']) && isset($_GET['name'])) {
		$_SESSION['xid']=$_GET['id'];
		$_SESSION['xname']=$_GET['name'];
	}

	//$wpdb->show_errors();
	/*if (check_admin_referer('countdown_with_background_settings_update')) {
		echo "update";
	}*/

	//if($_POST['Submit'] == 'Update Settings') {
	if(array_key_exists('Submit', $_POST) && $_POST['Submit'] == 'Update Settings') {
		//maintenance mode
		if ($_POST['enableMaintenanceMode']=='true') {
			$wpdb->query("UPDATE ".$wpdb->prefix ."countdown_with_background_settings SET enableMaintenanceMode='false' WHERE 1 = 1");
		}

		$_GET['xmlf']='';
		$except_arr=array('Submit','name','page_scroll_to_id_instances');

			$wpdb->update(
				$wpdb->prefix .'countdown_with_background_countdowns',
				array(
				'name' => $_POST['name']
				),
				array( 'id' => $_SESSION['xid'] )
			);
			$_SESSION['xname']=stripslashes($_POST['name']);


			foreach ($_POST as $key=>$val){
				if (in_array($key,$except_arr)) {
					unset($_POST[$key]);
				}
			}

			$wpdb->update(
				$wpdb->prefix .'countdown_with_background_settings',
				$_POST,
				array( 'id' => $_SESSION['xid'] )
			);
			//echo $wpdb->last_query;
			?>
			<div id="message" class="updated"><p><?php echo $countdown_with_background_messages['data_saved'];?></p></div>
	<?php
		writePreviewAndMaintenanceFile($_SESSION['xid'],'tpl/maintenance_mode.html');
	}



	//echo "WP_PLUGIN_URL: ".WP_PLUGIN_URL;
	$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."countdown_with_background_settings) WHERE id = %d",$_SESSION['xid'] );
	$row = $wpdb->get_row($safe_sql,ARRAY_A);
	$row=countdown_with_background_unstrip_array($row);
	$_POST = $row;
	//$_POST['existingWatermarkPath']=$_POST['watermarkPath'];
	$_POST=countdown_with_background_unstrip_array($_POST);

	include_once($countdown_with_background_path . 'tpl/settings_form.php');

}

function countdown_with_background_playlist_page()
{
	global $wpdb;
	global $countdown_with_background_messages;
	global $countdown_with_background_path;
	//$wpdb->show_errors();

	if (isset($_GET['id']) && isset($_GET['name'])) {
		$_SESSION['xid']=$_GET['id'];
		$_SESSION['xname']=$_GET['name'];
	}


	//if ($_GET['xmlf']=='add_playlist_record') {
	if (array_key_exists('xmlf', $_GET) && $_GET['xmlf']=='add_playlist_record') {
		//if($_POST['Submit'] == 'Add Record') {
		if(array_key_exists('Submit', $_POST) && $_POST['Submit'] == 'Add Record') {
			$errors_arr=array();
			/*if (empty($_POST['img']))
				 $errors_arr[]=$countdown_with_background_messages['empty_img'];*/


		if (count($errors_arr)) {
			include_once($countdown_with_background_path . 'tpl/add_playlist_record.php'); ?>
			<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
	  	<?php } else { // no upload errors
				$max_ord = 1+$wpdb->get_var( $wpdb->prepare( "SELECT max(ord) FROM ". $wpdb->prefix ."countdown_with_background_playlist WHERE countdownid = %d",$_SESSION['xid'] ) );

				$wpdb->insert(
					$wpdb->prefix . "countdown_with_background_playlist",
					array(
						'countdownid' => $_POST['countdownid'],
						'img' => $_POST['img'],
						'title' => $_POST['title'],
						'data-link' => $_POST['data-link'],
						'data-target' => $_POST['data-target'],
						'ord' => $max_ord
					),
					array(
						'%d',
						'%s',
						'%s',
						'%s',
						'%s',
						'%d'
					)
				);

	  			if (isset($_POST['setitfirst'])) {
					$sql_arr=array();
					$ord_start=$max_ord;
					$ord_stop=1;
					$elem_id=$wpdb->insert_id;
					$ord_direction='+1';

					$sql_arr[]="UPDATE ".$wpdb->prefix."countdown_with_background_playlist SET ord=ord+1  WHERE countdownid = ".$_SESSION['xid']." and ord>=".$ord_stop." and ord<".$ord_start;
					$sql_arr[]="UPDATE ".$wpdb->prefix."countdown_with_background_playlist SET ord=".$ord_stop." WHERE id=".$elem_id;

					//echo "elem_id: ".$elem_id."----ord_start: ".$ord_start."----ord_stop: ".$ord_stop;
					foreach ($sql_arr as $sql)
						$wpdb->query($sql);
				}
				?>
					<div class="wrap">
						<div id="lbg_logo">
							<h2>Social Channels for CountDown: <span style="color:#FF0000; font-weight:bold;"><?php echo strip_tags($_SESSION['xname'])?> - ID #<?php echo strip_tags($_SESSION['xid'])?></span> - Add New</h2>
			 			</div>
						<div id="message" class="updated"><p><?php echo $countdown_with_background_messages['data_saved'];?></p></div>
						<div>
							<p>&raquo; <a href="?page=countdown_with_background_Playlist&xmlf=add_playlist_record">Add New</a></p>
							<p>&raquo; <a href="?page=countdown_with_background_Playlist">Back to Social Channels List</a></p>
						</div>
					</div>
	  	<?php
				writePreviewAndMaintenanceFile($_SESSION['xid'],'tpl/maintenance_mode.html');
			}
		} else {
			include_once($countdown_with_background_path . 'tpl/add_playlist_record.php');
		}

	} else {
		//if ($_GET['duplicate_id']!='') {
		if (array_key_exists('duplicate_id', $_GET) && $_GET['duplicate_id']!='') {
			$max_ord = 1+$wpdb->get_var( $wpdb->prepare( "SELECT max(ord) FROM ". $wpdb->prefix ."countdown_with_background_playlist WHERE countdownid = %d",$_SESSION['xid'] ) );
			$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."countdown_with_background_playlist ( `countdownid` ,`img` ,`title` , `data-link` ,`data-target` ,`ord` ) SELECT `countdownid` ,`img` ,`title` ,`data-link` ,`data-target` ,".$max_ord." FROM (".$wpdb->prefix ."countdown_with_background_playlist) WHERE id = %d",$_GET['duplicate_id'] );
			$wpdb->query($safe_sql);
			$lastID=$wpdb->insert_id;
			//echo $wpdb->last_query;

			//header("Location: https://localhost/!wordpress/work/wp-admin/admin.php?page=countdown_with_background_Playlist&amp;id=".$_SESSION['xid']."&amp;name=".$_SESSION['xname']);
			//exit();
			writePreviewAndMaintenanceFile($_SESSION['xid'],'tpl/maintenance_mode.html');
			echo "<script>location.href='?page=countdown_with_background_Playlist&id=".$_SESSION['xid']."&name=".$_SESSION['xname']."'</script>";
		}

		$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."countdown_with_background_playlist) WHERE countdownid = %d ORDER BY ord",$_SESSION['xid'] );
		$result = $wpdb->get_results($safe_sql,ARRAY_A);

		/*$safe_sql=$wpdb->prepare( "SELECT width,height FROM (".$wpdb->prefix ."countdown_with_background_settings) WHERE id = %d",$_SESSION['xid'] );
		$row_settings = $wpdb->get_row($safe_sql);		*/

		//$_POST=countdown_with_background_unstrip_array($_POST);
		include_once($countdown_with_background_path . 'tpl/playlist.php');
	}
}



function countdown_with_background_bg_playlist_page()
{
	global $wpdb;
	global $countdown_with_background_messages;
	global $countdown_with_background_path;
	//$wpdb->show_errors();

	if (isset($_GET['id']) && isset($_GET['name'])) {
		$_SESSION['xid']=$_GET['id'];
		$_SESSION['xname']=$_GET['name'];
	}


	//if ($_GET['xmlf']=='add_playlist_record') {
	if (array_key_exists('xmlf', $_GET) && $_GET['xmlf']=='add_playlist_record') {
		//if($_POST['Submit'] == 'Add Record') {
		if(array_key_exists('Submit', $_POST) && $_POST['Submit'] == 'Add Record') {
			$errors_arr=array();
			/*if (empty($_POST['img']))
				 $errors_arr[]=$countdown_with_background_slider_messages['empty_img'];*/


		if (count($errors_arr)) {
			include_once($countdown_with_background_path . 'tpl/add_playlist_record_bg.php'); ?>
			<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
	  	<?php } else { // no upload errors
				$max_ord = 1+$wpdb->get_var( $wpdb->prepare( "SELECT max(ord) FROM ". $wpdb->prefix ."countdown_with_background_bg_playlist WHERE countdownid = %d",$_SESSION['xid'] ) );

				$wpdb->insert(
					$wpdb->prefix . "countdown_with_background_bg_playlist",
					array(
						'countdownid' => $_POST['countdownid'],
						'img' => $_POST['img'],
						'thumbnail' => $_POST['thumbnail'],
						'alt_text' => $_POST['alt_text'],
						'content' => $_POST['content'],
						'data-video' => $_POST['data-video'],
						'data-link' => $_POST['data-link'],
						'data-target' => $_POST['data-target'],
						'ord' => $max_ord
					),
					array(
						'%d',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%d'
					)
				);

	  			if (isset($_POST['setitfirst'])) {
					$sql_arr=array();
					$ord_start=$max_ord;
					$ord_stop=1;
					$elem_id=$wpdb->insert_id;
					$ord_direction='+1';

					$sql_arr[]="UPDATE ".$wpdb->prefix."countdown_with_background_bg_playlist SET ord=ord+1  WHERE countdownid = ".$_SESSION['xid']." and ord>=".$ord_stop." and ord<".$ord_start;
					$sql_arr[]="UPDATE ".$wpdb->prefix."countdown_with_background_bg_playlist SET ord=".$ord_stop." WHERE id=".$elem_id;

					//echo "elem_id: ".$elem_id."----ord_start: ".$ord_start."----ord_stop: ".$ord_stop;
					foreach ($sql_arr as $sql)
						$wpdb->query($sql);
				}
				?>
					<div class="wrap">
						<div id="lbg_logo">
							<h2>Playlist for Slider: <span style="color:#FF0000; font-weight:bold;"><?php echo strip_tags($_SESSION['xname'])?> - ID #<?php echo strip_tags($_SESSION['xid'])?></span> - Add New</h2>
			 			</div>
						<div id="message" class="updated"><p><?php echo $countdown_with_background_messages['data_saved'];?></p></div>
						<div>
							<p>&raquo; <a href="?page=countdown_with_background_bg_Playlist&xmlf=add_playlist_record">Add New</a></p>
							<p>&raquo; <a href="?page=countdown_with_background_bg_Playlist">Back to Playlist</a></p>
						</div>
					</div>
	  	<?php }
		} else {
			include_once($countdown_with_background_path . 'tpl/add_playlist_record_bg.php');
		}

	} else {
		//if ($_GET['duplicate_id']!='') {
		if (array_key_exists('duplicate_id', $_GET) && $_GET['duplicate_id']!='') {
			$max_ord = 1+$wpdb->get_var( $wpdb->prepare( "SELECT max(ord) FROM ". $wpdb->prefix ."countdown_with_background_bg_playlist WHERE countdownid = %d",$_SESSION['xid'] ) );
			$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."countdown_with_background_bg_playlist ( `countdownid` ,`img` ,`thumbnail` ,`alt_text` ,`content` ,`data-video` ,`data-link` ,`data-target` ,`ord` ) SELECT `countdownid` ,`img` ,`thumbnail` ,`alt_text` ,`content` ,`data-video` ,`data-link` ,`data-target` ,".$max_ord." FROM (".$wpdb->prefix ."countdown_with_background_bg_playlist) WHERE id = %d",$_GET['duplicate_id'] );
			$wpdb->query($safe_sql);
			$lastID=$wpdb->insert_id;
			//echo $wpdb->last_query;



			echo "<script>location.href='?page=countdown_with_background_bg_Playlist&id=".$_SESSION['xid']."&name=".$_SESSION['xname']."'</script>";

		}

		$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."countdown_with_background_bg_playlist) WHERE countdownid = %d ORDER BY ord",$_SESSION['xid'] );
		$result = $wpdb->get_results($safe_sql,ARRAY_A);



		//$_POST=countdown_with_background_unstrip_array($_POST);
		include_once($countdown_with_background_path . 'tpl/playlist_bg.php');
	}
}






function countdown_with_background_help_page()
{
	//include_once(plugins_url('tpl/help.php', __FILE__));
	global $countdown_with_background_path;
	include_once($countdown_with_background_path . 'tpl/help.php');
}

function countdown_with_background_generate_preview_code($countdownID) {
	global $wpdb;
	global $countdown_with_background_path;

	$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."countdown_with_background_settings) WHERE id = %d",$countdownID );
	$row = $wpdb->get_row($safe_sql,ARRAY_A);
	$row=countdown_with_background_unstrip_array($row);
	//echo $wpdb->last_query;

	//social
	$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."countdown_with_background_playlist) WHERE countdownid = %d ORDER BY ord",$countdownID );
	$result = $wpdb->get_results($safe_sql,ARRAY_A);
	$playlist_str='';
	foreach ( $result as $row_playlist ) {

		$row_playlist=countdown_with_background_unstrip_array($row_playlist);

		$img_over='';
		if ($row_playlist['img']!='') {
			if (strpos($row_playlist['img'], 'wp-content',9)===false)
				list($width, $height, $type, $attr) = getimagesize($row_playlist['img']);
			else
				list($width, $height, $type, $attr) = getimagesize( ABSPATH.substr($row_playlist['img'],strpos($row_playlist['img'], 'wp-content',9)) );
			$img_over='<img src="'.$row_playlist['img'].'" width="'.$width.'" height="'.$height.'" alt="'.$row_playlist['title'].'"  title="'.$row_playlist['title'].'" />';
			//$img_over='<img src="'.$row_playlist['img'].'" width="'.$width.'" height="'.$height.'" style="width:'.$width.'px; height:'.$height.'px;" alt="'.$row_playlist['title'].'"  title="'.$row_playlist['title'].'" />';
		}


		$playlist_str.='<li><a href="'.$row_playlist['data-link'].'" target="'.$row_playlist['data-target'].'">'.$img_over.'</a></li>';

	}

	//background
	$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."countdown_with_background_bg_playlist) WHERE countdownid = %d ORDER BY ord",$countdownID );
	$result_bg = $wpdb->get_results($safe_sql,ARRAY_A);
	$playlist_str_bg='';
	if ($wpdb->num_rows===0) {
			$img_over='<img src="'.plugins_url("", __FILE__).'/countdown_with_background/countdown_images/empty.png'.'" width="1" height="1">';
			$playlist_str_bg='<li data-video="" data-bottom-thumb="" data-link="" data-target="">'.$img_over.'</li>';
	}

	foreach ( $result_bg as $row_playlist_bg ) {
		$row_playlist_bg=countdown_with_background_unstrip_array($row_playlist_bg);

		$img_over='<img src="'.plugins_url("", __FILE__).'/countdown_with_background/countdown_images/empty.png'.'" width="1" height="1">';
		if ($row_playlist_bg['img']!='') {
			if (strpos($row_playlist_bg['img'], 'wp-content',9)===false)
				list($width, $height, $type, $attr) = getimagesize($row_playlist_bg['img']);
			else
				list($width, $height, $type, $attr) = getimagesize( ABSPATH.substr($row_playlist_bg['img'],strpos($row_playlist_bg['img'], 'wp-content',9)) );
			$img_over='<img src="'.$row_playlist_bg['img'].'" width="'.$width.'" height="'.$height.'" style="width:'.$width.'px; height:'.$height.'px;" alt="'.$row_playlist_bg['alt_text'].'" />';
		}


		$playlist_str_bg.='<li data-video="'.$row_playlist_bg['data-video'].'" data-bottom-thumb="'.$row_playlist_bg['thumbnail'].'" data-link="'.$row_playlist_bg['data-link'].'" data-target="'.$row_playlist_bg['data-target'].'">'.$img_over.$row_playlist_bg['content'].'</li>';

	}



	$currentY=date("Y");
	$currentM=date("n");
	$currentD=date("j");
	$currentH=date("H");
	$currentMin=date("i");
	$currentS=date("s");

	$servertime='';
	if ($row["servertime"]=='true') {
		$servertime=$currentY.','.$currentM.','.$currentD.','.$currentH.','.$currentMin.','.$currentS;
	}

	$the_logo='';
	if ($row["logo"]!='') {
		$the_logo='<div class="logoDiv">'.(($row["logoLink"]!='')?'<a href="'.$row["logoLink"].'" target="'.$row["logoTarget"].'">':'').'<img src="'.$row["logo"].'" alt="logo" border="0" />'.(($row["logoLink"]!='')?'</a>':'').'</div>';
	}

	$the_h2='';
	if ($row["h2Text"]!='') {
		$the_h2='<h2>'.$row["h2Text"].'</h2>';
	}

	$the_h3='';
	if ($row["h3Text"]!='') {
		$the_h3='<h3>'.$row["h3Text"].'</h3>';
	}

	$the_h4='';
	if ($row["h4Text"]!='') {
		$the_h4='<h4>'.$row["h4Text"].'</h4>';
	}

	$the_p_tag_content='';
	if ($row["p_tag_content"]!='') {
		$the_p_tag_content='<p>'.$row["p_tag_content"].'</p>';
	}

	$the_social='';
	if ($playlist_str!='') {
		$the_social='<div class="socialIconsDiv">'
            .$the_h4.
			'<ul class="socialIcons">'.$playlist_str.'</ul>
		 </div>';
	}


	//aux hours
	$aux_divBackgroundHoursImg=$row["divBackgroundHoursImg"];
	$aux_divBackgroundHoursHexa=$row["divBackgroundHoursHexa"];
	$aux_borderTopColorHours=$row["borderTopColorHours"];
	$aux_borderRightColorHours=$row["borderRightColorHours"];
	$aux_borderBottomColorHours=$row["borderBottomColorHours"];
	$aux_borderLeftColorHours=$row["borderLeftColorHours"];
	$aux_circleColorHours=$row["circleColorHours"];
	$aux_circleAlphaHours=$row["circleAlphaHours"];
	$aux_behindCircleColorHours=$row["behindCircleColorHours"];
	$aux_behindCircleAlphaHours=$row["behindCircleAlphaHours"];
	$aux_numberColorHours=$row["numberColorHours"];
	$aux_textColorHours=$row["textColorHours"];
	$aux_textBackgroundHoursImg=$row["textBackgroundHoursImg"];
	$aux_textBackgroundHoursHexa=$row["textBackgroundHoursHexa"];

	//aux minutes
	$aux_divBackgroundMinutesImg=$row["divBackgroundMinutesImg"];
	$aux_divBackgroundMinutesHexa=$row["divBackgroundMinutesHexa"];
	$aux_borderTopColorMinutes=$row["borderTopColorMinutes"];
	$aux_borderRightColorMinutes=$row["borderRightColorMinutes"];
	$aux_borderBottomColorMinutes=$row["borderBottomColorMinutes"];
	$aux_borderLeftColorMinutes=$row["borderLeftColorMinutes"];
	$aux_circleColorMinutes=$row["circleColorMinutes"];
	$aux_circleAlphaMinutes=$row["circleAlphaMinutes"];
	$aux_behindCircleColorMinutes=$row["behindCircleColorMinutes"];
	$aux_behindCircleAlphaMinutes=$row["behindCircleAlphaMinutes"];
	$aux_numberColorMinutes=$row["numberColorMinutes"];
	$aux_textColorMinutes=$row["textColorMinutes"];
	$aux_textBackgroundMinutesImg=$row["textBackgroundMinutesImg"];
	$aux_textBackgroundMinutesHexa=$row["textBackgroundMinutesHexa"];

	//aux seconds
	$aux_divBackgroundSecondsImg=$row["divBackgroundSecondsImg"];
	$aux_divBackgroundSecondsHexa=$row["divBackgroundSecondsHexa"];
	$aux_borderTopColorSeconds=$row["borderTopColorSeconds"];
	$aux_borderRightColorSeconds=$row["borderRightColorSeconds"];
	$aux_borderBottomColorSeconds=$row["borderBottomColorSeconds"];
	$aux_borderLeftColorSeconds=$row["borderLeftColorSeconds"];
	$aux_circleColorSeconds=$row["circleColorSeconds"];
	$aux_circleAlphaSeconds=$row["circleAlphaSeconds"];
	$aux_behindCircleColorSeconds=$row["behindCircleColorSeconds"];
	$aux_behindCircleAlphaSeconds=$row["behindCircleAlphaSeconds"];
	$aux_numberColorSeconds=$row["numberColorSeconds"];
	$aux_textColorSeconds=$row["textColorSeconds"];
	$aux_textBackgroundSecondsImg=$row["textBackgroundSecondsImg"];
	$aux_textBackgroundSecondsHexa=$row["textBackgroundSecondsHexa"];

	if ($row["useTheseSettingsForAll"]!='all') {
				//aux hours
				$aux_divBackgroundHoursImg=$row["divBackgroundDaysImg"];
				$aux_divBackgroundHoursHexa=$row["divBackgroundDaysHexa"];
				$aux_borderTopColorHours=$row["borderTopColorDays"];
				$aux_borderRightColorHours=$row["borderRightColorDays"];
				$aux_borderBottomColorHours=$row["borderBottomColorDays"];
				$aux_borderLeftColorHours=$row["borderLeftColorDays"];
				$aux_circleColorHours=$row["circleColorDays"];
				$aux_circleAlphaHours=$row["circleAlphaDays"];
				$aux_behindCircleColorHours=$row["behindCircleColorDays"];
				$aux_behindCircleAlphaHours=$row["behindCircleAlphaDays"];
				$aux_numberColorHours=$row["numberColorDays"];
				$aux_textColorHours=$row["textColorDays"];
				$aux_textBackgroundHoursImg=$row["textBackgroundDaysImg"];
				$aux_textBackgroundHoursHexa=$row["textBackgroundDaysHexa"];

				//aux minutes
				$aux_divBackgroundMinutesImg=$row["divBackgroundDaysImg"];
				$aux_divBackgroundMinutesHexa=$row["divBackgroundDaysHexa"];
				$aux_borderTopColorMinutes=$row["borderTopColorDays"];
				$aux_borderRightColorMinutes=$row["borderRightColorDays"];
				$aux_borderBottomColorMinutes=$row["borderBottomColorDays"];
				$aux_borderLeftColorMinutes=$row["borderLeftColorDays"];
				$aux_circleColorMinutes=$row["circleColorDays"];
				$aux_circleAlphaMinutes=$row["circleAlphaDays"];
				$aux_behindCircleColorMinutes=$row["behindCircleColorDays"];
				$aux_behindCircleAlphaMinutes=$row["behindCircleAlphaDays"];
				$aux_numberColorMinutes=$row["numberColorDays"];
				$aux_textColorMinutes=$row["textColorDays"];
				$aux_textBackgroundMinutesImg=$row["textBackgroundDaysImg"];
				$aux_textBackgroundMinutesHexa=$row["textBackgroundDaysHexa"];

				//aux seconds
				$aux_divBackgroundSecondsImg=$row["divBackgroundDaysImg"];
				$aux_divBackgroundSecondsHexa=$row["divBackgroundDaysHexa"];
				$aux_borderTopColorSeconds=$row["borderTopColorDays"];
				$aux_borderRightColorSeconds=$row["borderRightColorDays"];
				$aux_borderBottomColorSeconds=$row["borderBottomColorDays"];
				$aux_borderLeftColorSeconds=$row["borderLeftColorDays"];
				$aux_circleColorSeconds=$row["circleColorDays"];
				$aux_circleAlphaSeconds=$row["circleAlphaDays"];
				$aux_behindCircleColorSeconds=$row["behindCircleColorDays"];
				$aux_behindCircleAlphaSeconds=$row["behindCircleAlphaDays"];
				$aux_numberColorSeconds=$row["numberColorDays"];
				$aux_textColorSeconds=$row["textColorDays"];
				$aux_textBackgroundSecondsImg=$row["textBackgroundDaysImg"];
				$aux_textBackgroundSecondsHexa=$row["textBackgroundDaysHexa"];
	}


	/*$the_bg='';
	if ($playlist_str_bg!='') {
		$the_bg='<div class="socialIconsDiv">
			<ul class="socialIcons">'.$playlist_str.'</ul>
		 </div>';
	}*/


	$str_to_return='<link href="'.$row["pluginFontFamilyGoogleLink"].'" rel="stylesheet" type="text/css">
	<script>
		jQuery(function() {
			jQuery("#countdown_with_background_'.$row["id"].'").countdown_with_background({
				beginDate:"'.$row["beginDate_date"].','.$row["beginDate_hours"].','.$row["beginDate_minutes"].','.$row["beginDate_seconds"].'",
				launchingDate:"'.$row["endDate_date"].','.$row["endDate_hours"].','.$row["endDate_minutes"].','.$row["endDate_seconds"].'",
				nowDate:"'.$servertime.'",
				responsive:'.$row["responsive"].',
				pluginFontFamily:"'.$row["pluginFontFamily"].'",
				circleRadius:'.$row["circleRadius"].',
				circleLineWidth:'.$row["circleLineWidth"].',
				behindCircleLineWidthExpand:'.$row["behindCircleLineWidthExpand"].',
				circleTopBottomPadding:'.$row["circleTopBottomPadding"].',
				circleLeftRightPadding:'.$row["circleLeftRightPadding"].',
				numberSize:'.$row["numberSize"].',
				numberAdditionalTopPadding:'.$row["numberAdditionalTopPadding"].',
				textSize:'.$row["textSize"].',
				textMarginTop:'.$row["textMarginTop"].',
				textPadding:'.$row["textPadding"].',
				lineSeparatorImg:"'.$row["lineSeparatorImg"].'",
				allCirclesTopMargin:'.$row["allCirclesTopMargin"].',
				allCirclesBottomMargin:'.$row["allCirclesBottomMargin"].',
				socialBgOFF:"'.$row["socialBgOFF"].'",
				socialBgON:"'.$row["socialBgON"].'",
				complete:'.(($row["complete"]!='')?$row["complete"]:'""').',
				autoReset24h:'.$row["autoReset24h"].',


				divBackgroundDays:"'.(($row["divBackgroundDaysImg"])?$row["divBackgroundDaysImg"]:'#'.$row["divBackgroundDaysHexa"]).'",
				borderTopColorDays:"#'.$row["borderTopColorDays"].'",
				borderRightColorDays:"#'.$row["borderRightColorDays"].'",
				borderBottomColorDays:"#'.$row["borderBottomColorDays"].'",
				borderLeftColorDays:"#'.$row["borderLeftColorDays"].'",
				circleColorDays:"#'.$row["circleColorDays"].'",
				circleAlphaDays:'.$row["circleAlphaDays"].',
				behindCircleColorDays:"#'.$row["behindCircleColorDays"].'",
				behindCircleAlphaDays:'.$row["behindCircleAlphaDays"].',
				numberColorDays:"#'.$row["numberColorDays"].'",
				textColorDays:"#'.$row["textColorDays"].'",
				textColorBackgroundDays:"'.(($row["textBackgroundDaysImg"])?$row["textBackgroundDaysImg"]:'#'.$row["textBackgroundDaysHexa"]).'",

				divBackgroundHours:"'.(($aux_divBackgroundHoursImg)?$aux_divBackgroundHoursImg:'#'.$aux_divBackgroundHoursHexa).'",
				borderTopColorHours:"#'.$aux_borderTopColorHours.'",
				borderRightColorHours:"#'.$aux_borderRightColorHours.'",
				borderBottomColorHours:"#'.$aux_borderBottomColorHours.'",
				borderLeftColorHours:"#'.$aux_borderLeftColorHours.'",
				circleColorHours:"#'.$aux_circleColorHours.'",
				circleAlphaHours:'.$aux_circleAlphaHours.',
				behindCircleColorHours:"#'.$aux_behindCircleColorHours.'",
				behindCircleAlphaHours:'.$aux_behindCircleAlphaHours.',
				numberColorHours:"#'.$aux_numberColorHours.'",
				textColorHours:"#'.$aux_textColorHours.'",
				textColorBackgroundHours:"'.(($aux_textBackgroundHoursImg)?$aux_textBackgroundHoursImg:'#'.$aux_textBackgroundHoursHexa).'",

				divBackgroundMinutes:"'.(($aux_divBackgroundMinutesImg)?$aux_divBackgroundMinutesImg:'#'.$aux_divBackgroundMinutesHexa).'",
				borderTopColorMinutes:"#'.$aux_borderTopColorMinutes.'",
				borderRightColorMinutes:"#'.$aux_borderRightColorMinutes.'",
				borderBottomColorMinutes:"#'.$aux_borderBottomColorMinutes.'",
				borderLeftColorMinutes:"#'.$aux_borderLeftColorMinutes.'",
				circleColorMinutes:"#'.$aux_circleColorMinutes.'",
				circleAlphaMinutes:'.$aux_circleAlphaMinutes.',
				behindCircleColorMinutes:"#'.$aux_behindCircleColorMinutes.'",
				behindCircleAlphaMinutes:'.$aux_behindCircleAlphaMinutes.',
				numberColorMinutes:"#'.$aux_numberColorMinutes.'",
				textColorMinutes:"#'.$aux_textColorMinutes.'",
				textColorBackgroundMinutes:"'.(($aux_textBackgroundMinutesImg)?$aux_textBackgroundMinutesImg:'#'.$aux_textBackgroundMinutesHexa).'",

				divBackgroundSeconds:"'.(($aux_divBackgroundSecondsImg)?$aux_divBackgroundSecondsImg:'#'.$aux_divBackgroundSecondsHexa).'",
				borderTopColorSeconds:"#'.$aux_borderTopColorSeconds.'",
				borderRightColorSeconds:"#'.$aux_borderRightColorSeconds.'",
				borderBottomColorSeconds:"#'.$aux_borderBottomColorSeconds.'",
				borderLeftColorSeconds:"#'.$aux_borderLeftColorSeconds.'",
				circleColorSeconds:"#'.$aux_circleColorSeconds.'",
				circleAlphaSeconds:'.$aux_circleAlphaSeconds.',
				behindCircleColorSeconds:"#'.$aux_behindCircleColorSeconds.'",
				behindCircleAlphaSeconds:'.$aux_behindCircleAlphaSeconds.',
				numberColorSeconds:"#'.$aux_numberColorSeconds.'",
				textColorSeconds:"#'.$aux_textColorSeconds.'",
				textColorBackgroundSeconds:"'.(($aux_textBackgroundSecondsImg)?$aux_textBackgroundSecondsImg:'#'.$aux_textBackgroundSecondsHexa).'",

				h2Size:'.$row["h2Size"].',
				h2Color:"#'.$row["h2Color"].'",
				h2Weight:"'.$row["h2Weight"].'",
				h2TopMargin:'.$row["h2TopMargin"].',

				h3Size:'.$row["h3Size"].',
				h3Color:"#'.$row["h3Color"].'",
				h3Weight:"'.$row["h3Weight"].'",
				h3TopMargin:'.$row["h3TopMargin"].',

				h4Size:'.$row["h4Size"].',
				h4Color:"#'.$row["h4Color"].'",
				h4Weight:"'.$row["h4Weight"].'",
				h4TopMargin:'.$row["h4TopMargin"].',

				defaultTextSize:'.$row["defaultTextSize"].',
				defaultTextColor:"#'.$row["defaultTextColor"].'",
				defaultTextWeight:"'.$row["defaultTextWeight"].'",
				defaultTextTopMargin:'.$row["defaultTextTopMargin"].',

				defaultTextLinkSize:'.$row["defaultTextLinkSize"].',
				defaultTextLinkColor:"#'.$row["defaultTextLinkColor"].'",
				defaultTextLinkWeight:"'.$row["defaultTextLinkWeight"].'",

				autoPlay:'.$row["autoPlay"].',
				loop:'.$row["loop"].',
				fadeSlides:'.$row["fadeSlides"].',
				absUrl:"'.plugins_url("", __FILE__).'/countdown_with_background/",
				texturePath:"'.$row["texturePath"].'",
				enableTouchScreen:'.$row["enableTouchScreen"].',

				showLineTimer:'.$row["showLineTimer"].',
				lineTimerHeight:'.$row["lineTimerHeight"].',
				lineTimerColor:"#'.$row["lineTimerColor"].'",
				lineTimerAlpha:'.$row["lineTimerAlpha"].',

				showAllControllers:'.$row["showAllControllers"].',
				showNavArrows:'.$row["showNavArrows"].',
				showOnInitNavArrows:'.$row["showOnInitNavArrows"].',
				autoHideNavArrows:'.$row["autoHideNavArrows"].',
				showBottomNav:'.$row["showBottomNav"].',
				showOnInitBottomNav:'.$row["showOnInitBottomNav"].',
				autoHideBottomNav:'.$row["autoHideBottomNav"].',
				showPreviewThumbs:'.$row["showPreviewThumbs"].',
				thumbsWrapperMarginTop:'.$row["thumbsWrapperMarginTop"].',
				bottomNavPos:"'.$row["bottomNavPos"].'",
				bottomNavLateralMargin:'.$row["bottomNavLateralMargin"].',
				thumbsBorderColorON:"#'.$row["thumbsBorderColorON"].'",
				thumbsBorderColorOFF:"#'.$row["thumbsBorderColorOFF"].'",
				videoProportionWidth:'.$row["videoProportionWidth"].'



			});
		});
	</script>
	<div id="countdown_with_background_'.$row["id"].'">
			<div class="myloader"></div>
            <ul class="fullscreen_background_list">'.$playlist_str_bg.'</ul>
	</div>

    <div class="my_counter">'.$the_logo.$the_h2.$the_h3.$the_p_tag_content.
                '<div class="theCircles xgroup">
                    <div class="daysDiv">
                        <canvas class="canvasDays"></canvas>
                        <div class="innerNumber">0</div>
                        <div class="innerText">'.$row["translateDays"].'</div>
                    </div>
                    <div class="hoursDiv">
                        <canvas class="canvasHours"></canvas>
                        <div class="innerNumber">0</div>
                        <div class="innerText">'.$row["translateHours"].'</div>
                    </div>
                    <div class="minutesDiv">
                        <canvas class="canvasMinutes"></canvas>
                        <div class="innerNumber">0</div>
                        <div class="innerText">'.$row["translateMinutes"].'</div>
                    </div>
                    <div class="secondsDiv">
                        <canvas class="canvasSeconds"></canvas>
                        <div class="innerNumber">0</div>
                        <div class="innerText">'.$row["translateSeconds"].'</div>
                    </div>
                </div>'
		 .$the_social.'
	</div>';
	//return str_replace("\r\n", '', $str_to_return);
	return $str_to_return;
}


function countdown_with_background_shortcode($atts, $content=null) {
	global $wpdb;
	global $countdown_with_background_path;

	shortcode_atts( array('settings_id'=>''), $atts);
	if ($atts['settings_id']=='')
		$atts['settings_id']=1;

	return countdown_with_background_generate_preview_code($atts['settings_id']);

}

function countdown_with_background_plugin_redirect()
{
	global $wpdb;
	global $countdown_with_background_path;

	if(!is_admin()){
		if(!is_user_logged_in()) {
			//echo countdown_with_background_generate_preview_code($_POST['theCountDownID']);
			$safe_sql="SELECT id,enableMaintenanceMode,servertime FROM (".$wpdb->prefix ."countdown_with_background_settings)";
			$result = $wpdb->get_results($safe_sql,ARRAY_A);
			foreach ( $result as $row ) {
				if ($row['enableMaintenanceMode']=='true') {
					//wp_redirect( home_url( '/signup/' ) );
					if ($row['servertime']=="true") {
						writePreviewAndMaintenanceFile($row['id'],'tpl/maintenance_mode.html');
					}
					include(plugin_dir_path(__FILE__).'tpl/maintenance_mode.html');
					exit();
				}
			}
		}
	}
}


register_activation_hook(__FILE__,"countdown_with_background_activate"); //activate plugin and create the database
register_uninstall_hook(__FILE__, 'countdown_with_background_uninstall'); // on unistall delete all databases
add_action('init', 'countdown_with_background_init_sessions');	// initialize sessions
add_action('init', 'countdown_with_background_load_styles');	// loads required styles
add_action('init', 'countdown_with_background_load_scripts');			// loads required scripts
add_action('admin_menu', 'countdown_with_background_plugin_menu'); // create menus
add_shortcode('countdown_with_background', 'countdown_with_background_shortcode');				// COUNTDOWN-WITH-BACKGROUND shortcode
add_action( 'template_redirect', 'countdown_with_background_plugin_redirect');

add_action('wp_logout','countdown_with_background_end_sessions');
add_action('wp_login','countdown_with_background_end_sessions');







/** OTHER FUNCTIONS **/

//stripslashes for an entire array
function countdown_with_background_unstrip_array($array){
	if (is_array($array)) {
		foreach($array as &$val){
			if(is_array($val)){
				$val = unstrip_array($val);
			} else {
				$val = stripslashes($val);

			}
		}
	}
	return $array;
}







/* ajax update playlist record */

add_action('admin_head', 'countdown_with_background_update_playlist_record_javascript');

function countdown_with_background_update_playlist_record_javascript() {
	global $wpdb;
	global $countdown_with_background_path;
	//Set Your Nonce
	$countdown_with_background_update_playlist_record_ajax_nonce = wp_create_nonce("countdown_with_background_update_playlist_record-special-string");
	$countdown_with_background_update_playlist_bg_record_ajax_nonce = wp_create_nonce("countdown_with_background_update_playlist_bg_record-special-string");
	$countdown_with_background_preview_record_ajax_nonce = wp_create_nonce("countdown_with_background_preview_record-special-string");


	if(strpos($_SERVER['PHP_SELF'], 'wp-admin') !== false) {
		$page = (isset($_GET['page'])) ? $_GET['page'] : '';
		if(preg_match('/countdown_with_background/i', $page)) {
?>




<script type="text/javascript" >

//delete the entire record
function countdown_with_background_delete_entire_record (delete_id) {
	if (confirm('Are you sure?')) {
		jQuery("#countdown_with_background_sortable").sortable('disable');
		jQuery("#"+delete_id).css("display","none");
		//jQuery("#countdown_with_background_sortable").sortable('refresh');
		jQuery("#countdown_with_background_updating_witness").css("display","block");
		var data = "action=countdown_with_background_update_playlist_record&security=<?php echo $countdown_with_background_update_playlist_record_ajax_nonce; ?>&updateType=countdown_with_background_delete_entire_record&delete_id="+delete_id;
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			jQuery("#countdown_with_background_sortable").sortable('enable');
			jQuery("#countdown_with_background_updating_witness").css("display","none");
			//alert('Got this from the server: ' + response);
		});
	}
}





function countdown_with_background_delete_entire_record_bg (delete_id) {
	if (confirm('Are you sure?')) {
		jQuery("#countdown_with_background_slider_sortable").sortable('disable');
		jQuery("#"+delete_id).css("display","none");
		//jQuery("#countdown_with_background_sortable").sortable('refresh');
		jQuery("#countdown_with_background_updating_witness").css("display","block");
		var data = "action=countdown_with_background_update_playlist_bg_record&security=<?php echo $countdown_with_background_update_playlist_bg_record_ajax_nonce; ?>&updateType=countdown_with_background_delete_entire_record&delete_id="+delete_id;
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			jQuery("#countdown_with_background_slider_sortable").sortable('enable');
			jQuery("#countdown_with_background_updating_witness").css("display","none");
			//alert('Got this from the server: ' + response);
		});
	}
}








function countdown_with_background_process_val(val,cssprop) {
	retVal=parseInt(val.substring(0, val.length-2));
	if (cssprop=="top")
		retVal=retVal-148;
	return retVal;
}






function showDialogPreview(theCountDownID) {  //load content and open dialog
	var data ="action=countdown_with_background_preview_record&security=<?php echo $countdown_with_background_preview_record_ajax_nonce; ?>&theCountDownID="+theCountDownID;

	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery.post(ajaxurl, data, function(response) {
		//jQuery("#previewDialog").html(response);
		jQuery('#previewDialogIframe').attr('src','<?php echo plugins_url("tpl/preview.html?d=".time(), __FILE__)?>');
		jQuery("#previewDialog").dialog("open");
	});
}



jQuery(document).ready(function($) {
	/*PREVIEW DIALOG BOX*/
	jQuery( "#previewDialog" ).dialog({
	  minWidth:1400,
	  minHeight:650,
	  title:"CountDown Preview",
	  modal: true,
	  autoOpen:false,
	  hide: "fade",
	  resizable: false,
	   position: { my: "right center", at: "right center", of: window },
	  open: function() {
		//jQuery( this ).html();
	  },
	  close: function() {
		//jQuery("#previewDialog").html('');
		jQuery('#previewDialogIframe').attr('src','');
	  }
	});

	/* THE PLAYLIST SOCIAL*/
	if (jQuery('#countdown_with_background_sortable').length) {
		jQuery( '#countdown_with_background_sortable' ).sortable({
			placeholder: "ui-state-highlight",
			start: function(event, ui) {
	            ord_start = ui.item.prevAll().length + 1;
	        },
			update: function(event, ui) {
	        	jQuery("#countdown_with_background_sortable").sortable('disable');
	        	jQuery("#countdown_with_background_updating_witness").css("display","block");
				var ord_stop=ui.item.prevAll().length + 1;
				var elem_id=ui.item.attr("id");
				//alert (ui.item.attr("id"));
				//alert (ord_start+' --- '+ord_stop);
				var data = "action=countdown_with_background_update_playlist_record&security=<?php echo $countdown_with_background_update_playlist_record_ajax_nonce; ?>&updateType=change_ord&ord_start="+ord_start+"&ord_stop="+ord_stop+"&elem_id="+elem_id;
				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post(ajaxurl, data, function(response) {
					jQuery("#countdown_with_background_sortable").sortable('enable');
					jQuery("#countdown_with_background_updating_witness").css("display","none");
					//alert('Got this from the server: ' + response);
				});
			}
		});
	}



	/* THE PLAYLIST SOCIAL*/
	if (jQuery('#countdown_with_background_slider_sortable').length) {
		jQuery( '#countdown_with_background_slider_sortable' ).sortable({
			placeholder: "ui-state-highlight",
			start: function(event, ui) {
	            ord_start = ui.item.prevAll().length + 1;
	        },
			update: function(event, ui) {
	        	jQuery("#countdown_with_background_slider_sortable").sortable('disable');
	        	jQuery("#countdown_with_background_updating_witness").css("display","block");
				var ord_stop=ui.item.prevAll().length + 1;
				var elem_id=ui.item.attr("id");
				//alert (ui.item.attr("id"));
				//alert (ord_start+' --- '+ord_stop);
				var data = "action=countdown_with_background_update_playlist_bg_record&security=<?php echo $countdown_with_background_update_playlist_bg_record_ajax_nonce; ?>&updateType=change_ord&ord_start="+ord_start+"&ord_stop="+ord_stop+"&elem_id="+elem_id;
				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post(ajaxurl, data, function(response) {
					jQuery("#countdown_with_background_slider_sortable").sortable('enable');
					jQuery("#countdown_with_background_updating_witness").css("display","none");
					//alert('Got this from the server: ' + response);
				});
			}
		});
	}




	<?php
		$rows_count = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) FROM ". $wpdb->prefix . "countdown_with_background_playlist WHERE countdownid = %d ORDER BY ord",$_SESSION['xid'] ) );
//$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."countdown_with_background_playlist) WHERE countdownid = %d ORDER BY ord",$_SESSION['xid'] );
		for ($i=1;$i<=$rows_count;$i++) {
	?>
				jQuery('#upload_img_button_countdown_with_background_<?php echo $i?>').click(function(event) {
						var file_frame;
						event.preventDefault();
						// If the media frame already exists, reopen it.
						if ( file_frame ) {
							file_frame.open();
							return;
						}
						// Create the media frame.
						file_frame = wp.media.frames.file_frame = wp.media({
							title: jQuery( this ).data( 'uploader_title' ),
							button: {
							text: jQuery( this ).data( 'uploader_button_text' ),
							},
							multiple: false // Set to true to allow multiple files to be selected
						});
						// When an image is selected, run a callback.
						file_frame.on( 'select', function() {
							// We set multiple to false so only get one image from the uploader
							attachment = file_frame.state().get('selection').first().toJSON();
							// Do something with attachment.id and/or attachment.url here
							//alert (attachment.url);
							document.forms["form-playlist-countdown_with_background-"+<?php echo $i?>].img.value=attachment.url;
							jQuery('#img_'+<?php echo $i?>).attr('src',attachment.url);
						});
						// Finally, open the modal
						file_frame.open();
				});




	jQuery("#form-playlist-countdown_with_background-<?php echo $i?>").submit(function(event) {

		/* stop form from submitting normally */
		event.preventDefault();

		//show loading image
		jQuery('#ajax-message-<?php echo $i?>').html('<img src="<?php echo plugins_url('countdown_with_background/images/ajax-loader.gif', dirname(__FILE__))?>" />');
		var data ="action=countdown_with_background_update_playlist_record&security=<?php echo $countdown_with_background_update_playlist_record_ajax_nonce; ?>&"+jQuery("#form-playlist-countdown_with_background-<?php echo $i?>").serialize();

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			//alert('Got this from the server: ' + response);
			//alert(jQuery("#form-playlist-countdown_with_background-<?php echo $i?>").serialize());
			var new_img = '';
			if (document.forms["form-playlist-countdown_with_background-<?php echo $i?>"].img.value!='')
				new_img=document.forms["form-playlist-countdown_with_background-<?php echo $i?>"].img.value;
			jQuery('#top_image_'+document.forms["form-playlist-countdown_with_background-<?php echo $i?>"].id.value).attr('src',new_img);
			jQuery('#ajax-message-<?php echo $i?>').html(response);
		});
	});
	<?php }

		$rows_count = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) FROM ". $wpdb->prefix . "countdown_with_background_bg_playlist WHERE countdownid = %d ORDER BY ord",$_SESSION['xid'] ) );
		//$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."countdown_with_background_playlist) WHERE countdownid = %d ORDER BY ord",$_SESSION['xid'] );
		for ($i=1;$i<=$rows_count;$i++) {
	?>
				jQuery('#upload_img_button_<?php echo $i?>').click(function(event) {
						var file_frame;
						event.preventDefault();
						// If the media frame already exists, reopen it.
						if ( file_frame ) {
							file_frame.open();
							return;
						}
						// Create the media frame.
						file_frame = wp.media.frames.file_frame = wp.media({
							title: jQuery( this ).data( 'uploader_title' ),
							button: {
							text: jQuery( this ).data( 'uploader_button_text' ),
							},
							multiple: false // Set to true to allow multiple files to be selected
						});
						// When an image is selected, run a callback.
						file_frame.on( 'select', function() {
							// We set multiple to false so only get one image from the uploader
							attachment = file_frame.state().get('selection').first().toJSON();
							// Do something with attachment.id and/or attachment.url here
							//alert (attachment.url);
							document.forms["form-playlist-countdown_with_background_bg-"+<?php echo $i?>].img.value=attachment.url;
							jQuery('#img_'+<?php echo $i?>).attr('src',attachment.url);
						});
						// Finally, open the modal
						file_frame.open();
				});

				jQuery('#upload_thumbnail_button_countdown_with_background_slider_<?php echo $i?>').click(function(event) {
						var file_frame;
						event.preventDefault();
						// If the media frame already exists, reopen it.
						if ( file_frame ) {
							file_frame.open();
							return;
						}
						// Create the media frame.
						file_frame = wp.media.frames.file_frame = wp.media({
							title: jQuery( this ).data( 'uploader_title' ),
							button: {
							text: jQuery( this ).data( 'uploader_button_text' ),
							},
							multiple: false // Set to true to allow multiple files to be selected
						});
						// When an image is selected, run a callback.
						file_frame.on( 'select', function() {
							// We set multiple to false so only get one image from the uploader
							attachment = file_frame.state().get('selection').first().toJSON();
							// Do something with attachment.id and/or attachment.url here
							//alert (attachment.url);
							document.forms["form-playlist-countdown_with_background_bg-"+<?php echo $i?>].img.value=attachment.url;
							jQuery('#thumbnail_'+<?php echo $i?>).attr('src',attachment.url);
						});
						// Finally, open the modal
						file_frame.open();
				});


	jQuery("#form-playlist-countdown_with_background_bg-<?php echo $i?>").submit(function(event) {
		/* stop form from submitting normally */
		event.preventDefault();

		//show loading image
		jQuery('#ajax-message-<?php echo $i?>').html('<img src="<?php echo plugins_url('countdown_with_background/images/ajax-loader.gif', dirname(__FILE__))?>" />');
		var data ="action=countdown_with_background_update_playlist_bg_record&security=<?php echo $countdown_with_background_update_playlist_bg_record_ajax_nonce; ?>&"+jQuery("#form-playlist-countdown_with_background_bg-<?php echo $i?>").serialize();

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			//alert('Got this from the server: ' + response);
			//alert(jQuery("#form-playlist-countdown_with_background_bg-<?php echo $i?>").serialize());
			var new_img = '';
			if (document.forms["form-playlist-countdown_with_background_bg-<?php echo $i?>"].img.value!='')
				new_img=document.forms["form-playlist-countdown_with_background_bg-<?php echo $i?>"].img.value;
			jQuery('#top_image_'+document.forms["form-playlist-countdown_with_background_bg-<?php echo $i?>"].id.value).attr('src',new_img);
			jQuery('#ajax-message-<?php echo $i?>').html(response);
		});
	});
	<?php } ?>




});
</script>
<?php
		}
	}
}

//countdown_with_background_update_playlist_record is the action=countdown_with_background_update_playlist_record

add_action('wp_ajax_countdown_with_background_update_playlist_record', 'countdown_with_background_update_playlist_record_callback');
//FOR SOCIALS
function countdown_with_background_update_playlist_record_callback() {

	check_ajax_referer( 'countdown_with_background_update_playlist_record-special-string', 'security' ); //security=<?php echo $countdown_with_background_update_playlist_record_ajax_nonce;
	global $wpdb;
	global $countdown_with_background_messages;
	$errors_arr=array();
	//$wpdb->show_errors();

	//delete entire record
	//if ($_POST['updateType']=='countdown_with_background_delete_entire_record') {
	if (array_key_exists('updateType', $_POST) && $_POST['updateType']=='countdown_with_background_delete_entire_record') {
		$delete_id=$_POST['delete_id'];
		$safe_sql=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."countdown_with_background_playlist WHERE id = %d",$delete_id);
		$row = $wpdb->get_row($safe_sql, ARRAY_A);
		$row=countdown_with_background_unstrip_array($row);

		//delete the entire record
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."countdown_with_background_playlist WHERE id = %d",$delete_id));
		//update the order for the rest ord=ord-1 for > ord
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."countdown_with_background_playlist SET ord=ord-1 WHERE countdownid = %d and  ord>".$row['ord'],$_SESSION['xid']));
		writePreviewAndMaintenanceFile($_SESSION['xid'],'tpl/maintenance_mode.html');
	}

	//update elements order
	//if ($_POST['updateType']=='change_ord') {
	if (array_key_exists('updateType', $_POST) && $_POST['updateType']=='change_ord') {
		$sql_arr=array();
		$ord_start=$_POST['ord_start'];
		$ord_stop=$_POST['ord_stop'];
		$elem_id=(int)$_POST['elem_id'];
		$ord_direction='+1';
		if ($ord_start<$ord_stop)
			$sql_arr[]="UPDATE ".$wpdb->prefix."countdown_with_background_playlist SET ord=ord-1  WHERE countdownid = ".$_SESSION['xid']." and ord>".$ord_start." and ord<=".$ord_stop;
		else
			$sql_arr[]="UPDATE ".$wpdb->prefix."countdown_with_background_playlist SET ord=ord+1  WHERE countdownid = ".$_SESSION['xid']." and ord>=".$ord_stop." and ord<".$ord_start;
		$sql_arr[]="UPDATE ".$wpdb->prefix."countdown_with_background_playlist SET ord=".$ord_stop." WHERE id=".$elem_id;

		//echo "elem_id: ".$elem_id."----ord_start: ".$ord_start."----ord_stop: ".$ord_stop;
		foreach ($sql_arr as $sql) {
			$wpdb->query($sql);
		}

		writePreviewAndMaintenanceFile($_SESSION['xid'],'tpl/maintenance_mode.html');
	}




	//submit update
	/*if (empty($_POST['img']))
		$errors_arr[]=$countdown_with_background_messages['empty_img'];*/

	$theid=isset($_POST['id'])?$_POST['id']:0;
	if($theid>0 && !count($errors_arr)) {
		/*$except_arr=array('Submit'.$theid,'id','ord','action','security','updateType','uniqueUploadifyID');
		foreach ($_POST as $key=>$val){
			if (in_array($key,$except_arr)) {
				unset($_POST[$key]);
			}
		}*/
		//update playlist
		$wpdb->update(
			$wpdb->prefix .'countdown_with_background_playlist',
				array(
				'img' => $_POST['img'],
				'title' => $_POST['title'],
				'data-link' => $_POST['data-link'],
				'data-target' => $_POST['data-target']
				),
			array( 'id' => $theid )
		);


		writePreviewAndMaintenanceFile($_SESSION['xid'],'tpl/maintenance_mode.html');
		?>
			<div id="message" class="updated"><p><?php echo $countdown_with_background_messages['data_saved'];?></p></div>
	<?php
	} else if (!isset($_POST['updateType'])) {
		$errors_arr[]=$countdown_with_background_messages['invalid_request'];
	}
    //echo $theid;

	if (count($errors_arr)) { ?>
		<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
	<?php }

	die(); // this is required to return a proper result
}



add_action('wp_ajax_countdown_with_background_update_playlist_bg_record', 'countdown_with_background_update_playlist_bg_record_callback');
//FOR BACkGROUND
function countdown_with_background_update_playlist_bg_record_callback() {

	check_ajax_referer( 'countdown_with_background_update_playlist_bg_record-special-string', 'security' ); //security=<?php echo $countdown_with_background_update_playlist_record_ajax_nonce;
	global $wpdb;
	global $countdown_with_background_messages;
	$errors_arr=array();
	//$wpdb->show_errors();

	//delete entire record
	//if ($_POST['updateType']=='countdown_with_background_delete_entire_record') {
	if (array_key_exists('updateType', $_POST) && $_POST['updateType']=='countdown_with_background_delete_entire_record') {
		$delete_id=$_POST['delete_id'];
		$safe_sql=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."countdown_with_background_bg_playlist WHERE id = %d",$delete_id);
		$row = $wpdb->get_row($safe_sql, ARRAY_A);
		$row=countdown_with_background_unstrip_array($row);

		//delete the entire record
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."countdown_with_background_bg_playlist WHERE id = %d",$delete_id));
		//update the order for the rest ord=ord-1 for > ord
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."countdown_with_background_bg_playlist SET ord=ord-1 WHERE countdownid = %d and  ord>".$row['ord'],$_SESSION['xid']));
		writePreviewAndMaintenanceFile($_SESSION['xid'],'tpl/maintenance_mode.html');
	}

	//update elements order
	//if ($_POST['updateType']=='change_ord') {
	if (array_key_exists('updateType', $_POST) && $_POST['updateType']=='change_ord') {
		$sql_arr=array();
		$ord_start=$_POST['ord_start'];
		$ord_stop=$_POST['ord_stop'];
		$elem_id=(int)$_POST['elem_id'];
		$ord_direction='+1';
		if ($ord_start<$ord_stop)
			$sql_arr[]="UPDATE ".$wpdb->prefix."countdown_with_background_bg_playlist SET ord=ord-1  WHERE countdownid = ".$_SESSION['xid']." and ord>".$ord_start." and ord<=".$ord_stop;
		else
			$sql_arr[]="UPDATE ".$wpdb->prefix."countdown_with_background_bg_playlist SET ord=ord+1  WHERE countdownid = ".$_SESSION['xid']." and ord>=".$ord_stop." and ord<".$ord_start;
		$sql_arr[]="UPDATE ".$wpdb->prefix."countdown_with_background_bg_playlist SET ord=".$ord_stop." WHERE id=".$elem_id;

		//echo "elem_id: ".$elem_id."----ord_start: ".$ord_start."----ord_stop: ".$ord_stop;
		foreach ($sql_arr as $sql) {
			$wpdb->query($sql);
		}

		writePreviewAndMaintenanceFile($_SESSION['xid'],'tpl/maintenance_mode.html');
	}




	//submit update
	/*if (empty($_POST['img']))
		$errors_arr[]=$countdown_with_background_messages['empty_img'];*/

	$theid=isset($_POST['id'])?$_POST['id']:0;
	if($theid>0 && !count($errors_arr)) {
		/*$except_arr=array('Submit'.$theid,'id','ord','action','security','updateType','uniqueUploadifyID');
		foreach ($_POST as $key=>$val){
			if (in_array($key,$except_arr)) {
				unset($_POST[$key]);
			}
		}*/
		//update playlist
		$wpdb->update(
			$wpdb->prefix .'countdown_with_background_bg_playlist',
				array(
				'img' => $_POST['img'],
				'thumbnail' => $_POST['thumbnail'],
				'alt_text' => $_POST['alt_text'],
				'content' => $_POST['content'],
				'data-video' => $_POST['data-video'],
				'data-link' => $_POST['data-link'],
				'data-target' => $_POST['data-target']
				),
			array( 'id' => $theid )
		);
		$lst=$wpdb->last_query;

		writePreviewAndMaintenanceFile($_SESSION['xid'],'tpl/maintenance_mode.html');
		?>
			<div id="message" class="updated"><p><?php echo $countdown_with_background_messages['data_saved'];?></p></div>
	<?php
	} else if (!isset($_POST['updateType'])) {
		$errors_arr[]=$countdown_with_background_messages['invalid_request'];
	}
    //echo $theid;

	if (count($errors_arr)) { ?>
		<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
	<?php }

	die(); // this is required to return a proper result
}








function writePreviewAndMaintenanceFile($theCountDownID,$theFileName) {
	global $wpdb;
	//echo countdown_with_background_generate_preview_code($_POST['theCountDownID']);
	$safe_sql=$wpdb->prepare( "SELECT enableMaintenanceMode,pageBg,pageBgHexa,pageBgAdditionalCss FROM (".$wpdb->prefix ."countdown_with_background_settings) WHERE id = %d",$theCountDownID );
	$row = $wpdb->get_row($safe_sql,ARRAY_A);
	$row=countdown_with_background_unstrip_array($row);
	$bgColor='#CCCCCC';
	if ($row['enableMaintenanceMode']=='true') {
		if ($row['pageBgHexa'])
			$bgColor='#'.$row['pageBgHexa'];
		if ($row['pageBg'])
			$bgColor='url('.$row['pageBg'].')';
	}

	$aux_val=' <!DOCTYPE html>
	<html>
					<head>
			<link href="'.plugins_url('countdown_with_background/countdown_with_background.css', __FILE__).'" rel="stylesheet" type="text/css">

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
			<script src="'.plugins_url('countdown_with_background/js/countdown_with_background.js', __FILE__).'" type="text/javascript"></script>
			<script src="'.plugins_url('countdown_with_background/js/jquery.touchSwipe.min.js', __FILE__).'" type="text/javascript"></script>
					</head>
					<body style="padding:0px;margin:0px;background:'.$bgColor.' '.$row['pageBgAdditionalCss'].';">';

	$aux_val.=countdown_with_background_generate_preview_code($theCountDownID);
	$aux_val.="</body>
				</html>";
	$filename=plugin_dir_path(__FILE__) . $theFileName;
	if ($theFileName=='tpl/preview.html') {
		$fp = fopen($filename, 'w+');
		$fwrite = fwrite($fp, $aux_val);
	} else {
		if ($row['enableMaintenanceMode']=='true') {
			$fp = fopen($filename, 'w+');
			$fwrite = fwrite($fp, $aux_val);
		}
	}



	//echo $fwrite;

}






add_action('wp_ajax_countdown_with_background_preview_record', 'countdown_with_background_preview_record_callback');

function countdown_with_background_preview_record_callback() {
	check_ajax_referer( 'countdown_with_background_preview_record-special-string', 'security' );

	writePreviewAndMaintenanceFile($_POST['theCountDownID'],'tpl/preview.html');

	die(); // this is required to return a proper result
}



?>
