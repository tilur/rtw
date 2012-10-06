<?php

namespace Account\Services;

class PasswordValidator extends \DG\Base\Validator
{
    private function __construct() {}

    public static function make($input=null, $rules=null)
    {
        if ($input === null) {
            $input = \Input::all();
        }

        // Custom validation rule to verify that the current password being
        // entered matches the user logged in
        \Validator::register('current_password', function() use ($input) {
            return \Hash::check($input['password-current'], \Auth::user()->password);
        });

        // If the $rules variable is null, create the default rules for validating
        // this object.
        if (is_null($rules)) {
            $rules = array(
                'password-current' => 'required|current_password',
                'password-new'     => 'required|different:password-current',
                'password-verify'  => 'required|same:password-new',
            );
        }

        // Custom error messages for this validation
        $messages = array(
            'current_password' => 'Current password does not match our records',
            'different'        => 'Your new passowrd must be different than your current password',
            'same'             => 'Your new password must match the verification',
        );

        // Validate!
        return parent::validate($input, $rules, $messages);
    }
}