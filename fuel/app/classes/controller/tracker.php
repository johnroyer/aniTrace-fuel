<?php
/**
 * Methods for anime.
 **/
class controller_tracker extends Controller
{
    /**
     * Construtor for Anime
     **/
    public function before()
    {
        if (!Sentry::check()) {
            Response::redirect(Uri::create('auth/'));
        }
    }

    /**
     * Show anime list belong to user
     **/
    public function action_index()
    {
        $view = View::forge('tracker/watchable');
        $data = array(
            'page_title' => '動漫清單',
            'loggedin' => true,
            'user' => $this->getUserInfo(),
        );
        $view->set_global($data);
        return $view;
    }

    /**
     * Show anime list for download
     **/
    public function action_download()
    {
        $view = View::forge('tracker/download');
        $data = array(
            'page_title' => '動漫清單',
            'loggedin' => true,
            'user' => $this->getUserInfo(),
        );
        $view->set_global($data);
        return $view;
    }

    /**
     * Return user information needed in views.
     **/
    private function getUserInfo()
    {
        $user = Sentry::user();
        $result = array(
            'username' => $user->get('username'),
            'isAdmin' => $user->in_group('admin'),
        );
        return $result;
    }
}
