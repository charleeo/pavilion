<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class BadRequest extends Exception
{
   
     /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
       
    }

     /** 
    * Render the exception into an HTTP response. 
    * 
    * @param \Illuminate\Http\Request 
    * @return \Illuminate\Http\Response 
    */
    public function render($request, UnprocessableEntityHttpException $ex)
    {
        if($ex instanceof UnprocessableEntityHttpException) {
            return response()->json([
                "message" => "Bad request",
                "data" => null,
                "error" => $ex,
                "status" => false
            ],Response::HTTP_BAD_REQUEST);
        } 
    }

}
