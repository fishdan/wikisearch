<?php
/*
Plugin Name: WikiSearch
Plugin URI: https://fishdan.com/wikisearch
Description: Transforms specified hyperlinks into interactive elements for Wikipedia searches.
Version: 1.0.0
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
    define('WIKISEARCH_VERSION', '1.0.0');
}

add_action('init', 'wikisearch_load_textdomain');
/**
 * Register plugin textdomain for translations.
 */
function wikisearch_load_textdomain() {
    load_plugin_textdomain('wikisearch', false, dirname(plugin_basename(__FILE__)) . '/languages');
}

// Enqueue the JavaScript and CSS files.
function wikisearch_enqueue_scripts() {
    if (is_admin()) {
        return;
    }

    wp_enqueue_script('wikisearch-js', plugin_dir_url(__FILE__) . 'wikisearch.js', array(), WIKISEARCH_VERSION, true);
    wp_enqueue_style('wikisearch-css', plugin_dir_url(__FILE__) . 'wikisearch.css', array(), WIKISEARCH_VERSION);
}

add_action('wp_enqueue_scripts', 'wikisearch_enqueue_scripts');

if (!function_exists('wikisearch_build_wikipedia_url')) {
    /**
     * Build the Wikipedia URL for a given slug.
     *
     * @param string $slug Raw slug or link text.
     * @return string
     */
    function wikisearch_build_wikipedia_url($slug) {
        $decoded = html_entity_decode($slug, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $decoded = rawurldecode($decoded);
        $normalized = preg_replace('/\s+/u', ' ', $decoded);
        $normalized = trim($normalized);

        if ($normalized === '') {
            return '';
        }

        $normalized = str_replace(' ', '_', $normalized);
        $encoded = rawurlencode($normalized);
        $encoded = str_replace(array('%2F', '%3A'), array('/', ':'), $encoded);

        return sprintf('https://en.wikipedia.org/wiki/%s', $encoded);
    }
}

if (!function_exists('wikisearch_filter_content')) {
    /**
     * Replace placeholder links with Wikipedia URLs in rendered content.
     *
     * @param string $content The post content.
     * @return string
     */
    function wikisearch_filter_content($content) {
        if (false === stripos($content, 'wikisearch')) {
            return $content;
        }

        if (is_feed() || !class_exists('DOMDocument')) {
            return $content;
        }

        $previousLibxml = libxml_use_internal_errors(true);
        $document = new DOMDocument('1.0', 'UTF-8');
        $html = '<?xml encoding="utf-8" ?>' . $content;
        $libxmlOptions = 0;

        if (defined('LIBXML_HTML_NOIMPLIED') && defined('LIBXML_HTML_NODEFDTD')) {
            $libxmlOptions = LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD;
        }

        if ($document->loadHTML($html, $libxmlOptions)) {
            $links = $document->getElementsByTagName('a');

            foreach ($links as $link) {
                $href = $link->getAttribute('href');

                if (!$href) {
                    continue;
                }

                if (!preg_match('/^wikisearch(?::(.*))?$/i', trim($href), $matches)) {
                    continue;
                }

                $slug = '';

                if (!empty($matches[1])) {
                    $slug = $matches[1];
                } else {
                    $slug = $link->textContent;
                }

                $wikiUrl = wikisearch_build_wikipedia_url($slug);

                if ($wikiUrl === '') {
                    continue;
                }

                $link->setAttribute('href', $wikiUrl);

                $existingClass = $link->getAttribute('class');

                if (strpos($existingClass, 'wiki-search') === false) {
                    $link->setAttribute('class', trim($existingClass . ' wiki-search'));
                }
            }

            $content = $document->saveHTML();
        }

        libxml_clear_errors();
        libxml_use_internal_errors($previousLibxml);

        return $content;
    }
}

add_filter('the_content', 'wikisearch_filter_content', 20);
add_filter('widget_text_content', 'wikisearch_filter_content', 20);
add_filter('widget_block_content', 'wikisearch_filter_content', 20);
?>
