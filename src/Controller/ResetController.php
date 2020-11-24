<?php declare(strict_types = 1);

namespace Api\Controller;

use Api\Factory\GuestFactory;

class ResetController extends BaseController
{
    public function drop()
    {
        GuestFactory::dropDatabase()->handle();
        $this->response->setStatusCode(200);
        $this->response->setContent('OK');
    }
}