<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class BaseApiController extends Controller
{
        /**
     * Send the error response.
     *
     * @param  string|\Exception $message
     * @param  int $httpCode
     * @return \Illuminate\Http\Response|JsonResponse
     */
    protected function error($message, $httpCode = 500, $isValidationMessage = false)
    {
        logger($message);
        if(config('app.debug') || $isValidationMessage) {
            if ($message instanceof \Exception || $message instanceof \InvalidArgumentException) {
                $message = $message->getMessage();
            }
        } else {
            $message = 'Something error with your request. Please contact your administrator';
        }

        return response()->json(
            $this->generateMessage('Error', $message),
            $httpCode
        );
    }

    /**
     * Send the not found response.
     *
     * @return \Illuminate\Http\Response|JsonResponse
     */
    protected function notFound()
    {
        return response()->json(
            $this->generateMessage('Error', 'Not Found'), 404
        );
    }

    /**
     * Send the success response.
     *
     * @param  mixed|null $message
     * @param  integer $httpCode
     * @return \Illuminate\Http\Response|JsonResponse
     */
    protected function success($message = null, $httpCode = 200)
    {
        if (null == $message) {
            return response()->json(
                $this->generateMessage('Ok', 'Success'),
                $httpCode
            );
        }

        if (is_string($message)) {
            return response()->json(
                $this->generateMessage('Ok', $message),
                $httpCode
            );
        }

        if (is_array($message)) {
            $m = [
                'status' => 'Ok',
                'message' => 'Success',
            ];

            $message = array_merge($m, isset($message['data']) ? $message : ['data' => $message]);

            return response()->json(
                $message,
                $httpCode
            );
        }
    }

    /**
     * Generate response message.
     *
     * @param  string $status
     * @param  mixed $message
     * @return array
     */
    private function generateMessage($status, $message)
    {
        return [
            'status' => $status,
            'message' => $message,
        ];
    }

    protected function getUserActive()
    {
        return auth('api')->user();
    }

}
