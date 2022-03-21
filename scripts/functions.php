<?php

  function __countTimer(int $time_past) {
    $time_now = time() - $time_past;
    $seconds = $time_now;
    $minutes = $seconds / 60;
    $hours = $minutes / 60;
    $days = $hours / 24;
    $weeks = $days / 7;
    $months = $weeks / 4;
    $years = $months / 12;
    if ($seconds < 60) {
      echo $time_now.' seconds ago';
    } elseif (floor($minutes) == 1) {
      echo floor($minutes).' minute ago';
    } elseif (floor($minutes) > 1 && floor($minutes) < 60) {
      echo floor($minutes).' minutes ago';
    } elseif (floor($hours) == 1) {
      echo floor($hours).' hour ago';
    } elseif (floor($hours) > 1 && floor($hours) < 24) {
      echo floor($hours).' hours ago';
    } elseif (floor($days) == 1) {
      echo floor($days).' day ago';
    } elseif (floor($days) > 1 && floor($days) < 7) {
      echo floor($days).' days ago';
    } elseif (floor($weeks) == 1) {
      echo floor($weeks).' week ago';
    } elseif (floor($weeks) > 1 && floor($weeks) < 4) {
      echo floor($weeks).' weeks ago';
    } elseif (floor($months) == 1) {
      echo floor($months).' month ago';
    } elseif (floor($months) > 1 && floor($months) < 12) {
      echo floor($months).' months ago';
    } elseif (floor($years) == 1) {
      echo floor($years).' year ago';
    } elseif ($years >= 1) {
      echo floor($years).' years ago';
    }
  }

?>
