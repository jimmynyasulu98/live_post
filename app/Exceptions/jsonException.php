<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class jsonException extends Exception
{
    /**
     * report and exception (Log error to file or send to an email)
     * @return void
     */
    public function report()
    {

    }
    /**
     * Render http response for the exception
     * @param Request $request
     * 
     */
    public function render($request)
    {
        return new JsonResponse([
            'errors' => [
                'message' => $this->getMessage(), 
            ]
            ], $this->code);

    }


}
