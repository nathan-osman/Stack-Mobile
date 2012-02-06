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

class Page
{   
    public static $page_url;
    public static $current_page;
    
    public static function GeneratePageNumber($number)
    {
        if($number == self::$current_page)
            return '<span>' . number_format($number) . '</span>';
        else
            return '<a href=\'/' . self::$page_url . "?page=$number'>" . number_format($number) . '</a>';
    }
    
    public static function GeneratePageNumbers($total)
    {
        // Create an array of page numbers based on their position
        // regardless of whether or not they are valid.
        $page_numbers = array(self::$current_page - 2, self::$current_page - 1, self::$current_page,
                              self::$current_page + 1, self::$current_page + 2);
        
        // Now remove the invalid values
        $page_numbers = array_unique(array_filter($page_numbers, create_function('$value', 'return $value > 1 && $value < ' . $total . ';')));
        
        // Generate the HTML for the page numbers that remain
        $html = '<li><div class="page-numbers">' . self::GeneratePageNumber(1, self::$current_page);
        
        if($total > 1)
        {
            if(count($page_numbers) && current($page_numbers) > 2)
                $html .= '...';
            
            foreach($page_numbers as $number)
                $html .= self::GeneratePageNumber($number, self::$current_page);
            
            if(count($page_numbers) && end($page_numbers) < ($total - 1))
                $html .= '...';
            
            $html .= self::GeneratePageNumber($total, self::$current_page);
        }
        
        // Close the list and return the HTML
        $html .= '</div></li>';
        return $html;
    }
}

?>