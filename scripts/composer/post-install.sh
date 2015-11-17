#!/bin/sh

# Prepare the settings file for installation
if [ ! -f web/sites/default/settings.php ]
  then
    cp web/sites/default/default.settings.php web/sites/default/settings.php
    chmod 777 web/sites/default/settings.php
fi

echo "\$databases['default']['default'] = array (
  'database' => 'drupal',
  'username' => 'drupal',
  'password' => 'drupal',
  'prefix' => '',
  'host' => 'localhost',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
\$settings['install_profile'] = 'zap';
\$config_directories['sync'] = 'sites/default/files/config_4eJmMXr6BeZgx7dcsXSb9SDTZ6HzGJnNpyJia3ymYnLKtS_xdLdg_f3A4GB2HNJDg3BWE2ODNQ/sync';" >> web/sites/default/settings.php

# Prepare the services file for installation
if [ ! -f web/sites/default/services.yml ]
  then
    cp web/sites/default/default.services.yml web/sites/default/services.yml
    chmod 777 web/sites/default/services.yml
fi

# Prepare the files directory for installation
if [ ! -d web/sites/default/files ]
  then
    mkdir -m777 web/sites/default/files
fi
# Prepare the modules directory for development.
if [ ! -d web/modules/custom ]
  then
    mkdir web/modules/custom
fi
if [ ! -d web/modules/features ]
  then
    mkdir web/modules/features
fi
if [ ! -d web/modules/sandbox ]
  then
    mkdir web/modules/sandbox
fi
find . -name "README.txt" -type f|xargs rm -f
