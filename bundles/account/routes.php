<?php

Route::group(array('before' => 'auth'), function()
{
	$sub_navigation = array();
	if (Auth::check()) {
		$sub_navigation = Navigation::make('sub_'.(Auth::user()->type).'_account')->get();
	}

	Route::get('(:bundle)', function()
	{
		return Redirect::to('account/settings');
	});

	Route::get('(:bundle)/settings', function() use ($sub_navigation)
	{
		// Get the form data and populate it with our logged in account
		$form_data = Account\Services\Settings::form()
			->populate()
			->get();

		//$navigation[] = NavigationLink::make('/places-unknown', 'Where oh where?');
		//$navigation[] = NavigationLink::make('/fart', 'Smelly (after Where...)', 'btn-warning')->position(3);

		//return View::make('account::account-settings', array('navigation'=>$navigation));
		return View::make('account::account-settings')
			->with('form_data', $form_data)
			->with('sub_navigation', $sub_navigation)
			// Passing Session value in to populate an alert box of the success
			->with('success', \Session::get('success'));
	});

	Route::post('(:bundle)/settings', array('before' => 'csrf', function()
	{
		$validation = \Account\Services\SettingsValidator::make();

		if ($validation->fails()) {
			return \Redirect::to('/account/settings')
				->with_input()
				->with_errors($validation);
		}

		\Account\Repositories\Account::save();

		return Redirect::to('/account/settings')
			->with('success', 'update');
	}));

	Route::get('(:bundle)/password', function() use ($sub_navigation)
	{
		// Get the form data
		$form_data = Account\Services\Password::form()
			->get();

		return View::make('account::account-password')
			->with('form_data', $form_data)
			->with('sub_navigation', $sub_navigation)
			->with('success', \Session::get('success'));
	});

	Route::post('(:bundle)/password', array('before' => 'csrf', function()
	{
		$validation = \Account\Services\PasswordValidator::make();

		if ($validation->fails()) {
			return \Redirect::to('/account/password')
				->with_input()
				->with_errors($validation);
		}

		\Account\Repositories\Account::save_password();

		return Redirect::to('/account/password')
			->with('success', 'update');
	}));
});
