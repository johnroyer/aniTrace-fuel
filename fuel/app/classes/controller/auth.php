<?php
/**
 * Authenication. For user login, register, logout, etc.
 **/
class Controller_Auth extends Controller
{
	/**
	 * Default page. Show login and register form.
	 **/
	public function action_index()
	{
		$view = View::forge('auth/home');
		$data = array(
			'header' => View::forge('header'),
			'navbar' => View::forge('navbar'),
			'page_title' => 'aniTrace',
			'loggedin' => false,
		);
		$view->set_global($data);
		return $view;
	}

	/**
	 * Identify user data and let user login.
	 **/
	public function action_login()
	{
      $username = Input::post('username');
      $password = Input::post('password');
      if( $username !== '')
      {
         try{
            $valid = Sentry::login($username, $password, false);
            if( $valid )
            {
               Response::redirect( Uri::create('ani/') );
            }
            else
            {
               $view = View::forge('alert');
               $data['page_title'] = '登入';
               $data['loggedin'] = false;
               $data['alert'] = array(
                  'type' => '',
                  'title' => '登入失敗',
                  'text' => '請檢查您輸入的帳號、密碼，再重試一次。',
                  'return' => Uri::create('auth/'),
               );
               $view->set_global($data);
               return $view;
            }
         }
         catch( SentryAuthException $e )
         {
            echo $e->getMessage();
         }
      }
      else
      {
         $view = View::forge('auth/home');
         $data = array(
            'header' => View::forge('header'),
            'navbar' => View::forge('navbar'),
            'page_title' => 'aniTrace',
            'loggedin' => false,
         );
         $view->set_global($data);
         return $view;
      }
	}

	/**
	 * User registration. Make sure user data is not conflict with exist
	 * data and add new user data into database.
	 **/
	public function action_register()
	{
	}

	/**
	 * Logout loggined user.
	 **/
	public function action_logout()
	{
      Sentry::logout();
      Response::redirect( Uri::base() );
	}

	/**
	 * Check if username is conflict.
	 **/
	public function action_check_username()
	{
	}

	/**
	 * Check if user's email is conflict.
	 **/
	public function action_check_email()
	{
	}
}
