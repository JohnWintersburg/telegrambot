<?php
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  define('ROOT', dirname(__FILE__));
  require_once(ROOT.'/components/router.php');
  require_once(ROOT.'/components/graphql.php');
  require_once(ROOT.'/controllers/TelegramController.php');
  require_once(ROOT.'/controllers/SystemController.php');
  //require_once(ROOT.'/components/db.php');

  $router = new Router();
  $router->run();
