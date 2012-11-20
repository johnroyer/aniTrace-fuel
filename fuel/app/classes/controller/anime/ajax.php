<?php
use \Model\Anime;
/**
 * Methods for Ajax request in animtion page.
 **/
class Controller_Anime_Ajax extends Controller_Anime
{
	/**
	 * Default method. Return all availible animes which is not finished user.
	 **/
	public function action_index()
	{
		return json_encode(Anime::getList());
	}

	/**
	 * Return all watchable animes.
	 **/
	public function action_watchableList()
	{
		return json_encode(Anime::getList('watchable'));
	}
}
