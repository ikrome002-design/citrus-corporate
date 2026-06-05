<?php
/*
Plugin Name: Elfsight Form Builder CC
Description: Collect more data from your clients through various fill-in forms.
Plugin URI: https://elfsight.com/form-builder-widget/codecanyon/?utm_source=markets&utm_medium=codecanyon&utm_campaign=form-builder&utm_content=plugin-site
Version: 1.5.1
Author: Elfsight
Author URI: https://elfsight.com/?utm_source=markets&utm_medium=codecanyon&utm_campaign=form-builder&utm_content=plugins-list
*/

if (!defined('ABSPATH')) exit;


require_once('core/elfsight-plugin.php');
require_once('api/api.php');

$elfsight_form_builder_config_path = plugin_dir_path(__FILE__) . 'config.json';
$elfsight_form_builder_config = json_decode(file_get_contents($elfsight_form_builder_config_path), true);

new ElfsightFormBuilderApi\Api(
    array(
        'plugin_slug' => 'elfsight-form-builder',
        'plugin_file' => __FILE__,
        'recaptcha' => array(
            'checkbox' => array(
                'key' => '6LfXGHgUAAAAAHNIE_EH7kEI1l4xvf_ynIlg5bfo',
                'secret' => '6LfXGHgUAAAAAGCmhNNDS2ml7XEPuVPAu_SR7PlO'
            ),
            'invisible' => array(
                'key' => '6Ld1CXgUAAAAAFTHmixC1Eo-NP7_3ddB1YOj9AfX',
                'secret' => '6Ld1CXgUAAAAAEHIphoU9Rl8HFNl7sv-XquN8zc4'
            )
        )
    )
);

new ElfsightFormBuilderPlugin(
    array(
        'name' => esc_html__('Form Builder'),
        'slug' => 'elfsight-form-builder',
        'description' => esc_html__('Collect more data from your clients through various fill-in forms'),
        'version' => '1.5.1',
        'text_domain' => 'elfsight-form-builder',
        'editor_settings' => $elfsight_form_builder_config['settings'],
        'editor_preferences' => $elfsight_form_builder_config['preferences'],

        'plugin_name' => esc_html__('Elfsight Form Builder'),
        'plugin_file' => __FILE__,
        'plugin_slug' => plugin_basename(__FILE__),

        'vc_icon' => plugins_url('assets/img/vc-icon.png', __FILE__),
        'menu_icon' => plugins_url('assets/img/menu-icon.png', __FILE__),

        'update_url' => esc_url('https://a.elfsight.com/updates/v1/'),
        'product_url' => esc_url('https://codecanyon.net/item/form-builder-wordpress-form-plugin/22496923?ref=Elfsight'),
        'helpscout_plugin_id' => 110709
    )
);

?>
