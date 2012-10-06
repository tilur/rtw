<?php

namespace Account\Services;

use \Auth;

class Password extends \DG\Base\Service
{
    public static function form()
    {
        $_instance = new self;

        $_instance->prepare_form_data();

        return $_instance;
    }

    /*
    |--------------------------------------------------------------------------
    | prepare_form_data()
    |--------------------------------------------------------------------------
    | Prepares the array that is used in the views to create the signup form to 
    | the user. Private function that is called by the form() singleton when 
    | being statically called.
    |
    | @singleton: form
    | @return:    array
    */
    private function prepare_form_data()
    {
        $form_data = array(
            'user-id' => array(
                'name' => 'user-id',
                'value' => Auth::user()->id,
                'extra' => array('id'=>'password-user-id'),
            ),
            'password-current' => array(
                'name' => 'password-current',
                'extra' => array('id'=>'password-current', 'autofocus'=>''),
            ),
            'password-new' => array(
                'name'    => 'password-new',
                'extra'   => array('id'=>'password-new'),
            ),
            'password-verify'   => array(
                'name'    => 'password-verify',
                'extra'   => array('id'=>'password-verify'),
            ),

            'lbl-password-current'   => array(
                'target'  => 'password-current',
                'label'   => 'Current Password',
            ),
            'lbl-password-new' => array(
                'target'  => 'password-new',
                'label'   => 'New Password',
            ),
            'lbl-password-verify' => array(
                'target'  => 'password-verify',
                'label'   => 'Verify Password',
            ),

            'btn-submit'   => array(
                'value'   => 'Save Changes',
                'extra'   => array(
                    'class' => 'btn btn-primary',
                ),
            ),
        );

        $this->_form_data = $this->massage_form_data($form_data);
        return $this;
    }
}