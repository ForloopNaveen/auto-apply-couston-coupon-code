<?php

namespace Aacc\App\Helper;

class WoocommerceCheck
{

    /**
     * This is a function to check if the object and method exit or not
     *
     * @param $object
     * @param $method
     * @return bool
     */
    public function handleOperation($object, $method) {
        if (isset($object) && is_object($object) && method_exists($object, $method)) {
            return true;
        }
        return false;
    }
}
