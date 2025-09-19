<?php
/*
Plugin Name: WikiSearch
Plugin URI: https://fishdan.com/wikisearch
Description: Transforms specified hyperlinks into interactive elements for Wikipedia searches.
Version: 0.1.14
Author: Dan Fishman
Author URI: https://fishdan.com
License: MIT
License URI: https://opensource.org/licenses/MIT
Text Domain: wikisearch
Requires PHP: 7.4
Requires at least: 5.8
*/

if (!defined('ABSPATH')) {
    exit;
}

if (!defined('WIKISEARCH_VERSION')) {
    define('WIKISEARCH_VERSION', '0.1.14');
}

// Enqueue the JavaScript and CSS files
function wikisearch_enqueue_scripts() {
    wp_enqueue_script('wikisearch-js', plugin_dir_url(__FILE__) . 'wikisearch.js', array(), WIKISEARCH_VERSION, true);
    wp_enqueue_style('wikisearch-css', plugin_dir_url(__FILE__) . 'wikisearch.css', array(), WIKISEARCH_VERSION);
}

add_action('wp_enqueue_scripts', 'wikisearch_enqueue_scripts');
?>
