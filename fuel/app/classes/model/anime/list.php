<?php

class Model_Anime_List extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'name',
		'sub',
		'volumn',
		'download',
		'link',
		'finished',
		'public',
		'updated',
	);

	protected static $_observers = array(
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
			'property' => 'updated',
		),
	);
	protected static $_table_name = 'anime_lists';

}
