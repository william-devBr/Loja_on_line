<?php

  use core\classes\Database;
  use core\classes\Store;


//session start
session_start();

/** auto-load
 * config
 * routes
 */
 // o arquivo config.php está definido o caminho no composer.json
/** LOAD CLASSES */
require_once('../vendor/autoload.php');
// routes
require_once('../core/routes.php');
