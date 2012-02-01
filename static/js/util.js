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

// Display comments on a page
function ShowComments(id)
{
    // We do a transition here from the button to the comments.
    // Start by getting the height of the elements
    $('#comment_content_' + id).css('visibility', 'hidden').css('display', 'block');
    
    var bt_height = $('#comment_button_' + id).height();
    var ul_height = $('#comment_content_' + id).height();
    
    $('#comment_content_' + id).css('display', 'none').css('visibility', 'visible');
    
    // Animate the height of the div
    $('#comment_' + id).animate({ height: "+=" + (ul_height - bt_height) },
                                600);
    
    // Animate the hiding of the button
    $('#comment_button_' + id).fadeOut(300, function() {
        $('#comment_content_' + id).fadeIn(300);
    });
}