<?php

/**
 * Methods depend on users. Such as login, register, etc.
 **/
class Controller_User extends Controller 
{
    /**
     * Check if user has loggedin.
     **/
    public function before()
    {
        if ( !Sentry::check() )
        {
            // User is not loggedin
            Response::redirect( Uri::create('auth/') );
        }
    }

    /**
     * Show user informations.
     **/
    public function action_index()
    {
        $view = View::forge('user/home');
        $data = array(
            'page_title' => '帳號資訊',
            'loggedin' => true,
            'user' => $this->getUserInfo(),
        );
        $view->set_global($data);
        return $view;
    }

    /**
     * Change password
     **/
    public function action_chpassword()
    {
        if( Input::post('password', '') == '' )
        {
            $view = View::forge('user/chpassword');
            $data = array(
                'page_title' => '修改密碼',
                'loggedin' => true,
                'user' => $this->getUserInfo(),
            );
            $view->set_global($data);
            return $view;
        }
        else
        {
            // Validate password
            if( Input::post('password', '') == Input::post('passwordConfirm', '') )
            {
                try
                {
                    if( Sentry::user()->change_password(Input::post('password', ''), Input::post('origPassword', '')) )
                    {
                        // Success
                        $data = array(
                            'page_title' => '修改密碼',
                            'loggedin' => true,
                            'user' => $this->getUserInfo(),
                            'dialog' => array(
                                'type' => 'success',
                                'title' => '密碼修改成功',
                                'text' => '密碼修改完成。',
                                'next' => Uri::create('user/chpassword'),
                                'next_hint' => '繼續',
                            ),
                        );
                        $view = View::forge('dialog');
                        $view->set_global($data);
                        return $view;
                    }
                    else
                    {
                        // Failed
                        $data = array(
                            'page_title' => '修改密碼',
                            'loggedin' => true,
                            'user' => $this->getUserInfo(),
                            'dialog' => array(
                                'type' => 'error',
                                'title' => '密碼修改失敗',
                                'text' => '請檢查輸入的資料並再試一次。',
                                'next' => Uri::create('user/chpassword'),
                                'next_hint' => '重試',
                            ),
                        );
                        $view = View::forge('dialog');
                        $view->set_global($data);
                        return $view;
                    }
                }
                catch( SentryUserException $e )
                {
                        $data = array(
                            'page_title' => '修改密碼',
                            'loggedin' => true,
                            'user' => $this->getUserInfo(),
                            'dialog' => array(
                                'type' => 'warning',
                                'title' => '密碼修改失敗',
                                'text' => '原有密碼錯誤，請再試一次。',
                                'next' => Uri::create('user/chpassword'),
                                'next_hint' => '重試',
                            ),
                        );
                        $view = View::forge('dialog');
                        $view->set_global($data);
                        return $view;
                }
            }
            else
            {
                // Password confirm error
                $data = array(
                    'page_title' => '修改密碼',
                    'loggedin' => true,
                    'user' => $this->getUserInfo(),
                    'dialog' => array(
                        'type' => 'warning',
                        'title' => '密碼不符',
                        'text' => '二次所輸入的密碼並不相同',
                        'next' => Uri::create('user/chpassword'),
                        'next_hint' => '重試',
                    ),
                );
                $view = View::forge('dialog');
                $view->set_global($data);
                return $view;
            }
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
