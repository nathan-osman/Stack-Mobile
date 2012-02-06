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

class QuestionsController extends BaseController
{
    public function index($site)
    {
        $this->SetPageInfo('Recent Questions on {name}', '{url}/questions', $site);
        
        // Check for a page number
        $page = $this->GetGETVariable('page', 1);
        
        // Retrieve the current questions on the site
        $this->SetViewVariable('response', API::Site($site)->Questions()->Filter('!masJQxPJAU')->Exec()->Page($page));
        $this->SetViewVariable('page',     $page);
    }
    
    public function view($site, $id)
    {
        // Begin by attempting to retrieve the question with the specified ID
        $question = API::Site($site)->Questions($id)->Filter('!-)dQB__A07Ku')->Exec()->Fetch();
        
        if($question === FALSE)
            throw new Exception("The question with ID #$id does not exist.");
        
        // Set the page information and question data
        $this->SetPageInfo($question['title'], "{url}/q/$id", $site);
        $this->SetViewVariable('question', $question);
    }
}

?>