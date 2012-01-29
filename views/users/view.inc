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

ViewUtils::LoadUtil('number');

?>
<!-- Summary of information -->
<ul data-role='listview'>
  <li data-role='list-divider'>User <?php echo $user['display_name'] . (($user['user_type'] == 'moderator')?' &diams;':''); ?></li>
</ul><br />
<table>
  <tr>
    <td style='width: 68px;'>
      <img src='<?php echo $user['profile_image']; ?>&s=64' />
    </td>
    <td>
      <b>Location:</b> <?php echo ViewUtils::GetIndexValue($user, 'location'); ?><br />
      <b>Age:</b> <?php echo ViewUtils::GetIndexValue($user, 'age'); ?><br />
      <span class='reputation'><?php echo Number::FormatUnit($user['reputation']); ?></span>
    </td>
  </tr>
</table><br />

<!-- About me -->
<ul data-role='listview'>
  <li data-role="list-divider">About <?php echo $user['display_name']; ?></li>
</ul><br />
<?php echo ViewUtils::GetIndexValue($user, 'about_me', '[empty]'); ?>

<!-- The rest of the user's data -->