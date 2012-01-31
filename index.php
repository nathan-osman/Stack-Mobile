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

// Load the configuration settings
if(is_file('config/config.php'))
    require_once 'config/config.php';
else
    $config['site_name'] = 'Internal Error';

// Load some of the internal classes
require_once 'internal/base_controller.php';
require_once 'internal/url_manager.php';
require_once 'internal/view_utils.php';

/// Provides the core functionality of the site.
class StackMobile
{
    private $controller;
    private $action;
    private $parameters;
    
    /// Ensures that all requirements are met for displaying the page.
    private function CheckRequirements()
    {
        if(!is_file('config/config.php'))
            throw new Exception('The file "config.php" is missing. If you haven\'t run the installer yet, click <a href="install/">here</a>.');
        
        if(is_dir('install'))
            throw new Exception('The "install" directory needs to be renamed or removed.');
    }
    
    /// Parses the path and passes it to the URL Manager for routing.
    private function ParsePath()
    {
        if(!isset($_GET['STACKMOBILE_ORIGINAL_URI']))
            throw new Exception('Unable to determine the original request URI.');
        
        $url_entry = URLManager::MatchURLEntry($_GET['STACKMOBILE_ORIGINAL_URI']);
        
        // Check the return value to see if an entry matched
        if($url_entry !== FALSE)
        {
            // Extract the information from the URL manager
            $this->controller = $url_entry->GetController();
            $this->action     = $url_entry->GetAction();
            $this->parameters = $url_entry->GetParameters();
        }
        else
            throw new Exception('The specified page was not found.');
    }
    
    /// Runs the specified controller.
    /**
      * \return an array of view variables or null
      */
    private function RunController()
    {
        // Make sure we have a valid controller specified
        if($this->controller == '')
            throw new Exception('A valid controller was not specified.');
        
        // Make sure the controller file exists
        $controller_filename = "controllers/{$this->controller}.php";
        if(is_file($controller_filename) === FALSE)
            throw new Exception("The controller <code>$controller_filename</code> does not exist.");
        
        require $controller_filename;
        
        // Make sure the class exists in the file
        $class_name = ucwords($this->controller) . 'Controller';
        if(class_exists($class_name) === FALSE)
            throw new Exception("The <code>$class_name</code> class has not been defined in <code>$controller_filename</code>.");
        
        // Check for the specified action within the class
        $method_name = $this->action;
        if(method_exists($class_name, $method_name) === FALSE)
            throw new Exception("The <code>$method_name()</code> method does not exist in <code>$class_name</code>.");
        
        // Create an instance of the class
        $controller = new $class_name($this);
        
        // Check to see if the class derives from BaseController.
        if(!$controller instanceof BaseController)
            throw new Exception("The class <code>$class_name</code> must derive from <code>BaseController</code>.");
        
        // Actually run the method
        $ret = call_user_func_array(array($controller, $method_name), $this->parameters);
        
        // If a return value was specified, then redirect to that URL
        if($ret !== null)
        {
            // The page we will redirect to
            $redirect_page = '';
            
            if(is_array($ret))
                $redirect_page = URLManager::GetDocumentRoot() . '/' . implode('/', $ret);
            else
                $redirect_page = (string)$ret;
            
            // Redirect to the specified page
            header("Location: $redirect_page");
            
            return null;
        }
        else
            // Otherwise return the array of view variables
            return $controller->GetViewVariables();
    }
    
    private function DisplayView($view_variables)
    {
        // Make sure the default template and view exist
        $view_filename = 'views/' . $this->controller . '/' . $this->action . '.inc';
        
        if(is_file('views/template.inc') === FALSE)
            throw new Exception("The default template file <code>views/template.inc</code> is missing.");
        
        if(is_file($view_filename) === FALSE)
            throw new Exception("The view <kbd>$view_filename</kbd> does not exist.");
        
        // Now we need to import all of the variables in $view_variables into the local scope.
        foreach($view_variables as $key =>$value)
            $$key = $value;
        
        // Expose the global configuration settings
        global $config;
        
        // Capture the view output
        ob_start();
        require $view_filename;
        $page_contents = ob_get_contents();
        ob_end_clean();
        
        // Now require the main template
        require 'views/template.inc';
    }
    
    /// Initializes all classes and processes the request.
    public function Go()
    {
        // Determine whether we can use the default template for displaying errors
        $have_template = (is_file('views/template.inc') === TRUE);
        
        // Everything below is wrapped in a try block that captures
        // any errors that the methods below throw. This allows us to
        // try to display an error page.
        try
        {
            // Ensure the requirements are met
            $this->CheckRequirements();
            
            // Initialize the path
            $this->ParsePath();
            
            // Run the controller
            $view_variables = $this->RunController();
            
            // As long as $view_variables isn't null, then
            // we display the view.
            if($view_variables !== null)
                $this->DisplayView($view_variables);
        }
        catch(Exception $e)
        {
            if($have_template)
            {
                // Display the default template file with the error
                $page_contents  = '<h2>An Error Has Occurred</h2>';
                $page_contents .= $e->getMessage();
                $page_contents .= '<p>If you are seeing this error instead of the page you were looking for, try visiting the <a href="' . URLManager::GetDocumentRoot() . '/">home page</a>.</p>';
                
                global $config;
                require 'views/template.inc';
            }
            else
                echo $e->getMessage();
        }
    }
}

// Create an instance and go!
$stackmobile = new StackMobile();
$stackmobile->Go();

?>