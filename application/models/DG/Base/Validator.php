<?php

namespace DG\Base;

class Validator
{
    public static function validate($input=null, $rules=null, $messages=array())
    {
        // If the $input variable is null, automatically set it to Input::all().
        if (is_null($input)) {
            $input = \Input::all();
        }

        // If our $input array is empty, throw an exception (we NEED an array to
        // validate through).
        if (count($input) === 0) {
            throw new \InvalidArgumentException('Validator: $input cannot be empty');
        }

        // If $rules is still null or it's an empty array, throw an exception...
        // We need rules to validate the above $input against.
        if (is_null($rules) || count($rules) === 0) {
            throw new \InvalidArgumentException('Validator: $rules cannot be null or empty');
        }

        // Return the validation object.
        return \Validator::make($input, $rules, $messages);
    }
}