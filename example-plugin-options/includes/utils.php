<?php

namespace ExamplePluginOptions\Utils;

use ExamplePluginOptions\Constants;

function try_get_option_value($name)
{
    $options = get_option(Constants::WP_OPTION_NAME);
    $val = '';
    if (isset($options[$name])) {
        $val = esc_html($options[$name]);
    }
    return $val;
}
