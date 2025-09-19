=== WikiSearch ===
Contributors: fishdan
Tags: wikipedia, links, search, wiki
Requires at least: 5.8
Tested up to: 6.4
Requires PHP: 7.4
Stable tag: 0.1.14
License: MIT
License URI: https://opensource.org/licenses/MIT

WikiSearch turns links pointing to `wikisearch` into live Wikipedia searches using the link text.

== Description ==

WikiSearch lets editors create Wikipedia links without leaving the editor. Link any text to `wikisearch` (no protocol) and the plugin automatically points the front-end link to the matching article on Wikipedia. It ships with lightweight JavaScript and CSS that only runs on the front-end when needed.

* Gutenberg-friendly workflow
* Zero configuration
* Keeps links that already point to GitHub untouched

== Installation ==

1. Upload the `wikisearch` folder to `/wp-content/plugins/`, or install the plugin via the WordPress admin by uploading the ZIP file.
2. Activate the plugin through the "Plugins" screen in WordPress.

== Frequently Asked Questions ==

= Why isn’t my GitHub link changing? =
Links whose `href` contains `github` are intentionally skipped so developer documentation is unaffected.

= Can I force a different article slug than the visible text? =
Not yet. The plugin currently matches the Wikipedia article based on the visible anchor text.

== Screenshots ==

1. Linking text to `wikisearch` in Gutenberg automatically produces Wikipedia links on the front end.

== Changelog ==

= 0.1.14 =
* Refined asset loading and WordPress.org preparation.

= 0.1.0 =
* Initial release.

== Upgrade Notice ==

= 0.1.14 =
Prepare for the WordPress.org listing and ensure compatibility with recent WordPress versions.
