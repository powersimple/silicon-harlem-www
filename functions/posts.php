<?php




    function getPostsByType($post_type){
       
        $args = array( 
            'numberposts'		=> -1, // -1 is for all
            'post_type'		=> $post_type, // or 'post', 'page'
            'orderby' 		=> 'title', // or 'date', 'rand'
            'order' 		=> 'ASC', // or 'DESC'

          );
          // Get the posts
          $results = get_posts($args);
          
          // If there are posts
          if($results):
            ?>
            <ul class="list">
            <?php
            // Loop the posts
            foreach ($results as $result):
                $id = $result->ID;
               

               
                
               
          ?>
           
              <!-- Image -->
           
              
          
                  <li>
                  <?php
                    if($post_type == 'press'){
                      getPressItems( $result);
                    }
                  ?>
                
                 
                 
                 </li>
                <?php echo $trimmed = wp_trim_words(get_the_content($id), 15, '...'); ?>
             
            
          
            <?php endforeach; wp_reset_postdata(); ?>
            </ul>
          <?php endif; 

    }
    function getPostsByCategory($category){
        global $wp_query;
        $original_query = $wp_query;
        $wp_query = null;
        $args=array('posts_per_page'=>5, 'category' => $category);
        $wp_query = new WP_Query( $args );
        if ( have_posts() ) :
            while (have_posts()) : the_post();
            $permalink = get_permalink(get_the_id());
                echo "<li><a href='$permalink'>";
                the_title();
                echo '</a></li>';
            endwhile;
        endif;
        $wp_query = null;
        $wp_query = $original_query;
        wp_reset_postdata();
    }
    function getPostsByTag($tag){
        global $wp_query;
        $original_query = $wp_query;
        $wp_query = null;
        $args=array('posts_per_page'=>5, 'tag' => $tag);
        $wp_query = new WP_Query( $args );
        if ( have_posts() ) :
            while (have_posts()) : the_post();
            $permalink = get_permalink(get_the_id());
            echo "<li><a href='$permalink'>";
            the_title();
            echo '</a></li>';
            endwhile;
        endif;
        $wp_query = null;
        $wp_query = $original_query;
        wp_reset_postdata();
    }
    


    function getPressItems($result){
        $id = $result->ID;
        $thumbnail_id = get_post_thumbnail_id($id);
        $permalink = get_permalink($id);
        $post_categories = wp_get_post_categories( $id );
        $cats = array();
        $post_tags = wp_get_post_tags( $id );

        $thumbnail_id = get_post_thumbnail_id($id);
        $permalink = get_permalink($id);
        $post_categories = wp_get_post_categories( $id );
        $cats = array();
        $post_tags = wp_get_post_tags( $id );

        ?>
        <span class="press-thumbnail">
        <?php 
        //post_type specific metadata
        $press_date = get_post_meta($id,"press_date",true);
        $article_author = get_post_meta($id,"article_author",true);
        $article_publication = get_post_meta($id,"article_publication",true);
        $article_url = get_post_meta($id,"article_url",true);
        
        if(@$thumbnail_id){
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
        
             <a href="<?php print $article_url ?>" target="_blank" class="article-link"><?php echo get_the_title($id); ?></a><br>
             


             <?php
              if($result->excerpt != ''){
                  ?>
                  <p><?=$result->excerpt?></p>
                  <?php
              }

          ?>
          <span class="categories meta">
              <?php    
                  $cats_array = array();
                 foreach($post_categories as $c){
                                  $cat = get_category( $c );
                                  $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
                                  
                                  array_push($cats_array, "<a href='/category/$cat->slug'>$cat->name</a> "); 
                              }
                      print implode(", ",$cats_array);
                  ?></span>

              <span class="tags meta">
              <?php
              $tags_array = array();
              if ( $post_tags ) {
                  foreach( $post_tags as $tag ) {
                  array_push($tags_array, "<a href='/tag/$tag->slug'>$tag->name</a>"); 
                  }
                  print implode(", ",$tags_array);
              }
              ?>
              </span>

      </span>
      <?php
    }

?>