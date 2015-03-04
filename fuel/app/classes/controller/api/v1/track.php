<?php

use \Model\Anime;
use \Model\Track;

class Controller_Api_V1_Track extends ApiJson {
   public function get_track($id, $tmp = null){
      if($id == 'all'){
      return $this->response(Anime::getList('watchable'));
      }else{
         $id = intval($id);
         $anime = Model_Track::find($id);

         if($anime === null){
            return $this->response('track not found', 404);
         }else{
            return $this->response($anime->to_array());
         }
      }
   }
}