<?php
use \Model\Anime;
/**
 * Methods for Ajax request in animtion page.
 **/
class Controller_Anime_Ajax extends Controller_Anime
{
	/**
	 * Default method. Return all animte availible for user.
	 **/
	public function action_index()
	{
		return print_r(Anime::getList());
	}
}
