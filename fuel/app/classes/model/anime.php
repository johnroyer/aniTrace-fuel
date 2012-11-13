<?php
namespace Model;
use \DB;
/**
 * Anime list access.
 **/
class Anime extends \Model
{
	/**
	 * Return anime list by type.
	 *
	 * @param  string  'all' for all animes, 'download' for download list, 'watchable' for watchable animes.
	 * @return array   list of anime
	 **/
	public static function getList($type='')
	{
		return DB::select()->from('anime_lists')->where('user_id', 1)->execute()->as_array();
	}
}
