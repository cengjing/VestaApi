<?php
use VestaApi\Entity\OAuth\User;

require_once __DIR__ . '/../vendor/autoload.php';

if (empty($argv[1])) {
    exit("Please enter new user (email) and (password)\nExample: some@mail:password\n");
}
$param = array_combine(['email','password'], explode(':', $argv[1]));
if (!filter_var($param['email'], FILTER_VALIDATE_EMAIL)) {
    exit("($param[email]) - Invalid email address\n");
}

$em = require_once __DIR__ . '/em.php';

$user = new User();
$user->setEmail($param['email']);
$user->setPassword($param['password']);

$em->persist($user);
$em->flush();

echo "Create User with ID " . $user->getId() . "\n";