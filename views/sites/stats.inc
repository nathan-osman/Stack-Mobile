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

// Generate the URL prefix for content on the site
$url_prefix = ViewUtils::GetDocumentRoot() . '/' . $site['site']['api_site_parameter'];

?>
<table style='width: 100%;'>
  <tr>
    <td>
      <img src='<?php echo $site['site']['icon_url']; ?>' class='site-logo' />
    </td>
    <td>
      <h2><?php echo $site['site']['name']; ?></h2>
      <p>Site for <?php echo $site['site']['audience']; ?></p>
    </td>
  </tr>
</table>

<ul data-role='listview' data-inset='true'>
  <li><a href='<?php echo $url_prefix; ?>/questions'>Questions</a></li>
  <li><a href='<?php echo $url_prefix; ?>/users'>Users</a></li>
  <li><a href='<?php echo $url_prefix; ?>/tags'>Tags</a></li>
  <li data-icon='search'><a href='<?php echo $url_prefix; ?>/search'>Search</a></li>
</ul>

<h2>Related Sites:</h2>
<ul data-role='listview' data-inset='true'>
<?php

// TODO: this code is UGLY!
foreach($site['site']['related_sites'] as $related_site)
{
    // This is a bit of a hack but necessary since the API parameter
    // for the Meta is not included in the request.
    if($related_site['relation'] == 'meta')
        echo '<li><a href=\'' . ViewUtils::GetDocumentRoot() . "/meta.{$site['site']['api_site_parameter']}'>{$related_site['name']}</a></li>";
    // Same ugly hack as above only in reverse
    elseif($related_site['relation'] == 'parent')
        echo '<li><a href=\'' . ViewUtils::GetDocumentRoot() . '/' . str_replace('meta.', '', $site['site']['api_site_parameter']) . "'>{$related_site['name']}</a></li>";
    // Just redirect to the chat page (mobile friendly, of course)
    elseif($related_site['relation'] == 'chat')
        echo "<li><a href='{$related_site['site_url']}'>{$related_site['name']}</a></li>";
    else
        echo "<li>{$related_site['name']}</li>";
}

?>
</ul>

<h2>Site Information:</h2>
<table class='stats'>
  <tr>
    <th>Total questions:</th>
    <td><?php echo $site['total_questions']; ?></td>
  </tr>
  <tr>
    <th>Total answers:</th>
    <td><?php echo $site['total_answers']; ?></td>
  </tr>
  <tr>
    <th>Total users:</th>
    <td><?php echo $site['total_users']; ?></td>
  </tr>
  <tr>
    <th>New active users:</th>
    <td><?php echo $site['new_active_users']; ?></td>
  </tr>
</table>