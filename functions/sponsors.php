<?php

    function sponsorGridLevel($sponsor_level,$sponsor_count){
        $bootstrap= 'col-sm-6 col-md-3 col-lg-3';//default
        $max_per_level = 6;//default
        if($sponsor_count){ 
            $grid_lock = (12/$sponsor_count);
            if($grid_lock != intval($grid_lock)){
              //  print $grid_lock;
            }

            
           
            if($sponsor_level == 'Terrabit'){
                $max_per_level = 1;
            } else if($sponsor_level == 'Gigabit'){
                $max_per_level = 2;
                //return "col-xs-12 col-sm-5 col-sm-offset-1";
            } else if($sponsor_level == 'Megabit'){
                $max_per_level = 4;
             } else if($sponsor_level == 'Partner'){
                $max_per_level = 4;    
            } else if($sponsor_level == 'Production'){
                $max_per_level = 1;
            } else if($sponsor_level == 'Community Partner'){
                $max_per_level = 1;
                
            } else if($sponsor_level == 'Community'){
                $max_per_level = 4;
                
            } else if($sponsor_level == 'Printing'){
                $max_per_level = 1;
            } else if($sponsor_level == 'Streaming'){
                $max_per_level = 1;
            } else {
                //$sponsor_level == 'Community'){   
                //return 'col-sm-6 col-md-4 col-lg-4';
                $max_per_level = 6;
            } /*else if($sponsor_level == 'Previous'){
                  //  return 'col-sm-3 col-sm-offset-1 col-xs-5 col-xs-offset-1';
    

            } else{
                //return 'col-sm-6 col-md-3 col-lg-3';
            }*/
           // print $sponsor_level ." ".$sponsor_count." ".$max_per_level."<br>";
            if($max_per_level == 1){
                $bootstrap = "col-xs-12 col-sm-6 col-sm-offset-3";
                 if($sponsor_level == 'Streaming'){
                         $bootstrap = "col-xs-4 col-xs-offset-4 ol-sm-4 col-sm-offset-4 ";
                    } else if($sponsor_level == 'Production'){
                      $bootstrap = "col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4";
                    }
                    else if($sponsor_level == 'Community Partner'){
                      $bootstrap = "col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4";
                    }
                    else if($sponsor_level == 'Printing'){
                      $bootstrap = "col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4 col-md-3 col-md-offset-5";
                    }
              //  print "terrabit";
            }
            if($max_per_level == 2){
            //    print "gigabit";

                if($sponsor_count == 1){
                    $bootstrap = "col-xs-8 col-xs-offset-2";

                } else if ($sponsor_count == 2){
                    $bootstrap = "col-xs-3 col-xs-offset-2";

                } else if ($sponsor_count){
                    $bootstrap = "col-xs-4 col-xs-offset-1";

                } 

            } 
             if($max_per_level == 3){
               if($sponsor_count == 3){
                    $bootstrap = "col-xs-2 col-xs-offset-1";

                }
             }
             if($max_per_level == 4){
               if($sponsor_count == 1){
                    $bootstrap = "col-xs-offset-4 col-xs-4";

                } else if ($sponsor_count == 2){
                    $bootstrap = "col-xs-3 col-xs-offset-2";

                } else if ($sponsor_count){
                    $bootstrap = "col-xs-2 col-xs-offset-1";

                } 
              //  print "terrabit";
            }
            if($max_per_level == 6){
                if($sponsor_count == 3){
                    $bootstrap = "col-xs-4 col-sm-3 col-sm-offset-1 col-md-2 offset-2";
                } else {

                }
            }
            



            return $bootstrap;
        }
    }
    
    function sponsorLevelHeader($sponsor_level){
            if($sponsor_level == 'Terrabit'){
            } else if($sponsor_level == 'Gigabit'){
            } else if($sponsor_level == 'Megabit'){
            } else if($sponsor_level == 'Production'){
                return "<h4>Production Partner</h4>";
            }else if($sponsor_level == 'Printing'){
                    return "<h4>Printing</h4>";

            } else if($sponsor_level == 'Streaming'){
                    return "<h4>Livestream by</h4>";

            }else if($sponsor_level == 'Community'){
                  //  return "<h3>Community Partners</h3>";
            } else {

            }
    }

    function displaySponsors($parent,$sponsor_level){
       $sponsors = getSponsorLevel($parent,$sponsor_level);
      
        $bootstrap = sponsorGridLevel($sponsor_level,count($sponsors)); //calculates grid based on level and sponsors per
       
        foreach($sponsors as $key => $sponsor){
            extract( $sponsor);
            //var_dump($sponsor);


            print '<div class="'.$bootstrap.' sponsor '.strtolower($sponsor_level).'">';
             print sponsorLevelHeader($sponsor_level);
            $src= getThumbnail($thumbnail,"Full");
            print '<a href="'.$sponsor_url.'" target="_blank">';
            if($src == ''){
                print "<strong>$sponsor_name</strong>";
            } else {
            print '<img src="'.$src.'" alt="'.$sponsor_name.'">';
            }

            print '</a></div>';

        }
        
    }
    function getSponsorLevel($parent,$level){
        global $wpdb;
        
        $q = $wpdb->get_results("
            select p.ID, p.post_name, p.post_date, p.post_title, p.post_content
            from wp_posts p, wp_postmeta m
            where p.post_type = 'sponsor' 
            and p.post_status='publish'
            and p.post_parent = $parent
            and m.meta_key = 'sponsor_level'
            and m.meta_value = '$level'
            and m.post_id = p.ID
            order by menu_order
        ");
        $sponsors = array();
        
        foreach($q as $key => $value){
            extract((array) $value);

            array_push($sponsors,
            array(
                "id" => $ID,
                "sponsor_name" =>$post_title,
                "sponsor_url"=>get_post_meta($ID,"sponsor-url",true),
                "sponsor_level"=>get_post_meta($ID,"sponsor_level",true),
                "thumbnail" => get_post_thumbnail_id($ID)
            ));

        }
    return $sponsors;
    }
    function sponsorList($sponsors){
        $sponsor_list = array();
        foreach($sponsors as $key=>$sponsor_id){
            array_push($sponsor_list,getSponsor($sponsor_id));
        }
        return $sponsor_list;
    }
    function getSponsor($sponsor_id){
        global $wpdb;
        $q = $wpdb->get_row("
        select ID, post_name, post_date, post_excerpt, post_title, post_content
        from wp_posts
        where ID= $sponsor_id
        
        order by menu_order
            ");
            extract((array) $q);
        $sponsor = array(
            "id" => $sponsor_id,
            "sponsor_name" =>$post_title,
            "content" => $post_content,
            "excerpt" => $post_excerpt,
            
            
            "sponsor_url" => get_post_meta($sponsor_id,"sponsor-url",true),
            "sponsor_level" => get_post_meta($sponsor_id,"sponsor_level",true),
            "thumbnail" => get_post_thumbnail_id($ID),
        );
        
        return $sponsor;

    }
    function displaySponsor($sponsor_data){
        extract($sponsor_data);

         $src= getThumbnail($thumbnail,"thumbnail");
        
    
        print '<a class="" href="'.$sponsor_url.'" target="blank">';
        if($src != ''){
            print '<img class="sponsor '.strtolower($sponsor_level).'" src="'.$src.'" alt="'.$sponsor_name.'">';
        } else {
            print $sponsor_name;
        }
        
        print '</a>';

       
    }
?>