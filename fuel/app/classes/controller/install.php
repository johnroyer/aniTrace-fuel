<?php

class Controller_Install extends Controller
{

	public function action_index()
	{
		if( Migrate::latest('sentry', 'package') && Migrate::latest('default', 'app'))
		{
			$data = array(
				'username' => 'admin',
				'email' => 'admin@admin',
				'password' => 'admin',
			);
			$uid = Sentry::user()->create($data);
			return 'user id = '.$uid;
		}
		else
		{
			return 'migrate failed';
		}
	}

	public function action_version()
	{
		return Migrate::current('default');
	}
}
