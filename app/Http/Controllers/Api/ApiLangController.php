<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

/**
 * Class ApiLangController
 * @package App\Http\Controllers\Api
 */
class ApiLangController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['data' => trans('data')]);
    }
}
