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

// The URLManager provides us with the GetDocumentRoot method
require_once 'internal/url_manager.php';

/// A set of utility methods for views.
class ViewUtils
{
    /// Loads one of the utility classes.
    /**
      * \param $class_name the name of the class to load
      */
    public static function LoadUtil($class_name)
    {
        // Load the file containing the class
        require_once "utils/$class_name.php";
    }

    /// Returns the document root.
    /**
      * \return the document root
      */
    public static function GetDocumentRoot()
    {
        return URLManager::GetDocumentRoot();
    }
    
    /// Returns the absolute path to a file in the static directory.
    /**
      * \param $filename the name of a file in the static directory
      * \return the absolute path to the file
      */
    public static function GetStaticPath($filename)
    {
        return self::GetDocumentRoot() . '/static/' . $filename;
    }
    
    /// Returns the value of the provided index or a default if none provided.
    /**
      * \param $variable an array
      * \param $index an index into the array
      * \param $default_value the default value to display
      * \return the value to display
      */
    public static function GetIndexValue($variable, $index, $default_value='[unknown]')
    {
        return (isset($variable[$index]) && $variable[$index] != '')?$variable[$index]:"<span class='unknown'>$default_value</span>";
    }
}

?>