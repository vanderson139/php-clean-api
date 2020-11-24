<?php declare(strict_types = 1);

namespace Api\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $content = '<h1>Hello World</h1>';
        $content .= 'Hello ' . $this->request->getParameter('name', 'stranger');
        $this->response->setContent($content);
    }
}