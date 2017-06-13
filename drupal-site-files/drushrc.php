<?php
// See: https://drupal.org/node/1158144
// Keeps drush from showing http://default in links.
$options['uri'] = 'http://cuww.dev/oit';
$command_specific['config-export']['skip-modules'] = array('devel');
