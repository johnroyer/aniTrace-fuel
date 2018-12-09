<?php
return array(
	'version' => 
	array(
		'app' => 
		array(
			'default' => 
			array(
				0 => '001_create_anime_lists',
				1 => '002_create_admin_user',
				2 => '003_add_updated_to_anime_lists',
				3 => '004_rename_table_anime_lists_to_tracks',
				4 => '005_add_delete_at_tracks',
				5 => '006_rename_field_updated_to_update_at_in_tracks',
			),
		),
		'module' => 
		array(
		),
		'package' => 
		array(
			'sentry' => 
			array(
				0 => '001_install_sentry_auth',
				1 => '002_add_group_parent_column',
			),
		),
	),
	'folder' => 'migrations/',
	'table' => 'migration',
);
