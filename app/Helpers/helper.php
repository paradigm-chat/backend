<?php


if (!function_exists('apiResponse')) {
    function apiResponse( $success, $errors_or_data = [], $code = 0 )
    {
        return response( [
            'success' => boolval( $success ),
            $success ? 'data' : 'errors' => $errors_or_data,
        ], $code ? $code : ( $success ? 200 : 422 ) );
    }
}

