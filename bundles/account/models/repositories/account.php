<?php

namespace Account\Repositories;

class Account {
	public static function save($input=null)
	{
        if ($input === null) {
            $input = \Input::all();
        }

		$affected = \DB::table('users')
			->where('id', '=', $input['user-id'])
			->update(array(
				'first_name' => $input['first-name'],
				'last_name' => $input['last-name'],
			));

		return $affected;
	}

    public static function save_password($input=null)
    {
        if ($input === null) {
            $input = \Input::all();
        }

        $affected = \DB::table('users')
            ->where('id', '=', $input['user-id'])
            ->update(array(
                'password' => \Hash::make($input['password-new']),
            ));

        return $affected;
    }
}