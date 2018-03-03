<?php

namespace Shared\Util;

final class Sanitize
{
    private function __construct()
    {
    }

    public static function requestParamValueOf($paramValue){

        if($paramValue == null) {
            return null;
        }

        $filteredValue = null;
        if(isset($paramValue) && $paramValue != null) {
            //$filtered = nl2br(filter_var(trim($paramValue), FILTER_SANITIZE_STRING));
            $filteredValue = htmlspecialchars(trim($paramValue));
        }
        return $filteredValue;
    }
}
