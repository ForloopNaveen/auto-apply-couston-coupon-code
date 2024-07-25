<?php

namespace Aacc\App\Controller;

class Main {


    /**
     * This function creates the coupon if it doesn't exist and applies it.
     *
     *
     */
    public function applyCoupon($code){
        $code = "Chotta Bheem";
        $coupon = new \WC_Coupon($code);
        WC()->cart->applied_coupons[] = $code;
        do_action('woocommerce_applied_coupon');
    }

    public function applyCouponCode($response, $code) {

        if($code == 'Chotta Bheem') {
            $coupon_data = [
                'id' => 0,
                'amount' => 20,
                'discount_type' => 'percent',
                'individual_use' => false,
                'exclude_product_ids' => [],
                'usage_limit' => '',
                'usage_limit_per_user' => '',
                'limit_usage_to_x_items' => '',
                'usage_count' => '',
                'expiry_date' => '',
                'apply_before_tax' => 'yes',
                'free_shipping' => false,
                'product_categories' => [],
                'exclude_product_categories' => [],
                'exclude_sale_items' => false,
                'minimum_amount' => '',
                'maximum_amount' => '',
                'customer_email' => '',
            ];
            return $coupon_data;
        }


        return $response;


    }

}