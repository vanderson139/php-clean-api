<?php declare(strict_types = 1);

namespace Api\Controller;

use Api\Enum\HttpResponse;
use Core\Factory\UserFactory;

class AccountController extends AbstractController
{

    public function balance()
    {
        $id = $this->request->getParameter('account_id', '');
        $account = UserFactory::getAccount()->handle($id);

        if(empty($account)) {
            $this->response->setStatusCode(HttpResponse::NOT_FOUND);
            $this->response->setContent('0');
            return;
        }
        
        $this->response->setContent($account->balance);
    }
}