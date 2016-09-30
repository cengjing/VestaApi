<?php

use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;

$settings = require __DIR__ . '/../src/settings.php';
$settings = $settings['settings'];

$config = Setup::createAnnotationMetadataConfiguration(
    $settings['doctrine']['meta']['entity_path'],
    $settings['doctrine']['meta']['auto_generate_proxies'],
    $settings['doctrine']['meta']['proxy_dir'],
    $settings['doctrine']['meta']['cache'],
    false
);

return EntityManager::create($settings['doctrine']['connection'], $config);