<?php
/**
 * Admin panel home page.
 **/
class Controller_Admin extends Controller
{
	/**
	 * Check permission.
	 **/
	public function before()
	{
		if(!Sentry::check())
		{
			Response::redirect(Uri::create('auth/'));
		}
		else
		{
			if(!Sentry::user()->in_group('admin'))
			{
				Response::redirect(Uri::create('anime/'));
			}
		}
	}

	/**
	 * Default action.
	 **/
	public function action_index()
	{
		Response::redirect(Uri::create('admin/userList'));
	}

	/**
	 * List users.
	 * @param string 'admin' for admin, empty for general list
	 **/
	public function action_userList($type='')
	{
		$view = View::forge('admin/list');
		$data = array(
			'page_title' => '使用者管理',
			'loggedin' => true,
			'user' => $this->getUserInfo(),
		);
		if( $type == 'admin' )
		{
			$data['users'] = Sentry::group('admin')->users();
			$data['tab_general'] = '';
			$data['tab_admin'] = 'active';
		}
		else
		{
			$data['users'] = Sentry::user()->all();
			$data['tab_general'] = 'active';
			$data['tab_admin'] = '';
		}
		$view->set_global($data);
		return $view;
	}

	/**
		* Delete selected user.
		* @param  int    user ID
		* @param  string 'confirmed' if confirm to delete
	 **/
	public function action_deleteUser($id=-1, $confirm='')
	{
		if( $id == -1 )
		{
			Response::redirect(Uri::create('admin/userList'));
		}
		else
		{
			// Check if ID is himself
			if( $id == Sentry::user()->get('id') )
			{
				// Can not delete himself
				$data = array(
					'page_title' => '刪除帳號',
					'loggedin' => true,
					'type' => 'warning',
					'user' => $this->getUserInfo(),
					'dialog' => array(
						'title' => '警告',
						'text' => '無法刪除自己的帳號',
						'next' => Uri::create('admin/userList'),
						'next_hint' => '返回',
					),
				);
				$view = View::forge('dialog');
				$view->set_global($data);
				return $view;
			}
			else
			{
				if( $confirm == 'confirmed' )
				{
					// Delete user data

					// Delete account
				}
				else
				{
					// Show confirm dialog
					$view = View::forge('admin/delete_confirm');
					$data = array(
						'page_title' => '刪除帳號',
						'loggedin' => true,
						'type' => 'warning',
						'user' => $this->getUserInfo(),
						'target' => array(
								'id' => '',
								'username' => '',
								'email' => '',
							),
					);
					$view->set_global($data);
					return $view;
				}
			}
		}
	}

	/**
	 * Get user data.
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
