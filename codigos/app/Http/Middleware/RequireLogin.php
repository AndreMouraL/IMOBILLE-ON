<?php
namespace App\Http\Middleware;


use \Exception;
use \App\Model\User;

class RequireLogin {
    public function handle($request, $next) {
        $user = new User();
        if (!$user->isLogged()) {
            $request->getRouter()->redirect("/");
        }

        return $next($request);
    }
}