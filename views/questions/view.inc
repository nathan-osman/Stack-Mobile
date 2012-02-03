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
  <li data-role='list-divider'><?php echo Post::GenerateQuestionTitle($question); ?></li>
  <?php
  
  echo '<li><div class="item-body">';
  
  // Determine if the question was migrated to / from a site
  if(isset($question['migrated_to']))
      echo '<blockquote><p><b>Migrated ' . Date::RelativeTime($question['migrated_to']['on_date']) . "</b> to {$question['migrated_to']['other_site']['name']}</p></blockquote>";
  elseif(isset($question['migrated_from']))
      echo '<blockquote><p><b>Migrated ' . Date::RelativeTime($question['migrated_from']['on_date']) . "</b> from {$question['migrated_from']['other_site']['name']}</p></blockquote>";
  // Determine if the question was closed or not
  elseif(isset($question['closed_date']) && isset($question['closed_reason']))
      echo '<blockquote><p><b>Closed ' . Date::RelativeTime($question['closed_date']) . "</b> - {$question['closed_reason']}</p></blockquote>";
  
  echo $question['body'];
  echo Post::GenerateTagList($site_prefix, $question['tags']);
  echo Post::GenerateUserBox($site_prefix, $question['owner'], $question['creation_date']);
  
  // Display any comments if provided
  if(isset($question['comments']))
      echo Post::GenerateCommentButton($site_prefix, $question['comments'], $question['question_id']);
  
  echo '</div></li>';
  
  // Question answers
  $s = ($question['answer_count'] == 1)?'':'s';
  echo "<li data-role='list-divider'>{$question['answer_count']} answer$s:</li>";
  
  if(isset($question['answers']))
  {
      foreach($question['answers'] as $answer)
      {
          echo '<li><div class="item-body">' . Post::GenerateUserBox($site_prefix, $answer['owner'], $answer['creation_date']) . $answer['body'];
          
          // Display any comments if provided
          if(isset($answer['comments']))
              echo Post::GenerateCommentButton($site_prefix, $answer['comments'], $answer['answer_id']);
          
          echo '</div></li>';
      }
  }
  else
      echo '<li><span class="unknown">[no answers]</span></li>';

  ?>
</ul>