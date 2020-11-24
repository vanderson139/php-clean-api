<?php declare(strict_types = 1);

namespace Api\Controllers;

class ResetController extends BaseController
{
    public function index()
    {
        $content = 'OK';
        $this->response->setContent($content);
    }
}