<?php
/**
 * Admin panel home page.
 **/
class Controller_Admin extends Controller
{
	/**
	 * Check permission.
	 **/
	public function before()
	{
		if(!Sentry::check())
		{
			Response::redirect(Uri::create('auth/'));
		}
		else
		{
			if(!Sentry::user()->in_group('admin'))
			{
				Response::redirect(Uri::create('anime/'));
			}
		}
	}

	/**
	 * Default action.
	 **/
	public function action_index()
	{
		$view = View::forge('admin/list');
		$data = array(
			'page_title' => '使用者管理',
			'loggedin' => true,
			'user' => $this->getUserInfo(),
		);
		$view->set_global($data);
		return $view;
	}

	/**
	 * Get user data.
	 **/
	private function getUserInfo()
	{
		$user = Sentry::user();
		$result = array(
			'username' => $user->get('username'),
			'isAdmin' => $user->in_group('admin'),
		);
		return $result;
	}
}
