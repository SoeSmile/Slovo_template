<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

/**
 * Class ApiOrderController
 * @package App\Http\Controllers\Api
 */
class ApiOrderController
{
    /**
     * получение типов и вариантов исполнения для заказа
     *
     * @return JsonResponse
     */
    public function getTypeAndExecution(): JsonResponse
    {
        return response()->json([
            'types'      => config('slovo.orderType'),
            'executions' => config('slovo.orderExecution'),
        ]);
    }
}
