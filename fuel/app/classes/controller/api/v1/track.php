<?php
use \Model\Anime;
use \Model\Track;

class controller_api_v1_track extends ApiJson
{
	/**
	 * Valid keys from POST data
	 */
	private $validField = array(
		'name',
		'sub',
		'volumn',
		'download',
		'link',
		'finished',
		'public',
	);

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
        }

		$id = intval($id);
		$anime = Model_Track::find($id);

		if ($anime === null) {
			return $this->response('track not found', 404);
		}

		if (Sentry::user()->get('id') !== $anime->user_id) {
			return $this->response('track not found', 404);
		}

		return $this->response($anime->to_array());
    }

    /**
     * Update track infomation
     *
     * @param int $id track ID
     */
    public function put_track($id)
    {
		$id = intval($id);
		$anime = Model_Track::find($id);

		if ($anime === null) {
			return $this->response('track not found', 404);
		}

		if (Sentry::user()->get('id') !== $anime->user_id) {
			return $this->response('track not found', 404);
		}

		$anime->name = Input::('name', '');
		$anime->sub = Input::('sub', '');
		$anime->volumn = intval(Input::('volumn', 0));
		$anime->download = intval(Input::('download', 0));
		$anime->link = Input::('link', '');
		$anime->finished = $this->getBoolInt(Input::put('finished'), 0);
		$anime->public = $this->getBoolInt(Input::put('public'), 0);
		$anime->save();

		return $this->response();
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
        $id = intval($id);
        $anime = Model_Track::find($id);

        if (null === $anime) {
            return $this->response('track not found', 404);
        }

        if (Sentry::user()->get('id') !== $anime->id) {
            return $this->response('track not found', 404);
        }

        try {
            $anime->delete();
            return $this->response();
        } catch (Exception $e) {
            return $this->response('failed to delete track', 500);
        }
    }

	/**
	 * Return 0 or 1 value from input
	 *
	 * @param mixed $val input value
	 * @param int $default default value to return if value can not be recognized
	 * @return int 0 or 1
	 */
	private function getBoolInt($val, $default)
	{
		if (0 !== $default || 1 !== $default) {
			return new Exception('default value is invalid');
		}

		$val = intval($val);
		if (0 === $val || 1 === $val) {
			return $val;
		}
		return $default;
	}
}
