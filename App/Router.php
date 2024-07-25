<?php

namespace Aacc\App;

use \Aacc\App\Controller\Main;

class Router {

    public $admin;
    /**
     * Initializes the hooks.
     */
    public function init() {

        $this->admin = new Main();

        add_action('woocommerce_before_cart',[$this->admin,'applyCoupon'],10,1);

        add_filter('woocommerce_get_shop_coupon_data',[$this->admin,'applyCouponCode'], 10, 2);
    }
}
