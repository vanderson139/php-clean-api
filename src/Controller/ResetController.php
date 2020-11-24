<?php declare(strict_types = 1);

namespace Api\Controller;

use Api\Factory\ResetFactory;

class ResetController extends BaseController
{
    public function index()
    {
        ResetFactory::dropDatabase()->handle();
        $this->response->setStatusCode(200, 'OK');
        $this->response->setContent('OK');
    }
}