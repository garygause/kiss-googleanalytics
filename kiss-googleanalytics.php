<?php
/*
Plugin Name: KISS Google Analytics
Plugin URI: http://vrtl.io/kiss-google-analytics-wordpress-plugin
Description: The KISS (Keep It Simple Stupid) Google Analytics plugin that allows you to paste your GA code in directly.
Author: Gary Gause
Version: 1.0
Requires at least: 5.8
Tested up to: 6.8
Requires PHP: 7.4
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: kiss-googleanalytics
*/

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('KissGoogleAnalytics')) {

    class KissGoogleAnalytics {

        private $group = 'kiss-ga-group';

        private $page_slug = 'kiss-ga-options';

        /**
         * Register the options used by the plugin.
         */
        public function init_options() {
            register_setting($this->group, 'kiss_ga_code', array(
                'type' => 'string',
                'sanitize_callback' => array($this, 'sanitize_ga_code'),
            ));
        }

        /**
         * Optional sanitization when saving via the Settings API; raw script/HTML is allowed for GA snippets.
         *
         * @param mixed $value
         * @return string
         */
        public function sanitize_ga_code($value) {
            return is_string($value) ? wp_unslash($value) : '';
        }

        /**
         * Adds the admin menu under settings.
         */
        public function init_menu() {
            add_options_page(
                __('Google Analytics', 'kiss-googleanalytics'),
                __('Google Analytics', 'kiss-googleanalytics'),
                'manage_options',
                $this->page_slug,
                array($this, 'render_options_form')
            );
        }

        /**
         * Displays the options form.
         */
        public function render_options_form() {
            ?>
<div class="wrap">

<?php
            if (!empty($_GET['kiss_ga_updated']) && $_GET['kiss_ga_updated'] === '1') {
                echo '<div id="message" class="updated"><p>' . esc_html__('Settings saved.', 'kiss-googleanalytics') . '</p></div>';
            }
            ?>

<h1><?php echo esc_html__('Google Analytics Code', 'kiss-googleanalytics'); ?></h1>
<p><?php echo esc_html__('Paste your Google Analytics code here. (Remember the script tags.)', 'kiss-googleanalytics'); ?></p>

<form method="post" action="<?php echo esc_url(admin_url('options-general.php?page=' . $this->page_slug)); ?>">
<?php wp_nonce_field('save_options', '_kissga_nonce'); ?>

<textarea name="kiss_ga_code" style="width:100%;height:300px;"><?php echo esc_textarea(get_option('kiss_ga_code')); ?></textarea>
<?php submit_button(__('Save Changes', 'kiss-googleanalytics')); ?>
</form>
</div>
<?php
        }

        /**
         * Saves options when the settings form is submitted.
         */
        public function save_options() {
            if (!isset($_POST['kiss_ga_code'], $_POST['_kissga_nonce'])) {
                return;
            }

            if (!current_user_can('manage_options')) {
                wp_die(esc_html__('You are not authorized to access this resource.', 'kiss-googleanalytics'));
            }

            check_admin_referer('save_options', '_kissga_nonce');

            update_option('kiss_ga_code', wp_unslash($_POST['kiss_ga_code']));

            wp_safe_redirect(add_query_arg('kiss_ga_updated', '1', admin_url('options-general.php?page=' . $this->page_slug)));
            exit;
        }

        /**
         * Outputs the stored snippet in wp_head. Value is set only by users who can manage_options.
         */
        public function generate_output() {
            $code = get_option('kiss_ga_code');
            if ($code !== '' && $code !== false) {
                echo $code; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- intentionally raw GA/gtag markup
            }
        }

    }

}

$plugin_instance = new KissGoogleAnalytics();

add_action('admin_init', array($plugin_instance, 'init_options'));
add_action('admin_init', array($plugin_instance, 'save_options'));
add_action('admin_menu', array($plugin_instance, 'init_menu'));
add_action('wp_head', array($plugin_instance, 'generate_output'), 10);
