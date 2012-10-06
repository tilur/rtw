<?php

namespace Login;

class Login
{
    private $form_data = null;

    private function __construct()
    {
        return $this;
    }

    public static function form()
    {
        $instance = new self;
        $instance->form_data = $instance->prepare_form_data();

        return $instance;
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
            'email' => array(
                'name'    => 'email',
                'options' => array(
                    '' => '--',
                ),
                'extra'   => array('id'=>'login-email', 'autofocus'=>''),
            ),
            'password'   => array(
                'name'    => 'password',
                'options' => array(
                    '' => '--',
                ),
                'extra'   => array('id'=>'login-password'),
            ),

            'lbl-email'   => array(
                'target'  => 'email',
                'label'   => 'E-mail Address',
            ),
            'lbl-password' => array(
                'target'  => 'password',
                'label'   => 'Password',
            ),

            'btn-submit'   => array(
                'value'   => 'Login',
                'extra'   => array(
                    'class' => 'btn btn-primary',
                ),
            ),
        );

        return \DG\Utility::massage_form_data($form_data);
    }

    /*
    |--------------------------------------------------------------------------
    | get_data()
    |--------------------------------------------------------------------------
    | Function to return the form data for the Signup::form singleton.
    |
    | @return array
    */
    public function get_data()
    {
        return $this->form_data;
    }

    public function validate($input=null, $rules=null)
    {
        // If the $input variable is null, automatically set it to Input::all().
        if (is_null($input)) {
            $input = Input::all();
        }

        // If the $rules variable is null, create the default rules for validating
        // this object.
        if (is_null($rules)) {
            $rules = array(
                'email'    => 'required|email',
                'password' => 'required|alpha_num',
            );
        }

        // Return the validation object.
        return \Validator::make($input, $rules);
    }
}