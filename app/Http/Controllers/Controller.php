<?php

namespace App\Http\Controllers;

use View;
use App\Classes\Blade\PageMeta;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class Controller
 * @package App\Http\Controllers
 *
 * @author Wouter van Marrum <w.vanmarrum@texemus.com>
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Controller constructor.
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     */
    public function __construct()
    {
        View::share('meta', new PageMeta());
    }

    /**
     * Get the value for the config key.
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     * @param $key
     *
     * @return mixed
     */
    public function __get($key)
    {
    	$searchKey = str_replace("_", ".", $key);

    	if (!is_null(config("phantom.{$searchKey}"))) {
    		return config("phantom.{$searchKey}");
    	}
    }
}
