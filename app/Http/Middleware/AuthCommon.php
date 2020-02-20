<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class AuthCommon
 * @package App\Http\Middleware
 */
class AuthCommon
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->hasHeader('X-common')) {
            $code   = 'c23050c2-45e5-41d3-8b84-e23d6e533ea8';
            $common = $request->header('X-common');

            return $code === $common ? $next($request) : $this->unauthorized();
        }


        return $this->unauthorized();
    }


    /**
     * @return JsonResponse
     */
    private function unauthorized(): JsonResponse
    {
        return response()->json([
            'errors' => trans('data.warning.unauthorized')
        ], 401);
    }
}
