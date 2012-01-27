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

?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $page_title; ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo ViewUtils::GetStaticPath('css/style.css'); ?>">
</head>
<body>
  <!-- CONTENT GOES HERE -->
  <?php echo $page_contents; ?>
</body>
</html>