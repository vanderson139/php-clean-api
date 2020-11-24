<?php declare(strict_types = 1);

namespace Api\Controllers;

use Http\Request;
use Http\Response;

class BaseController
{
    protected $request;
    protected $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}