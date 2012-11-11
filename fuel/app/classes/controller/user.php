<?php

/**
 * Methods depend on users. Such as login, register, etc.
 **/
class Controller_User extends Controller 
{
	/**
	 * Check if user has loggedin.
	 **/
	public function before()
	{
		if ( !Sentry::check() )
		{
			// User is not loggedin
			Response::redirect( Uri::create('auth/') );
		}
	}
}
