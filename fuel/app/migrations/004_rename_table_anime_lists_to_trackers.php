<?php

namespace Fuel\Migrations;

class Rename_table_anime_lists_to_trackers
{
	public function up()
	{
		\DBUtil::rename_table('anime_lists', 'trackers');
	}

	public function down()
	{
		\DBUtil::rename_table('trackers', 'anime_lists');
	}
}