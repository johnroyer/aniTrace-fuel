<?php
/**
 * Authenication. For user login, register, logout, etc.
 **/
class Controller_Auth extends Controller
{
	/**
	 * Default page. Show login and register form.
	 **/
	public function action_index()
	{
		$view = View::forge('user/home');
		$data = array(
			'header' => View::forge('header'),
			'navbar' => View::forge('navbar'),
			'page_title' => 'aniTrace',
			'loggedin' => false,
		);
		$view->set_global($data);
		return $view;
	}

	/**
	 * Identify user data and let user login.
	 **/
	public function actiion_login()
	{
	}

	/**
	 * User registration. Make sure user data is not conflict with exist
	 * data and add new user data into database.
	 **/
	public function action_register()
	{
	}

	/**
	 * Logout loggined user.
	 **/
	public function action_logout()
	{
	}

	/**
	 * Check if username is conflict.
	 **/
	public function action_check_username()
	{
	}

	/**
	 * Check if user's email is conflict.
	 **/
	public function action_check_email()
	{
	}
}
