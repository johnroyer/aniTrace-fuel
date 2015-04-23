<?php

namespace Fuel\Migrations;

class Rename_field_updated_to_update_at_in_tracks
{
	public function up()
	{
		\DBUtil::modify_fields('tracks', array(
			'updated' => array('name' => 'update_at', 'type' => 'int', 'constraint' => 11)
		));
	}

	public function down()
	{
	\DBUtil::modify_fields('tracks', array(
			'update_at' => array('name' => 'updated', 'type' => 'int', 'constraint' => 11)
		));
	}
}