<?php

namespace Fuel\Migrations;

class Rename_table_anime_lists_to_tracks
{
	public function up()
	{
		\DBUtil::rename_table('anime_lists', 'tracks');
	}

	public function down()
	{
		\DBUtil::rename_table('tracks', 'anime_lists');
	}
}