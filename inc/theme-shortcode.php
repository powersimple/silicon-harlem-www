<?php
/*
 * Blockquote Shortcode
 */
function blockquote_shortcode($attr, $content) {
    extract( shortcode_atts( array(
        'author' => ''
    ), $attr ) );
    
    $output = '';
    
    $output .= '<div class="quotation span12 clearfix">';
    $output .= '<div class="quotation-mark"></div>';
    $output .= '<p>' . apply_filters('the_content', $content) . '</p>';
    if ($author !== '')
        $output .= '<span class="quotation-author">' . $author . '</span>';
    $output .= '</div>';
    
    return $output;
}
add_shortcode('blockquote', 'blockquote_shortcode');

/*
 * Row Shortcode
 */
function row_shortcode($attr, $content) {
    return '<div class="container">' . do_shortcode(apply_filters('the_content', $content)) . '</div>';
}
add_shortcode('row', 'row_shortcode');

/*
 * 1 Column Shortcode
 */
function col1_shortcode($attr, $content) {
    return '<div class="span12">' . do_shortcode(apply_filters('the_content', $content)) . '</div>';
}
add_shortcode('col1', 'col1_shortcode');

/*
 * 2 Column Shortcode
 */
function col2_shortcode($attr, $content) {
    return '<div class="span6">' . do_shortcode(apply_filters('the_content', $content)) . '</div>';
}
add_shortcode('col2', 'col2_shortcode');

/*
 * 3 Column Shortcode
 */
function col3_shortcode($attr, $content) {
    return '<div class="span4">' . do_shortcode(apply_filters('the_content', $content)) . '</div>';
}
add_shortcode('col3', 'col3_shortcode');

/*
 * 4 Column Shortcode
 */
function col4_shortcode($attr, $content) {
    return '<div class="span3">' . do_shortcode(apply_filters('the_content', $content)) . '</div>';
}
add_shortcode('col4', 'col4_shortcode');

/*
 * Team Shortcode
 */
function team_shortcode($attr) {
    extract(shortcode_atts(array(
        'column' => 3
    ), $attr));
    $args = array(
        'post_type' => 'team',
        'post_status'=>'publish',
        'orderby' => 'id',
        'order' => 'ASC',
        'posts_per_page=-1',
    );
    $team = new WP_Query($args);
    if ($team->have_posts()) {
        $i = 0;
        $output = '';

        if ($column == 2) {
            $span = 'span6';
            $style = 'style="width: 616px;"';
        } else {
            $span = 'span4';
            $style = '';
        }
        
        foreach ($team->posts as $team_item) {
            if (get_post_meta($team_item->ID, 'team_social', true))
                $social = get_post_meta($team_item->ID, 'team_social', true);
            else
                $social = '';

            if (get_post_meta($team_item->ID, 'team_job', true))
                $job = get_post_meta($team_item->ID, 'team_job', true);
            else
                $job = '';

            if (get_the_post_thumbnail($team_item->ID, 'team'))
                $thumbnail = get_the_post_thumbnail($team_item->ID, 'team');
            else
                $thumbnail = '';
            if (($i++ % $column) == 0)
                $output .= '<div class="container team-container" ' . $style . '>';
            $output .= '    <div class="' . $span . ' team-mate">';
            $output .= '        <span class="figcap"></span>';
            $output .= '        <a href="#" class="content">
                                    <div class="img">' . $thumbnail . '</div>
                                    <h2>' . get_the_title($team_item->ID) . '</h2>
                                    <h3>' . $job . '&nbsp;</h3>
                                </a>';
            if ($team_item->post_content)
                $output .= do_shortcode(apply_filters('the_content', $team_item->post_content));
            if ($social)
                $output .= '    <ul class="social-bar2 black">' . do_shortcode($social) . '</ul>';
            $output .= '    </div>';
            if (($i % $column) == 0)
                $output .= '</div>';
        }
    }
    return $output;
}
add_shortcode('team', 'team_shortcode');

/*
 * Social Icon Shortcode
 */
function social_shortcode($attr) {
    extract(shortcode_atts(array(
        'href' => '',
        'type_icon' => ''
    ), $attr));
    return '<li><a href="' . $href . '" target="_blank"><i class="fa fa-' . $type_icon . '"></i></a></li>';
}
add_shortcode( 'social', 'social_shortcode' );
/*
 * Program Shortcode
 */
function program_shortcode($attr) {
    extract(shortcode_atts(array(
        'filter' => false,
        'column' => 3
    ), $attr));
    $args = array(
        'post_type' => 'program',
        'post_status'=>'publish',
        'orderby' => 'id',
        'order' => 'DESC',
        'posts_per_page=-1',
    );
    if (!@$metrika_options['menu_type']) @$metrika_options['menu_type'] = 'yes';

    $program = new WP_Query($args);
    $metrika_options = get_option('metrika_theme_options');
    if ($program->have_posts()) {
        $i = 0;
        if ($metrika_options['menu_type'] == 'no') {
            $output = '';
            foreach ($program->posts as $program_item) {
                $categories = get_the_terms($program_item->ID, 'program-category');
                $output .= '<div class="program_item">';
                $output .= '    <div class="pull-left image">';
                $output .=          get_the_post_thumbnail($program_item->ID, 'program-small');;
                $output .= '    </div>';
                $output .= '    <div class="pull-right description">';
                $output .= '        <h2>' . get_the_title($program_item->ID) . '</h2>';
                $output .= '        <h3>';
                if ($categories) {
                    foreach ($categories as $category) {
                        $output .= $category->slug . ', ';
                    }
                }
                $output .= '        </h3>';
                $output .= '        <p>' . apply_filters('the_content', $program_item->post_content) . '</p>';
                $output .= '        <a class="link" target="_blank" href="' . get_post_meta($program_item->ID, 'program_link', true) . '">' . __('Visit Site', 'metrika') . '</a>';
                $output .= '    </div>';
                $output .= '    <div class="clearfix"></div>';
                $output .= '</div>';
            }
        } else {
            $output = '';
            $categories = get_terms('program-category', $args = array('hide_empty' => true));
            if (!empty($categories) && !empty($filter) or $filter){
                $output .= '<ul id="filterOptions" class="portfolio-toolbar toolbar">
                                <li href="#" class="category filter active" data-filter="item-p">' . __('All', 'metrika') . '</li>';
                foreach (get_terms('program-category', $args = array('hide_empty' => true)) as $term) {
                    $output .= '<li href="#" class="category filter" data-filter="' . $term->slug . '">' . $term->name . '</li>';
                }
                $output .= '</ul><div class="clearfix"></div>';
            }
            $output .= '<div class="clearfix"></div>';
            if ($column == '2')
                $output .= '<ul id="program-grid" class="og-grid ourHolder" style="width: 646px; margin: auto;">';
            else
                $output .= '<ul id="program-grid" class="og-grid ourHolder">';
            global $wp_embed;
            foreach ($program->posts as $program_item) {
                $gallery = get_post_meta($program_item->ID, 'portfolio_gallery', true);
                $gallery = json_decode(html_entity_decode($gallery), true);
                $categories = get_the_terms($program_item->ID, 'program-category');
                $large_image = wp_get_attachment_image( get_post_thumbnail_id($program_item->ID), 'program-large');
                $video = get_post_meta($program_item->ID, 'program_video_link', true);
                $shortcode = '[embed width="462"]' . get_post_meta($program_item->ID, 'program_video_link', true) . '&w=240[/embed]';
                $client = get_post_meta($program_item->ID, 'program_client', true);
                $link = get_post_meta($program_item->ID, 'program_link', true);
                $client = !empty($client) ? $client : '';
                $link = !empty($link) ? $link : '';

                $category_items = '';
                $category_items_name = '';
                if ($categories) {
                    $current_category_item = 0;
                    foreach ($categories as $category) {
                        if (count($categories) !== ++$current_category_item) {
                            $category_items_name .= $category->name . ', ';
                            $category_items .= $category->slug . ' ';
                        } else {
                            $category_items_name .= $category->name;
                            $category_items .= $category->slug;
                        }
                    }
                }
                $output .= '<li class="item-p ' . $category_items . '" data-id="id-' . ++$i . '" data-type="';
                $output .= '">';
                $output .= '    <a href="#">';
                $output .= '    <span class="figcap"></span>';
                $output .= '    <div class="img">';
                $output .=      get_the_post_thumbnail($program_item->ID, 'program-small');
                $output .= '    </div>';
                $title = get_the_title($program_item->ID);
                if (strlen($title) > 28)
                    $title = substr($title, 0, 28) . '...';
                $output .= '    <h2>' . $title . '</h2>';
                $output .= '    <h3>';
                if ($category_items_name) {
                    $output .= $category_items_name;
                }
                $output .= '    </h3>';
                $output .= '    <svg class="arrow" width="38" height="20" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <title>Layer 1</title>
                                        <rect id="svg_1" height="0" width="1" y="-22" x="-398" stroke-width="5" stroke="#000000" fill="#FF0000"/>
                                        <path id="svg_7" d="m0.2,19.85c0.1,0 17.3,-19.7 17.3,-19.75c0,-0.05 20,19.55 20,19.5c0,-0.049999 -37.3,0.25 -37.3,0.25z" stroke-linecap="null" stroke-linejoin="null" stroke-dasharray="null" stroke="#007fff" fill="#007fff"/>
                                    </g>
                                </svg>';
                $output .= '    </a>';
                $output .= '    <div class="full og-expander">';
                $output .= '        <div class="og-expander-inner">';
                $output .= '            <span class="og-close"></span>';
                $output .= '            <div class="og-fullimg">';
                if ($large_image && !$gallery && empty($video))
                    $output .= $large_image;
                elseif (($large_image && !empty($video)) or !empty($video))
                    $output .= $wp_embed->run_shortcode($shortcode);
                elseif ($gallery) {
                    $output .= '<div class="portfolio_gallery">';
                    foreach ($gallery as $gallery_item) {
                        $output .= wp_get_attachment_image($gallery_item['id'], 'program-large');
                    }
                    $output .= '</div>';
                    $output .= '<a class="prev-slide" href="#"></a>';
                    $output .= '<a class="next-slide" href="#"></a>';
                }
                $output .= '            </div>';
                $output .= '            <div class="og-details">';
                $output .= '                <h3>' . get_the_title($program_item->ID) . '</h3>';
                if (!empty($category_items_name) or !empty($client)) {
                    $output .= '            <div class="og-tags">';
                    if (!empty($category_items_name))
                        $output .= '            <span><p>' . __('Category:', 'metrika') . ' ' . $category_items_name . '</p></span>';
                    if (!empty($client))
                        $output .= '            <span><p>' . __('Client:', 'metrika') . ' ' . $client . '</p></span>';
                    $output .= '            </div>';
                }
                if (!empty($program_item->post_content))
                    $output .= '                <div class="program_content">' . apply_filters('the_content', $program_item->post_content) . '</div>';
                if (!empty($link))
                    $output .= '                <a class="program_link" target="_blank" href="' . $link . '">' . __('Visit Site', 'metrika') . '</a>';
                $output .= '            </div>';
                $output .= '        </div>';
                $output .= '    </div>';
                $output .= '</li>';
            }
            $output .= '</ul>';
            $output .= '<div class="clearfix"></div>';
        }
    }
    
    return $output;
}
add_shortcode( 'program', 'program_shortcode' );
/*
 * Event Shortcode
 */
function event_shortcode($attr) {
    extract(shortcode_atts(array(
        'filter' => false,
        'column' => 3
    ), $attr));
    $args = array(
        'post_type' => 'event',
        'post_status'=>'publish',
        'orderby' => 'id',
        'order' => 'DESC',
        'posts_per_page=-1',
    );
    if (!@$metrika_options['menu_type']) @$metrika_options['menu_type'] = 'yes';

    $event = new WP_Query($args);
    $metrika_options = get_option('metrika_theme_options');
    if ($event->have_posts()) {
        $i = 0;
        if ($metrika_options['menu_type'] == 'no') {
            $output = '';
            foreach ($event->posts as $event_item) {
                $categories = get_the_terms($event_item->ID, 'event-category');
                $output .= '<div class="event_item">';
                $output .= '    <div class="pull-left image">';
                $output .=          get_the_post_thumbnail($event_item->ID, 'event-small');;
                $output .= '    </div>';
                $output .= '    <div class="pull-right description">';
                $output .= '        <h2>' . get_the_title($event_item->ID) . '</h2>';
                $output .= '        <h3>';
                if ($categories) {
                    foreach ($categories as $category) {
                        $output .= $category->slug . ', ';
                    }
                }
                $output .= '        </h3>';
                $output .= '        <p>' . apply_filters('the_content', $event_item->post_content) . '</p>';
                $output .= '        <a class="link" target="_blank" href="' . get_post_meta($event_item->ID, 'event_link', true) . '">' . __('Visit Site', 'metrika') . '</a>';
                $output .= '    </div>';
                $output .= '    <div class="clearfix"></div>';
                $output .= '</div>';
            }
        } else {
            $output = '';
            $categories = get_terms('event-category', $args = array('hide_empty' => true));
            if (!empty($categories) && !empty($filter) or $filter){
                $output .= '<ul id="filterOptions" class="portfolio-toolbar toolbar">
                                <li href="#" class="category filter active" data-filter="item-p">' . __('All', 'metrika') . '</li>';
                foreach (get_terms('event-category', $args = array('hide_empty' => true)) as $term) {
                    $output .= '<li href="#" class="category filter" data-filter="' . $term->slug . '">' . $term->name . '</li>';
                }
                $output .= '</ul><div class="clearfix"></div>';
            }
            $output .= '<div class="clearfix"></div>';
            if ($column == '2')
                $output .= '<ul id="-event-grid" class="og-grid ourHolder" style="width: 646px; margin: auto;">';
            else
                $output .= '<ul id="event-grid" class="og-grid ourHolder">';
            global $wp_embed;
            foreach ($event->posts as $event_item) {
               
                $gallery = get_post_meta($event_item->ID, 'portfolio_gallery', true);
                $gallery = json_decode(html_entity_decode($gallery), true);
                $categories = get_the_terms($event_item->ID, 'event-category');
                $large_image = wp_get_attachment_image( get_post_thumbnail_id($event_item->ID), 'event-large');
                $video = get_post_meta($event_item->ID, 'event_video_link', true);
                $shortcode = '[embed width="462"]' . get_post_meta($event_item->ID, 'event_video_link', true) . '&w=240[/embed]';
                $event_date = get_post_meta($event_item->ID, 'event_event_date', true);
                $link = get_post_meta($event_item->ID, 'event_link', true);
                $event_date = !empty($event_date) ? $event_date : '';
                $link = !empty($link) ? $link : '';

                $category_items = '';
                $category_items_name = '';
                if ($categories) {
                    $current_category_item = 0;
                    foreach ($categories as $category) {
                        if (count($categories) !== ++$current_category_item) {
                            $category_items_name .= $category->name . ', ';
                            $category_items .= $category->slug . ' ';
                        } else {
                            $category_items_name .= $category->name;
                            $category_items .= $category->slug;
                        }
                    }
                }
                $output .= '<li class="item-p ' . $category_items . '" data-id="id-' . ++$i . '" data-type="';
                $output .= '">';
                $output .= '    <a href="#">';
                $output .= '    <span class="figcap"></span>';
                $output .= '    <div class="img">';
                $output .=      get_the_post_thumbnail($event_item->ID, 'event-small');
                $output .= '    </div>';
                $title = get_the_title($event_item->ID);
                if (strlen($title) > 28)
                    $title = substr($title, 0, 28) . '...';
                $output .= '    <h2>' . $title . '</h2>';
                $output .= '    <h3>';
                if ($category_items_name) {
                    $output .= $category_items_name;
                }
                $output .= '    </h3>';
                $output .= '    <svg class="arrow" width="38" height="20" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <title>Layer 1</title>
                                        <rect id="svg_1" height="0" width="1" y="-22" x="-398" stroke-width="5" stroke="#000000" fill="#FF0000"/>
                                        <path id="svg_7" d="m0.2,19.85c0.1,0 17.3,-19.7 17.3,-19.75c0,-0.05 20,19.55 20,19.5c0,-0.049999 -37.3,0.25 -37.3,0.25z" stroke-linecap="null" stroke-linejoin="null" stroke-dasharray="null" stroke="#007fff" fill="#007fff"/>
                                    </g>
                                </svg>';
                $output .= '    </a>';
                $output .= '    <div class="full og-expander">';
                $output .= '        <div class="og-expander-inner">';
                $output .= '            <span class="og-close"></span>';
                $output .= '            <div class="og-fullimg">';
                if ($large_image && !$gallery && empty($video))
                    $output .= $large_image;
                elseif (($large_image && !empty($video)) or !empty($video))
                    $output .= $wp_embed->run_shortcode($shortcode);
                elseif ($gallery) {
                    $output .= '<div class="portfolio_gallery">';
                    foreach ($gallery as $gallery_item) {
                        $output .= wp_get_attachment_image($gallery_item['id'], 'event-large');
                    }
                    $output .= '</div>';
                    $output .= '<a class="prev-slide" href="#"></a>';
                    $output .= '<a class="next-slide" href="#"></a>';
                }
                $output .= '            </div>';
                $output .= '            <div class="og-details">';
                $output .= '                <h3>' . get_the_title($event_item->ID) . '</h3>';
                if (!empty($category_items_name) or !empty($event_date)) {
                    $output .= '            <div class="og-tags">';
                    if (!empty($category_items_name))
                        $output .= '            <span><p>' . __('Category:', 'metrika') . ' ' . $category_items_name . '</p></span>';
                    if (!empty($event_date))
                        $output .= '            <span><p>' . __('Event Date/Time:', 'metrika') . ' ' . $event_date . '</p></span>';
                    $output .= '            </div>';
                }
                if (!empty($event_item->post_content))
                    $output .= '                <div class="event_content">' . apply_filters('the_content', $event_item->post_content) . '</div>';
                if (!empty($link))
                    $output .= '                <a class="event_link" target="_blank" href="' . $link . '">' . __('Visit Site', 'metrika') . '</a>';
                $output .= '            </div>';
                $output .= '        </div>';
                $output .= '    </div>';
                $output .= '</li>';
            }
            $output .= '</ul>';
            $output .= '<div class="clearfix"></div>';
        }
    }
    
    return $output;
}
add_shortcode( 'event', 'event_shortcode' );

/*
 * Works Shortcode
 */
function works_shortcode($attr) {
    extract(shortcode_atts(array(
        'filter' => false,
        'column' => 3
    ), $attr));
    $args = array(
        'post_type' => 'works',
        'post_status'=>'publish',
        'orderby' => 'id',
        'order' => 'DESC',
        'posts_per_page=-1',
    );
    if (!@$metrika_options['menu_type']) @$metrika_options['menu_type'] = 'yes';

    $works = new WP_Query($args);
    $metrika_options = get_option('metrika_theme_options');
    if ($works->have_posts()) {
        $i = 0;
        if ($metrika_options['menu_type'] == 'no') {
            $output = '';
            foreach ($works->posts as $works_item) {
                $categories = get_the_terms($works_item->ID, 'works-category');
                $output .= '<div class="works_item">';
                $output .= '    <div class="pull-left image">';
                $output .=          get_the_post_thumbnail($works_item->ID, 'works-small');;
                $output .= '    </div>';
                $output .= '    <div class="pull-right description">';
                $output .= '        <h2>' . get_the_title($works_item->ID) . '</h2>';
                $output .= '        <h3>';
                if ($categories) {
                    foreach ($categories as $category) {
                        $output .= $category->slug . ', ';
                    }
                }
                $output .= '        </h3>';
                $output .= '        <p>' . apply_filters('the_content', $works_item->post_content) . '</p>';
                $output .= '        <a class="link" target="_blank" href="' . get_post_meta($works_item->ID, 'works_link', true) . '">' . __('Visit Site', 'metrika') . '</a>';
                $output .= '    </div>';
                $output .= '    <div class="clearfix"></div>';
                $output .= '</div>';
            }
        } else {
            $output = '';
            $categories = get_terms('works-category', $args = array('hide_empty' => true));
            if (!empty($categories) && !empty($filter) or $filter){
                $output .= '<ul id="filterOptions" class="portfolio-toolbar toolbar">
                                <li href="#" class="category filter active" data-filter="item-p">' . __('All', 'metrika') . '</li>';
                foreach (get_terms('works-category', $args = array('hide_empty' => true)) as $term) {
                    $output .= '<li href="#" class="category filter" data-filter="' . $term->slug . '">' . $term->name . '</li>';
                }
                $output .= '</ul><div class="clearfix"></div>';
            }
            $output .= '<div class="clearfix"></div>';
            if ($column == '2')
                $output .= '<ul id="works-grid" class="og-grid ourHolder" style="width: 646px; margin: auto;">';
            else
                $output .= '<ul id="works-grid" class="og-grid ourHolder">';
            global $wp_embed;
            foreach ($works->posts as $works_item) {
                $gallery = get_post_meta($works_item->ID, 'portfolio_gallery', true);
                $gallery = json_decode(html_entity_decode($gallery), true);
                $categories = get_the_terms($works_item->ID, 'works-category');
                $large_image = wp_get_attachment_image( get_post_thumbnail_id($works_item->ID), 'works-large');
                $video = get_post_meta($works_item->ID, 'works_video_link', true);
                $shortcode = '[embed width="462"]' . get_post_meta($works_item->ID, 'works_video_link', true) . '&w=240[/embed]';
                $client = get_post_meta($works_item->ID, 'works_client', true);
                $link = get_post_meta($works_item->ID, 'works_link', true);
                $client = !empty($client) ? $client : '';
                $link = !empty($link) ? $link : '';

                $category_items = '';
                $category_items_name = '';
                if ($categories) {
                    $current_category_item = 0;
                    foreach ($categories as $category) {
                        if (count($categories) !== ++$current_category_item) {
                            $category_items_name .= $category->name . ', ';
                            $category_items .= $category->slug . ' ';
                        } else {
                            $category_items_name .= $category->name;
                            $category_items .= $category->slug;
                        }
                    }
                }
                $output .= '<li class="item-p ' . $category_items . '" data-id="id-' . ++$i . '" data-type="';
                $output .= '">';
                $output .= '    <a href="#">';
                $output .= '    <span class="figcap"></span>';
                $output .= '    <div class="img">';
                $output .=      get_the_post_thumbnail($works_item->ID, 'works-small');
                $output .= '    </div>';
                $title = get_the_title($works_item->ID);
                if (strlen($title) > 28)
                    $title = substr($title, 0, 28) . '...';
                $output .= '    <h2>' . $title . '</h2>';
                $output .= '    <h3>';
                if ($category_items_name) {
                    $output .= $category_items_name;
                }
                $output .= '    </h3>';
                $output .= '    <svg class="arrow" width="38" height="20" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <title>Layer 1</title>
                                        <rect id="svg_1" height="0" width="1" y="-22" x="-398" stroke-width="5" stroke="#000000" fill="#FF0000"/>
                                        <path id="svg_7" d="m0.2,19.85c0.1,0 17.3,-19.7 17.3,-19.75c0,-0.05 20,19.55 20,19.5c0,-0.049999 -37.3,0.25 -37.3,0.25z" stroke-linecap="null" stroke-linejoin="null" stroke-dasharray="null" stroke="#007fff" fill="#007fff"/>
                                    </g>
                                </svg>';
                $output .= '    </a>';
                $output .= '    <div class="full og-expander">';
                $output .= '        <div class="og-expander-inner">';
                $output .= '            <span class="og-close"></span>';
                $output .= '            <div class="og-fullimg">';
                if ($large_image && !$gallery && empty($video))
                    $output .= $large_image;
                elseif (($large_image && !empty($video)) or !empty($video))
                    $output .= $wp_embed->run_shortcode($shortcode);
                elseif ($gallery) {
                    $output .= '<div class="portfolio_gallery">';
                    foreach ($gallery as $gallery_item) {
                        $output .= wp_get_attachment_image($gallery_item['id'], 'works-large');
                    }
                    $output .= '</div>';
                    $output .= '<a class="prev-slide" href="#"></a>';
                    $output .= '<a class="next-slide" href="#"></a>';
                }
                $output .= '            </div>';
                $output .= '            <div class="og-details">';
                $output .= '                <h3>' . get_the_title($works_item->ID) . '</h3>';
                if (!empty($category_items_name) or !empty($client)) {
                    $output .= '            <div class="og-tags">';
                    if (!empty($category_items_name))
                        $output .= '            <span><p>' . __('Category:', 'metrika') . ' ' . $category_items_name . '</p></span>';
                    if (!empty($client))
                        $output .= '            <span><p>' . __('Client:', 'metrika') . ' ' . $client . '</p></span>';
                    $output .= '            </div>';
                }
                if (!empty($works_item->post_content))
                    $output .= '                <div class="work_content">' . apply_filters('the_content', $works_item->post_content) . '</div>';
                if (!empty($link))
                    $output .= '                <a class="work_link" target="_blank" href="' . $link . '">' . __('Visit Site', 'metrika') . '</a>';
                $output .= '            </div>';
                $output .= '        </div>';
                $output .= '    </div>';
                $output .= '</li>';
            }
            $output .= '</ul>';
            $output .= '<div class="clearfix"></div>';
        }
    }
    
    return $output;
}
add_shortcode( 'works', 'works_shortcode' );

function contact_shortcode() {
    $options = get_option('contacts_options');
    ob_start();
    if (!empty($options['address'])) :?>
    <div class="span4 addspace">
        <h2><?php _e('Address', 'metrika') ?></h2>
        <p><?php echo $options['address'] ?></p>
    </div>
    <?php endif; ?>
    <?php if (!empty($options['first_phone_number']) or !empty($options['second_phone_number'])) : ?>
        <div class="span4 addspace">
            <h2><?php _e('Phone', 'metrika') ?></h2>
            <p>
            <?php if (!empty($options['first_phone_label'])) : ?>
                <?php echo $options['first_phone_label'] . ': ' ?>
            <?php endif; ?>
            <?php if (!empty($options['first_phone_number'])) : ?>
                <?php echo $options['first_phone_number'] . ' ' ?>
            <?php endif; ?>
            <?php if (!empty($options['first_phone_time'])) : ?>
                <?php echo '(' . $options['first_phone_time'] . ')' ?>
            <?php endif; ?>
            </p>
            <p>
            <?php if (!empty($options['second_phone_label'])) : ?>
                <?php echo $options['second_phone_label'] . ': ' ?>
            <?php endif; ?>
            <?php if (!empty($options['second_phone_number'])) : ?>
                <?php echo $options['second_phone_number'] . ' ' ?>
            <?php endif; ?>
            <?php if (!empty($options['second_phone_time'])) : ?>
                <?php echo '(' . $options['second_phone_time'] . ')' ?>
            <?php endif; ?>
            </p>
        </div>
    <?php endif; ?>
    <?php if (!empty($options['first_email']) or !empty($options['second_email'])) : ?>
        <div class="span4 addspace">
            <h2><?php _e('E-mail', 'metrika') ?></h2>
            <p>
            <?php if (!empty($options['first_email_label'])) : ?>
                <?php echo $options['first_email_label'] . ': ' ?>
            <?php endif; ?>
            <?php if (!empty($options['first_email'])) : ?>
                <?php echo $options['first_email'] ?>
            <?php endif; ?>
            </p>
            <p>
            <?php if (!empty($options['second_email_label'])) : ?>
                <?php echo $options['second_email_label'] . ': ' ?>
            <?php endif; ?>
            <?php if (!empty($options['second_email'])) : ?>
                <?php echo $options['second_email'] ?>
            <?php endif; ?>
            </p>
        </div>
    <?php endif; ?>
    <?php return ob_get_clean();
}
add_shortcode('contact', 'contact_shortcode');

function contact_form_shortcode($atts) {
    $options = get_option('contacts_options');
    $output = '';
    if (!empty($options['form_to'])) {
        $output .= '<script>';
        $output .= 'var url = "' . get_template_directory_uri() . '"';
        $output .= '</script>';
        $output .= '<form method="post" name="feedback-form" id="feedback-form" class="addspace clearfix">
                        <fieldset class="span6">
                            <span id="sprytextfield1">
                                <input type="text" name="name" placeholder="' . __('Your Name *', 'metrika') . '" id="name">
                            </span>
                            <span id="sprytextfield2">
                                <input type="email" name="email" placeholder="' . __('Your Email *', 'metrika') . '" id="email">
                            </span>
                        </fieldset>
                        <fieldset class="span6">
                            <span id="sprytextarea1">
                                <textarea name="message" placeholder="' . __('Any comment *', 'metrika') . '" id="message" cols="45" rows="5"></textarea>
                            </span>
                        </fieldset>
                        <input type="hidden" value="' . $metrika_options['form_email'] . '" name="email_to">
                        <input name="submit" type="submit" class="submit" id="submit" value="Submit">
                        <div id="success"></div>
                  </form>';
    }
    return $output;
}
add_shortcode('contact_form', 'contact_form_shortcode');

function accordion_shortcode($atts, $content) {
    return '<div id="accordion"><div>' . do_shortcode($content) . '</div></div>';
}
add_shortcode('accordion', 'accordion_shortcode');

function accordion_item($atts, $content) {
    extract( shortcode_atts( array(
        'title' => 'Item Title'
    ), $atts ) );
    return '<h3>' . $title . '</h3>
            <div><p>' . do_shortcode(apply_filters('the_content', $content)) . '</p></div>';
}
add_shortcode('accordion_item', 'accordion_item');

function tabs_shortcode($atts, $content) {
    return '<div id="tabs"><div>' . do_shortcode(apply_filters('the_content', $content)) . '</div></div>';
}
add_shortcode('tabs', 'tabs_shortcode');

function tabs_title($atts, $content) {
    return '<ul>' . do_shortcode($content) . '</ul>';
}
add_shortcode('tabs_title', 'tabs_title');

function tab_title($atts) {
    extract( shortcode_atts( array(
        'id' => 'Item_id',
        'title' => 'Item Title'
    ), $atts ) );
    return '<li><a href="#' . $id . '">' . $title . '</a></li>';
}
add_shortcode('tab_title', 'tab_title');

function tab_content($atts, $content) {
    extract( shortcode_atts( array(
        'id' => 'Item_id'
    ), $atts ) );
    return '<div id="' . $id . '">
                <p>' . apply_filters('the_content', $content) . '</p>
            </div>';
}
add_shortcode('tab_content', 'tab_content');