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
    /// The model that corresponds with this controller.
    protected $model = null;
    
    /// Contains all of the variables that will be passed to the view.
    private $view_variables = array();
    
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
}

?>