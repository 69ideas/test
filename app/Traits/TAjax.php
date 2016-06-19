<?php

namespace App\Traits;

use Illuminate\View\View;

trait TAjax
{
    public function ajax_response( $data, $status = 'success', $code = 0)
    {
        $response = [
            'status'=>$status,
            'error_code'=>$code,
        ];

        if(is_string($data))
            $data = ['content' => $data];

        if($data instanceof View)
            $data = ['content' => $data->render()];

        if(is_object($data))
            $data = ['content' => $data->__toString()];

        if(is_array($data))
            $response = array_merge($response, $data);
        else
            throw new \Exception("Неизвестный тип данных");

        return $response;
    }
}