=== emBold Sage10 Tweaks ===
Contributors: itsjsutxan
Tags: sage, tweaks
Requires at least: 6.0
Tested up to: 6.2.2
Stable tag: 0.14.0
Requires PHP: 8.0

A collection of tweaks and changes to the Sage 10 framework.

== Description ==

There are common things we'll need to change in every Sage 10 theme, this plugin simplifies making all these changes with
a drag and drop plugin.

1. Enqueues app.css styles in only the Gutenberg editor, not the entire admin panel.
2. Add "wp-block-paragraph" class to Gutenberg paragraph blocks to allow easier styling of the blocks vs ACF wysiwyg p's.
3. Add "wp-block-ul" and "wp-block-ol" classes to Gutenberg list blocks to allow easier targeting.
4. Always make sure the default block library is loaded even when Soil is installed and set to clean.

== Changelog ==

= 0.14.0 =
* don't lose custom classes added to block lists when we add our default class

= 0.13.0 =
* add fix for gravity forms

= 0.12.0 =
* update for targeting paragraph blocks

= 0.11.0 =
* change how we're loading styles in the block editor

= 0.10.0 =
* open source the plugin

= 0.9.0 =
* gracefully timeout after a fraction of a second if API call fails

= 0.8.0 =
* Add plugin update ability

== Upgrade Notice ==

= 0.8.0 =
* Add plugin update ability
