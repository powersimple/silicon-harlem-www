<?php

		function getSessions($parent){
			global $wpdb;
			$q = $wpdb->get_results("
			select ID, post_name, post_date, post_title, post_content
			from wp_posts
			where post_type = 'session'
			and post_parent = '$parent'
			and post_status='publish'
			
			order by menu_order
				");
			$sessions = array();
			foreach($q as $key => $value){
				extract((array) $value);


				array_push($sessions,
				array(
					"id" => $ID,
					"title" =>$post_title,
					"content" => urlencode($post_content),
					"slug" => $post_name,
					"start"=>get_post_meta($ID,"session_start",true),
					"end"=>get_post_meta($ID,"session_end",true),
					"thumbnail" => get_post_thumbnail_id($ID),
					"sponsors" => get_post_meta($ID,"sponsors"),
					"speakers" => get_post_meta($ID,"speakers")
				));

			}
			return $sessions;
		}
		function sessionTime($start,$end){

			$start_time = date("g:i a",$start);
			if(@$end){
				$end_time = date("g:i a",strtotime(@$end));
			}
			return $start_time." - ".@$end_time;
		}
	
		function registrationButton(){
			return "<div class='button-wrap'><a class='registration-button' href='https://www.eventbrite.com/e/sh6-the-silicon-harlem-sixth-annual-next-gen-tech-conference-tickets-68730052437' target='_new' >REGISTER NOW</a></div>";
		}
