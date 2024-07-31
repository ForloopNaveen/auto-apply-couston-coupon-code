<?php
/**
 * Plugin Name: Auto Apply Coupon Code
 * Description: The "Auto Apply Coupon Code" plugin for WooCommerce automatically creates and applies a coupon code to the cart. When activated, the plugin generates a coupon code offering a 20% discount on all products and applies it to the cart.  This plugin ensures that customers always receive the discount without needing to manually enter the coupon code at checkout.
 * Version: 1.8
 * Author: Naveen Kumar
 * Text Domain: auto-apply-coupon-code
 * Domain Path: /i18n/languages/
 * Slug: auto-apply-coupon-code
 * Requires at least: 4.9.0
 * WC requires at least: 6.0
 */

defined('ABSPATH') or exit();
defined("AACCFILE") or define("AACCFILE", __FILE__);
defined("AACCDIR") or define("AACCDIR", __DIR__);
defined("AACC_PLUGIN_NAME") or define("AACC_PLUGIN_NAME", "Auto Apply Coupon Code");
defined('AACC_MINIMUM_PHP_VERSION') or define('AACC_MINIMUM_PHP_VERSION', '7.0.0');
defined('AACC_MINIMUM_WP_VERSION') or define('AACC_MINIMUM_WP_VERSION', '4.9');
defined('AACC_MINIMUM_WC_VERSION') or define('AACC_MINIMUM_WC_VERSION', '6.0');


if (file_exists(__DIR__ . "/vendor/autoload.php")) {
    require_once __DIR__ . "/vendor/autoload.php";
}


if(class_exists('\Aacc\App\Helper\CompatabilityCheck')){
   $activation_check = new \Aacc\App\Helper\CompatabilityCheck();
   if(!$activation_check->initCheck()){
       add_action("all_admin_notices", [$activation_check, "compatabilityNotice"]);
       return;
   }
    if (class_exists('\Aacc\App\Router')) {
        $router = new \Aacc\App\Router();
        $router->init();
    }
}



