<?php
namespace Lemontech\Lemonlog\Client;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class Client
{
    protected $serviceAccount;
    protected $database;
    protected $tenant;
    protected $application;
    public function __construct($options)
    {
        $account = empty($options['account']) ? __DIR__.'/google-service-account.json' : $options['account'];
        $this->application = empty($options['application']) ? 'TTB' : $options['application'];
        $this->tenant = empty($options['tenant']) ? 'Lemontech' : $options['tenant'];
        $this->serviceAccount = ServiceAccount::fromJsonFile($account);
        $firebase = (new Factory)
        ->withServiceAccount($this->serviceAccount)    
        ->create();
        $this->database = $firebase->getDatabase();        
    }

    public function setError($name, $payload)
    {
        $this->setLog('error', $name, $payload);
    }

    public function setWarning($name, $payload)
    {
        $this->setLog('warning', $name, $payload);
    }

    public function setInfo($name, $payload)
    {
        $this->setLog('info', $name, $payload);
    }

    public function setSuccess($name, $payload)
    {
        $this->setLog('success', $name, $payload);
    }

    protected function setLog($type, $name, $payload)
    {
        $data = [
            'name' => $name,
            'payload' => $payload,
            'created_at' => Database::SERVER_TIMESTAMP
        ];
        $reference = "logs/{$this->application}/{$this->tenant}/{$type}";
        $key = $this->database->getReference($reference)->push($data);
    }
}
