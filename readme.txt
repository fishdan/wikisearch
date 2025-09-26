=== WikiSearch ===
Contributors: fishdan
Tags: wikipedia, links, search, wiki
Requires at least: 5.8
Tested up to: 6.5
Requires PHP: 7.4
Stable tag: 1.0.0
License: MIT
License URI: https://opensource.org/licenses/MIT

WikiSearch turns links pointing to `wikisearch` into live Wikipedia searches using the link text.

== Description ==

WikiSearch lets editors create Wikipedia links without leaving the editor. Link any text to `wikisearch` (no protocol) and the plugin automatically points the front-end link to the matching article on Wikipedia. It ships with lightweight JavaScript and CSS that only runs on the front-end when needed, while keeping the resulting anchor tags accessible and SEO friendly.

* Gutenberg-friendly workflow
* Zero configuration with optional slug overrides using `wikisearch:Custom_Slug`
* Retains anchor semantics for keyboard users and visitors without JavaScript

== Installation ==

1. Upload the `wikisearch` folder to `/wp-content/plugins/`, or install the plugin via the WordPress admin by uploading the ZIP file.
2. Activate the plugin through the "Plugins" screen in WordPress.

== Frequently Asked Questions ==

= Does this work without JavaScript? =
Yes. The plugin replaces placeholder links on the server, so front-end HTML already points to Wikipedia.

= Can I force a different article slug than the visible text? =
Yes. Set the URL to `wikisearch:Albert_Einstein` (for example) to bypass the automatic slug derived from the link text.

== Screenshots ==

1. Linking text to `wikisearch` in Gutenberg automatically produces Wikipedia links on the front end.

== Changelog ==

= 1.0.0 =
* Convert placeholder links on the server for SEO/no-JS safety.
* Preserve anchor semantics and add focus styling for accessibility.
* Allow optional custom slugs via `wikisearch:Custom_Slug`.
* Load the text domain and refresh metadata for the WordPress.org submission.

= 0.1.4 =
* Refined asset loading and WordPress.org preparation.

= 0.1.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.0 =
Server-side placeholder conversion, improved accessibility, and optional slug overrides.
