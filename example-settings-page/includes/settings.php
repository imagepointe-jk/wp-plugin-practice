<?php



function example_single_settings_page()
{
    add_menu_page(
        'Example - Single Settings Page',
        'Example <span style="color:red";>Plugin</span>', //text in the sidebar
        'manage_options', //permissions
        'example-single-settings-page', //slug
        'example_single_settings_page_markup', //callback to render settings page
        'dashicons-admin-multisite', //dashicons found at https://developer.wordpress.org/resource/dashicons/
        100
    );
}
add_action('admin_menu', 'example_single_settings_page');

function example_single_settings_page_markup()
{
    if (!current_user_can('manage_options')) {
        return;
    }
?>
    <div>
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <p>Here&apos;s the content of the settings page.</p>
    </div>
<?php
}
