<?php

use ExampleHTTPRequest\Constants;

function example_http_request()
{
    add_menu_page(
        Constants::PLUGIN_TITLE,
        Constants::MENU_TITLE, //text in the sidebar
        Constants::CAPABILITY, //permissions
        Constants::SLUG, //slug
        'example_http_request_markup', //callback to render settings page
        'dashicons-admin-multisite', //dashicons found at https://developer.wordpress.org/resource/dashicons/
        100
    );
}
add_action('admin_menu', 'example_http_request');

function example_http_request_markup()
{
    if (!current_user_can(Constants::CAPABILITY)) {
        return;
    }
?>


    <div>
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <p>The below data was retrieved from SWAPI.</p>
    </div>
    <?php

    $response = wp_remote_get('https://www.swapi.tech/api/people/2', ['timeout' => 2]);

    if (is_wp_error($response)) {
        return;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);
    if (!is_array($data)) {
        return;
    }

    ?><div>Name: <?php echo $data['result']['properties']['name']; ?></div>
<?php
}
