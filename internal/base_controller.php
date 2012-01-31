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
    
    /// Retrieves information from the provided site.
    /**
      * \param $site the API parameter for the site
      *
      * Note: the site data will be accessible in a protected variable
      * named $site and will be exposed as a view variable under the same name.
      */
    protected function SetSite($site)
    {
        $this->site = API::Site($site)->Info()->Filter(new Filter('!-q8LLJA7'))->Exec()->Fetch();
        $this->SetViewVariable('site', $this->site);
    }
}

?>