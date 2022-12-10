<?php

namespace App\Http\Controllers;



trait ApiResponse

{
 public function apiresponse($data=null,$msg=null,$status)
 {
    $array=[
        'data'=>$data,
        'msg'=>$msg,
        'status'=>$status,


    ];
    return response( $array,$status);

 }



}