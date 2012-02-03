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

class User
{
    public static function GenerateUserList($site, $response)
    {
        $users_html = array();
        
        while($user = $response->Fetch(FALSE))
        {
            // Determine if the user is a mod.
            $mod = ($user['user_type'] == 'moderator')?' &diams;':'';
            
            // Get the user's location
            $user['location'] = ViewUtils::GetIndexValue($user, 'location');
            
            // Generate the URL of their profile
            $profile_url = ViewUtils::GetDocumentRoot() . "/$site/users/{$user['user_id']}";
            
            $users_html[] = "<li><a href='$profile_url'><img src='{$user['profile_image']}&s=16' class='site-icon ui-li-icon' />{$user['display_name']}$mod<p>{$user['location']}</p></a></li>";
        }
        
        if(count($users_html))
            return implode('', $users_html);
        else
            return '<li><span class="unknown">[empty]</span></li>';
    }
}

?>