<?php

//using namespace so we don't have to prefix every single function
//without namespace, functions are defined globally, which can cause unexpected name collisions
namespace ExamplePluginOptions\Settings;

use ExamplePluginOptions\Constants;
use ImagePointe\Utils\Fields\DropdownOptionConfig;
use ImagePointe\Utils\Fields\RadioButtonConfig;

use function ImagePointe\Utils\Fields\checkbox;
use function ImagePointe\Utils\Fields\dropdown;
use function ImagePointe\Utils\Fields\radio_buttons;
use function ImagePointe\Utils\Fields\text_field;
use function ImagePointe\Utils\Fields\text_area;

function settings_init()
{
    $section_name = Constants::SLUG . '_settings_section';

    //if no settings for this plugin exist in the wp_options table, create a row for them
    if (!get_option(Constants::WP_OPTION_NAME)) {
        add_option(Constants::WP_OPTION_NAME);
    }

    //a section is registered in admin_init; the fields will be rendered in the template using Settings API
    //the section has to be registered to make it available to Settings API
    add_settings_section(
        // unique id for section
        id: $section_name,
        //this will be rendered as the section title
        title: 'My Example Plugin Settings',
        //this callback will render arbitrary markup below the section title
        //namespace must be prepended for WP to find the function in this namespace
        //double backslash because backslash itself is an escape character
        callback: __NAMESPACE__ . '\\section_1',
        //what page the section will be on
        page: Constants::SLUG
    );

    //register a field and assign it to the section we just registered
    //the field has to be registered to make it available to Settings API
    add_settings_field(
        //unique id for field
        id: Constants::SLUG . '_custom_text',
        //this will be rendered as the label of the field
        title: 'My Custom Text Field',
        //this callback will render the markup for the field itself (but not the label or the surrounding markup used for layout)
        callback: __NAMESPACE__ . '\\custom_text_field_1',
        //what page the field will be on
        page: Constants::SLUG,
        //what section the field will be in
        section: $section_name,
    );

    //demonstrate different types of fields
    add_settings_field(
        id: Constants::SLUG . '_custom_textarea',
        title: 'My Custom Text Area',
        callback: __NAMESPACE__ . '\\custom_textarea_1',
        page: Constants::SLUG,
        section: $section_name,
    );

    add_settings_field(
        id: Constants::SLUG . '_custom_checkbox',
        title: 'My Custom Checkbox',
        callback: __NAMESPACE__ . '\\custom_checkbox_1',
        page: Constants::SLUG,
        section: $section_name,
    );

    add_settings_field(
        id: Constants::SLUG . '_custom_radio',
        title: 'My Custom Radio Buttons',
        callback: __NAMESPACE__ . '\\custom_radio_1',
        page: Constants::SLUG,
        section: $section_name,
    );

    add_settings_field(
        id: Constants::SLUG . '_custom_select',
        title: 'My Custom Dropdown',
        callback: __NAMESPACE__ . '\\custom_dropdown_1',
        page: Constants::SLUG,
        section: $section_name,
    );

    register_setting(Constants::WP_OPTION_NAME, Constants::WP_OPTION_NAME);
}
add_action('admin_init', __NAMESPACE__ . '\\settings_init');

function section_1()
{
?>
    <div>This is arbitrary markup at the <span style="color:red;font-weight:bold;">start</span> of the settings section.</div>
<?php
}

function custom_text_field_1()
{
    text_field(
        db_setting_name: 'custom_text',
        db_option_name: Constants::WP_OPTION_NAME
    );
}

function custom_textarea_1()
{
    text_area(
        db_setting_name: 'custom_textarea',
        db_option_name: Constants::WP_OPTION_NAME
    );
}

function custom_checkbox_1()
{
    checkbox(
        db_setting_name: 'custom_checkbox',
        db_option_name: Constants::WP_OPTION_NAME,
        label: 'This is the checkbox label'
    );
}

function custom_radio_1()
{
    radio_buttons(
        db_setting_name: 'custom_radio',
        db_option_name: Constants::WP_OPTION_NAME,
        buttons: [
            new RadioButtonConfig('Red', 'red'),
            new RadioButtonConfig('Blue', 'blue'),
            new RadioButtonConfig('Yellow', 'yellow'),
            new RadioButtonConfig('Purple', 'purple'),
        ]
    );
}

function custom_dropdown_1()
{
    dropdown(
        db_setting_name: 'custom_dropdown',
        db_option_name: Constants::WP_OPTION_NAME,
        options: [
            new DropdownOptionConfig('Dog', 'dog'),
            new DropdownOptionConfig('Cat', 'cat'),
            new DropdownOptionConfig('Fish', 'fish'),
            new DropdownOptionConfig('A much longer option written to take up lots more space', 'long'),
        ]
    );
}
