<?php

namespace Account\Services;

use \Auth;

class Settings extends \DG\Base\Service
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
                'extra' => array('id'=>'account-user-id'),
            ),
            'email' => array(
                'name'    => 'email',
                'extra'   => array('id'=>'account-email', 'autofocus'=>''),
            ),
            'first-name'   => array(
                'name'    => 'first-name',
                'extra'   => array('id'=>'account-first-name'),
            ),
            'last-name'   => array(
                'name'    => 'last-name',
                'extra'   => array('id'=>'account-last-name'),
            ),

            'lbl-email'   => array(
                'target'  => 'account-email',
                'label'   => 'E-mail Address',
            ),
            'lbl-first-name' => array(
                'target'  => 'account-first-name',
                'label'   => 'First Name',
            ),
            'lbl-last-name' => array(
                'target'  => 'account-last-name',
                'label'   => 'Last Name',
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

    public function populate($input=null)
    {
        $form_data = $this->_form_data;

        $form_data['user-id']['value'] = \Auth::user()->id;
        $form_data['email']['value'] = \Input::old('email') != '' ? \Input::old('email') : \Auth::user()->email;
        $form_data['first-name']['value'] = \Input::old('first-name') != '' ? \Input::old('first-name') : \Auth::user()->first_name;
        $form_data['last-name']['value'] = \Input::old('last-name') != '' ? \Input::old('last-name') : \Auth::user()->last_name;

        $this->_form_data = $form_data;

        return $this;
    }
}