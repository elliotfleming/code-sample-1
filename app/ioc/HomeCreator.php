<?php

/**
 * Be sure to enable the $ee singleton in the 'Before' filter
 * before using this creator
 */
class HomeCreator
{
	public function compose($view)
	{
		$ee = App::make('ee');
		if ($ee->loggedIn)
		{
			$view->with('user', $ee->user);
		}
	}
}
