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

class Tag
{
    // Generates a list of tags
    public static function GenerateTagList($site, $response)
    {
        $tags_html = array();
        
        while($tag = $response->Fetch(FALSE))
        {
            // Generate the URL for the tag page
            $escaped_tag = urlencode($tag['name']);
            $tag_url = ViewUtils::GetDocumentRoot() . "/{$site['site']['api_site_parameter']}/tags/$escaped_tag";
            
            $tags_html[] = "<li><a href='$tag_url'>{$tag['name']}</a></li>";
        }
        
        if(count($tags_html))
            return implode('', $tags_html);
        else
            return '<li><span class="unknown">[empty]</span></li>';
    }
}

?>