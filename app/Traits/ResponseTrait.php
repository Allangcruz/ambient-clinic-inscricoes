<?php

namespace App\Traits;

use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;

trait ResponseTrait
{
    public function responseNotFound(string $message): ResponseInterface
    {
        return response()
            ->setStatusCode(Response::HTTP_NOT_FOUND)
            ->setJSON(['message' => $message]);
    }

    public function responseSuccess(string $message): ResponseInterface
    {
        return response()
            ->setStatusCode(Response::HTTP_OK)
            ->setJSON(['message' => $message]);
    }

    public function responseCreated(string $message, ?string $pathResource = null): ResponseInterface
    {
        return response()
            ->setHeader('Location', $pathResource)
            ->setStatusCode(Response::HTTP_CREATED)
            ->setJSON(['message' => $message]);
    }

    public function responseNoContent(): ResponseInterface
    {
        return response()->setStatusCode(Response::HTTP_NO_CONTENT);
    }

    public function responseBadRequest(string $message): ResponseInterface
    {
        return response()
            ->setStatusCode(Response::HTTP_BAD_REQUEST)
            ->setJSON(['message' => $message]);
    }

    public function responseUnprocessableEntity($errors): ResponseInterface
    {
        return response()
            ->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->setJSON(['errors' => $errors]);
    }

    public function responseInternalServerError(string $message): ResponseInterface
    {
        return response()
            ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->setJSON(['message' => $message]);
    }
}