<?php
use VestaApi\Entity\Client;

require_once __DIR__ . '/../vendor/autoload.php';

unset($argv[0]);

$param = array_combine(['client_id','client_secret','redirect_uri'], $argv);

if (empty($param['client_id'])) {
    exit("Please enter new client (client_id) \n");
}

$em = require_once __DIR__ . '/em.php';

$client = new Client();
$client->setClientIdentifier($param['client_id']);
$client->setClientSecret($param['client_secret']);
$client->setRedirectUri($param['redirect_uri']);

$em->persist($client);
$em->flush();

echo "Create User with ID " . $client->getId() . "\n";