<?php
$configDir=realpath(__DIR__ . '/../config/');
$projectDir=str_replace(realpath(__DIR__.'/../..').DIRECTORY_SEPARATOR, '', realpath(__DIR__.'/..'));

// environment domains
defined('PROD_SERVER') or define('PROD_SERVER', 'crm-yii.com');
defined('STAGE_SERVER') or define('STAGE_SERVER', 'test.crm-yii.com');
defined('DEV_SERVER') or define('DEV_SERVER', 'local.crm-yii.com');

defined('DEV_SERVER_PATH') or define('DEV_SERVER_PATH', 'www.crm-yii.com');

defined('APP_VERSION') or define('APP_VERSION', '1.00');

// command line execution? if not get the server name
$isCLI=(PHP_SAPI === 'cli') || ((!empty($argv) && !empty($argc)) ? 1 : 0);
$serverName=isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';


// find server environment; whether running on web or command line and define environment variable, configuration file
if ($serverName == PROD_SERVER || $serverName == 'www.' . PROD_SERVER || ($isCLI && stripos($projectDir, PROD_SERVER) === 0))
{
  defined('SERVER_DOMAIN') or define('SERVER_DOMAIN', PROD_SERVER);
  defined('YII_ENV') or define('YII_ENV', 'prod');
  defined('DB_CONFIG') or define('DB_CONFIG', $configDir . '/db-prod.php');
  defined('SERVER_DECAL') or define('SERVER_DECAL', '');
}
else
if ($serverName == STAGE_SERVER || ($isCLI && stripos($projectDir, STAGE_SERVER) === 0))
{
  defined('SERVER_DOMAIN') or define('SERVER_DOMAIN', STAGE_SERVER);
  defined('YII_ENV') or define('YII_ENV', 'staging');
  defined('DB_CONFIG') or define('DB_CONFIG', $configDir . '/db-stage.php');
  defined('SERVER_DECAL') or define('SERVER_DECAL', '<div id="serverDecal">TEST&nbsp;&nbsp;Server</div>');
}
else
if ($serverName == DEV_SERVER || ($isCLI && stripos($projectDir, DEV_SERVER_PATH) === 0))
{
  defined('SERVER_DOMAIN') or define('SERVER_DOMAIN', DEV_SERVER);
  defined('YII_ENV') or define('YII_ENV', 'dev');
  defined('DB_CONFIG') or define('DB_CONFIG', $configDir . '/db.php');
  defined('YII_DEBUG') or define('YII_DEBUG', true);
  defined('SERVER_DECAL') or define('SERVER_DECAL', '<div id="serverDecal">DEV_Server</div>');
}

if (!defined('SERVER_DOMAIN'))
{
  echo 'Bad server configuration! :( ' . "\n";
  exit(1);
}
