<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = session('user');

        if (!$user) {
            return redirect('/dang-nhap')
                ->with('error', 'Vui lòng đăng nhập để tiếp tục!');
        }

        if ($user->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập trang này!');
        }

        return $next($request);
    }
}
