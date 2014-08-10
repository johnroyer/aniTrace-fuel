<?php

use \Model\Anime;
use \Model\Anime_list;

class Controller_Api_V1 extends ApiJson {
   private function auth(){
      if(!Sentry::check()){
         Response::redirect(Uri::create('auth'));
      }
   }

   public function get_track(){
      $this->auth();

      $list = Anime::getList('watchable');
      //var_dump($list);
      //return $list;
      echo json_encode($list);
   }
}