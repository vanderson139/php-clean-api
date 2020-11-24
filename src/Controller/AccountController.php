<?php declare(strict_types = 1);

namespace Api\Controller;

use Api\Repository\AccountRepository;
use Http\Request;
use Http\Response;

class AccountController extends BaseController
{
    /**
     * @var AccountRepository
     */
    private $accountRepository;

    public function __construct(Request $request, Response $response, AccountRepository $accountRepository)
    {
        parent::__construct($request, $response);
        $this->accountRepository = $accountRepository;
    }

    public function balance()
    {
        $id = $this->request->getParameter('account_id', '');
        $account = $this->accountRepository->find($id);

        if(empty($account)) {
            $this->response->setStatusCode(404, '0');
            $this->response->setContent('0');
            return;
        }
        
        $this->response->setContent($account->balance);
    }
}