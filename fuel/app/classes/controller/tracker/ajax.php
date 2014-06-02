<?php
use \Model\Anime;
use \Model\Anime_List;

/**
 * Methods for Ajax request in animtion page.
 **/
class Controller_Tracker_Ajax extends Controller
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
    * Default method. Return all availible animes which is not finished user.
    **/
   public function action_index()
   {
      return json_encode(Anime::getList('download'));
   }

   /**
    * Return all watchable animes.
    **/
   public function action_watchableList()
   {
      return json_encode(Anime::getList('watchable'));
   }

   /**
    * Return anime information.
    * @param  int   anime ID
    * @return json  anime information, empty array if not found
    **/
   public function action_anime($id=0)
   {
      $id = intval($id);
      $anime = Model_Anime_List::find($id);

      if($anime == null){
         return new Response($stat, 404);  // not found
      }
      return json_encode($anime->to_array());
   }

   /**
    * Add or subtract anime volumn.
    * @param  string  'up' or 'down'
    * @param  int     anime ID
    * @return json    anime information after update
    **/
   public function action_vol($action, $id=0)
   {
      $id = intval($id);
      $anime = Model_Anime_List::find($id);

      if($anime === null){
         $stat = json_encode(array('stat' => 'item not found'));
         return new Response($stat, 404);  // not found
      }

      // Can only delete self's list
      if($anime->user_id !== Sentry::user()->get('id')){
         $stat = json_encode(array('stat' => 'access denied'));
         return new Response($stat, 406);  // not accessable
      }

      if($action == 'up'){
         $anime->volumn++;
         $anime->save();
         return json_encode(Anime::getAnime($id));
      }else{
         $anime->volumn--;
         $anime->save();
         return json_encode(Anime::getAnime($id));
      }
   }

   /**
    * Add or subtract anime download progress.
    * @param  string  'up' or 'down'
    * @param  int     anime ID
    * @return json    anime information after update
    **/
   public function action_download($action, $id=0)
   {
      $id = intval($id);
      $anime = Model_Anime_List::find($id);

      if($anime === null){
         $stat = json_encode(array('stat' => 'item not found'));
         return new Response($stat, 404);  // not found
      }

      // Can only delete self's list
      if($anime->user_id !== Sentry::user()->get('id')){
         $stat = json_encode(array('stat' => 'access denied'));
         return new Response($stat, 406);  // not accessable
      }

      if($action == 'up'){
         $anime->download++;
         $anime->save();
         return json_encode(Anime::getAnime($id));
      }else{
         $anime->download--;
         $anime->save();
         return json_encode(Anime::getAnime($id));
      }
   }

   /**
    * Set if anime has finished.
    * @param  int   anime ID
    * @return jsosn anime information
    **/
   public function action_finished($id=0)
   {
      $id = intval($id);
      $anime = Model_Anime_List::find($id);

      if($anime === null){
         $stat = json_encode(array('stat' => 'item not found'));
         return new Response($stat, 404);  // not found
      }

      // Can only delete self's list
      if($anime->user_id !== Sentry::user()->get('id')){
         $stat = json_encode(array('stat' => 'access denied'));
         return new Response($stat, 406);  // not accessable
      }

      // swap between 0 and 1
      $anime->finished = ($anime->finished + 1) % 2;
      $anime->save();
      return json_encode(Anime::getAnime($id));
   }

   /**
    * Add a new anime.
    * @return  json  anime information which has been inserted
    **/
   public function action_add()
   {
      $validate = Validation::forge();
      $validate->add_field('name', 'anime name', 'required');
      $validate->add_field('link', 'external link', 'max_length[10240]');
      if( $validate->run() ){
         $anime = new Model_Anime_List();
         $anime->user_id = Sentry::user()->get('id');
         $anime->name = Input::post('name');
         $anime->sub = Input::post('sub', '');
         $anime->save();
         return json_encode($anime->to_array());
      }else{
         echo json_encode(array('stat'=>'input error'));
      }
   }

   /**
    * Modify anime information
    * @return  json  anime information after update
    **/
   public function action_mod()
   {
      $id = intval(Input::post('id', 0));
      $anime = Model_Anime_List::find($id);

      if($anime === null){
         $stat = json_encode(array('stat' => 'item not found'));
         return new Response($stat, 404);  // not found
      }

      // Can only delete self's list
      if($anime->user_id !== Sentry::user()->get('id')){
         $stat = json_encode(array('stat' => 'access denied'));
         return new Response($stat, 406);  // not accessable
      }

      $anime->name = Input::post('name', '');
      $anime->sub = Input::post('sub', '');
      $anime->volumn = intval(Input::post('vol', 0));
      $anime->download = intval(Input::post('buy', 0));
      $anime->link = Input::post('link', '');
      $anime->save();
      return json_encode($anime->to_array());
   }

   public function action_delete($id=0) {
      $id = intval($id);
      $user = $this->getUserInfo();
      $anime = Model_Anime_List::find($id);

      // find item
      if($anime === null){
         return json_encode(array('stat' => 'error'));
      }

      // Can only delete self's list
      if($anime->user_id !== Sentry::user()->get('id')){
         return json_encode(array('stat' => 'error'));
      }

      // delete it
      try{
         $anime->delete();
         return json_encode(array('stat'=>'ok'));
      }catch(Exception $e){
         return json_encode(array('stat' => 'error'));
      }
   }

   /**
    * Return user information needed in views.
    **/
   private function getUserInfo()
   {
      $user = Sentry::user();
      $result = array(
         'username' => $user->get('username'),
         'isAdmin' => true,
      );
      return $result;
   }
}
