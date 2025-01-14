<?php
/**
 * Plugin Name: WooCommerce PDF Pricing
 * Plugin URI: https://example.com
 * Description: A WooCommerce plugin to calculate product prices based on PDF page count, size, and quantity.
 * Version: 1.0
 * Author: Saeed Sarshar
 * Author URI: https://SaeedSarshar.ir
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wc-pdf-pricing
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Load Composer autoloader if available
if (file_exists(plugin_dir_path(__FILE__) . 'vendor/autoload.php')) {
    require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';
}

// Load plugin textdomain for translations
add_action('plugins_loaded', 'wc_pdf_pricing_load_textdomain');
function wc_pdf_pricing_load_textdomain() {
    load_plugin_textdomain('wc-pdf-pricing', false, dirname(plugin_basename(__FILE__)) . '/languages');
}

// Hook to initialize the plugin
add_action('init', function() {
    // Include necessary files
    require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
    require_once plugin_dir_path(__FILE__) . 'includes/ajax-handler.php';
    require_once plugin_dir_path(__FILE__) . 'includes/pdf-helper.php';
});

// Enqueue admin scripts and styles
add_action('admin_enqueue_scripts', function($hook) {
    if ($hook === 'toplevel_page_wc-pdf-pricing') {
        wp_enqueue_style('wc-pdf-admin-styles', plugin_dir_url(__FILE__) . 'assets/css/admin-styles.css');
        wp_enqueue_script('wc-pdf-admin-scripts', plugin_dir_url(__FILE__) . 'assets/js/admin-scripts.js', ['jquery'], '1.0', true);
    }
});
