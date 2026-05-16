<?php
date_default_timezone_set('Asia/Kolkata');
function timeAgo($datetime) {
    $timestamp = strtotime($datetime);
    $difference = time() - $timestamp;

    if ($difference < 60) {
        return ($difference == 1) ? "1 second ago" : $difference . " seconds ago";
    }

    else if ($difference < 3600) {
        $minutes = floor($difference / 60);
        return ($minutes == 1) ? "1 minute ago" : $minutes . " minutes ago";
    }

    else if ($difference < 86400) {
        $hours = floor($difference / 3600);
        return ($hours == 1) ? "1 hour ago" : $hours . " hours ago";
    }

    else if ($difference < 604800) {
        $days = floor($difference / 86400);
        return ($days == 1) ? "1 day ago" : $days . " days ago";
    }

    else if ($difference < 2592000) {
        $weeks = floor($difference / 604800);
        return ($weeks == 1) ? "1 week ago" : $weeks . " weeks ago";
    }

    else if ($difference < 31536000) {
        $months = floor($difference / 2592000);
        return ($months == 1) ? "1 month ago" : $months . " months ago";
    }

    else {
        $years = floor($difference / 31536000);
        return ($years == 1) ? "1 year ago" : $years . " years ago";
    }
}
?>