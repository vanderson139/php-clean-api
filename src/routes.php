<?php declare(strict_types = 1);

return [
    ['GET', '/', ['Api\Controller\HomeController', 'index']],
    ['GET', '/reset', ['Api\Controller\ResetController', 'index']]
];