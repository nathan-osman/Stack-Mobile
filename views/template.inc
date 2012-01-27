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

// Set up the page title
if(!isset($page_title))
    $page_title = '';
else
    $page_title = " - $page_title";

// Prepend this string
$page_title = 'Stack Mobile' . $page_title;

// Generate a unique ID for the current page.
$page_id = 'page_' . uniqid();

?>
<!DOCTYPE html>
<html>
<head>
  
  <!-- Set the character-encoding and viewport -->
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  
  <!-- Set the page title -->
  <title><?php echo $page_title; ?></title>
  
  <!-- Include the jQuery Mobile files + our css modifications -->
  <script type='text/javascript' src='http://code.jquery.com/jquery.min.js'></script>
  <script type='text/javascript' src='http://code.jquery.com/mobile/latest/jquery.mobile.min.js'></script>
  <link rel='stylesheet' type='text/css' href='http://code.jquery.com/mobile/latest/jquery.mobile.min.css' />
  
  <link rel='stylesheet' type='text/css' href='<?php echo ViewUtils::GetStaticPath('css/style.css'); ?>'>
</head>
<body>
  <div data-role='page' id='<?php echo $page_id; ?>' data-add-back-btn='true'>
    <div data-role="header" data-position='fixed'>
      <h1><?php echo $config['site_name']; ?></h1>
    </div>
    <div data-role="content">
      <?php echo $page_contents; ?>
    </div>
    <div data-role="footer">
      <p style="text-align: center;">&copy; 2012 - Nathan Osman -
        <a href="#">[About]</a>
      </p>
    </div>
  </div>
</body>
</html>