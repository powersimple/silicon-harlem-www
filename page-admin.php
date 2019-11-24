<?php
    global $wpdb;
    $q = $wpdb->get_results("SELECT *  FROM `wp_postmeta` WHERE `meta_key` LIKE 'video_code%' and meta_value <> '' order by post_id");
    
    foreach($q as $v => $video){
        extract((array) $video);
        print "<a href='http://youtube.com/watch?v=$meta_value'>$meta_value</a><br>";
    }

?>