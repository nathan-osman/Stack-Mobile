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

require 'internal/url_entry.php';

$global_url_map = array(
    
    // This rule deals with the default page
    new URLEntry('{^$}', 'sites', 'index'),
    
    // This rule deals with the pages/ URLs
    new URLEntry('{^pages/(\w+)$}', 'pages', '$1'),
    
    // This rule deals with the [site]/ URLs
    new URLEntry('{^([\w\.]+)/?$}', 'sites', 'stats', '$1'),
    
    // This rule deals with the [site]/[controller] URLs
    new URLEntry('{^([\w\.]+)/(\w+)/?$}', '$2', 'index', '$1'),
    
    // This rule deals with the [site]/[controller]/[id] URLs
    new URLEntry('{^([\w\.]+)/(\w+)/(\d+)/?$}', '$2', 'view', '$1/$3'),
    
    // This rule deals with the [site]/[controller]/[id]/[action] URLs
    new URLEntry('{^([\w\.]+)/(\w+)/(\d+)/(\w+)$}', '$2', '$4', '$1/$3'),
    
);

?>