<?php

namespace Fuel\Migrations;

class Create_ani_lists
{
	public function up()
	{
		\DBUtil::create_table('ani_lists', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'id' => array('constraint' => 11, 'type' => 'int'),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'name' => array('constraint' => 200, 'type' => 'varchar'),
			'sub' => array('constraint' => 100, 'type' => 'varchar'),
			'volumn' => array('constraint' => 11, 'type' => 'int'),
			'download' => array('constraint' => 11, 'type' => 'int'),
			'link' => array('constraint' => 10240, 'type' => 'varchar'),
			'finished' => array('constraint' => 1, 'type' => 'int'),
			'public' => array('constraint' => 1, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('ani_lists');
	}
}