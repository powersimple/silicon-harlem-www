<?php




    function getPress(){

        $args = array( 
            'numberposts'		=> -1, // -1 is for all
            'post_type'		=> 'press', // or 'post', 'page'
            'orderby' 		=> 'title', // or 'date', 'rand'
            'order' 		=> 'ASC', // or 'DESC'

          );
          
          // Get the posts
          $press = get_posts($args);
          
          // If there are posts
          if($press):
            ?>
            <ul class="list">
            <?php
            // Loop the posts
            foreach ($press as $press_item):
                $id = $press_item->ID;
                $thumbnail_id = get_post_thumbnail_id($id);
                $permalink = get_permalink($id);
                $press_date = get_post_meta($id,"press_date",true);
                $article_author = get_post_meta($id,"article_author",true);
                $article_publication = get_post_meta($id,"article_publication",true);
                $article_url = get_post_meta($id,"article_url",true);
                
                $post_categories = wp_get_post_categories( $id );
                    $cats = array();
                    $post_tags = wp_get_post_tags( $id );

          ?>
           
              <!-- Image -->
           
              
          
                  <li>
                  <span class="press-thumbnail">
                  <?php if(@$thumbnail_id){
                      $src = getThumbnail($thumbnail_id,"thumbnail");
                      $meta = get_media_data($thumbnail_id);
                      ?>
                  
                        <img src="<?=$src?>" alt="<?=$meta['alt']?>">
                   
                   
                      <?php
                  }    

                  ?>
                   </span>
              <span class="article-link">
                   <span class="article-publication meta"><?=$article_publication?></span>
                   <span class="press-date meta"><?=date("M j, Y",$press_date);?></span>
                   <span class="article-author meta"><?=$article_author?></span>
                  
                       <a href="<?php print $article_url ?>" target="_blank"><?php echo get_the_title($id); ?></a><br>
                       


                       <?php
                        if($press_item->excerpt != ''){
                            ?>
                            <p><?=$press_item->excerpt?></p>
                            <?php
                        }

                    ?>
                    <span class="categories meta">
                        <?php    
                           foreach($post_categories as $c){
                                            $cat = get_category( $c );
                                            $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
                                            
                                            echo "<a href='/category/$cat->slug'>$cat->name</a> "; 
                                        }
                            ?></span>

                        <span class="tags meta">
                        <?php
                        
                        if ( $post_tags ) {
                            foreach( $post_tags as $tag ) {
                            echo "<a href='/tag/$tag->slug'>$tag->name</a> "; 
                            }
                        }
                        ?>
                        </span>

                </span></li>
                <?php echo $trimmed = wp_trim_words(get_the_content($id), 15, '...'); ?>
             
            
          
            <?php endforeach; wp_reset_postdata(); ?>
            </ul>
          <?php endif; 

    }
    function getPressItems(){
        
    }

?>