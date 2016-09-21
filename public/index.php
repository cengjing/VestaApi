<?php

require '../vendor/autoload.php';

$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);
// Set up dependencies
require __DIR__ . '/../src/dependencies.php';
// Register middleware
require __DIR__ . '/../src/middleware.php';
// Register routes

/**
 * @var \Doctrine\ORM\EntityManager $em
 */
$em = $container['em'];
$clientStorage  = $em->getRepository('VestaApi\Entity\OAuth\Client');
$userStorage = $em->getRepository('VestaApi\Entity\OAuth\User');
$accessTokenStorage = $em->getRepository('VestaApi\Entity\OAuth\AccessToken');
$authorizationCodeStorage = $em->getRepository('VestaApi\Entity\OAuth\AuthorizationCode');
$refreshTokenStorage = $em->getRepository('VestaApi\Entity\OAuth\RefreshToken');


// Pass the doctrine storage objects to the OAuth2 server class
$server = new \OAuth2\Server([
    'client_credentials' => $clientStorage,
    'user_credentials'   => $userStorage,
    'access_token'       => $accessTokenStorage,
    'authorization_code' => $authorizationCodeStorage,
    'refresh_token'      => $refreshTokenStorage,
], [
    'auth_code_lifetime' => 30,
    'refresh_token_lifetime' => 30,
    'allow_public_clients' => true
]);

require __DIR__ . '/../src/routes.php';

$app->run();