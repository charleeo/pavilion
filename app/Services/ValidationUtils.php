<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

final class ValidationUtils {


    public function validationErrorResponse(ValidationException $exception, Request $request) {
        $errors = $this->formatErrorBlock($exception->validator);

        // package the response data
        $res = self::responseStructure("Validation not passed.", false, $errors);

        // return response
        return response()->json($res, Response::HTTP_OK);
    }

    /**
     * 
     * format and return validation messages
     */
    private function formatErrorBlock($validator)
    {
        // extract errors into array
        $errors = $validator->errors()->toArray();
        $errorResponse = [];

        // loop throtugh the errors and save them in array
        foreach ($errors as $field => $message) {
            $errorField = ['field' => $field];

            foreach ($message as $key => $msg) {
                if ($key) {
                    $errorField['message' . $key] = $msg;
                } else {
                    $errorField['message'] = $msg;
                }
            }

            $errorResponse[] = $errorField;
        }

        return $errorResponse;
    }


    public static function responseStructure(string $message, bool $status = true, $data = null) {
        return [
            'status' => $status,
            'response' => $data,
            'message' => $message,
        ];
    }
}