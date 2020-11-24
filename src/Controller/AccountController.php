<?php declare(strict_types = 1);

namespace Api\Controller;

use Api\Factory\AccountFactory;
use Api\Repository\AccountRepository;
use Http\Request;
use Http\Response;

class AccountController extends BaseController
{

    public function balance()
    {
        $id = $this->request->getParameter('account_id', '');
        $account = AccountFactory::getAccount()->handle($id);

        if(empty($account)) {
            $this->response->setStatusCode(404, '0');
            $this->response->setContent('0');
            return;
        }
        
        $this->response->setContent($account->balance);
    }
}