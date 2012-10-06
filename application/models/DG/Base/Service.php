<?php

namespace DG\Base;

use \DG\Utility;
use \Auth;

class Service
{
    protected $_form_data = null;

    public function __construct() {}

    protected function massage_form_data($form_data)
    {
        return Utility::massage_form_data($form_data);
    }

    public function get()
    {
        return $this->_form_data;
    }
}