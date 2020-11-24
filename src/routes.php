<?php declare(strict_types = 1);

return [
    ['GET', '/', ['Api\Controllers\HomeController', 'index']],
    ['GET', '/reset', ['Api\Controllers\ResetController', 'index']]
];