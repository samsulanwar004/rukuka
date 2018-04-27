<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Exception;

class BaseController extends Controller
{  

    protected function getUserActive()
    {
        if (session()->has('as.guest')) {
            $email = session()->get('as.guest')['email'];

            $user = (new \App\Repositories\UserRepository)->getUserByEmail($email);
            return $user ? $user : session()->forget('as.guest');
        }
        
    	return auth('web')->user();
    }

    /**
     * Validate the user request input data.
     *
     * @param  Request $request
     * @return \Illuminate\Validation\Validator
     */
    protected function validRequest(Request $request, $rules)
    {
        return Validator::make($request->all(), $rules);
    }

    protected function validDelete($value)
    {
        if($value->deleted_at != null)
        {
            throw new Exception("Page Not Found", 1);
        }
    }

    protected function validActive($value)
    {
        if($value->is_active == 0)
        {
            throw new Exception("Page Not Found", 1);
        }
    }

    protected function isCurlSupported() {
        if (in_array ('curl', get_loaded_extensions())) {
            return true;
        }
        else {
            return false;
        }
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

}
