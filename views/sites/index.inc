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
<ul data-role="listview">
  <li data-role="list-divider">Select a Stack Exchange site:</li>
</ul>
<br /><br />
<ul data-role="listview" data-filter="true" data-filter-placeholder="Search for Stack Exchange Site..." class='site-list'>
<?php

while($site = $response->Fetch(TRUE))
{
    if($site['site_state'] != 'linked_meta')
        echo "<li><a href='$document_root/{$site['api_site_parameter']}'><img src='{$site['icon_url']}' class='ui-li-icon' />{$site['name']}<p>for {$site['audience']}</p></a></li>";
}

?>
</ul>