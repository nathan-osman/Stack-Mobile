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

/// Represents a URL entry for use in the URL map.
class URLEntry
{
    private $pattern, $controller, $action, $parameters;
    private $captured_data;
    
    /// Initializes a URL entry with the specified parameters.
    /**
      * \param $pattern a regular expression representing the path to match
      * \param $controller the name of the controller that corresponds with the path
      * \param $action the action that corresponds with the path
      * \param $parameters either an array of parameters or a string to be split by '/'
      *
      * This method is used to construct a URL entry, typically for use in the URL map.
      * The first parameter is a regular expression (excluding opening and closing
      * delimiters) that will be used to test against the requested path. The second and
      * third parameters are the controller and action that correspond with the provided
      * path. These are strings that may refer to capture groups in the regular expression
      * (in the form of '$1', '$2', etc.).
      *
      * The final parameter represents the parameters that will be passed (in order) to
      * the action of the controller. These may be an array of strings (that can refer to
      * capture groups) or simply a string that will be split using '/' and the values
      * passed directly to the action.
      */
    function __construct($pattern, $controller, $action = 'index', $parameters = '')
    {
        $this->pattern    = $pattern;
        $this->controller = $controller;
        $this->action     = $action;
        $this->parameters = $parameters;
    }
    
    /// Returns the captured data that corresponds with the supplied index.
    /**
      * \param $matches an array of matches returned by preg_replace_callback
      * \return the captured data that matches the offset or an empty string
      */
    private function CapturedData($matches)
    {
        $offset = intval($matches[1]);
        
        if(isset($this->captured_data[$offset]))
            return $this->captured_data[$offset];
        else
            return '';
    }
    
    /// Substitutes $xxx values for the equivalent captured data.
    /**
      * \param $string a string containing zero or more $xxx references
      * \return the equivalent string with the captured data inserted where specified
      *
      * Note: you can use a literal '$' character in the string by preceeding it
      * with a backslash.
      */
    private function SubstituteCapturedData($string)
    {
        return preg_replace_callback('{(?<!\\\\)\$(\d+)}', array($this, 'CapturedData'), $string);
    }
    
    /// Matches the path given against the pattern.
    /**
      * \param $path the path to match against
      * \return a nonzero value if the path matched the pattern
      *
      * Note: if the pattern matches, you can then query the other methods of this class
      * to retrieve the information extracted from the path.
      */
    public function Matches($path)
    {
        return preg_match($this->pattern, $path, $this->captured_data);
    }
    
    /// Returns the controller that matched the pattern.
    /**
      * \return the value for the controller
      */
    public function GetController()
    {
        return $this->SubstituteCapturedData($this->controller);
    }
    
    /// Returns the action that matched the pattern.
    /**
      * \return the value for the action
      */
    public function GetAction()
    {
        return $this->SubstituteCapturedData($this->action);
    }
    
    /// Returns an array of parameters that matched the pattern.
    /**
      * \return an array of parameters
      */
    public function GetParameters()
    {
        // Note that $this->parameters might be a string, if so
        // convert it to an array split by '/'
        if(is_string($this->parameters))
        {
            $this->parameters = explode('/', $this->parameters);
            
            // Make sure the parameters is an array
            if($this->parameters === FALSE)
                return array();
        }
        
        // Perform the substitutions
        $processed_parameters = array();
        
        foreach($this->parameters as $parameter)
            $processed_parameters[] = $this->SubstituteCapturedData($parameter);
        
        return $processed_parameters;
    }
}

?>