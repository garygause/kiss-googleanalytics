<?php
/*
Plugin Name: KISS Google Analytics
Plugin URI: http://vrtl.io/kiss-google-analytics-wordpress-plugin
Description: The KISS (Keep It Simple Stupid) Google Analytics plugin that allows you to paste your GA code in directly.
Author: Gary Gause
Version: 1.0
License: GPL v2+
*/

if (!class_exists('KissGoogleAnalytics')) {

    class KissGoogleAnalytics {

        private $group = 'kiss-ga-group';

        /**
         * init_options
         * register the options used by the plugin
         * @return void
         */
        public function init_options() {
            register_setting($group, 'kiss_ga_code');
        }

        /**
         * init_menu
         * adds the admin menu under settings
         * @return void
         */
        public function init_menu() {
            add_options_page('Google Analytics', 'Google Analytics', 'manage_options', 'kiss-ga-options', array($this, 'render_options_form'));
        }

        /**
         * render_options_form
         * displays the options form
         * @return void
         */
        public function render_options_form() {
?>
<div class="wrap">

<?php
    if (isset($_POST['kiss_ga_code'])) {
        echo '<div id="message" class="updated"><p>Settings saved</p></div>';
    }    
?>


<h1>Google Analytics Code</h1>
<p>Paste your Google Analytics code here. (Remember the script tags.)</p>

<form method="post" action="options-general.php?page=kiss-ga-options">
<?php settings_fields($group); ?>
<?php do_settings_sections($group); ?>
<?php wp_nonce_field( 'save_options', '_kissga_nonce' ); ?>

<textarea name="kiss_ga_code" style="width:100%;height:300px;"><?php echo esc_textarea( get_option('kiss_ga_code') ); ?></textarea>
<?php submit_button(); ?>
</form>
</div>
<?php
        }

        /**
         * save_options 
         * save the options to the db
         * @return void
         */
        public function save_options() {
            // authorization
            if (!current_user_can('manage_options')) { 
                wp_die( 'You are not authorized to access this resource.' ); 
            }
            check_admin_referer( 'save_options', '_kissga_nonce' );
            update_option('kiss_ga_code', stripslashes($_POST["kiss_ga_code"]));
        }

        /**
         * generate_output
         * generates the output of the plugin
         * @return void
         */
        public function generate_output() {
            echo get_option('kiss_ga_code');
        }

    } // end class

} // end class check

$plugin_instance = new KissGoogleAnalytics();

// init plugin options
add_action('admin_init', array($plugin_instance, 'init_options'));

// add menu
add_action('admin_menu', array($plugin_instance, 'init_menu'));

// add save action
if (isset($_POST['kiss_ga_code'])) {
    add_action('admin_init', array($plugin_instance, 'save_options'));
}

// add output
add_action('wp_head', array($plugin_instance, 'generate_output'), 10);
