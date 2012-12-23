<?php
/**
 * Ajax Controller for admin panel.
 **/
class Controller_Admin_Ajax extends Controller
{
	/**
	 * Search user by keyword.
	 * @param  string  keyword to Search
	 * @return json    search result in json
	 **/
	public function action_searchUser($key='')
	{
		return 'search';
	}
}
