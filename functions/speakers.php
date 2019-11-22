<?php
    	function getSpeaker($speaker_id){
			global $wpdb;
			$q = $wpdb->get_row("
			select ID, post_name, post_date, post_excerpt, post_title, post_content
			from wp_posts
			where ID= $speaker_id
			
			order by menu_order
				");
				extract((array) $q);
			$speaker = array(
				"id" => $speaker_id,
				"speaker_name" =>@$post_title,
				"content" => @$post_content,
				"excerpt" => @$post_excerpt,
				
				"slug" => @$post_name,
				"speaker_title" => get_post_meta($speaker_id,"speaker_title",true),
				"speaker_company" => get_post_meta($speaker_id,"speaker_company",true),
				"speaker_website" => get_post_meta($speaker_id,"speaker_website",true),
				"speaker_wikipedia" => get_post_meta($speaker_id,"speaker_wikipedia",true),
				"speaker_twitter" => get_post_meta($speaker_id,"speaker_twitter",true),
				"speaker_facebook" => get_post_meta($speaker_id,"speaker_facebook",true),
				"speaker_linkedin" => get_post_meta($speaker_id,"speaker_linkedin",true),
				"speaker_flickr" => get_post_meta($speaker_id,"speaker_flickr",true),
				"speaker_instagram" => get_post_meta($speaker_id,"speaker_instagram",true),
				
				"thumbnail" => get_post_thumbnail_id(@$ID),
				"featured_image" => get_media_data(get_post_thumbnail_id(@$ID)),
                "permalink" => get_permalink($speaker_id)
			);
			
			return $speaker;

		}
		function displaySpeaker($speaker_data,$media_size,$context="none"){
			extract($speaker_data);
			
			$src= getThumbnail($thumbnail,$media_size);
			
			if($context=="long"){
				print '<div class="speaker-long-bio">';
				 print '<div class="speaker-info col-xs-12  ">';
			} else if($context=="speaker-list"){
				print '<div class="speaker-list col-sm-6 col-md-4 col-lg-3">';
				 print '<div class="speaker-info col-xs-12 col-sm-6 col-md-5 col-lg-4">';
				
			} else {
				print '<div class="speaker-short-bio">';
				 print '<div class="speaker-info col-xs-12 col-sm-6 col-md-5 col-lg-4">';
				
			}
			
           
           
			if($src != ""){
                print '<div class="speaker-image  col-xs-offset-4 col-xs-4 col-sm-offset-2 col-sm-8">';
				
				print '<img src="'.$src.'" alt="'.$speaker_name.'"></div>';
				print '</a>';
            }
           
            print '<div class="speaker-vitals col-xs-12 col-sm-12">';
           
			speakerVitals($speaker_data);
			
            print "</div>
            </div>";
			if(@$context == 'long'){
				 print '<div class="speaker-excerpt col-xs-12  col-lg-12 ">';
				print do_blocks($content);
				 print '</div">';
            } else if(@$context=="speaker-list"){
				//print '<div style="clear:both;width:100%;"></div>';
			//	print "SESSION:".$session;
			} else if(@$context == 'short'){
				 print '<div class="speaker-excerpt col-xs-12 col-sm-6 col-md-7 col-lg-8">';
			   print do_blocks($excerpt);
			   print '<br><a href="'.$permalink.'" class="read-more">Read More</a>';
			    print '</div>';
            } else{
                
            }
            print '</div>';
		}
		function speakerVitals($speaker_data){
				extract($speaker_data);
							print "<div class='social'>
			";

			if(@$speaker_website){
				print '<a href="'.$speaker_website.'" target="_blank"><i class="fa fa-link"></i></a>';
			}
			if(@$speaker_wikipedia){
				print '<a href="'.$speaker_wikipedia.'" target="_blank"><i class="fa fa-wikipedia-w"></i></a>';
			}
			if(@$speaker_linkedin){
				print '<a href="'.$speaker_linkedin.'" target="_blank"><i class="fa fa-linkedin"></i></a>';
			}
			if(@$speaker_twitter){
				print '<a href="'.$speaker_twitter.'" target="_blank"><i class="fa fa-twitter"></i></a>';
			}
			if(@$speaker_facebook){
				print '<a href="'.$speaker_facebook.'" target="_blank"><i class="fa fa-facebook"></i></a>';
			}
			
			if(@$speaker_instagram){
				print '<a href="'.$speaker_instagram.'" target="_blank"><i class="fa fa-instagram"></i></a>';
			}
			if(@$speaker_flickr){
				print '<a href="'.$speaker_flickr.'" target="_blank"><i class="fa fa-flickr"></i></a>';
			}
			
			print "</div>";//social
				

			print '<strong>';
			print '<a href="'.$permalink.'">';
			print $speaker_name;
			print "</strong>";
			print "</a>";
			
			 print "<div class='affiliation'>";
			if(@$speaker_title && @$context != "speaker-list"){
				print @$speaker_title.",<br>";
			}
			if(@$speaker_company){
				print @$speaker_company."<br>";
			}
			print "</div>";
			
		}

        function speakerList($speakers){
            $speaker_list = array();
           
			foreach($speakers as $key=>$speaker){
				array_push($speaker_list,getSpeaker($speaker));
				
            }
            return $speaker_list;
		}
		

		function getSpeakers($parent=0){
			global $wpdb;
			$sql ="
			select ID
			from wp_posts
			where post_status = 'publish' 
			and post_type = 'speaker'
			and post_parent = $parent
			order by menu_order
				";
		$q = $wpdb->get_results($sql);
			$speaker_list = array();
			foreach($q as $key=>$value){
				array_push($speaker_list,getSpeaker($value->ID));
				
            }
				
			return $speaker_list;

		}


		

?>