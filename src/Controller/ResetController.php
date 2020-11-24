<?php declare(strict_types = 1);

namespace Api\Controller;

class ResetController extends BaseController
{
    public function index()
    {
        $this->response->setContent('OK');
    }
}