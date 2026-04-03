=== KISS Google Analytics ===
Contributors: garygause
Tags: google analytics, analytics, gtag, ga4, tracking
Requires at least: 5.8
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Paste your Google Analytics snippet from Settings, track with gtag/GA4, and output it in wp_head. Keep it simple—one field, no extra configuration.

== Description ==

KISS Google Analytics is a minimal plugin for sites that already know what snippet they want: paste the full measurement code from Google (including `script` tags), save, and it appears in `wp_head` on the front of your site.

* Settings live under **Settings → Google Analytics**
* Only users who can `manage_options` (typically administrators) can view or save the snippet
* Works with the standard snippet Google provides for GA4 / gtag

Project site: http://vrtl.io/kiss-google-analytics-wordpress-plugin

== Installation ==

1. Upload the `kiss-googleanalytics` folder to the `/wp-content/plugins/` directory, or upload the plugin ZIP under **Plugins → Add New → Upload Plugin**.
2. Activate **KISS Google Analytics** through the **Plugins** menu in WordPress.
3. Go to **Settings → Google Analytics**, paste your snippet, and click **Save Changes**.

== Frequently Asked Questions ==

= Who can edit the analytics code? =

Only users with the `manage_options` capability—usually site administrators.

= Does this support GA4 or Universal Analytics? =

Paste whatever snippet Google gives you now (for example gtag / GA4). Include the complete block, including opening and closing `script` tags.

= Where does the code appear on the site? =

The saved snippet is printed in `wp_head` on front-end pages.

== Changelog ==

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.0 =
First public release.
