<?php declare(strict_types = 1);

namespace Api\Controller;

class ResetController extends BaseController
{
    public function index()
    {
        $this->response->setStatusCode(200, 'OK');
        $this->response->setContent('OK');
    }
}