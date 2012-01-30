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

ViewUtils::LoadUtil('number');
ViewUtils::LoadUtil('post');

?>
<!-- Summary of information -->
<ul data-role='listview'>
  <li data-role='list-divider'>
    User <?php echo $user['display_name'] . (($user['user_type'] == 'moderator')?' &diams;':''); ?>
  </li>
  <li>
    <table>
      <tr>
        <td style='width: 68px;'>
          <img src='<?php echo $user['profile_image']; ?>&s=64' />
        </td>
        <td>
          <b>Location:</b> <?php echo ViewUtils::GetIndexValue($user, 'location'); ?><br />
          <b>Age:</b> <?php echo ViewUtils::GetIndexValue($user, 'age'); ?><br />
          <span class='reputation'><?php echo Number::FormatUnit($user['reputation']); ?></span>
        </td>
      </tr>
    </table>
  </li>
  <li data-role="list-divider">About <?php echo $user['display_name']; ?></li>
  <li>
    <div class='item-body'>
      <?php echo ViewUtils::GetIndexValue($user, 'about_me', '[empty]'); ?>
    </div>
  </li>
  <?php

  // Get the total number of questions and answers
  $total_questions = $questions->Total(FALSE);
  if($total_questions)
  {
      $title = ($total_questions > 1)?"$total_questions questions":'question';
      echo "<li data-role='list-divider'>Top $title</li>";
      echo Post::GeneratePostList($site, $questions);
  }
  
  $total_answers   = $answers->Total(FALSE);
  if($total_answers)
  {
      $title = ($total_answers > 1)?"$total_answers answers":'answer';
      echo "<li data-role='list-divider'>Top $title</li>";
      echo Post::GeneratePostList($site, $answers);
  }
  
  ?>
</ul>