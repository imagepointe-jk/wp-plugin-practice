<?php

use ExampleEnqueue\Constants;

function example_enqueue_assets_page()
{
    add_menu_page(
        Constants::PLUGIN_TITLE,
        Constants::MENU_TITLE, //text in the sidebar
        Constants::CAPABILITY, //permissions
        Constants::SLUG, //slug
        'enqueue_assets_settings_page_markup', //callback to render settings page
        'dashicons-admin-multisite', //dashicons found at https://developer.wordpress.org/resource/dashicons/
        100
    );

    add_submenu_page(
        Constants::SLUG,
        'Enqueue Subsettings 1',
        'Subsettings 1',
        Constants::CAPABILITY,
        'subsettings-1',
        'subsettings_page_1_markup'
    );
}
add_action('admin_menu', 'example_enqueue_assets_page');

function enqueue_assets_settings_page_markup()
{
    if (!current_user_can('manage_options')) {
        return;
    }
?>
    <div class="my-test-class">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <p>Here&apos;s the content of the settings page.</p>
    </div>
<?php
}

function subsettings_page_1_markup()
{
    if (!current_user_can(Constants::CAPABILITY)) {
        return;
    }

?>
    <div class="my-test-class">Subsettings 1</div>
<?php
}
