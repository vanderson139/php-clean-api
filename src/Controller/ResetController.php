<?php declare(strict_types = 1);

namespace Api\Controller;

use Api\Enum\HttpResponse;
use Api\Factory\GuestFactory;

class ResetController extends AbstractController
{
    public function drop()
    {
        GuestFactory::dropDatabase()->handle();
        $this->response->setStatusCode(HttpResponse::OK);
        $this->response->setContent('OK');
    }
}