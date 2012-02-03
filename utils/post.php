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

require_once 'utils/date.php';
require_once 'utils/number.php';

class Post
{
    // Generate a list of tags
    public static function GenerateTagList($site, $tags)
    {
        $tags_html = array();
        
        foreach($tags as $tag)
        {
            // Generate the URL for the tag
            $tag_url = ViewUtils::GetDocumentRoot() . "/$site/tags/{$tag}";
            
            $tags_html[] = "<a href='$tag_url'class='tag'>$tag</a>";
        }
        
        return '<p class="tag-list">' . implode('', $tags_html) . '</p>';
    }
    
    // Generates a list of questions
    public static function GeneratePostList($site, $response)
    {
        $questions_html = array();
        
        while($question = $response->Fetch(FALSE))
        {
            // Generate the question title
            $title = $question['title'] . ((isset($question['closed_date']))?' [closed]':'');
            
            // Generate the brief portion of the question shown
            $preview = strip_tags($question['body']);
            $preview = substr($preview, 0, 100) . ((strlen($preview) > 100)?'&hellip;':'');
            
            // Generate the tags for the post if applicable
            if(isset($question['tags']))
                $tags_html = self::GenerateTagList($site, $question['tags']);
            else
                $tags_html = '';
            
            // Generate the URL for the question
            $question_url = ViewUtils::GetDocumentRoot() . "/$site/questions/{$question['question_id']}";
            
            $questions_html[] = "<li><a href='$question_url' class='question'><h3>$title</h3><p>$preview</p></a>$tags_html</li>";
        }
        
        if(count($questions_html))
            return implode('', $questions_html);
        else
            return '<li><span class="unknown">[empty]</span></li>';
    }
    
    // Generates a user box
    public static function GenerateUserBox($site, $user, $timestamp)
    {
        // Determine if the user exists or not
        if($user['user_type'] == 'does_not_exist')
        {
            $opening_element = "<div data-role='button' class='ui-disabled user-box'>";
            $closing_element = '</div>';
            $reputation = '';
            $gravatar = "<img src='http://www.gravatar.com/avatar/0?s=32&d=mm' />";
        }
        else
        {
            $profile_url = ViewUtils::GetDocumentRoot() . "/$site/users/{$user['user_id']}";
            $opening_element = "<a href='$profile_url' data-role='button' class='user-box'>";
            $closing_element = '</a>';
            $reputation = '<span class="reputation">' . Number::FormatUnit($user['reputation']) . '</span>';
            $gravatar = "<img src='{$user['profile_image']}&s=32' />";
        }
        
        // Generate the date for the timestamp
        $date = Date::RelativeTime($timestamp);
        
        return "$opening_element$reputation$gravatar{$user['display_name']}<br />$date$closing_element";
    }
    
    // Generates a list of comments
    public static function GenerateCommentButton($site, $comments, $post_id)
    {
        // Generate the comment HTML
        $comments_html = "<ul id='comment_content_$post_id' data-role='listview' data-inset='true'>";
        
        foreach($comments as $comment)
        {
            if($comment['owner']['user_type'] == 'does_not_exist')
                $comments_html .= '<li>' . strip_tags($comment['body']) . " - <b>{$comment['owner']['display_name']}</b></li>";
            else
            {
                // Generate the URL for the comment
                $comment_url = ViewUtils::GetDocumentRoot() . "/$site/users/{$comment['owner']['user_id']}";
                
                $comments_html .= "<li><a href='$comment_url'>" . strip_tags($comment['body']) . " - <b>{$comment['owner']['display_name']} <span class='reputation'>" . Number::FormatUnit($comment['owner']['reputation']) . '</span></b></a></li>';
            }
        }
        
        $comments_html .= '</ul>';
        
        $s = (($count = count($comments)) == 1)?'':'s';
        return "<div id='comment_$post_id' class='comment'><div data-role='button' id='comment_button_$post_id' onclick='ShowComments($post_id);'>Show $count comment$s</div>$comments_html</div>";
    }
}

?>