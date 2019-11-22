

<?php
get_header(); 


                    
?>

<section class="home-section home-parallax home-fade home-full-height" id="home">
<div id="particles-js"></div>
        <div class="hero-slider">

          <ul class="slides">
          <?php
    $slides = get_slides($post->ID);
    foreach ($slides as $key => $media_id) {
       $src= wp_get_attachment_image_src( $media_id,"Full");
       //var_dump($src);//var_dump(get_media_data($media_id));

        extract((array) get_media_data($media_id));
        ?>

          
            <li class="bg-dark-30 bg-dark" style="background-image:url(<?php echo $src[0];?>);">
              <div class="titan-caption">
                <div class="caption-content">
                  <div class="font-alt mb-30 titan-title-size-2">RE/THINK</div>
                  <div class="font-alt mb-40 titan-title-size-4"><?php echo $title?></div><a class="section-scroll btn btn-border-w btn-round" href="#about"><?php echo $caption?></a>
                </div>
              </div>
            </li>
            <?php
            }
          ?>
          </ul>
        </div>
      </section>
      <main class="main">
       

        
      <?php
 //require_once('lava.html');
$pages = get_home_children();
foreach($pages as $key => $value){
  extract((array)$value);

  if(!get_post_meta($ID,"redirect",true)){ //don't render if external url.

  

  ?>
      <section class="module" id="<?php echo $slug?>">
          <div class="container">
            <?php
            if(file_exists (get_stylesheet_directory()."/page-$slug.php") ){
              require_once(get_stylesheet_directory()."/page-$slug.php"); // includes page-slug.php if it exists
            } else {
            ?>
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2">
                <h2 class="module-title font-alt"><?php echo $title?></h2>
                <div class="panel-body"><?php echo wpautop($content);?></div>
              </div>
            </div>
            
            <?php 
              } 
            ?>

          </div>
         
           <?php
          }
          ?>
        </section>
        <?php 
          
          if(trim(@$section_foot) != ''){
            ?><div class="section-foot">
              <img  src="<?php echo getThumbnail($section_foot,"Full");?>">

        </div>
       

<?php
    }
  }
get_footer(); ?>