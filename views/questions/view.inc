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

ViewUtils::LoadUtil('date');
ViewUtils::LoadUtil('post');

?>
<!-- Question body -->
<ul data-role='listview'>
  <li data-role='list-divider'><?php echo $question['title'] . ((isset($question['closed_date']))?' [closed]':''); ?></li>
  <?php
  
  echo '<li><div class="item-body">';
  
  // Determine if the question was closed or not
  if(isset($question['closed_date']) && isset($question['closed_reason']))
      echo '<blockquote><p><b>Closed ' . Date::RelativeTime($question['closed_date']) . "</b> - {$question['closed_reason']}</p></blockquote>";
  
  echo $question['body'];
  echo Post::GenerateUserBox($site, $question['owner'], $question['creation_date']);
  
  echo '</div></li>';
  
  // Question answers
  $s = ($question['answer_count'] == 1)?'':'s';
  echo "<li data-role='list-divider'>{$question['answer_count']} answer$s:</li>";
  
  if(isset($question['answers']))
  {
      // Generate the HTML for each answer
      $answer_html = array();
      
      foreach($question['answers'] as $answer)
          $answer_html[] = '<li><div class="item-body">' . $answer['body'] . Post::GenerateUserBox($site, $answer['owner'], $answer['creation_date']) . '</div></li>';
      
      echo implode('', $answer_html);
  }
  else
      echo '<li><span class="unknown">[no answers]</span></li>';

  ?>
</ul>