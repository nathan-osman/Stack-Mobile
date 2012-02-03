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

?>
<table style='width: 100%;'>
  <tr>
    <td>
      <img src='<?php echo $site_data['site']['icon_url']; ?>' class='site-logo' />
    </td>
    <td>
      <h2><?php echo $site_data['site']['name']; ?></h2>
      <p>Site for <?php echo $site_data['site']['audience']; ?></p>
    </td>
  </tr>
</table>

<ul data-role='listview' data-inset='true'>
  <li><a href='<?php echo "$document_root/$site"; ?>/questions'>Questions</a></li>
  <li><a href='<?php echo "$document_root/$site"; ?>/users'>Users</a></li>
  <li><a href='<?php echo "$document_root/$site"; ?>/tags'>Tags</a></li>
  <li data-icon='search'><a href='<?php echo "$document_root/$site"; ?>/search'>Search</a></li>
</ul>

<h2>Related Sites:</h2>
<ul data-role='listview' data-inset='true'>
<?php

foreach($site_data['site']['related_sites'] as $related_site)
{
    if(isset($related_site['api_site_parameter']))
        echo "<li><a href='$document_root/{$related_site['api_site_parameter']}'>{$related_site['name']}</a></li>";
    elseif($related_site['relation'] == 'chat')
        echo "<li><a href='{$related_site['site_url']}?mobile=true'>{$related_site['name']}</a></li>";
    else
        echo "<li>{$related_site['name']}</li>";
}

?>
</ul>

<h2>Site Information:</h2>
<table class='stats'>
  <tr>
    <th>Total questions:</th>
    <td><?php echo number_format($site_data['total_questions']); ?></td>
  </tr>
  <tr>
    <th>Total answers:</th>
    <td><?php echo number_format($site_data['total_answers']); ?></td>
  </tr>
  <tr>
    <th>Total users:</th>
    <td><?php echo number_format($site_data['total_users']); ?></td>
  </tr>
  <tr>
    <th>New active users:</th>
    <td><?php echo number_format($site_data['new_active_users']); ?></td>
  </tr>
</table>