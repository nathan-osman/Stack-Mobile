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

class TagsController extends BaseController
{
    public function index($site)
    {
        $this->SetSite($site);
        
        // Fetch the first page of tags from the site
        $this->SetViewVariable('response', API::Site($site)->Tags()->Exec());
    }
    
    public function view($site, $tag)
    {
        $this->SetSite($site);
        
        // Attempt to retreive questions with the specified tag
        $this->SetViewVariable('tag', $tag);
        $this->SetViewVariable('response', API::Site($site)->Questions()->Tagged($tag)->Filter('!-psgAvQU')->Exec());
    }
}

?>