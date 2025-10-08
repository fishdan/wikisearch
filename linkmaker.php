<?php
/*
Plugin Name: LinkMaker
Plugin URI: https://fishdan.com/linkmaker
Description: Transforms specified hyperlinks into interactive elements for Wikipedia searches.
Version: 0.1.4
Author: Dan Fishman
Author URI: https://fishdan.com
License: MIT
License URI: https://opensource.org/licenses/MIT
Text Domain: linkmaker
Requires PHP: 7.4
Requires at least: 5.8
*/

if (!defined('ABSPATH')) {
    exit;
}

if (!defined('LINKMAKER_VERSION')) {
    define('LINKMAKER_VERSION', '0.1.4');
}

// Enqueue the JavaScript and CSS files
function linkmaker_enqueue_scripts() {
    wp_enqueue_script('linkmaker-js', plugin_dir_url(__FILE__) . 'linkmaker.js', array(), LINKMAKER_VERSION, true);
    wp_enqueue_style('linkmaker-css', plugin_dir_url(__FILE__) . 'linkmaker.css', array(), LINKMAKER_VERSION);
}

add_action('wp_enqueue_scripts', 'linkmaker_enqueue_scripts');
?>
