<?php
$settings['trusted_host_patterns'] = array(
  '^cuww\.dev',
);
$settings['hash_salt'] = 'lZPTP5TLHPAOUIjM9Su6HvPqxmjBUD1eauqtxAMKqW0JvQo40CYG4eHUvAxPaIhyp_o1Gpj4hg';
$settings['file_private_path'] = '/var/www/drupalvm/drupal/oit/private';

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

