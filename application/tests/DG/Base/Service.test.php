<?php

class TestService extends PHPUnit_Framework_TestCase {

    public function testInstanceOfService()
    {
        $this->assertInstanceOf('DG\Base\Service', new \DG\Base\Service());    
    }

    public function testHasFormData() {
        $this->assertObjectHasAttribute('_form_data', new \DG\Base\Service());
    }

    public function testFormDataNull() {
        $obj = new \DG\Base\Service();
        $this->assertNull($obj->get());
    }

    public function testFromDataSet() {
        $array = array(
            'field'  => 'value',
            'field2' => 'value2',
        );
        $obj = new \DG\Base\Service();
        $this->assertTrue($obj->set($array));
        $this->assertNotNull($obj->get());
    }

}