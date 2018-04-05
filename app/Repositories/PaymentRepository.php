<?php

namespace App\Repositories;

use App\Order;
use DB;
use App\Setting;
use CRUDBooster;

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
        $message = 'already paid';
        $order = (new OrderRepository)->getOrderbyOrderCode($data["order"]["order_code"]);
                    $order->payment_status = 1;
                    $order->payment_name = $data["order"]["card_holder"];
                    $order->pending_reason = $message;
                    $order->update();

        //create notification
        $users = config('common.admin.users_id');
        $module = 'orders';
        $this->notificationforAdmin($users, $order->order_code.' '.$message, $module);

        return $order;
    }

    public function notificationforAdmin($users, $message, $module)
    {
        $config['content'] = $message;
        $config['to'] = CRUDBooster::adminPath($module);
        $config['id_cms_users'] = explode(',', $users); 
        CRUDBooster::sendNotification($config);
    }

    
}