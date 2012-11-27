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
