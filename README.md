# KISS Google Analytics

**Version:** 1.1 · Directory slug: `kiss-googleanalytics`

A small WordPress plugin for pasting your Google Analytics snippet (for example gtag / GA4) straight into the site; nothing beyond **Settings → Google Analytics** and your measurement code.

**Plugin page:** [vrtl.io/kiss-google-analytics-wordpress-plugin](http://vrtl.io/kiss-google-analytics-wordpress-plugin)  
**Source:** [github.com/garygause/kiss-googleanalytics](https://github.com/garygause/kiss-googleanalytics)

For listing on [WordPress.org](https://wordpress.org/plugins/), this repo also includes **`readme.txt`** in the [plugin directory format](https://developer.wordpress.org/plugins/wordpress-org/how-your-readme-txt-works/) (used by the directory; **README.md** remains for GitHub).

## Installation

1. Copy the `kiss-googleanalytics` folder into your site’s `wp-content/plugins/` directory, **or** install from a ZIP via **Plugins → Add New → Upload Plugin**.
2. In the WordPress admin, go to **Plugins** and activate **KISS Google Analytics**.

## Usage

1. Open **Settings → Google Analytics** (administrators only: you need the `manage_options` capability).
2. Paste the full tracking snippet from Google, **including** the `<script>` … `</script>` tags.
3. Click **Save Changes**. The snippet is output in `wp_head` on the front of the site.

## Requirements

- A normal WordPress install and PHP version supported by your WordPress release.

## License

Distributed under the **GNU General Public License v2.0 or later**. See [LICENSE](LICENSE) for the full text.
