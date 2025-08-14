<?php

//misc project-agnostic utility functions.
namespace ImagePointe\Utils\Misc;

function try_get_option_value(string $setting_name, string $option_name)
{
    $options = get_option($option_name);
    $val = '';
    if (isset($options[$setting_name])) {
        $val = esc_html($options[$setting_name]);
    }
    return $val;
}
