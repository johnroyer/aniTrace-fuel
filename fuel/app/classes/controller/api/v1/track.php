<?php

use \Model\Anime;
use \Model\Track;

class controller_api_v1_track extends ApiJson
{
    /**
     * Get specific track
     *
     * @param int $id track ID
     */
    public function get_track($id)
    {
        if ($id == 'all') {
            // TODO: do not use this model any more
            return $this->response(Anime::getList('watchable'));
        } else {
            $id = intval($id);
            $anime = Model_Track::find($id);

            if ($anime === null) {
                return $this->response('track not found', 404);
            } else {
                return $this->response($anime->to_array());
            }
        }
    }

    /**
     * Update track infomation
     *
     * @param int $id track ID
     */
    public function put_track($id)
    {
    }

    /**
     * Create new track
     */
    public function post_track()
    {
    }

    /**
     * Delete a track
     *
     * @param int $id track ID
     */
    public function delete_track($id)
    {
    }
}
