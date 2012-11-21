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

	/**
	 * Return anime information.
	 * @param  int   anime ID
	 * @return json  anime information
	 **/
	public function action_anime($id=0)
	{
		$id = intval($id);
		if( $id > 0 )
		{
			echo json_encode(Anime::getAnime($id));
		}
	}

	/**
	 * Add or subtract anime volumn.
	 * @param  string  'up' or 'down'
	 * @param  int     anime ID
	 * @return json    anime information after update
	 **/
	public function action_vol($action, $id=0)
	{
		$id = intval($id);
		if( $id > 0 )
		{
			if( $action == 'up' )
			{
				Anime::volumnUp($id);
				echo json_encode(Anime::getAnime($id));
			}
			else
			{
				Anime::volumnDown($id);
				echo json_encode(Anime::getAnime($id));
			}
		}
	}
}
