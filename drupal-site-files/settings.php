<?php
$config_directories = array();
$settings['hash_salt'] = '';
$settings['update_free_access'] = FALSE;
$settings['container_yamls'][] = __DIR__ . '/services.yml';
if (isset($_SERVER["PROTITUDE_ENV"])) {
  if ($_SERVER["PROTITUDE_ENV"] == 'dev') {
    $conf['error_level'] = 2;
    $settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';
    $config['system.performance']['css']['preprocess'] = FALSE;
    $config['system.performance']['js']['preprocess'] = FALSE;
  }
}
$settings['install_profile'] = 'zap';
$config_directories['sync'] = '../config/sync';
if (file_exists(__DIR__ . '/settings.local.php')) {
  include __DIR__ . '/settings.local.php';
}

