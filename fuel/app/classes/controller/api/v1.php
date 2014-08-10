<?php

class Controller_Api_V1 extends ApiJson {
   public function get_track(){
      return array('hello' => 'world');
   }
}