<?php
  function timecompute($roznica)
  {
    if($roznica < 3600) {
      $minutes = $roznica/60;
      $minutes = floor($minutes);
      $date = "$minutes minutes ago";
    }

    elseif($roznica < 86400) {
      $hours  = $roznica/3600;
      $hours = floor($hours);
      $date = "$hours hours ago";
    }

    elseif($roznica < 604800) {
      $days  = $roznica/86400;
      $days = floor($days);
      $date = "$days days ago";
    }

    elseif($roznica < 2629743.83) {
      $weeks = $roznica/604800;
      $weeks = floor($weeks);
      $date = "$weeks weeks ago";
    }

    elseif($roznica < 31556926) {
      $months = $roznica/2629743.83;
      $months = floor($months);
      $date = "$months months ago";
    }

    elseif($roznica < 315569260000) {
      $years = $roznica/31556926;
      $years = floor($years);
      $date = "$years years ago";
    }

    return $date;
  }
?>
