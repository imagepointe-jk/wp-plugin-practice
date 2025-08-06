<?php

use ExampleEnqueue\Constants;

function example_enqueue_admin_scripts($hook)
{
    $key_handle_suffix = 'handle_suffix';
    $key_path = 'path';

    //figure out which hook belongs to a specific page by using print_r(get_current_screen()) in the function that renders the page
    $hookAssets = [
        'toplevel_page_example-enqueue' => [
            $key_handle_suffix => '-admin-script-main',
            $key_path => 'assets/js/index.js'
        ],
        //the prefix of this hook appears to be derived from the menu title of the main menu page
        'enqueue-assets_page_subsettings-1' => [
            $key_handle_suffix => '-admin-script-subsettings1',
            $key_path => 'assets/js/subsettings1.js'
        ],
    ];

    if (!isset($hookAssets[$hook])) return;
    $asset = $hookAssets[$hook];

    wp_enqueue_script(
        Constants::SLUG . $asset[$key_handle_suffix],
        ENQUEUE_SCRIPTS_PLUGIN_URL . $asset[$key_path]
    );
}
add_action('admin_enqueue_scripts', 'example_enqueue_admin_scripts', 100);
