<?php

namespace DG;
use \Laravel\Config as Config;
use \Laravel\HTML as HTML;

class Navigation
{
    /**
     * The navigation payload
     *
     * @var array
     */    
    private $_navigation = null;

    /**
     * Create a new navigation instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Create a new navigation singleton.
     *
     * @param  integer $user_type
     * @return object
     */
    public static function make($user_type=0)
    {
        $_instance = new self;

        // Set the payload to the default navigation options defined by the 
        // config file.
        $_instance->_navigation = Config::get('navigation.'.$user_type);
        
        return $_instance;
    }

    public function append($data=null)
    {
        array_push($this->_navigation, $data);

        return $this;
    }

    public function prepend($data=null)
    {
        array_unshift($this->_navigation, $data);

        return $this;
    }

    public function after($position, $data=null)
    {
        $left = array_slice($this->_navigation, 0, $position);
        array_push($left, $data);
        $right = array_slice($this->_navigation, $position);
        $this->_navigation = array_merge($left, $right);

        return $this;
    }

    public function before($position, $data=null)
    {
        $left = array_slice($this->_navigation, 0, ($position-1));
        array_push($left, $data);
        $right = array_slice($this->_navigation, ($position-1));
        $this->_navigation = array_merge($left, $right);

        return $this;
    }

    public function position($position, $data=null)
    {
        $this->after(($position-1), $data);

        return $this;
    }

    public function ammend($data)
    {
        foreach ($data AS $navigation) {
            if ((isset($navigation['prepend']) && isset($navigation['append'])) ||
                (!isset($navigation['prepend']) && isset($navigation['append']))) {
                $this->append($navigation['link']);
                continue;
            }

            if (isset($navigation['prepend'])) {
                $this->prepend($navigation['link']);
                continue;
            }

            if (isset($navigation['after'])) {
                $this->after($navigation['after'], $navigation['link']);
                continue;
            }

            if (isset($navigation['before'])) {
                $this->before($navigation['before'], $navigation['link']);
                continue;
            }

            if (isset($navigation['position'])) {
                $this->position($navigation['position'], $navigation['link']);
                continue;
            }
        }

        return $this;       
    }

    public function get($output='object')
    {
        switch ($output) {
            case 'object':
                return $this;
                break;
            case 'raw':
                return $this->_navigation;
                break;
        }
    }

    public function display()
    {
        foreach ($this->_navigation AS $i => $link) {
            if (!isset($link['size']) || empty($link['size'])) {
                $link['size'] = Config::get('navigation.default_btn_size');
            }

            if (!isset($link['class'])) {
                $link['class'] = '';
            }

            echo HTML::link($link['href'], $link['label'], array('class'=>'btn btn-'.$link['size'].' '.$link['class']));
        }
    }
}