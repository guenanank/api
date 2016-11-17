<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) :
            try {
                $username = Crypt::decrypt($request->input('token'));
                if(collect(\App\Models\Gateway\Employee::findOrFail($username))->isEmpty()) :
                    return response(['stat' => false, 'msg' => 'Not allowed']);
                endif;
            } catch (DecryptException $e) {
                return response(['stat' => false, 'msg' => 'Not authenticated']);
            }
        endif;

        return $next($request);
        
//        if ($this->auth->guard($guard)->guest()) {
//            return response('Unauthorized.', 401);
//        }
//
//        return $next($request);
    }
}
