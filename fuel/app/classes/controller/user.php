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

	/**
	 * Show user informations.
	 **/
	public function action_index()
	{
		$view = View::forge('user/home');
		$data = array(
			'page_title' => '帳號資訊',
			'loggedin' => true,
			'user' => $this->getUserInfo(),
		);
		$view->set_global($data);
		return $view;
	}

	/**
	 * Change password
	 **/
	public function action_chpassword()
	{
		if( Input::post('password', '') == '' )
		{
			$view = View::forge('user/chpassword');
			$data = array(
				'page_title' => '修改密碼',
				'loggedin' => true,
				'user' => $this->getUserInfo(),
			);
			$view->set_global($data);
			return $view;
		}
		else
		{
			// Validate password
			if( Input::post('password', '') != Input::post('passwordConfirm', '') )
			{
				try
				{
					if( Sentry::user()->change_password(Input::post('origPassword', ''), Input::post('password', '')) )
					{
						// Success
					}
					else
					{
						// Failed
					}
				}
				catch( SentryUserException $e )
				{
				}
			}
			else
			{
				// Password confirm error
			}
		}
	}

	/**
	 * Return user information needed in views.
	 **/
	private function getUserInfo()
	{
		$user = Sentry::user();
		$result = array(
			'username' => $user->get('username'),
			'isAdmin' => true,
		);
		return $result;
	}
}
