<?php


namespace App\Services;


/**
 * Class ResponseService
 * @package App\Services
 */
class ResponseService
{
    /**
     * @return \Illuminate\Http\Response
     */
    public static function noContent(): \Illuminate\Http\Response
    {
        return response()->noContent();
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public static function notFound(): \Illuminate\Http\Response
    {
        return response()->noContent(404);
    }

    public static function jsonResponse($data, $statusCode)
    {
        return response()->json(
            [
                "response" => $data
            ],
            $statusCode
        );
    }
}
