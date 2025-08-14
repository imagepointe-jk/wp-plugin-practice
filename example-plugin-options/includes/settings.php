<?php

//using namespace so we don't have to prefix every single function
//without namespace, functions are defined globally, which can cause unexpected name collisions
namespace ExamplePluginOptions\Settings;

use ExamplePluginOptions\Constants;
use function ExamplePluginOptions\Utils\try_get_option_value;

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
        $section_name,
        //this will be rendered as the section title
        'My Example Plugin Settings',
        //this callback will render arbitrary markup below the section title
        //namespace must be prepended for WP to find the function in this namespace
        //double backslash because backslash itself is an escape character
        __NAMESPACE__ . '\\section_1',
        //what page the section will be on
        Constants::SLUG
    );

    //register a field and assign it to the section we just registered
    //the field has to be registered to make it available to Settings API
    add_settings_field(
        //unique id for field
        Constants::SLUG . '_custom_text',
        //this will be rendered as the label of the field
        'My Custom Text Field',
        //this callback will render the markup for the field itself (but not the label or the surrounding markup used for layout)
        __NAMESPACE__ . '\\custom_text_field_1',
        //what page the field will be on
        Constants::SLUG,
        //what section the field will be in
        $section_name,
    );

    //demonstrate different types of fields
    add_settings_field(
        Constants::SLUG . '_custom_textarea',
        'My Custom Text Area',
        __NAMESPACE__ . '\\custom_textarea_1',
        Constants::SLUG,
        $section_name,
    );

    add_settings_field(
        Constants::SLUG . '_custom_checkbox',
        'My Custom Checkbox',
        __NAMESPACE__ . '\\custom_checkbox_1',
        Constants::SLUG,
        $section_name,
    );

    add_settings_field(
        Constants::SLUG . '_custom_radio',
        'My Custom Radio Buttons',
        __NAMESPACE__ . '\\custom_radio_1',
        Constants::SLUG,
        $section_name,
    );

    add_settings_field(
        Constants::SLUG . '_custom_select',
        'My Custom Dropdown',
        __NAMESPACE__ . '\\custom_dropdown_1',
        Constants::SLUG,
        $section_name,
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
    $value = try_get_option_value('custom_text');
    $field_name = Constants::WP_OPTION_NAME . '[custom_text]';

?>
    <input type="text" id="example_plugin_options_custom_text" name="<?php echo $field_name; ?>" value="<?php echo $value; ?>">
<?php
}

function custom_textarea_1()
{
    $value = try_get_option_value('custom_textarea');
    $field_name = Constants::WP_OPTION_NAME . '[custom_textarea]';

?>
    <textarea id="example_plugin_options_custom_textarea" name="<?php echo $field_name; ?>" rows="5" cols="50"><?php echo $value; ?></textarea>
<?php
}

function custom_checkbox_1()
{
    $value = try_get_option_value('custom_checkbox');
    $field_name = Constants::WP_OPTION_NAME . '[custom_checkbox]';
    $field_id = 'example_plugin_options_custom_checkbox';

?>
    <label for="<?php echo $field_id; ?>">
        <input type="checkbox" id="<?php echo $field_id; ?>" name="<?php echo $field_name; ?>" value="1" <?php checked(1, $value); ?>>
        This is the checkbox label
    </label>
<?php
}

function custom_radio_1()
{
    $value = try_get_option_value('custom_radio');
    $field_name = Constants::WP_OPTION_NAME . '[custom_radio]';
    $field_id_1 = 'example_plugin_options_custom_radio_1';
    $field_id_2 = 'example_plugin_options_custom_radio_2';

?>
    <label for="<?php echo $field_id_1; ?>" style="display:block;">
        <input type="radio" name="<?php echo $field_name; ?>" id="<?php echo $field_id_1; ?>" value="1" <?php checked(1, $value); ?>>
        Option 1
    </label>
    <label for="<?php echo $field_id_2; ?>" style="display:block;">
        <input type="radio" name="<?php echo $field_name; ?>" id="<?php echo $field_id_2; ?>" value="2" <?php checked(2, $value); ?>>
        Option 2
    </label>
<?php
}

function custom_dropdown_1()
{
    $value = try_get_option_value('custom_dropdown');
    $field_name = Constants::WP_OPTION_NAME . '[custom_dropdown]';
    $field_id = 'example_plugin_options_custom_dropdown';

?>
    <select name="<?php echo $field_name; ?>" id="<?php echo $field_id; ?>">
        <option value="dog" <?php selected('dog', $value); ?>>Dog</option>
        <option value="cat" <?php selected('cat', $value); ?>>Cat</option>
        <option value="fish" <?php selected('fish', $value); ?>>Fish</option>
        <option value="long" <?php selected('long', $value); ?>>A much longer option written to take up lots more space</option>
    </select>
<?php
}
