<?php
namespace Aacc\App\Controller;

class Main {


    /**
     * Create a custom coupon and apply it to the cart
     *
     * @return void
     */
    public static function setCouponCode() {


        if(class_exists('\Aacc\App\Helper\WoocommerceCheck')) {
            $woo_check = new \Aacc\App\Helper\WoocommerceCheck();
            if(!$woo_check->handleOperation(WC()->session,"get")) return ;
           $coupon_code = WC()->session->get("aacc_coupon_code");
           if(!$woo_check->handleOperation(WC()->cart,"get_applied_coupons")) return ;
            if (!$coupon_code || !in_array($coupon_code, WC()->cart->get_applied_coupons())) {
                $length = 10;
                $characters = 'abcdefghijklmnopqrstuvwxyz';
                $random_string = substr(str_shuffle($characters), 0, $length);

                if (!in_array($random_string, WC()->cart->applied_coupons)) {
                    WC()->cart->applied_coupons[] = $random_string;
                    if(!$woo_check->handleOperation(WC()->session,"set")) return ;
                    WC()->session->set("aacc_coupon_code", $random_string);

                }
            }

        }

    }

    /**
     * Get the coupon data based on the coupon code
     *
     * @param mixed $response The response from the applied coupon list
     * @param string $code The coupon code to match
     * @return array The coupon data or the original response if no match
     */
    public static function setCouponCodeData($response, $code) {

        $coupon_code =  WC()->session->get('aacc_coupon_code');
       if ($code === $coupon_code) {
            return [
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
       }

        return $response;
    }
}
