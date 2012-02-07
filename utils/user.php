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

require_once 'utils/number.php';
require_once 'utils/page.php';

class User
{
    // Generates the name of a user
    public static function GenerateUsername($user)
    {
        $username = $user['display_name'];
        
        if($user['user_type'] == 'moderator')
            $username .= ' &diams;';
        
        return $username;
    }
    
    // Generates a list of users which can optionally be paginated
    public static function GenerateUserList($site_prefix, $response, $paginate=FALSE)
    {
        $users_html = array();
        
        // IF total > 30 then we display page numbers
        if($paginate && $response->Total(TRUE) > 30)
            $users_html[] = Page::GeneratePageNumbers(ceil($response->Total() / 30));
        
        while($user = $response->Fetch(FALSE))
        {
            // Get the user's location
            $user['location'] = ViewUtils::GetIndexValue($user, 'location');
            
            // Generate the URL of their profile
            $profile_url = "$site_prefix/users/{$user['user_id']}";
            
            $users_html[] = '<li><span class="ui-li-count">' . Number::FormatUnit($user['reputation']) . "</span><a href='$profile_url'><img src='{$user['profile_image']}&s=16' class='site-icon ui-li-icon' />" . self::GenerateUsername($user) . "<p>{$user['location']}</p></a></li>";
        }
        
        if(count($users_html))
            return implode('', $users_html);
        else
            return '<li><span class="unknown">[empty]</span></li>';
    }
}

?>