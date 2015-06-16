<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		$liensDeplacer = Page::getMenuLinks(1);
		$liensInfosPratiques = Page::getMenuLinks(2);
		
		View::share('liensSeDeplacer', $liensDeplacer);
		View::share('liensInfosPratiques', $liensInfosPratiques);
		
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
