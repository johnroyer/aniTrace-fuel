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
}