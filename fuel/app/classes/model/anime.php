<?php
namespace Model;
use DB;
use Sentry;

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
		if( $type == '' )
		{
			return DB::select()
				->from('anime_lists')
				->where('user_id', Sentry::user()->get('id'))
				->execute()->as_array();
		}
		elseif( $type == 'download' )
		{
			return DB::select()
				->from('anime_lists')
				->where('user_id', Sentry::user()->get('id'))
				->and_where('finished', 0)
				->execute()->as_array();
		}
		elseif( $type == 'watchable' )
		{
			$sql  = 'select * from anime_lists
							where user_id = ' . Sentry::user()->get('id') .'
							and (
								(`download` = 0 and `volumn` = 0)
								or (`download` > `volumn` or `finished` = 0)
							) ';
			return DB::query($sql)->execute()->as_array();
		}
	}
}
