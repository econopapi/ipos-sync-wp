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

// carga de clases princpales
require_once IPOS_SYNC_WP_PLUGIN_DIR . 'includes/class-ipos-api.php';
require_once IPOS_SYNC_WP_PLUGIN_DIR . 'includes/class-category-sync.php';
require_once IPOS_SYNC_WP_PLUGIN_DIR . 'includes/class-product-sync.php';
require_once IPOS_SYNC_WP_PLUGIN_DIR . 'includes/class-stock-sync.php';
require_once IPOS_SYNC_WP_PLUGIN_DIR . 'includes/class-webhook-handler.php';

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

// instancia de admin ui
if(is_admin()){
    require_once IPOS_SYNC_WP_PLUGIN_DIR . 'admin/ipos-sync-admin.php';
    // inicializar admin class
    if(class_exists('IPos_Sync_Admin')){
        new IPos_Sync_Admin();
    }
}

// instancia de handlers
if(class_exists('IPos_Sync_Webhook_Handler')){
    new IPos_Sync_Webhook_Handler();
}