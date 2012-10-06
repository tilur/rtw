<?php

namespace DG;

use \Laravel\Config;

class NavigationLink
{
    /**
     * The instance to singleton
     *
     * @var object
     */
    private static $_instance = null;

    /**
     * The link payload
     *
     * @var array
     */
    private static $_link = null;

    public static function make($href=null, $label=null, $class=null, $size=null)
    {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

        // Validate $href, cannot be null
        if (is_null($href)) {
            throw new \InvalidArgumentException('NavigationLink: $href cannot be null');
        }

        // Validate $label, cannot be null or empty
        if (is_null($label) || empty($label)) {
            throw new \InvalidArgumentException('NavigationLink: $label cannot be null or empty');
        }

        $size = is_null($size) ? Config::get('navigation.default_btn_size') : $size;

        self::$_link = array(
            'link' => array('href' => $href, 'label' => $label, 'class' => $class, 'size'=>$size),
        );
        
        return self::$_instance;
    }

    public function append()
    {
        self::clear_positioning();
        self::$_link['append'] = true;
        return $this;
    }

    public function prepend()
    {
        self::clear_positioning();
        self::$_link['prepend'] = true;
        return $this;
    }

    public function after($position)
    {
        if (is_null($position) || empty($position)) {
            throw new \InvalidArgumentException('NavigationLink::after: $position cannot be null or empty');
        }

        if (!is_numeric($position)) {
            throw new \InvalidArgumentException('NavigationLink::after: $position must be numeric');
        }

        self::clear_positioning();
        self::$_link['after'] = $position;
        return $this;
    }

    public function before($position)
    {
        if (is_null($position) || empty($position)) {
            throw new \InvalidArgumentException('NavigationLink::before: $position cannot be null or empty');
        }

        if (!is_numeric($position)) {
            throw new \InvalidArgumentException('NavigationLink::before: $position must be numeric');
        }

        self::clear_positioning();
        self::$_link['before'] = $position;
        return $this;
    }

    public function position($position)
    {
        if (is_null($position) || empty($position)) {
            throw new \InvalidArgumentException('NavigationLink::position: $position cannot be null or empty');
        }

        if (!is_numeric($position)) {
            throw new \InvalidArgumentException('NavigationLink::position: $position must be numeric');
        }

        self::clear_positioning();
        self::$_link['position'] = $position;
        return $this;
    }

    public function get()
    {
        return self::$_link;
    }

    private function clear_positioning()
    {
        unset(self::$_link['append']);
        unset(self::$_link['prepend']);
        unset(self::$_link['after']);
        unset(self::$_link['before']);
        unset(self::$_link['position']);
    }
}