<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('user')) {
            if ($request->expectsJson()) {
                return response()->json([
                    'code'    => 401,
                    'message' => 'Vui lòng đăng nhập để tiếp tục!',
                ], 401);
            }

            return redirect('/dang-nhap')
                ->with('error', 'Vui lòng đăng nhập để tiếp tục!');
        }

        return $next($request);
    }
}
