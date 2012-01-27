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

// Include the map of URLs that the user has defined
require 'config/url_map.inc';

/// Provides methods for managing URLs.
class URLManager
{
    /// Finds the URLEntry that matches the requested URL.
    /**
      * \param $url the URL to match against
      * \return the URLEntry if a match was found, otherwise FALSE
      */
    public static function MatchURLEntry($url)
    {
        global $global_url_map;
        
        // Check each entry (in order) for a match
        foreach($global_url_map as $entry)
            if($entry->Matches($url))
                return $entry;
        
        // If none found, return FALSE
        return FALSE;
    }
    
    /// Returns the path to the document root.
    /**
      * \return the document root
      */
    public static function GetDocumentRoot()
    {
        return substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
    }
}

?>