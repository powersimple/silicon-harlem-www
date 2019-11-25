<?php
add_action('wp_ajax_metrika_homeMenu', 'homeMenu');
add_action('wp_ajax_nopriv_metrika_homeMenu', 'homeMenu');
function homeMenu() {
    $metrika_menu = get_option('metrika_menu'); ?>
    <nav class="navi">
        <div class="container gridster">
        <?php ob_start(); ?>
            <ul class="unstyled">
            <?php if (!empty($metrika_menu)) : ?>
                <?php $blog_page = get_option('blog_page'); ?>
                <?php if (empty($blog_page)) $blog_page = 0 ?>
                <?php $menu_number = 0 ?>
                <?php foreach($metrika_menu as $item) : ?>
                    <?php
                    if (empty($item['tile_type']))
                        $item['tile_type'] = '';
                    if (empty($item['bg_img']))
                        $item['bg_img'] = '';

                    $onclick = '';
                    $link = '';
                    $url = '';
                    $blog = '';
                    ?>
                    <?php if ((empty($item['tile_type']) or $item['tile_type'] == 'page') && !empty($item['page_id'])) { ?>
                        <?php
                        if ($blog_page == $item['page_id'])
                            $blog = 'blog-page';
                        else
                            $blog = '';
                        $post = get_post($item['page_id']);
                        $url = $post->post_name;
                        $page_animation = get_post_meta($item['page_id'], 'page_animation', true);
                        if (empty($page_animation)) $page_animation = '17';
                        ?>
                        <?php $onclick = 'onclick="gotoPage(' . ++$menu_number . ', ' . $page_animation . ')"' ?>
                    <?php } elseif ($item['tile_type'] == 'file') {
                        if (!empty($item['file_id'])) {
                            $attachment = wp_get_attachment_url($item['file_id']);
                            $link = '<a target="_blank" href="' . $attachment . '"></a>';
                        } elseif (!empty($item['file_id']) && !empty($item['file_title'])) {
                            $attachment = wp_get_attachment_metadata($item['file_id']);
                            $link = '<a target="_blank" href="'. $attachment . '">' . $item['file_title'] . '</a>';
                        }
                    } elseif ($item['tile_type'] == 'link') {
                        if (!empty($item['external_link']))
                            $link = '<a target="_blank" href="' . $item['external_link'] . '"></a>';
                        elseif (!empty($item['external_link']) && !empty($item['external_link_title']))
                            $link = '<a target="_blank" href="' . $item['external_link'] . '">' . $item['external_link_title'] . '</a>';
                    } ?>

                    <li <?php echo $onclick ?> 
                        page="<?php if (!empty($menu_number)) echo $menu_number ?>"
                        url="<?php echo $url ?>"
                        style="background-color: <?php echo $item['color'] ?>; 
                                background-image: url(<?php echo wp_get_attachment_url($item['bg_img']) ?>);" 
                        data-row="<?php echo $item['row'] ?>" 
                        data-col="<?php echo $item['col'] ?>" 
                        data-sizex="<?php echo $item['sizex'] ?>" 
                        data-sizey="<?php echo $item['sizey'] ?>"
                        class="<?php echo $blog ?>">
                        <?php echo $link ?>
                        <?php if (!empty($item['icon'])) : ?>
                            <i class="fa <?php echo $item['icon'] ?>"></i>
                        <?php elseif (!empty($item['img'])) : ?>
                            <div class="img_icon_container">
                                <?php echo wp_get_attachment_image($item['img'], 'full'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($item['tile_type'] == 'file') : ?>
                            <?php if (!empty($item['file_title'])) : ?>
                                <span class="title"><?php echo $item['file_title'] ?></span>
                            <?php endif; ?>
                        <?php elseif ($item['tile_type'] == 'link') : ?>
                            <?php if (!empty($item['external_link_title'])) : ?>
                                <span class="title"><?php echo $item['external_link_title'] ?></span>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php if (!empty($item['page_id'])) : ?>
                                <?php if (empty($item['disable_title'])) : ?>
                                <span class="title"><?php echo get_the_title($item['page_id']) ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            <?php else : ?>
                <li data-row="1" data-col="1" data-sizex="1" data-sizey="1"></li>
                <li data-row="1" data-col="1" data-sizex="1" data-sizey="1"></li>
                <li data-row="2" data-col="1" data-sizex="2" data-sizey="1"></li>
         
                <li data-row="1" data-col="2" data-sizex="2" data-sizey="2"></li>
         
                <li data-row="1" data-col="5" data-sizex="1" data-sizey="1"></li>
                <li data-row="1" data-col="6" data-sizex="1" data-sizey="1"></li>
                <li data-row="2" data-col="5" data-sizex="2" data-sizey="1"></li>
            <?php endif; ?>
            </ul>
            <?php $menu = ob_get_clean() ?>
            <?php echo $menu; ?>
        </div>
    </nav>
    <div class="hidden-menu">
        <?php echo $menu ?>
    </div>
    <?php
}

function subMenu($current) {
    $metrika_menu = get_option('metrika_menu');
    $i            = 0;
    $pages        = array();

    foreach ($metrika_menu as $item) {
        if ((empty($item['tile_type']) or $item['tile_type'] == 'page') && !empty($item['page_id'])) {
            $pages['pages'][$i] = $item['page_id'];
            $pages['keys'][$i] = $i;
            $i++;
        }
    }

    $pos     = ceil(count($pages['pages']) / 2 - 1);
    $pages   = subMenuSort($pages, $current, $pos);
    $items   = trimMenu($pages['pages']);
    $keys    = trimMenu($pages['keys']);
    $subMenu = array_combine($keys, $items);
    $i       = 1;
    $output  = '';
    $inline  = false;
    $blog_page = get_option('blog_page');
    if (empty($blog_page)) $blog_page = 0;

    $subMenu = trimMenu($subMenu);

    foreach ($subMenu as $key => $item) {
        $post = get_post($item);
        if ($blog_page != 0 && $blog_page == $post->ID)
            $class = 'submenu-blog';
        else
            $class = '';
        $page_animation = get_post_meta($item, 'page_animation', true);
        if (empty($page_animation)) $page_animation = '17';
        $key++;
        if ($item == $current) {
            $inline = true;
            $output .= '<li class="current"><a href="#' . $post->post_name . '" class="page-transition ' . $class . '" onclick="gotoPage(' . $key . ', ' . $page_animation . ')">' . get_the_title($item) . '</a></li>';
        } elseif ($inline) {
            $inline = false;
            $output .= '<li class="inline"><a href="#' . $post->post_name . '" class="page-transition ' . $class . '" onclick="gotoPage(' . $key . ', ' . $page_animation . ')">' . get_the_title($item) . '</a></li>';
        } else {
            $output .= '<li><a href="#' . $post->post_name . '" class="page-transition ' . $class . '" onclick="gotoPage(' . $key . ', ' . $page_animation . ')">' . get_the_title($item) . '</a></li>';
        }
        $i++;
    }

    if (count($subMenu) < 3) {
        $ul_class = 'page1-submenu';
    } elseif (count($subMenu) == 3) {
        $ul_class = 'page2-submenu';
    } elseif (count($subMenu) == 4) {
        $ul_class = 'page3-submenu';
    } elseif (count($subMenu) == 5) {
        $ul_class = 'page4-submenu';
    } elseif (count($subMenu) == 6) {
        $ul_class = 'page5-submenu';
    } elseif (count($subMenu) == 7) {
        $ul_class = 'page6-submenu';
    } elseif (count($subMenu) >= 8) {
        $ul_class = 'page7-submenu';
    }
    ?>
    <nav class="submenu <?php echo $ul_class ?>">
        <ul>
        <?php echo $output ?>
        </ul>
    </nav>
    <?php
}

function subMenuSort($array, $current, $pos) {

    $last_p = array_pop($array['pages']);
    $last_k = array_pop($array['keys']);

    array_unshift($array['pages'], $last_p);
    array_unshift($array['keys'], $last_k);

    if (array_search($current, $array['pages']) != $pos)
        $array = subMenuSort($array, $current, $pos);

    return $array;
}

function trimMenu($array) {
    if (count($array) > 8) {
        array_shift($array);
    }
    if (count($array) > 8) {
        array_pop($array);
        $array = trimMenu($array);
    }
    return $array;
}