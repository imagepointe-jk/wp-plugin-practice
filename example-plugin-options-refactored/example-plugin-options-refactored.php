<?php
/*
Plugin Name: Example - Plugin Options Refactored
Description: This is a test Description
Version: 1.0.0
Contributors: jklope
Author: Josh Klope
*/

if (!defined('WPINC')) {
    die;
}

define('EXAMPLE_PLUGIN_OPTIONS_DIR', plugin_dir_path(__FILE__));

include(plugin_dir_path(__FILE__) . 'includes/constants.php');
include(plugin_dir_path(__FILE__) . 'includes/utils/misc.php');
include(plugin_dir_path(__FILE__) . 'includes/utils/fields.php');
include(plugin_dir_path(__FILE__) . 'includes/settings.php');
include(plugin_dir_path(__FILE__) . 'includes/menus.php');
