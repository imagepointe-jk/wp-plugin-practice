<?php
/*
Plugin Name: Example - Enqueue Assets
Description: This is a test Description
Version: 1.0.0
Contributors: jklope
Author: Josh Klope
*/

if (!defined('WPINC')) {
    die;
}

define('ENQUEUE_SCRIPTS_PLUGIN_URL', plugin_dir_url(__FILE__));

include(plugin_dir_path(__FILE__) . 'includes/constants.php');
include(plugin_dir_path(__FILE__) . 'includes/settings.php');
include(plugin_dir_path(__FILE__) . 'includes/scripts.php');
include(plugin_dir_path(__FILE__) . 'includes/styles.php');
