<?php

class TestValidator extends PHPUnit_Framework_TestCase {

    /**
     * Test that a given condition is met.
     *
     * @return void
     */
    public function testInstanceOfValidator()
    {
        $this->assertInstanceOf('DG\Base\Validator', new \DG\Base\Validator());    
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInstanceOfInvalidArgumentExceptionInputArray() {
        $validator = \DG\Base\Validator::validate();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInstanceOfInvalidArgumentExceptionInputArrayEmpty() {
        $validator = \DG\Base\Validator::validate(array());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInstanceOfInvalidArgumentExceptionRulesArray() {
        $input     = array('field' => 'value');
        $validator = \DG\Base\Validator::validate($input);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInstanceOfInvalidArgumentExceptionRulesArrayEmpty() {
        $input     = array('field' => 'value');
        $validator = \DG\Base\Validator::validate($input, array());
    }

    public function testReturnValue() {
        $input     = array('field' => 'value');
        $rules     = array('field' => 'required');
        $validator = \DG\Base\Validator::validate($input, $rules);

        $this->assertInstanceOf('Laravel\Validator', $validator);
    }

}