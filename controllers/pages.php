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

require_once 'config/config.php';
require_once 'internal/base_controller.php';

class PagesController extends BaseController
{
    public function about()
    {
        global $config;
        $this->SetPageInfo('About ' . $config['site_name']);
    }
    
    public function dialog()
    {
        $this->SetPageInfo('Options');
        
        if(!isset($_GET['page_url']) || !isset($_GET['equiv_url']))
            throw new Exception('"page_url" or "equiv_url" is missing from the request.');
        
        $this->SetViewVariable('dialog', TRUE);
        $this->SetViewVariable('page_url', $_GET['page_url']);
        $this->SetViewVariable('equiv_url', $_GET['equiv_url']);
    }
}

?>