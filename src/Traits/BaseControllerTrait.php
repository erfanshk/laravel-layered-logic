<?php

namespace Erfanshk\LaravelLayeredLogic\Traits;


use Erfanshk\LaravelLayeredLogic\Helpers\HttpResponses;
use Illuminate\Http\JsonResponse;

trait BaseControllerTrait
{

    private array $responseArray;
    private int $statusCode;


    public function setMessage(string $string): self
    {
        $this->responseArray['message'] = $string;
        return $this;
    }

    public function setResponseArray(array $array): self
    {
        foreach ($array as $key => $item) {
            $this->responseArray[$key] = $item;
        }
        return $this;
    }

    public function setStatus(int $statusCode): self
    {
        if ($statusCode < 300 && $statusCode >= 200) {
            $this->responseArray['status'] = true;
        } else {
            $this->responseArray['status'] = false;
        }
        $this->statusCode = $statusCode;
        return $this;
    }

    public function respond(): JsonResponse
    {
        if (empty($this->statusCode)) {
            $this->setStatus(HttpResponses::OK);
        }
        return response()->json($this->responseArray, $this->statusCode);
    }

    public function respondException(\Exception $exception): JsonResponse
    {
        return $this
            ->setMessage($exception->getMessage())
            ->setStatus(HttpResponses::BAD_REQUEST)
            ->respond();
    }
}
