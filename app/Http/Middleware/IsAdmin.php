<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class BasicAuth
 * @package App\Http\Middleware
 */
class IsAdmin
{
    /**
     * @param $request
     * @param Closure $next
     * @return JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        if (!isAdmin()) {
            return response()->json([
                'errors' => trans('data.warning.unauthorized')
            ], 403);
        }

        return $next($request);
    }
}
