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
    public static function GenerateTagList($site_prefix, $response, $paginate=FALSE)
    {
        $tags_html = array();
        
        // IF total > 30 then we display page numbers
        if($paginate && $response->Total(TRUE) > 30)
            $tags_html[] = Page::GeneratePageNumbers(ceil($response->Total() / 30));
        
        while($tag = $response->Fetch(FALSE))
        {
            // Generate the URL for the tag page
            $escaped_tag = urlencode($tag['name']);
            $tag_url = "/$site_prefix/tags/$escaped_tag";
            
            $tags_html[] = "<li><a href='/$tag_url'>{$tag['name']}</a></li>";
        }
        
        if(count($tags_html))
            return implode('', $tags_html);
        else
            return '<li><span class="unknown">[empty]</span></li>';
    }
}

?>