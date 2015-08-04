<?php
namespace Model;

use DB;
use Sentry;
use Arr;
use Model\Track;

/**
 * Anime list access.
 **/
class anime extends \Model
{
    /**
     * Return anime list by type.
     *
     * @param  string  'all' for all animes, 'download' for download list, 'watchable' for watchable animes.
     * @return array   list of anime
     **/
    public static function getList($type='')
    {
        if ($type == '') {
            return DB::select()
                ->from('tracks')
                ->where('user_id', Sentry::user()->get('id'))
                ->and_where('delete_at', '=', null)
                ->order_by('id', 'asc')
                ->execute()->as_array();
        } elseif ($type == 'download') {
            return DB::select()
                ->from('tracks')
                ->where('user_id', Sentry::user()->get('id'))
                ->and_where('delete_at', '=', null)
                ->and_where('finished', 0)
                ->order_by('id', 'asc')
                ->execute()->as_array();
        } elseif ($type == 'watchable') {
            $sql  = 'select * from tracks
				where user_id = ' . Sentry::user()->get('id') .'
				and (
						(`download` = 0 and `volumn` = 0)
						or (`download` > `volumn` or `finished` = 0)
				) and download > 0 and download > volumn 
                and delete_at is null
				order by `id` asc ';
            return DB::query($sql)->execute()->as_array();
        }
    }

    /**
     * Get anime information.
     * @param  int    anime ID
     * @return array  properties of anime
     **/
    public static function getAnime($id = 0)
    {
        if ($id != 0) {
            $result = DB::select()
                ->from('tracks')
                ->where('user_id', Sentry::user()->get('id'))
                ->where('id', $id)
                ->execute()->as_array();
            return $result[0];
        }
    }

    /**
     * Get anime volumn.
     * @param  int anime ID
     * @return int anime volumn
     **/
    public static function getVolumn($id = 0)
    {
        $result = Anime::getAnime($id);
        return $result['volumn'];
    }

    /**
     * Get anime download value.
     * @param  int anime ID
     * @return int anime download
     **/
    public static function getDownload($id = 0)
    {
        $result = Anime::getAnime($id);
        return $result['download'];
    }

    /**
     * Update anime data
     * @param  array  anime information
     * @return array  anime information after update
     **/
    public static function setAnime($data='')
    {
        $id = Arr::get($data, 'id', '');
        if (Arr::is_assoc($data) && $id != '') {
            // Validate input data
            $data['user_id'] = Sentry::user()->get('id');
            $data['sub'] = Arr::get($data, 'sub', '');
            $data['volumn'] = Arr::get($data, 'volumn', '0');
            $data['download'] = Arr::get($data, 'download', '0');
            $data['link'] = Arr::get($data, 'link', '');

            // Check value of volumn and download, Minumal value is 0.
            if ($data['volumn'] < 0) {
                $data['volumn'] = 0;
            }
            if ($data['download'] < 0) {
                $data['download'] = 0;
            }
            Arr::delete($data, 'id');
            Arr::delete($data, 'user_id');
            $result = DB::update('tracks')
                ->where('id', $id)
                ->where('user_id', Sentry::user()->get('id'))
                ->set($data)
                ->execute();
            return Anime::getAnime($id);
        }
    }

    /**
     * Add anime volumn by one.
     * @param  int anime ID
     **/
    public static function volumnUp($id)
    {
        $vol = Anime::getVolumn($id);
        $vol++;
        DB::update('tracks')
            ->where('id', $id)
            ->where('user_id', Sentry::user()->get('id'))
            ->value('volumn', $vol)
            ->execute();
    }

    /**
     * Subtract anime volumn by one until volumn equal 0.
     * @param  int anime ID
     **/
    public static function volumnDown($id)
    {
        $vol = Anime::getVolumn($id);
        if ($vol > 0) {
            $vol--;
            DB::update('tracks')
                ->where('id', $id)
                ->where('user_id', Sentry::user()->get('id'))
                ->value('volumn', $vol)
                ->execute();
        }
    }

    /**
     * Add download value by one.
     * @param  int anime ID
     **/
    public static function downloadUp($id)
    {
        $download = Anime::getDownload($id);
        $download++;
        DB::update('tracks')
            ->where('id', $id)
            ->where('user_id', Sentry::user()->get('id'))
            ->value('download', $download)
            ->execute();
    }

    /**
     * Subtract anime download by one until download equal 0.
     * @param  int anime ID
     **/
    public static function downloadDown($id)
    {
        $download = Anime::getDownload($id);
        if ($download > 0) {
            $download--;
            DB::update('tracks')
                ->where('id', $id)
                ->where('user_id', Sentry::user()->get('id'))
                ->value('download', $download)
                ->execute();
        }
    }

    /**
     * Modify finish status between 0 and 1.
     * 0 if not finished, 1 if finished.
     * @param  int anime ID
     **/
    public static function setFinished($id)
    {
        $anime = Anime::getAnime($id);
        $finished = $anime['finished'];
        $finished = ($finished + 1) % 2;  // Swap between 0 and 1
        DB::update('tracks')
            ->where('id', $id)
            ->where('user_id', Sentry::user()->get('id'))
            ->value('finished', $finished)
            ->execute();
    }

    /**
     * Add a new anime.
     * @param  array anime information, element 'name' is needed.
     * @return array anime builded.
     **/
    public static function addAnime($data)
    {
        if (Arr::is_assoc($data)) {
            // Check if element 'name' is exist
            if (array_key_exists('name', $data)) {
                $data['user_id'] = Sentry::user()->get('id');
                $data['sub'] = Arr::get($data, 'sub', '');
                $data['volumn'] = Arr::get($data, 'volumn', '0');
                $data['download'] = Arr::get($data, 'download', '0');
                $data['link'] = Arr::get($data, 'link', '');
                $data['finished'] = Arr::get($data, 'finished', '0');
                $data['public'] = Arr::get($data, 'public', '0');

                list($id, $affectedRow) = DB::insert('tracks')
                    ->set($data)
                    ->execute();
                return Anime::getAnime($id);
            }
        }
    }

    public static function deleteAnime($id)
    {
        if ($id > 0) {
            $affected = DB::delete('tracks')
                ->where('user_id', Sentry::user()->get('id'))
                ->and_where('id', $id)
            ->execute();
            return $affected;
        }
    }
}
