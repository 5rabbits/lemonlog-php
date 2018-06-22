## PHP Client

### Install
`composer require lemonlog`

### Use

```
<?php
require 'vendor/autoload.php';

use Lemontech\Lemonlog\Client\Client;

$account = __DIR__.'/account.json';

$client = new Client([
    'application' => 'My Application',
    'tenant' => 'International Business inc.',
    'account' => $account
]);

$client->setError('warning', "Este es un warning");
$client->setWarning('test', 'Este warning si que es real');
$client->setInfo('invoice_module', 'Se ha creado una factura');
```