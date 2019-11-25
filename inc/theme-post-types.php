<?php
function posts_type() {
    
 /*   register_post_type( 'team',
        array(
            'labels'            => array(
                'name'               => __( 'Team', 'metrika' ),
                'singular_name'      => __( 'Members Item', 'metrika' ),
                'all_items'          => __('Members List', 'metrika'),
                'add_new'            => 'Add New',
                'not_found'          => 'No team members found.',
                'not_found_in_trash' => 'No team members found in Trash',
                'add_new_item'       => 'Add New Team Member'
                ),
            'show_in_nav_menus' => false,
            'public'            => true,
            'supports'          => array(
                'title',
                'thumbnail',
                'editor'
                ),
        ));
*/
    register_post_type( 'press',
        array(
            'labels' => array(
            'name' => __( 'Press', 'metrika' ),
            'singular_name' => __( 'Press', 'metrika' ),
            'all_items' => __('Press List', 'metrika'),
            'has_archive' => true,
            'show_ui' => true,
            'add_new' => 'Add Press',
            'not_found' => 'No found.',
            'not_found_in_trash' => 'In the cart slides found',
            'add_new_item' => 'Add Press Item'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'content',
                'thumbnail',
                'editor',
                'excerpt'
            ),
            'show_ui' => true,
            'taxonomies' => array('post_tag','category')
        ));

        
    register_post_type( 'works',
        array(
            'labels' => array(
            'name' => __( 'What We Do', 'metrika' ),
            'singular_name' => __( 'What we do', 'metrika' ),
            'all_items' => __('List of We Do', 'metrika'),
            'has_archive' => true,
            'add_new' => 'Add New What We do',
            'not_found' => 'No found.',
            'not_found_in_trash' => 'In the cart slides found',
            'add_new_item' => 'Add New Work'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
                'content'
            ),
        ));
        
        register_post_type( 'program',
        array(
            'labels' => array(
            'name' => __( 'Education', 'metrika' ),
            'singular_name' => __( 'Education Program', 'metrika' ),
            'all_items' => __('Program List', 'metrika'),
            'has_archive' => true,
            'add_new' => 'Add New Program',
            'not_found' => 'No found.',
            'not_found_in_trash' => 'In the cart slides found',
            'add_new_item' => 'Add New Program'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
                'content'
            ),
            'show_ui' => true,
            'taxonomies' => array('post_tag','category')
        ));
        register_post_type( 'event',
        array(
            'labels' => array(
            'name' => __( 'Events', 'metrika' ),
            'singular_name' => __( 'Events', 'metrika' ),
            'all_items' => __('Event List', 'metrika'),
            'has_archive' => true,
            'add_new' => 'Add New',
            'not_found' => 'No found.',
            'not_found_in_trash' => 'In the cart slides found',
            'add_new_item' => 'Add New Event'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
                'content'
            ),
            'show_ui' => true,
            'taxonomies' => array('post_tag','category')
        ));
}
add_action( 'init', 'posts_type' );

register_taxonomy('works-category', 'works', array(
    'label'             => __('Works Categories', 'precise'),
    'show_in_nav_menus' => false,
));

register_taxonomy('program-category', 'program', array(
    'label'             => __('Program Categories', 'precise'),
    'show_in_nav_menus' => false,
));
register_taxonomy('event-category', 'event', array(
    'label'             => __('Event Categories', 'precise'),
    'show_in_nav_menus' => false,
));
function add_metrika_meta_box() {
    add_meta_box('page_animation', __('Page Animation', 'metrika'), 'page_animation', 'page', 'side');
    add_meta_box('team_social', __('Social Link', 'metrika'), 'team_social', 'team', 'side');
    add_meta_box('team_job', __('Job Title', 'metrika'), 'team_job', 'team', 'side');
    add_meta_box('works_client', __('Client', 'metrika'), 'works_client', 'works', 'side');
    add_meta_box('works_link', __('Project Link', 'metrika'), 'works_link', 'works', 'side');
    add_meta_box('works_video_link', __('Project Video Link', 'metrika'), 'works_video_link', 'works', 'side');
    add_meta_box('works_gallery', __('Project Gallery', 'metrika'), 'works_gallery', 'works');

     add_meta_box('program_client', __('Client', 'metrika'), 'program_client', 'program', 'side');
    add_meta_box('program_link', __('Project Link', 'metrika'), 'program_link', 'program', 'side');
    add_meta_box('program_video_link', __('Project Video Link', 'metrika'), 'program_video_link', 'program', 'side');
    add_meta_box('program_gallery', __('Project Gallery', 'metrika'), 'program_gallery', 'program');

    
     add_meta_box('event_client', __('Client', 'metrika'), 'event_client', 'event', 'side');
    add_meta_box('event_link', __('Project Link', 'metrika'), 'event_link', 'event', 'side');
    add_meta_box('event_video_link', __('Project Video Link', 'metrika'), 'event_video_link', 'event', 'side');
    add_meta_box('event_gallery', __('Project Gallery', 'metrika'), 'event_gallery', 'event');

}
add_action('admin_init', 'add_metrika_meta_box');








/*
 * Page Animation Meta Box Input
 */
function page_animation($post) {
    ?>
    <p><strong><?php _e('Select Animation:', 'metrika') ?></strong></p>
    <?php
    $page_animation = get_post_meta($post->ID, 'page_animation', true);
    if (empty($page_animation)) $page_animation = 0;
    animationList('page-animation', $page_animation, 'page_animation');
}

/*
 * Team Socia Meta Box Input
 */
function team_social($post) {
    ?>
    <input id="social_team_input" type="hidden" name="team_social" value="<?php echo get_post_meta($post->ID, 'team_social', true); ?>" />
    <?php socialIconsList('team_social_select') ?>
        <input type="text" placeholder="<?php _e('URL', 'metrika') ?>" class="team_social_link">
        <a href="#" id="team_social_add" class="button button-primary button-large"><?php _e('Add', 'precise' ); ?></a>
        <div class="team_social_preview">
            <ul class="unstyled">
            <?php
            if (get_post_meta($post->ID, 'team_social', true) !== '') {
                echo do_shortcode(get_post_meta($post->ID, 'team_social', true));
            }
            ?>
            </ul>
        </div>
    <?php
}

/*
 * Team Job Title Meta Box Input
 */
function team_job($post) {
    ?>
    <input type="text" name="team_job" class="team_custom_input" value="<?php echo get_post_meta($post->ID, 'team_job', true) ?>">
    <?php
}

/*
 * Works Client Meta Box Input
 */
function works_client($post) {
    ?>
    <p></p>
    <input type="text" name="works_client" class="works_custom_input" value="<?php echo get_post_meta($post->ID, 'works_client', true) ?>">
    <?php
}

/*
 * Works Link Meta Box Input
 */
function works_link($post) {
    ?>
    <p></p>
    <input type="text" name="works_link" class="works_custom_input" value="<?php echo get_post_meta($post->ID, 'works_link', true) ?>">
    <?php
}

/*
 * Works Video Link Meta Box Input
 */
function works_video_link($post) {
    ?>
    <p></p>
    <input type="text" name="works_video_link" class="works_custom_input" value="<?php echo get_post_meta($post->ID, 'works_video_link', true) ?>">
    <?php
}
function program_client($post) {
    ?>
    <p></p>
    <input type="text" name="program_client" class="program_custom_input" value="<?php echo get_post_meta($post->ID, 'program_client', true) ?>">
    <?php
}

/*
 * Works Link Meta Box Input
 */
function program_link($post) {
    ?>
    <p></p>
    <input type="text" name="program_link" class="program_custom_input" value="<?php echo get_post_meta($post->ID, 'program_link', true) ?>">
    <?php
}

/*
 * Works Video Link Meta Box Input
 */
function program_video_link($post) {
    ?>
    <p></p>
    <input type="text" name="program_video_link" class="program_custom_input" value="<?php echo get_post_meta($post->ID, 'program_video_link', true) ?>">
    <?php
}

function event_client($post) {
    ?>
    <p></p>
    <input type="text" name="event_client" class="event_custom_input" value="<?php echo get_post_meta($post->ID, 'event_client', true) ?>">
    <?php
}

/*
 * Works Link Meta Box Input
 */
function event_link($post) {
    ?>
    <p></p>
    <input type="text" name="event_link" class="event_custom_input" value="<?php echo get_post_meta($post->ID, 'event_link', true) ?>">
    <?php
}

/*
 * Works Video Link Meta Box Input
 */
function event_video_link($post) {
    ?>
    <p></p>
    <input type="text" name="event_video_link" class="event_custom_input" value="<?php echo get_post_meta($post->ID, 'event_video_link', true) ?>">
    <?php
}


/*
 * Works Gllery
 */
function works_gallery($post) {
    ?>
    <p class="clearfix"></p>
    <input type="hidden" id="portfolio_gallery" name="portfolio_gallery" value="<?php echo get_post_meta($post->ID, 'portfolio_gallery', true) ?>">
    <a href="#" id="add_gallery_img" class="button button-primary button-large"><?php _e('Add Gallery Image', 'metrika'); ?></a>
    <ul id="gallery_list">
        <?php $json = json_decode(html_entity_decode(get_post_meta($post->ID, 'portfolio_gallery', true)), true); ?>
        <?php if (!empty($json)) : ?>
            <?php foreach ($json as $item) : ?>
                <?php if (!empty($item)) : ?>
                <li data-img-id="<?php echo $item['id'] ?>">
                    <a href="#" class="remove_gallery_img"><i class="fa fa-trash-o"></i></a>
                    <?php echo wp_get_attachment_image($item['id'], 'works-small'); ?>
                </li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <?php
}
function program_gallery($post) {
    ?>
    <p class="clearfix"></p>
    <input type="hidden" id="portfolio_gallery" name="portfolio_gallery" value="<?php echo get_post_meta($post->ID, 'portfolio_gallery', true) ?>">
    <a href="#" id="add_gallery_img" class="button button-primary button-large"><?php _e('Add Gallery Image', 'metrika'); ?></a>
    <ul id="gallery_list">
        <?php $json = json_decode(html_entity_decode(get_post_meta($post->ID, 'portfolio_gallery', true)), true); ?>
        <?php if (!empty($json)) : ?>
            <?php foreach ($json as $item) : ?>
                <?php if (!empty($item)) : ?>
                <li data-img-id="<?php echo $item['id'] ?>">
                    <a href="#" class="remove_gallery_img"><i class="fa fa-trash-o"></i></a>
                    <?php echo wp_get_attachment_image($item['id'], 'works-small'); ?>
                </li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <?php
}
function event_gallery($post) {
    ?>
    <p class="clearfix"></p>
    <input type="hidden" id="portfolio_gallery" name="portfolio_gallery" value="<?php echo get_post_meta($post->ID, 'portfolio_gallery', true) ?>">
    <a href="#" id="add_gallery_img" class="button button-primary button-large"><?php _e('Add Gallery Image', 'metrika'); ?></a>
    <ul id="gallery_list">
        <?php $json = json_decode(html_entity_decode(get_post_meta($post->ID, 'portfolio_gallery', true)), true); ?>
        <?php if (!empty($json)) : ?>
            <?php foreach ($json as $item) : ?>
                <?php if (!empty($item)) : ?>
                <li data-img-id="<?php echo $item['id'] ?>">
                    <a href="#" class="remove_gallery_img"><i class="fa fa-trash-o"></i></a>
                    <?php echo wp_get_attachment_image($item['id'], 'works-small'); ?>
                </li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
    <?php
}
function getImage() {
    echo '<li data-img-id="' . $_POST['img_id'] . '">';
    echo '<a href="#" class="remove_gallery_img button">' . __('Remove', 'metrika') . '</a>';
    echo wp_get_attachment_image($_POST['img_id'], 'works-small');
    echo '</li>';
    die();
}
add_action('wp_ajax_metrika_getImage', 'getImage');
add_action('wp_ajax_nopriv_metrika_getImage', 'getImage');

/*
 * Save Meta Box
 */
function save_meta_box($post_id) {
    
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
        return $post_id;
    
    if ( !current_user_can( 'edit_post', $post_id ) )
        return $post_id;
    
    $post = get_post($post_id);
    if ($post->post_type == 'team') {
        $social = !empty($_POST['team_social']) ? $_POST['team_social'] : '';
        $job    = !empty($_POST['team_job'])    ? $_POST['team_job']    : '';
        update_post_meta($post_id, 'team_social', esc_attr($social));
        update_post_meta($post_id, 'team_job', esc_attr($job));
    } elseif ($post->post_type == 'works') {
        $category   = !empty($_POST['works_category'])    ? $_POST['works_category']    : '';
        $client     = !empty($_POST['works_client'])      ? $_POST['works_client']      : '';
        $link       = !empty($_POST['works_link'])        ? $_POST['works_link']        : '';
        $video_link = !empty($_POST['works_video_link'])  ? $_POST['works_video_link']  : '';
        $gallery    = !empty($_POST['portfolio_gallery']) ? $_POST['portfolio_gallery'] : '';
        update_post_meta($post_id, 'works_category', esc_attr($category));
        update_post_meta($post_id, 'works_client', esc_attr($client));
        update_post_meta($post_id, 'works_link', esc_attr($link));
        update_post_meta($post_id, 'works_video_link', esc_attr($video_link));
        update_post_meta($post_id, 'portfolio_gallery', esc_attr($gallery));
    } elseif ($post->post_type == 'program') {
        $category   = !empty($_POST['program_category'])    ? $_POST['program_category']    : '';
        $client     = !empty($_POST['program_client'])      ? $_POST['program_client']      : '';
        $link       = !empty($_POST['program_link'])        ? $_POST['program_link']        : '';
        $video_link = !empty($_POST['program_video_link'])  ? $_POST['program_video_link']  : '';
        $gallery    = !empty($_POST['portfolio_gallery']) ? $_POST['portfolio_gallery'] : '';
        update_post_meta($post_id, 'program_category', esc_attr($category));
        update_post_meta($post_id, 'program_client', esc_attr($client));
        update_post_meta($post_id, 'program_link', esc_attr($link));
        update_post_meta($post_id, 'program_video_link', esc_attr($video_link));
        update_post_meta($post_id, 'portfolio_gallery', esc_attr($gallery));    

    }  elseif ($post->post_type == 'event') {
        $category   = !empty($_POST['event_category'])    ? $_POST['event_category']    : '';
        $client     = !empty($_POST['event_client'])      ? $_POST['event_client']      : '';
        $link       = !empty($_POST['event_link'])        ? $_POST['event_link']        : '';
        $video_link = !empty($_POST['event_video_link'])  ? $_POST['event_video_link']  : '';
        $gallery    = !empty($_POST['portfolio_gallery']) ? $_POST['portfolio_gallery'] : '';
        update_post_meta($post_id, 'event_category', esc_attr($category));
        update_post_meta($post_id, 'event_client', esc_attr($client));
        update_post_meta($post_id, 'event_link', esc_attr($link));
        update_post_meta($post_id, 'event_video_link', esc_attr($video_link));
        update_post_meta($post_id, 'portfolio_gallery', esc_attr($gallery));    

    } elseif ($post->post_type == 'page') {
        $page_animation    = !empty($_POST['page_animation']) ? $_POST['page_animation'] : '';
        update_post_meta($post_id, 'page_animation', esc_attr($page_animation));
    }
    
    return $post_id;
}
add_action('save_post', 'save_meta_box');