<?php
/**
 * Methods for anime.
 **/
class Controller_Anime extends Controller
{
	/**
	 * Construtor for Anime
	 **/
	public function before()
	{
		if(!Sentry::check())
		{
			Response::redirect(Uri::create('auth/'));
		}
	}

	/**
	 * Show anime list belong to user
	 **/
	public function action_index()
	{
		echo 'Anime index';
	}
}
