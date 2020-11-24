<?php declare(strict_types = 1);

namespace Api\Controller;

use Http\Request;
use Http\Response;
use League\Fractal\Manager;

abstract class AbstractController
{
    protected $request;
    protected $response;
    protected $fractal;

    public function __construct(Request $request, Response $response, Manager $fractal)
    {
        $this->request = $request;
        $this->response = $response;
        $this->fractal = $fractal;
    }

    protected function getPostData()
    {
        return json_decode($this->request->getRawBody());
    }
}