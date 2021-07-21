<?php
class View {
	/**
	 * If the route is valid create the view and the view controller.
	 * If the route is invalid do nothing and if something goes wrong
	 * checking the route return 0;
	 */
	public static function make( $view ) {

		if ( Route::isRouteValid() ) {
			// Create the view and the view controller.
			require_once './controllers/' . $view . '.php';
			require_once './views/' . $view . '.php';
			return 1;
		}

	}

}
