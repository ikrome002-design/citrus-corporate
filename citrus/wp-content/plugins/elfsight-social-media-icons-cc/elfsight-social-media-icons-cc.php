<?php
/*
Plugin Name: Elfsight Social Media Icons CC
Description: Increasing followers and your social networks subscribers is fast and easy with the stylish and creative Elfsight Social Icons plugin.
Plugin URI: https://elfsight.com/social-media-icons-widget/wordpress/?utm_source=markets&utm_medium=codecanyon&utm_campaign=social-media-icons&utm_content=plugin-site
Version: 1.3.0
Author: Elfsight
Author URI: https://elfsight.com/?utm_source=markets&utm_medium=codecanyon&utm_campaign=social-media-icons&utm_content=plugins-list
*/

if (!defined('ABSPATH')) exit;


require_once('core/elfsight-plugin.php');

$elfsight_social_media_icons_config_path = plugin_dir_path(__FILE__) . 'config.json';
$elfsight_social_media_icons_config = json_decode(file_get_contents($elfsight_social_media_icons_config_path), true);

new ElfsightPlugin(array(
    'name' => 'Social Media Icons',
    'description' => 'Increasing followers and your social networks subscribers is fast and easy with the stylish and creative Elfsight Social Icons plugin.',
    'slug' => 'elfsight-social-media-icons',
    'version' => '1.3.0',
    'text_domain' => 'elfsight-social-media-icons',
    'editor_settings' => $elfsight_social_media_icons_config['settings'],
    'editor_preferences' => $elfsight_social_media_icons_config['preferences'],
    'script_url' => plugins_url('assets/elfsight-social-media-icons.js', __FILE__),

    'plugin_name' => 'Elfsight Social Media Icons',
    'plugin_file' => __FILE__,
    'plugin_slug' => plugin_basename(__FILE__),

    'vc_icon' => plugins_url('assets/img/vc-icon.png', __FILE__),

    'menu_icon' => plugins_url('assets/img/menu-icon.png', __FILE__),
    'update_url' => 'https://a.elfsight.com/updates/v1/',

    'preview_url' => plugins_url('preview/index.html', __FILE__),
    'observer_url' => plugins_url('preview/social-icons-observer.js', __FILE__),

    'product_url' => 'https://codecanyon.net/item/wordpress-social-media-icons-social-icons-plugin/20612375?ref=Elfsight',
    'support_url' => 'https://elfsight.ticksy.com/submit/#100010704'
));

?>