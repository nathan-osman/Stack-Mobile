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

require_once 'internal/base_controller.php';
require_once 'internal/api.php';

require_once 'internal/view_utils.php';

class SearchController extends BaseController
{
    public function index($site)
    {
        $this->SetPageInfo('Search {name}', '{url}/search', $site);
        
        // If the 'q' parameter was supplied, then redirect
        if(isset($_GET['q']) && isset($_GET['search_type']))
            return array($site, 'search', $_GET['search_type'], rawurlencode($_GET['q']));
    }
    
    public function questions($site, $q)
    {
        $this->SetPageInfo('Search Results for "' . htmlentities($q) . '"', '{url}/search?q=' . urlencode($q), $site);
        
        // Perform the search
        $this->SetViewVariable('q', $q);
        $this->SetViewVariable('response', API::Site($site)->Search($q)->Filter('!-psgAvQU')->Exec());
    }
    
    public function users($site, $q)
    {
        $this->SetPageInfo('Search Results for "' . htmlentities($q) . '"', '{url}/search?q=' . urlencode($q), $site);
        
        // Filter tags by the search string
        $this->SetViewVariable('q', $q);
        $this->SetViewVariable('response', API::Site($site)->Users()->Inname($q)->Exec());
    }
    
    public function tags($site, $q)
    {
        $this->SetPageInfo('Search Results for "' . htmlentities($q) . '"', '{url}/search?q=' . urlencode($q), $site);
        
        // Filter tags by the search string
        $this->SetViewVariable('q', $q);
        $this->SetViewVariable('response', API::Site($site)->Tags()->Inname($q)->Exec());
    }
}

?>