<?php

class TestNavigationLink extends PHPUnit_Framework_TestCase {

    /**
     * Test that a given condition is met.
     *
     * @return void
     */
    public function testInstanceOfNavigationLink()
    {
        $this->assertInstanceOf('NavigationLink', new \DG\NavigationLink());    
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInstanceOfInvalidArgumentExceptionHref()
    {
        $link = \DG\NavigationLink::make(null, 'label');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInstanceOfInvalidArgumentExceptionLabelNull()
    {
        $link = \DG\NavigationLink::make('/link', null);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInstanceOfInvalidArgumentExceptionLabelEmpty()
    {
        $link = \DG\NavigationLink::make('/link', '');
    }

    public function testLinkHasProperGetStructure()
    {
        $link = \DG\NavigationLink::make('/link', 'Label')->get();
        // Asert that what is returned is an array
        $this->assertTrue(is_array($link));
        // Assert that the array only has two elements
        $this->assertTrue(sizeof($link) === 1);
        // Assert that the element 'link' exists in the $link
        $this->assertArrayHasKey('link', $link);
    }

    public function testLinkHasProperAppendStructure()
    {
        $link = \DG\NavigationLink::make('/link', 'label')->append()->get();

        // Asert that what is returned is an array
        $this->assertTrue(is_array($link));        
        // Assert that the array only has two elements
        $this->assertTrue(sizeof($link) === 2);
        // Assert that the element 'link' exists in the $link
        $this->assertArrayHasKey('link', $link);
        // Assert that the element 'append' exists in the $link
        $this->assertArrayHasKey('append', $link);
        // Assert that the value of 'append' is true
        $this->assertTrue($link['append'] === true);
    }

    public function testLinkHasProperPrependStructure()
    {
        $link = \DG\NavigationLink::make('/link', 'label')->prepend()->get();

        // Asert that what is returned is an array
        $this->assertTrue(is_array($link));        
        // Assert that the array only has two elements
        $this->assertTrue(sizeof($link) === 2);
        // Assert that the element 'link' exists in the $link
        $this->assertArrayHasKey('link', $link);
        // Assert that the element 'append' exists in the $link
        $this->assertArrayHasKey('prepend', $link);
        // Assert that the value of 'append' is true
        $this->assertTrue($link['prepend'] === true);
    }

    public function testLinkHasProperAfterStructure()
    {
        $link = \DG\NavigationLink::make('/link', 'label')->after(1)->get();

        // Asert that what is returned is an array
        $this->assertTrue(is_array($link));        
        // Assert that the array only has two elements
        $this->assertTrue(sizeof($link) === 2);
        // Assert that the element 'link' exists in the $link
        $this->assertArrayHasKey('link', $link);
        // Assert that the element 'after' exists in the $link
        $this->assertArrayHasKey('after', $link);
        // Assert that the value of 'after' is numeric
        $this->assertTrue(is_numeric($link['after']));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInstanceOfInvalidArgumentExceptionAfter()
    {
        $link = \DG\NavigationLink::make('/link', 'label')->after('')->get();
        $link = \DG\NavigationLink::make('/link', 'label')->after(null)->get();
        $link = \DG\NavigationLink::make('/link', 'label')->after('null')->get();
    }

    public function testLinkHasProperBeforeStructure()
    {
        $link = \DG\NavigationLink::make('/link', 'label')->before(2)->get();

        // Asert that what is returned is an array
        $this->assertTrue(is_array($link));        
        // Assert that the array only has two elements
        $this->assertTrue(sizeof($link) === 2);
        // Assert that the element 'link' exists in the $link
        $this->assertArrayHasKey('link', $link);
        // Assert that the element 'before' exists in the $link
        $this->assertArrayHasKey('before', $link);
        // Assert that the value of 'before' is numeric
        $this->assertTrue(is_numeric($link['before']));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInstanceOfInvalidArgumentExceptionBefore()
    {
        $link = \DG\NavigationLink::make('/link', 'label')->before('')->get();
        $link = \DG\NavigationLink::make('/link', 'label')->before(null)->get();;
        $link = \DG\NavigationLink::make('/link', 'label')->before('null')->get();
    }

    public function testLinkHasProperPositionStructure()
    {
        $link = \DG\NavigationLink::make('/link', 'label')->position(2)->get();

        // Asert that what is returned is an array
        $this->assertTrue(is_array($link));        
        // Assert that the array only has two elements
        $this->assertTrue(sizeof($link) === 2);
        // Assert that the element 'link' exists in the $link
        $this->assertArrayHasKey('link', $link);
        // Assert that the element 'position' exists in the $link
        $this->assertArrayHasKey('position', $link);
        // Assert that the value of 'position' is numeric
        $this->assertTrue(is_numeric($link['position']));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInstanceOfInvalidArgumentExceptionPosition()
    {
        $link = \DG\NavigationLink::make('/link', 'label')->position('')->get();
        $link = \DG\NavigationLink::make('/link', 'label')->position(null)->get();
        $link = \DG\NavigationLink::make('/link', 'label')->position('null')->get();
    }

    public function testHasClearedPositioning()
    {
        $link = \DG\NavigationLink::make('/link', 'label')
            ->prepend()
            ->after(1)
            ->before(2)
            ->position(2)
            ->append()
            ->get();
        if (isset($link['prepend']) || isset($link['after']) || isset($link['before']) || isset($link['position'])) {
            $this->fail('Appending link should not contain other positioning');
        }

        $link = \DG\NavigationLink::make('/link', 'label')
            ->append()
            ->after(1)
            ->before(2)
            ->position(2)
            ->prepend()
            ->get();
        if (isset($link['append']) || isset($link['after']) || isset($link['before']) || isset($link['position'])) {
            $this->fail('Appending link should not contain other positioning');
        }

        $link = \DG\NavigationLink::make('/link', 'label')
            ->append()
            ->prepend()
            ->before(2)
            ->position(2)
            ->after(1)
            ->get();
        if (isset($link['append']) || isset($link['prepend']) || isset($link['before']) || isset($link['position'])) {
            $this->fail('Appending link should not contain other positioning');
        }

        $link = \DG\NavigationLink::make('/link', 'label')
            ->append()
            ->prepend()
            ->after(1)
            ->position(2)
            ->before(2)
            ->get();
        if (isset($link['append']) || isset($link['prepend']) || isset($link['after']) || isset($link['position'])) {
            $this->fail('Appending link should not contain other positioning');
        }

        $link = \DG\NavigationLink::make('/link', 'label')
            ->append()
            ->prepend()
            ->after(1)
            ->before(2)
            ->position(2)
            ->get();
        if (isset($link['append']) || isset($link['prepend']) || isset($link['after']) || isset($link['before'])) {
            $this->fail('Appending link should not contain other positioning');
        }

    }
}