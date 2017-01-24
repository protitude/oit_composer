<?php
$settings['trusted_host_patterns'] = array(
  '^drupal\.dev',
);
$settings['hash_salt'] = 'rXRqLDFU2Ls4oCohqGu9YX_SrbvT_2cjcCAKqOQqFps';
#$settings['file_private_path'] = '/var/www/drupalvm/drupal/SITE/private';

$databases = array();
$databases['default']['default'] = array (
  'database' => 'drupal',
  'username' => 'drupal',
  'password' => 'drupal',
  'prefix' => '',
  'host' => 'localhost',
  'port' => '3306',
  'namespace' => 'Drupal\Core\Database\Driver\mysql',
  'driver' => 'mysql',
);

