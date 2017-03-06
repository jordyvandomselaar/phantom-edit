<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;

/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 * @author Wouter van Marrum <w.vanmarrum@texemus.com>
 */
class AuthController extends Controller
{
    protected $auth;

    /**
     * AuthController constructor.
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     * @param JWTAuth $auth
     */
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    /**
     *
     * @author Wouter van Marrum <w.vanmarrum@texemus.com>
     *
     * @return string
     */
    public function register()
    {
        return "";
    }
}
