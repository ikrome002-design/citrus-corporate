<?php 

if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) exit();

// delete plugin options
delete_option('elfsight_social_media_icons_other_products_hidden');
delete_option('elfsight_social_media_icons_latest_version');
delete_option('elfsight_social_media_icons_last_check_datetime');

?>