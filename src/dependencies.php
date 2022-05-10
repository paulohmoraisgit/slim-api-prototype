<?php
// DIC configuration
use Illuminate\Database\Capsule\Manager as Capsule;

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
  $settings = $c->get('settings')['renderer'];
  return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
  $settings = $c->get('settings')['logger'];
  $logger = new Monolog\Logger($settings['name']);
  $logger->pushProcessor(new Monolog\Processor\UidProcessor());
  $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
  return $logger;
};

// db
$container['db'] = function ($c) {
  $capsule = new Capsule;

  $settings = $c->get('settings')['db'];
  $capsule->addConnection($settings);

  $capsule->setAsGlobal();
  $capsule->bootEloquent();

  return $capsule;
};

$container->get('db');