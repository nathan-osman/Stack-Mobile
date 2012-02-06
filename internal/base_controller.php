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

require_once 'internal/url_manager.php';

/// The base controller from which all other controllers must derive.
class BaseController
{
    /// Contains all of the variables that will be passed to the view.
    private $view_variables = array();
    
    /// Data for the current site
    protected $site = null;
    
    /// Adds the specified variable to the list of view variables.
    /**
      * \param $name the name of the variable
      * \param $value the value for the variable
      *
      * Note: if the variable $name already exists, it will be replaced
      * with the new value.
      */
    protected function SetViewVariable($name, $value)
    {
        $this->view_variables[$name] = $value;
    }
    
    /// Retrieves the view variables as an array.
    /**
      * \return an array containing the view variables
      */
    public function GetViewVariables()
    {
        return $this->view_variables;
    }
    
    /// Retrieves the value of a GET variable.
    public function GetGETVariable($name, $default)
    {
        return (isset($_GET[$name]))?$_GET[$name]:$default;
    }
    
    /// Sets the information for the page.
    /**
      * \param $title the title for the page
      * \param $equiv_url the equivalent URL on Stack Exchange
      * \param $site the site for the current page
      *
      * Note: it is important to call this method since it also sets a number of
      * special view variables that the main template uses.
      */
    protected function SetPageInfo($title, $equiv_url=null, $site=null)
    {
        // Expose the document root as a view variable
        $this->SetViewVariable('document_root', URLManager::GetDocumentRoot());
        
        // Provide the view with access to the current page URL
        $this->SetViewVariable('page_url', URLManager::$current_url);
        
        // If the site is provided, include it in the view variables and substitute
        // the information in some of the other fields.
        if($site !== null)
        {
            // Retrieve the site information from the API
            $this->site = API::Site($site)->Info()->Filter(new Filter('!-q8LLJA7'))->Exec()->Fetch();
            
            // Pass on the site name and API parameter to the views
            $this->SetViewVariable('site',        $this->site['site']['api_site_parameter']);
            $this->SetViewVariable('site_name',   $this->site['site']['name']);
            $this->SetViewVariable('site_prefix', URLManager::GetDocumentRoot() . '/' . $this->site['site']['api_site_parameter']);
            
            // Replace '{name}' in page title with the site name
            $title = str_replace('{name}', $this->site['site']['name'], $title);
            
            // Do the same for the page's equivalent URL
            if($equiv_url !== null)
            $equiv_url = str_replace('{url}', $this->site['site']['site_url'], $equiv_url);
        }
        
        // Set the page title and equivalent URL
        $this->SetViewVariable('page_title', $title);
        
        if($equiv_url !== null)
            $this->SetViewVariable('equiv_url',  $equiv_url);
    }
}

?>