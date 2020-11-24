<?php declare(strict_types = 1);

namespace Api\Controller;

use Api\Repository\AccountRepository;

class AccountController extends BaseController
{
    public function balance()
    {
        $id = $this->request->getParameter('account_id', '');
        $repository = new AccountRepository();
        $account = $repository->find($id);

        if(empty($account)) {
            $this->response->setStatusCode(404, '0');
            $this->response->setContent('0');
            return;
        }
        
        $this->response->setContent($account->balance);
    }
}