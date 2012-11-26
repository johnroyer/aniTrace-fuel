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
			if(!Sentry::in_group('admin'))
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
		return 'admin';
	}
}
