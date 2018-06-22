<?php
require 'vendor/autoload.php';

use Lemontech\Lemonlog\Client\Client;

$account = __DIR__.'/account.json';

$client = new Client([
    'application' => 'My Application',
    'tenant' => 'International Business inc',
    'account' => $account
]);

$client->setError('invoice_module', "Este es un warning");
$client->setWarning('user_module', 'Este warning si que es real');
$client->setInfo('accounts_module', 'Se ha creado una cuenta');