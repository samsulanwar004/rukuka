<?php

namespace App\Repositories;

use App\Order;
use DB;
use App\Setting;

class PaymentRepository
{
    public function createResponsePayment($responseObject,$order_code)
    {
        $response =  json_encode($responseObject);
        $response_cc = $responseObject;

        DB::table('response_payments')->insert(
                    [
                        'order_code'    => $order_code,
                        'response_json' => $response, 
                        'created_at'    => date("Y-m-d H:i:s"),
                        'updated_at'    => date("Y-m-d H:i:s")
                    ]
                );
    }

    public function updateOrder($data)
    {
        $order = (new OrderRepository)->getOrderbyOrderCode($data["order"]["order_code"]);
                    $order->payment_status = 1;
                    $order->payment_name = $data["order"]["card_holder"];
                    $order->pending_reason = 'already paid';
                    $order->update();

        return $order;
    }

    
}