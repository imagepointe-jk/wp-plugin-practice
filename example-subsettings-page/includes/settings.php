<?php

use ExampleSubsettingsPage\Constants;




function example_subsettings_page()
{
    add_menu_page(
        Constants::PLUGIN_TITLE,
        Constants::MENU_TITLE, //text in the sidebar
        Constants::CAPABILITY, //permissions
        Constants::SLUG, //slug
        'example_subsettings_page_markup', //callback to render settings page
        'dashicons-admin-multisite', //dashicons found at https://developer.wordpress.org/resource/dashicons/
        100
    );

    add_submenu_page(
        Constants::SLUG,
        'Subsettings Page 1',
        'Subsettings 1',
        Constants::CAPABILITY,
        'subsettings-1',
        'subsettings_page_1_markup'
    );

    add_submenu_page(
        Constants::SLUG,
        'Subsettings Page 2',
        'Subsettings 2',
        Constants::CAPABILITY,
        'subsettings-2',
        'subsettings_page_2_markup'
    );
}
add_action('admin_menu', 'example_subsettings_page');

function example_subsettings_page_markup()
{
    if (!current_user_can(Constants::CAPABILITY)) {
        return;
    }
?>
    <div>
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <p>Here&apos;s the NEW content of the settings page.</p>
    </div>
<?php
}

function subsettings_page_1_markup()
{
    if (!current_user_can(Constants::CAPABILITY)) {
        return;
    }

?>
    <div>Subsettings 1</div>
<?php
}

function subsettings_page_2_markup()
{
    if (!current_user_can(Constants::CAPABILITY)) {
        return;
    }

?>
    <div>Subsettings 2</div>
<?php
}
