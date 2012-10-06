<?php

namespace DG;
use \Laravel\Auth;

class View extends \Laravel\View {
	/**
	 * Create a new view instance.
	 *
	 * <code>
	 *		// Create a new view instance
	 *		$view = View::make('home.index');
	 *
	 *		// Create a new view instance of a bundle's view
	 *		$view = View::make('admin::home.index');
	 *
	 *		// Create a new view instance with bound data
	 *		$view = View::make('home.index', array('name' => 'Taylor'));
	 * </code>
	 *
	 * @param  string  $view
	 * @param  array   $data
	 * @return View
	 */
	public static function make($view, $data = array())
	{
		// Create a local navigation variable
		$out_navigation = Navigation::make(Auth::check() ? Auth::user()->type : 0);
		// Check the incoming array to see if extra navigation is attempting to 
		// make it's way into the data.
		if (array_key_exists('navigation', $data)) {
			// Ammend any extra navigation data we're trying to pass to the view.
			$out_navigation->ammend($data['navigation']);
		}

		// $view_data is an array that we pass to the views to contain any extra
		// data we may need use.
		$view_data = array(
			'navigation' => $out_navigation->get(), // object
		);

		return new static($view, array_merge($data, array('view_data' => $view_data)));
	}
	
}