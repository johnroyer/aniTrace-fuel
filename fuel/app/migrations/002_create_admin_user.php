<?php

namespace Fuel\Migrations;

class Create_Admin_User
{
	public function up()
	{
      $uid = \Sentry::user()->create( array(
         'username' => 'admin',
         'email' => 'admin@admin.com',
         'password' => 'admin',
      ));
      $gid = \Sentry::group()->create( array(
         'name' => 'admin',
         'level' => 100,
      ));
      \Sentry::user($uid)->add_to_group('admin');
	}

	public function down()
	{
      \Sentry::user('admin')->remove_from_group('admin');
      \Sentry::group('admin')->delete();
      \Sentry::user('admin')->delete();
	}
}
