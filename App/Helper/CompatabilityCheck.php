<?php

namespace Aacc\App\Helper;

class CompatabilityCheck{

    /**
     * Initial Check
     *
     * @return bool
     */
    public function initCheck(){
    if(!$this->isWoocommerceActivate()){
        return false;
    }elseif (!$this->isEnvironmentCompatible()){
        return false;

    }elseif (!$this->isWordPressCompatible()){
        return false;
    }elseif (!$this->isWoocommerceCompatible()){
        return false;
    }
    return true;

    }

    /**
     * This function check if the woocommerce is active or not
     *
     * @return bool
     */

    public function isWoocommerceActivate()
    {
        $activate_plugins = apply_filters('active_plugins', get_option('active_plugins',array()));
        if(is_multisite()){
            $activate_plugins = array_merge($activate_plugins, get_site_option('active_sitewide_plugins', array()));
        }
        return (in_array('woocommerce/woocommerce.php', $activate_plugins) || array_key_exists('woocommerce/woocommerce.php', $activate_plugins));


    }

    /**
     * This function holds the admin notice
     *
     * @return void
     */
    public function     compatabilityNotice()
    {
        $message = $this->getCompatibilityContent();
        echo '<div class="notice notice-error"><p><strong>' . esc_html($message) . '</strong></p></div>';
    }

    /**
     * This function holds the admin notice messages
     *
     * @return string
     */
    public function getCompatibilityContent()
    {
        $message = '';
        if(!$this->isWoocommerceActivate()){
            $message = esc_html__(' Woocommerce  must be installed and activated in-order to use ','auto-apply-coupon-code ').AACC_PLUGIN_NAME;
        }elseif(!$this->isEnvironmentCompatible()){
            $message = AACC_PLUGIN_NAME.esc_html__(' is inactive. Because, it requires minimum PHP version of ','auto-apply-coupon-code ').AACC_MINIMUM_PHP_VERSION;
        }elseif (!$this->isWordPressCompatible()){
            $message = AACC_PLUGIN_NAME.esc_html__(' is inactive. Because, it requires minimum WordPress version of ','auto-apply-coupon-code ').AACC_MINIMUM_WP_VERSION;
        }elseif (!$this->isWoocommerceCompatible()){
            $message = AACC_PLUGIN_NAME.esc_html__(' is inactive. Because, it requires minimum Woocommerce version of ','auto-apply-coupon-code ').AACC_MINIMUM_WC_VERSION;
        }
        return $message;
    }
    /**
     * This function check the php version
     *
     * @return bool|int
     */
    public function isEnvironmentCompatible(){
        return version_compare(PHP_VERSION, AACC_MINIMUM_PHP_VERSION, '>=');
    }
    /**
     * This function check the WordPress version
     *
     * @return bool|int
     */
    public function isWordPressCompatible(){
        return (!AACC_MINIMUM_PHP_VERSION) ? true : version_compare(get_bloginfo('version'), AACC_MINIMUM_WP_VERSION, '>=');
    }
    /**
     * This function get the woocommerce version
     *
     * @return mixed|string
     */
    public function woocommerceVersion() {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
        $plugin_folder = get_plugin_data(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php');
        return isset($plugin_folder['Version']) ? $plugin_folder['Version'] : '1.0.0';
    }
    /**
     * This function check the woocommerce version
     *
     * @return bool|int
     */
    public function isWoocommerceCompatible(){
        $wc_version = $this->woocommerceVersion();
        return (!AACC_MINIMUM_WP_VERSION) ? true : version_compare($wc_version, AACC_MINIMUM_WC_VERSION, '>=');
    }
}