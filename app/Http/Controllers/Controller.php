<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get the config value from the phantom config
     *
     * @param      string  $key    The key
     *
     * @return     string  The value of the key
     */
    public function __get($key)
    {
    	$searchKey = str_replace("_", ".", $key);

    	if (!is_null(config("phantom.{$searchKey}"))) {
    		return config("phantom.{$searchKey}");
    	}
    }
}
