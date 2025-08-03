<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ViewLimitMiddleware {
    public function handle(Request $request, Closure $next): Response {
        $user = Auth::user();

        if ($user && $user->isSubscribed()) {
            $membership = $user->membership;
            if ($membership && $membership->hasExceededProfileViewLimit()) {
                if ($request->ajax()) {
                    return response()->json([
                        'status'  => 'error',
                        'title'   => 'Profile View Limit Exceeded',
                        'message' => 'You have exceeded your profile view limit. You need to purchase another subscription to view more profiles.',
                    ]);
                } else {
                    session()->flash('sweet_alert', [
                        'type'    => 'error',
                        'title'   => 'Profile View Limit Exceeded',
                        'message' => 'You have exceeded your profile view limit. You need to purchase another subscription to view more profiles.',
                    ]);
                    return redirect()->back();
                }
            }

            // if ($membership) {
            //     $membership->incrementProfileViewsUsed();
            // }
        }
        return $next($request);
    }
}
