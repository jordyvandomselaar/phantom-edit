<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Website\Website;
use Request;
use View;

/**
 * Class MainController
 * @package App\Http\Controllers\Website
 * @author Wouter van Marrum <w.vanmarrum@texemus.com>
 */
class MainController extends Controller
{
    /**
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     * @param string $route
     * @return mixed
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
