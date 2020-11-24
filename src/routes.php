<?php declare(strict_types=1);

return [
    ['GET', '/', ['Api\Controller\HomeController', 'index']],
    ['POST', '/reset', ['Api\Controller\ResetController', 'drop']],
    ['GET', '/balance', ['Api\Controller\AccountController', 'balance']],
    ['POST', '/event', ['Api\Controller\EventController', 'create']]
];