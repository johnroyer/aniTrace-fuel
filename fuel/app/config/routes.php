<?php
return array(
	'_root_'  => 'home/index',  // The default route
	'_404_'   => 'home/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),

	// API controller routing
	'api/v1/(:alpha)/(:any)' => 'api/v1/$1/$1/$2',
);
