<?php

namespace Fuel\Migrations;

class Create_anime_lists
{
	public function up()
	{
		\DBUtil::create_table('anime_lists', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'name' => array('constraint' => 200, 'type' => 'varchar'),
			'sub' => array('constraint' => 100, 'type' => 'varchar', 'null' => true),
			'volumn' => array('constraint' => 11, 'type' => 'int'),
			'download' => array('constraint' => 11, 'type' => 'int'),
			'link' => array('constraint' => 10240, 'type' => 'varchar', 'null' => true),
			'finished' => array('constraint' => 1, 'type' => 'int'),
			'public' => array('constraint' => 1, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('anime_lists');
	}
}
