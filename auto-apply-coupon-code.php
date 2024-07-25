<?php
/**
 * Plugin Name: Auto Apply Coupon Code
 * Description: The "Auto Apply Coupon Code" plugin for WooCommerce automatically creates and applies a coupon code to the cart. When activated, the plugin generates a coupon code offering a 20% discount on all products and applies it to the cart.  This plugin ensures that customers always receive the discount without needing to manually enter the coupon code at checkout.
 * Version: 1.8
 * Author: Naveen Kumar
 * Author URI: https://forloopnaveen.github.io/portfolioOfNK/
 * Text Domain: auto-apply-coupon-code
 * Domain Path: /i18n/languages/
 * Slug: auto-apply-coupon-code
 */

defined('ABSPATH') or exit();
defined("AACCFILE") or define("AACCFILE", __FILE__);


if (file_exists(__DIR__ . "/vendor/autoload.php")) {
    require_once __DIR__ . "/vendor/autoload.php";
}


if (class_exists('\Aacc\App\Router')) {
    $router = new \Aacc\App\Router();
    $router->init();

}



