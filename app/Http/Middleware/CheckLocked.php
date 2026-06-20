<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLocked
{
    public function handle(Request $request, Closure $next): Response
    {
        $sessionUser = session('user');

        if ($sessionUser) {
            // Kiểm tra lại trạng thái mới nhất từ database
            $user = User::find($sessionUser->id);

            if (!$user || $user->is_locked) {
                session()->flush();
                return redirect('/dang-nhap')
                    ->with('error', 'Tài khoản của bạn đã bị khóa!');
            }
        }

        return $next($request);
    }
}
