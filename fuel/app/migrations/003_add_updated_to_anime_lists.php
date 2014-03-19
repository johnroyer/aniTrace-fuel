<?php

namespace Fuel\Migrations;

class Add_updated_to_anime_lists
{
	public function up()
	{
		\DBUtil::add_fields('anime_lists', array(
			'updated' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('anime_lists', array(
			'updated'

		));
	}
}