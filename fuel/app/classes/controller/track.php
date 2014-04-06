<?php

/**
 * Controller for loading anime tracking view.
 */
class Controller_Track extends Controller
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
      $view = View::forge('anime/watchable');
      $data = array(
         'page_title' => '追蹤清單',
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