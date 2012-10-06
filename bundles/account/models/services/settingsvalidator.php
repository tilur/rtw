<?php

namespace Account\Services;

class SettingsValidator extends \DG\Base\Validator
{
    private function __construct() {}

    public static function make($input=null, $rules=null)
    {
        // If the $rules variable is null, create the default rules for validating
        // this object.
        if (is_null($rules)) {
            $rules = array(
                'email'         => 'required|email',
                'first-name'    => 'required|alpha',
                'last-name'     => 'required|alpha',
            );
        }

        return parent::validate($input, $rules);
    }
}