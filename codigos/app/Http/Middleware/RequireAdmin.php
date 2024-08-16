<?php
namespace App\Http\Middleware;


use \Exception;
use \App\Model\User;

class RequireAdmin {
    public function handle($request, $next) {
        $user = new User();
        if (!$user->isAdmin()) {
            $request->getRouter()->redirect("/home");
        }

        return $next($request);
    }
}