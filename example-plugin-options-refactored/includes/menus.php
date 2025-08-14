<?php

use ExamplePluginOptions\Constants;

function example_plugin_options_page()
{
    add_menu_page(
        Constants::PLUGIN_TITLE,
        Constants::MENU_TITLE, //text in the sidebar
        Constants::CAPABILITY, //permissions
        Constants::SLUG, //slug
        'plugin_options_settings_page_markup', //callback to render settings page
        'dashicons-admin-multisite', //dashicons found at https://developer.wordpress.org/resource/dashicons/
        100
    );
}
add_action('admin_menu', 'example_plugin_options_page');
function plugin_options_settings_page_markup()
{
    if (!current_user_can('manage_options')) {
        return;
    }

    include(EXAMPLE_PLUGIN_OPTIONS_DIR . 'templates/settings-page.php');
}
