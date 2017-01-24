<?php

/**
 * @file
 * Contains \DrupalProject\composer\ScriptHandler.
 */

namespace DrupalProject\composer;

use Composer\Script\Event;
use Symfony\Component\Filesystem\Filesystem;

class ScriptHandler {

  protected static function getDrupalRoot($project_root) {
    return $project_root .  '/oit';
  }

  public static function scaffoldFiles(Event $event) {
    $fs = new Filesystem();
    $root = static::getDrupalRoot(getcwd());
    $composer_root = exec('pwd|cat');
    // Use default or custom scaffold files.
    $scaffold = !$fs->exists($composer_root . '/drupal-site-files/DEFAULT-scaffold')?'prod-scaffold':'DEFAULT-scaffold';
    $event->getIO()->write("Using Scaffold file:" . $scaffold );
    if (!$fs->exists($composer_root . '/' . $root)) {
      exec('cp -fR ' . $composer_root . '/drupal-site-files/' . $scaffold . ' '  . $root);
    }
  }
  public static function createRequiredFiles(Event $event) {
    $fs = new Filesystem();
    $root = static::getDrupalRoot(getcwd());
    $composer_root = exec('pwd|cat');

    $dirs = [
      'modules',
      'modules/custom',
      //'profiles',
      'themes',
    ];

    $dev_modules = [
      'devel',
      'migrate_manifest',
      'migrate_upgrade',
      'migrate_plus',
      'migrate_tools'
    ];

    // Required for unit testing
    foreach ($dirs as $dir) {
      if (!$fs->exists($root . '/'. $dir)) {
        $fs->mkdir($root . '/'. $dir);
        $fs->touch($root . '/'. $dir . '/.gitkeep');
      }
    }

    // Remove Dev modules from production.
    if (!isset($_SERVER["PROTITUDE_ENV"])) {
      $_SERVER["PROTITUDE_ENV"] = 'NOTSET';
    }
    if ($_SERVER["PROTITUDE_ENV"] == 'NOTSET' ) {
#      foreach ($dev_modules as $dev_module) {
#        if ($fs->exists($root . '/modules/contrib/' . $dev_module)) {
#          exec('rm -fR ' . $root . '/modules/contrib/' . $dev_module);
#          $event->getIO()->write('Removed dev module: ' . $root . '/modules/contrib/' . $dev_module);
#        }
#      }
    }

    // Prepare the settings file for installation
    if (!$fs->exists($root . '/sites/default/settings.php')) {
      $fs->copy($composer_root . '/drupal-site-files/settings.php', $root . '/sites/default/settings.php');
      $fs->chmod($root . '/sites/default/settings.php', 0666);
      $event->getIO()->write("Create a sites/default/settings.php file with chmod 0666");
    }

    // Prepare the services file for installation
    if (!$fs->exists($root . '/sites/default/services.yml')) {
      $fs->copy($composer_root . '/drupal-site-files/default.services.yml', $root . '/sites/default/services.yml');
      $fs->chmod($root . '/sites/default/services.yml', 0666);
      $event->getIO()->write("Create a sites/default/services.yml file with chmod 0666");
    }

    // Create the files directory
    if ( (!$fs->exists($root . '/sites/default/files')) && ($_SERVER["PROTITUDE_ENV"] == 'NOTSET' ) ) {
        exec('cp -fR ' . $composer_root . '/drupal-site-files/files' . ' '  . $root . '/sites/default');
        $event->getIO()->write("Copy files directory");
    } elseif ( (!is_link($root . '/sites/default/files')) && ($_SERVER["PROTITUDE_ENV"] == 'dev') ) {
      symlink('../../../drupal-site-files/files', $root . '/sites/default/files');
      #$fs->mkdir($root . '/sites/default/files', 0777);
      $event->getIO()->write("Symlink sites/default/files directory");
    }

    // Copy settings.local.php file to default
    if (!$fs->exists($root . '/sites/default/settings.local.php')) {
      $fs->copy($composer_root . '/drupal-site-files/settings.local.php', $root . '/sites/default/settings.local.php');
      $event->getIO()->write("Copy settings.local.php file to default");
    }

    // Copy settings.local.php file to default
    if (!$fs->exists($root . '/sites/default/drushrc.php')) {
      $fs->copy($composer_root . '/drupal-site-files/drushrc.php', $root . '/sites/default/drushrc.php');
      $event->getIO()->write("Copy drushrc.php file to default");
    }

    if ( (!$fs->exists($root . '/profiles/contrib/zap')) && ($_SERVER["PROTITUDE_ENV"] == 'NOTSET' ) ) {
      exec('cp -fR ' . $composer_root . '/drupal-site-files/zap ' . $root . '/profiles/contrib');
      $event->getIO()->write('copied profiles directory');
    }  elseif ( (!is_link($root . '/profiles/contrib/zap')) && ($_SERVER["PROTITUDE_ENV"] == 'dev') ) {
      symlink('../../../drupal-site-files/zap', $root . '/profiles/contrib/zap');
#      $fs->copy($composer_root . '/profiles/contrib/zap/contrib/zap/scripts/development.services.yml', $root . '/sites/development.services.yml');
      $event->getIO()->write('symlink created');
    }
    // Place zap_initialize folder
    $zap_initialize = $fs->exists($composer_root . '/drupal-site-files/zap_initialize')?'zap_initialize':'DEFAULT-zap_initialize';
    if ( (!$fs->exists($root . '/profiles/contrib/zap/modules/custom/zap_initialize')) && ($_SERVER["PROTITUDE_ENV"] == 'NOTSET' ) ) {
        exec('cp -fR ' . $composer_root . '/drupal-site-files/' . $zap_initialize . ' '  . $root . '/profiles/contrib/zap/modules/custom');
        $event->getIO()->write("Copy zap_initialize in profiles");
    } elseif (!is_link($root . '/modules/custom/zap_initialize') && ($_SERVER["PROTITUDE_ENV"] == 'dev')) {
      if (!$fs->exists($root . '/profiles/contrib/zap/modules/custom/zap_initialize')) {
        symlink('../../../drupal-site-files/' . $zap_initialize, $root . '/modules/custom/zap_initialize');
        #$fs->mkdir($root . '/sites/default/files', 0777);
        $event->getIO()->write("Symlink zap_initialize in profiles");
      }
    }
#    if ($fs->exists($root . '/profiles/contrib/zap/contrib/zap')) {
#      exec('cd ' . $root . '/profiles/contrib/zap/contrib/zap && composer install');
#      $event->getIO()->write("Zap profile built");
#    }
  }

}
