<?php declare(strict_types = 1);

namespace Api\Controller;

use Api\Factory\UserFactory;

class AccountController extends BaseController
{

    public function balance()
    {
        $id = $this->request->getParameter('account_id', '');
        $account = UserFactory::getAccount()->handle($id);

        if(empty($account)) {
            $this->response->setStatusCode(404);
            $this->response->setContent('0');
            return;
        }
        
        $this->response->setContent($account->balance);
    }
}