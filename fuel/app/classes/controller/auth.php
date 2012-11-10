<?php

/**
 * This controller used to make user authenication.
 */
class Controller_Auth extends Controller
{
   
   /**
    * Default page. Show login page and register form.
    */
   public function action_index()
   {
		$view = View::forge('user/home');
		$data = array(
			'header' => View::forge('header'),
			'navbar' => View::forge('navbar'),
			'page_title' => 'aniTrace',
			'loggedin' => false,
		);
		$view->set_global( $data );
		return $view;
   }
}
