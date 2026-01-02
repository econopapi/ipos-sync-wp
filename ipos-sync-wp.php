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