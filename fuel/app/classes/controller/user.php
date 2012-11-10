<?php

/**
 * Methods depend on users. Such as login, register, etc.
 **/
class Controller_User extends Controller 
{
	public function action_index()
	{
		$view = View::forge('user/home');
		$data = array(
			'header' => View::forge('header'),
			'navbar' => View::forge('navbar'),
			'page_title' => 'aniTrace',
			'loggedin' => false,
		);
		$view->set_global( $data );
		return $view;
	}
}
