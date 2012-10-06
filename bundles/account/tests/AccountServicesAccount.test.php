<?php
require_once(__DIR__.'/../models/services/account.php');

class TestServicesAccount extends PHPUnit_Framework_TestCase {

    public function testInstanceOfServicesAccount()
    {
        $this->assertInstanceOf('Account\Services\Account', new \Account\Services\Account());    
    }
}