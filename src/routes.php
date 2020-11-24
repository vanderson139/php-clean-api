<?php declare(strict_types=1);

return [
    ['GET', '/', ['Api\Controller\HomeController', 'index']],
    ['GET', '/reset', ['Api\Controller\ResetController', 'index']],
    ['GET', '/balance', ['Api\Controller\AccountController', 'balance']],
    ['POST', '/event', ['Api\Controller\EventController', 'create']]
];