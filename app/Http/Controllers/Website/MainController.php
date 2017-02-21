<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\Website;
use Request;
use View;

/**
 * Class    MainController
 * @package    App\Http\Controllers\Website
 */
class MainController extends Controller
{
	/**
	 * Gets the page content.
	 *
	 * @param      string  $route  The route
	 *
	 * @return     404 | View  The page content.
	 */
	public function getPageContent($route = "/")
	{
		$content = Website::with(['pages' => function($query) use ($route) {
			return $query->with('content')->where('slug', '=', $route);
		}])->where('name', '=', 'phantom-edit.app')->first();

		if (is_null($content)) {
			abort(404);
		}

		return View::make($this->theme_folder.$content->pages->first()->view_file)
			->withPageContent($content->pages->first());
	}
}
