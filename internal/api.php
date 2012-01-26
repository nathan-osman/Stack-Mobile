<?php

/* Stack Mobile - Bringing Stack Exchange Sites to Mobile Devices
   Copyright (C) 2012  Nathan Osman

   This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program.  If not, see <http://www.gnu.org/licenses/>. */

// Load the Stack.PHP library and the SQL cache class
require_once 'stackphp/api.php';
require_once 'stackphp/sql_cache.php';

// Load the configuration file which contains the API key
// and information for accessing the database.
require 'config/config.php';

// Set the API key
API::$key = $config['api_key'];

// Set the SQL cache
API::SetCache(new SQLCache($config['db_host'],
                           '',
                           $config['db_username'],
                           $config['db_password']));

?>