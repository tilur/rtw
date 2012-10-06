<?php

Route::get('(:bundle)/hash/(:any)', function()
{
    return Hash::make(URI::segment(3));
});

Route::get('(:bundle)', function()
{
	$form_data = Login\Login::form()->get_data();

	return View::make('login::login')
		->with('form_data', $form_data);
});
Route::post('(:bundle)', array('before' => 'csrf', function()
{
    $validation = Login\Login::form()->validate(Input::all());

    if ($validation->fails()) {
        return Redirect::to('login')
            ->with_errors($validation);
    }   

    $credentials = array('username' => Input::get('email'), 'password' => Input::get('password'));
    if (Auth::attempt($credentials)) {
        return Redirect::to('dashboard');
    }   

    return Redirect::to('login');
}));