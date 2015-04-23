<?php

namespace Fuel\Migrations;

class Add_delete_at_tracks
{
	public function up()
	{
		\DBUtil::add_fields('tracks', array(
			'delete_at' => array('constraint' => 12, 'type' => 'int', 'null' => true),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('tracks', array(
			'delete_at'

		));
	}
}