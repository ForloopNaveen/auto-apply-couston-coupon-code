<?php

namespace Aacc\App;

use \Aacc\App\Controller\Main;

class Router {


    /**
     * Initializes the hooks.
     */
    public function init() {
        if (is_admin()) return;

        add_action('woocommerce_before_calculate_totals', [Main::class, 'setCouponCode'], 10, 1);
        add_filter('woocommerce_get_shop_coupon_data',[Main::class,'setCouponCodeData'], 10, 2);
    }
}
