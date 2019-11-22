<?php

    /* OLD RELIABLE!
        HASN'T CHANGED IN YEARS
            RETURNS URL BY ID, AND OPTIONAL SIZE */
		function getThumbnail($id,$use="full"){
			global $post;
			
			
			$img = wp_get_attachment_image_src(  $id, $use);
			if($img[0] !=""){
			} 
			return $img[0];
			
		}
	
	
		
	
	
		/* 	PASS ID AND IT RETURNS OBJECT OF SIZES BY URL */
		function getThumbnailVersions($id){
				global $post;
				$thumbnail_versions = array(); //creates the array of size by url
				$thumbnail_versions['original'] = getThumbnail($id);
				foreach(get_intermediate_image_sizes() as $key => $size){//loop through sizes
					$img = wp_get_attachment_image_src($id,$size);//get the url 
					
					if($img[0] !=""){
						$thumbnail_versions[$size]=$img[0];//sets size by url
					} 
				}
				return $thumbnail_versions;
			
		}
	
	
	
	
		//Embed Video  Shortcode
	
		function video_shortcode( $atts, $content = null ) {
			//set default attributes and values
			$values = shortcode_atts( array(
				'url'   	=> '#',
				'className'	=> 'video-embed',
				'aspect' => '56.25%'
			), $atts );
			
			ob_start();
			?>
			<div class="video-wrapper">
				<iframe src="<?php echo $values['url']?>" class="<?php echo $values['className']?>"></iframe>
			</div> 
			<?php
			return ob_get_clean();
			//return '<a href="'. esc_attr($values['url']) .'"  target="'. esc_attr($values['target']) .'" class="btn btn-green">'. $content .'</a>';
		
		}
		add_shortcode( 'embed_video', 'video_shortcode' );
//
		function get_media_data( $id ) { //this function builds the data for a lean json packet of media
			$data = array();   
			$url = wp_upload_dir();
			$upload_path = $url['baseurl']."/";
			$file_path = str_replace($upload_path,'',wp_get_attachment_url($id));
			$file = basename($file_path);
			$path = str_replace($file,"",$file_path);
			$mime = get_post_mime_type( $id );
			$meta  = (array) wp_get_attachment_metadata( $id,true);
			$meta_data = array();
			
			//	The meta data properties are only accessible inside a loop for some dumb reason.
		
			if(strpos($mime,'mage/') && !strpos($mime,'svg')){ // the i is left of so the strpos returns a postive value
				$meta_data = array();
				foreach($meta as $key => $value){
					if($key == 'width'){
						$meta_data['w'] = $value;
					} else if($key == 'height'){
						$meta_data['h'] = $value;
					} else if($key == 'sizes'){
						$meta_data['sizes'] = array();
						foreach($meta[$key] as $size_name => $props){
							$meta_data['sizes'][$size_name] = $meta[$key][$size_name]['file'];
						}
					}
					//
				}
			} else {
				//let non image mimetypes pass their full metadata
				$meta_data = $meta;
			}
			$image_post = get_post($id);
			$data = array(
			
				'alt' => get_post_meta($id,"_wp_attachment_image_alt",true),
				'caption' => wp_get_attachment_caption($id),
				'title'=> get_the_title($id),
				'desc' => $image_post->post_content,
				'path'=> $path,
				'file' => $file,
				'mime' => $mime,
				'meta' => $meta_data
				
			);
		return $data;//from functions.php,
		}

		

?>