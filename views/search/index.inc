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

?>
<form method='get'>
  <label for='q'>Search terms</label>
  <input type='text' id='q' name='q' />
  <fieldset data-role='controlgroup'>
    <legend>Search type</legend>
    <input type='radio' name='search_type' value='questions' id='questions' checked='checked' />
    <label for='questions'>Questions</label>
    <input type='radio' name='search_type' value='users' id='users' />
    <label for='users'>Users</label>
    <input type='radio' name='search_type' value='tags' id='tags' />
    <label for='tags'>Tags</label>
  </fieldset>
  <input type='submit' value='Search' />
</form>