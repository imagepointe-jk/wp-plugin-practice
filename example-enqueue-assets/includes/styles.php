<?php

use ExampleEnqueue\Constants;

function example_enqueue_admin_styles($hook)
{
    $key_handle_suffix = 'handle_suffix';
    $key_path = 'path';

    //figure out which hook belongs to a specific page by using print_r(get_current_screen()) in the function that renders the page
    $hookAssets = [
        'toplevel_page_example-enqueue' => [
            $key_handle_suffix => '-admin-style-main',
            $key_path => 'assets/css/index.css'
        ],
        //the prefix of this hook appears to be derived from the menu title of the main menu page
        'enqueue-assets_page_subsettings-1' => [
            $key_handle_suffix => '-admin-style-subsettings1',
            $key_path => 'assets/css/subsettings1.css'
        ],
    ];

    if (!isset($hookAssets[$hook])) return;
    $asset = $hookAssets[$hook];

    wp_enqueue_style(
        Constants::SLUG . $asset[$key_handle_suffix],
        ENQUEUE_SCRIPTS_PLUGIN_URL . $asset[$key_path]
    );
}
add_action('admin_enqueue_scripts', 'example_enqueue_admin_styles', 100);
