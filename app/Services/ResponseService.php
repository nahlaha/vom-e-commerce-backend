<?php


namespace App\Services;

use App\Constants\Error;
use Illuminate\Http\JsonResponse;

/**
 * Class ResponseService
 * @package App\Services
 */
final class ResponseService
{

    /**
     * Gets a response object with the data returned to clients
     *
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSuccessResponse($data = ""): JsonResponse
    {
        $result = array('data' => $data);
        return response()->json($result);
    }

    /**
     * Gets a response object for any error that occurs through out the application
     *
     * @param int $errorCode
     * @param array $validationErrors
     * @return \Illuminate\Http\JsonResponse
     */
    public function getErrorResponse(int $errorCode, $validationErrors = array()): JsonResponse
    {
        $error = Error::from($errorCode);
        $result = array('error' => array('code' => $error->value, 'message' => $error->getErrorMessage()));
        if (count($validationErrors) > 0) {
            $result['validation'] = $validationErrors;
        }
        return response()->json($result, $error->getHttpCode());
    }
}
