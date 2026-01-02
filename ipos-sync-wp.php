<?php
/**
 * Plugin Name: iPos Sync WP
 * Description: Integración completa de iPos con WordPress/WooCommerce.
 * Version: 1.0.0
 * Author: Daniel Limón
 * Author URI: https://dlimon.net
 * Licence: Pendiente
 */

// evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// constantes del plugin
define('IPOS_SYNC_WP_VERSION', '1.0.0');
define('IPOS_SYNC_WP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('IPOS_SYNC_WP_PLUGIN_URL', plugin_dir_url(__FILE__));

// verificar WooCommerce al cargar el plugin
add_action('admin_init', 'ipos_sync_wp_check_woocommerce');

function ipos_sync_wp_check_woocommerce() {
    if(!class_exists('WooCommerce')){
        add_action('admin_notices', 'ipos_sync_wp_woocommerce_missing_notice');
        return false;
    }
    return true;
}

function ipos_sync_wp_woocommerce_missing_notice() {
    echo '<div class="error"><p><strong>iPos Sync WP</strong> requiere <a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a> para funcionar correctamente. Por favor, instala y activa WooCommerce.</p></div>';
}