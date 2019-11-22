<?php
add_action('wp_ajax_metrika_comment', 'Ajax_Comment');
add_action('wp_ajax_nopriv_metrika_comment', 'Ajax_Comment');

function Ajax_Comment() {

    if (isset($_REQUEST['spam_bot'])) {
        if ($_REQUEST['spam_bot'] && $_REQUEST['spam_bot'] !== '')
            wp_die( __('Your are Bot', 'metrika') );
    }
    
    $comment_post_ID = isset($_REQUEST['comment_id']) ? (int) $_REQUEST['comment_id'] : 0;
    
    $post = get_post($comment_post_ID);
    
    if ( empty($post->comment_status) ) {
	do_action('comment_id_not_found', $comment_post_ID);
	exit;
    }
    
    $status = get_post_status($post);

    $status_obj = get_post_status_object($status);

    if ( !comments_open($comment_post_ID) ) {
            do_action('comment_closed', $comment_post_ID);
            wp_die( __('Sorry, comments are closed for this item.', 'metrika') );
    } elseif ( 'trash' == $status ) {
            do_action('comment_on_trash', $comment_post_ID);
            exit;
    } elseif ( !$status_obj->public && !$status_obj->private ) {
            do_action('comment_on_draft', $comment_post_ID);
            exit;
    } elseif ( post_password_required($comment_post_ID) ) {
            do_action('comment_on_password_protected', $comment_post_ID);
            exit;
    } else {
            do_action('pre_comment_on_post', $comment_post_ID);
    }
    
    $comment_author       = ( isset($_REQUEST['author']) )  ? trim(strip_tags($_REQUEST['author'])) : null;
    $comment_author_email = ( isset($_REQUEST['email']) )   ? trim($_REQUEST['email']) : null;
    $comment_content      = ( isset($_REQUEST['comment']) ) ? trim($_REQUEST['comment']) : null;
    
    $user = wp_get_current_user();
    if ( $user->exists() ) {
            if ( empty( $user->display_name ) )
                $user->display_name=$user->user_login;
            $comment_author       = wp_slash( $user->display_name );
            $comment_author_email = wp_slash( $user->user_email );
            $comment_author_url   = wp_slash( $user->user_url );
            if ( current_user_can('unfiltered_html') ) {
                    if ( @wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != @$_POST['_wp_unfiltered_html_comment'] ) {
                            kses_remove_filters(); // start with a clean slate
                            kses_init_filters(); // set up the filters
                    }
            }
    } else {
            if ( get_option('comment_registration') || 'private' == $status )
                    wp_die( __('Sorry, you must be logged in to post a comment.', 'metrika') );
    }

    $comment_type = '';

    if ( get_option('require_name_email') && !$user->exists() ) {
            if ( 6 > strlen($comment_author_email) || '' == $comment_author )
                    wp_die( __('Please fill the required fields (Name, E-mail, Comment).', 'metrika') );
            elseif ( !is_email($comment_author_email))
                    wp_die( __('Please enter a valid email address.', 'metrika') );
    }

    if ( '' == $comment_content )
            wp_die( __('Please type a comment.', 'metrika') );

    $comment_parent = isset($_REQUEST['comment_parrent']) ? absint($_REQUEST['comment_parrent']) : 0;

    $commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');

    $comment_id = wp_new_comment( $commentdata );

    $comment = get_comment($comment_id);
    do_action('set_comment_cookies', $comment, $user);

    if ($comment_id) {
        echo __('Your comment awaiting approval', 'metrika');
    } else {
        echo __('Your comment not sending. Please try to later', 'metrika');
    }
    exit();
}

function menuSave() {
    update_option('metrika_menu', $_POST['object']);
    update_option('blog_page', $_POST['blog_page']);
    die();
}
add_action('wp_ajax_metrika_menuSave', 'menuSave');
add_action('wp_ajax_nopriv_metrika_menuSave', 'menuSave');

function getPreviewImage() {
    echo wp_get_attachment_image($_POST['id'], 'full');
    die();
}
add_action('wp_ajax_metrika_getPreviewImage', 'getPreviewImage');
add_action('wp_ajax_nopriv_metrika_getPreviewImage', 'getPreviewImage');

function getPageTitle() {
    echo get_the_title($_POST['id']);
    die();
}
add_action('wp_ajax_metrika_getPageTitle', 'getPageTitle');
add_action('wp_ajax_nopriv_metrika_getPageTitle', 'getPageTitle');

function getFileTitle() {
    $attachment = wp_get_attachment_url($_POST['id']);
    echo substr($attachment, strrpos($attachment, '/') + 1);
    die();
}
add_action('wp_ajax_metrika_getFileTitle', 'getFileTitle');
add_action('wp_ajax_nopriv_metrika_getFileTitle', 'getFileTitle');

function saveSocialButton() {
    update_option('header_social_buttons', $_POST['object']);
    die();
}
add_action('wp_ajax_metrika_saveSocialButton', 'saveSocialButton');
add_action('wp_ajax_nopriv_metrika_saveSocialButton', 'saveSocialButton');

function saveLogo() {
    update_option('logo', $_POST['object']);
    die();
}
add_action('wp_ajax_metrika_saveLogo', 'saveLogo');
add_action('wp_ajax_nopriv_metrika_saveLogo', 'saveLogo');

function saveHomeBg() {
    update_option('home_bg', $_POST['object']);
    die();
}
add_action('wp_ajax_metrika_saveHomeBg', 'saveHomeBg');
add_action('wp_ajax_nopriv_metrika_saveHomeBg', 'saveHomeBg');

function saveHomeBotomBlock() {
    update_option('bottom_block', $_POST['object']);
    die();
}
add_action('wp_ajax_metrika_saveHomeBotomBlock', 'saveHomeBotomBlock');
add_action('wp_ajax_nopriv_metrika_saveHomeBotomBlock', 'saveHomeBotomBlock');

function saveCopyright() {
    update_option('copyright', $_POST['object']);
    die();
}
add_action('wp_ajax_metrika_saveCopyright', 'saveCopyright');
add_action('wp_ajax_nopriv_metrika_saveCopyright', 'saveCopyright');

function savePageHeaderOptions() {
    update_option('page_header_options', $_POST['object']);
    die();
}
add_action('wp_ajax_metrika_savePageHeaderOptions', 'savePageHeaderOptions');
add_action('wp_ajax_nopriv_metrika_savePageHeaderOptions', 'savePageHeaderOptions');

function saveBlog() {
    update_option('blog_options', $_POST['object']);
    die();
}
add_action('wp_ajax_metrika_saveBlog', 'saveBlog');
add_action('wp_ajax_nopriv_metrika_saveBlog', 'saveBlog');

function saveContacts() {
    update_option('contacts_options', $_POST['object']);
    die();
}
add_action('wp_ajax_metrika_saveContacts', 'saveContacts');
add_action('wp_ajax_nopriv_metrika_saveContacts', 'saveContacts');

function saveOthers() {
    update_option('other_options', $_POST['object']);
    die();
}
add_action('wp_ajax_metrika_saveOthers', 'saveOthers');
add_action('wp_ajax_nopriv_metrika_saveOthers', 'saveOthers');

function formSend() {
    if (empty($_POST['object']['name']))
        echo '<span class="error">' . __("'Your Name' field is required") . '</span><br>';
    if (empty($_POST['object']['email']))
        echo '<span class="error">' . __("'Your E-mail' field is required") . '</span><br>';
    if (empty($_POST['object']['message']))
        echo '<span class="error">' . __("'Any comment' field is required") . '</span>';
    if (empty($_POST['object']['name']) or 
        empty($_POST['object']['email']) or 
        empty($_POST['object']['message']))
        die();
    $options = get_option('contacts_options');
    $to      = $options['form_to'];
    $subject = $options['form_subject'];
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=iso-8859-1";
    $headers[] = 'From: ' . $options['form_from'];
    $message = '
    <html>
        <head>
            <title>' . $options['form_title'] . '</title>
        </head>
        <body>
            <h3>Name: <span style="font-weight: normal;">' . $_POST['object']['name'] . '</span></h3>
            <h3>Email: <span style="font-weight: normal;">' . $_POST['object']['email'] . '</span></h3>
            <div>
                <h3 style="margin-bottom: 5px;">Comment:</h3>
                <div>' . $_POST['object']['message'] . '</div>
            </div>
        </body>
    </html>';
    $result = wp_mail($to, $subject, $message, $headers);
    if ($result)
        echo __('Your message was sent succesfully!', 'metrika');
    else
        echo __("This message wasn't sent. Please try again later.", 'metrika');
    die();
}
add_action('wp_ajax_metrika_formSend', 'formSend');
add_action('wp_ajax_nopriv_metrika_formSend', 'formSend');

function blogPosts() {
    $options = get_option('blog_options');
    !empty($options['date']) ? $date_format = $options['date'] : $date_format = 'd.m.Y';
    $posts = get_posts(array(
        'posts_per_page' => 4,
        'offset' => $_POST['offset']));
    ob_start();
    $i = $_POST['count'];
    $options['list_meta'] == 'true'
        ? $height = 'height: 144px;'
        : $height = '';
    foreach ($posts as $key => $value) {
        $title = $value->post_title;
        if (strlen($title) > 33)
            $title = substr($title, 0, 33) . '...';
        $slug = $value->post_name;
        $author = get_the_author_meta('nickname', $value->post_author);
        $date = get_the_time($date_format, $value->ID);
        $comments = wp_count_comments($value->ID);
        if (comments_open($value->ID))
            $comments = '<i class="fa fa-comment"></i>&nbsp;' . $comments->approved;
        else
            $comments = '';
        $content = $value->post_content;
        $thumbnail = wp_get_attachment_url(get_post_thumbnail_id($value->ID));
        if ($thumbnail && strlen($content) > 150)
            $content = substr($content, 0, 150) . '...';
        elseif (strlen($content) > 189)
            $content = substr($content, 0, 189) . '...';
        ($options['author_info'] == 'true')
            ? $author = ''
            : $author = $author . ', ';
        ?>
        <div class="span6" style="display: none; <?php echo $height ?>">
            <a class="blogpost" href="#<?php echo $slug ?>" onclick="gotoPage(<?php echo $i++; ?>, 7)">
                <h2><?php echo $title ?></h2>
                <?php if (empty($options['list_meta']) or $options['list_meta'] == 'false') : ?>
                    <span class="post-meta"><?php echo $author ?><?php echo $date ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $comments ?></span>
                <?php endif; ?>
                <?php if ($thumbnail) : ?>
                    <div class="thumbnail" style="background-image: url(<?php echo $thumbnail ?>)"></div>
                <?php endif; ?>
                <p><?php echo strip_tags($content) ?></p>
            </a>
        </div>
        <?php
    }
    $list = ob_get_clean();
    $i = $_POST['count'];
    $metrika_menu = get_option('metrika_menu');
    $blog_page = get_option('blog_page');
    $blog_post = get_post($blog_page);
    $blog_slug = $blog_post->post_name;
    foreach ($metrika_menu as $key => $value) {
        if (array_search($blog_page, $value)) {
            $menu_key = $key;
            break;
        }
    }
    if (empty($blog_page)) $blog_page = 0;
    global $user_level;
    if ($user_level == 0) {
        @$form_args = array(
            'comment_notes_after' => '',
            'comment_field' =>  '<fieldset class="span6 comment-form-comment"><textarea id="comment" placeholder="' . __( 'Comment *', 'metrika' ) . '" name="comment" cols="45" rows="8" aria-required="true">' .
                                '</textarea></fieldset></div>',
            'fields' => apply_filters( 'comment_form_default_fields', array(
                'author' =>
                  '<div class="container"><fieldset class="span6">' .
                  ( $req ? '<span class="required">*</span>' : '' ) .
                  '<input id="author" placeholder="' . __( 'Name *', 'metrika' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                  '" size="30"' . $aria_req . ' /><input id="spam_bot" type="hidden">',

                'email' =>
                  ( $req ? '<span class="required">*</span>' : '' ) .
                  '<input id="email" placeholder="' . __( 'E-mail *', 'metrika' ) . '" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                  '" size="30"' . $aria_req . ' /></fieldset>',

                'url' => ''
                )
              )
        );
    } else {
        $form_args = array(
            'comment_notes_after' => '',
            'comment_field' =>  '<div class="container"><fieldset class="span12 comment-form-comment"><textarea id="comment" placeholder="' . __( 'Comment *', 'metrika' ) . '" name="comment" cols="45" rows="8" aria-required="true">' .
                                '</textarea></fieldset></div>'
        );
    }
    ob_start();
    foreach ($posts as $key => $value) {
        $slug = $value->post_name;
        $title = $value->post_title;
        $author = get_the_author_meta('nickname', $value->post_author);
        $date = get_the_time($date_format, $value->ID);
        $comments = wp_count_comments($value->ID);
        if (comments_open($value->ID))
            $comments = '<i class="fa fa-comment"></i>&nbsp;' . $comments->approved;
        else
            $comments = '';
        ($options['author_info'] == 'true')
            ? $author = ''
            : $author = $author . ', ';
        ?>
        <style>
            .pt-page-<?php echo $i; ?> textarea,
            .pt-page-<?php echo $i; ?> input[type=submit] {
                color: <?php echo $metrika_menu[$menu_key]['color'] ?>;
            }
            .pt-page-<?php echo $i ?> input::-webkit-input-placeholder {color: <?php echo $metrika_menu[$menu_key]['color'] ?>;}
            .pt-page-<?php echo $i ?> input:-moz-placeholder {color: <?php echo $metrika_menu[$menu_key]['color'] ?>;}
            .pt-page-<?php echo $i ?> input::-moz-placeholder {color: <?php echo $metrika_menu[$menu_key]['color'] ?>;}
            .pt-page-<?php echo $i ?> input:-ms-input-placeholder {color: <?php echo $metrika_menu[$menu_key]['color'] ?>;}
            .pt-page-<?php echo $i ?> textarea::-webkit-input-placeholder {color: <?php echo $metrika_menu[$menu_key]['color'] ?>;}
            .pt-page-<?php echo $i ?> textarea:-moz-placeholder {color: <?php echo $metrika_menu[$menu_key]['color'] ?>;}
            .pt-page-<?php echo $i ?> textarea::-moz-placeholder {color: <?php echo $metrika_menu[$menu_key]['color'] ?>;}
            .pt-page-<?php echo $i ?> textarea:-ms-input-placeholder {color: <?php echo $metrika_menu[$menu_key]['color'] ?>;}
        </style>
        <article class="post pt-page pt-page-<?php echo $i; ?>" 
                    id="<?php echo $slug ?>"
                    originalclasslist="pt-page pt-page-<?php echo $i++; ?>">
            <div class="outer-wrapper" style="background-color: <?php echo $metrika_menu[$menu_key]['color'] ?>;">
              <!--Header-->
                <header class="row-fluid">
                    <div class="container">
                        <div class="span8 relative">
                            <?php $header_options = get_option('page_header_options') ?>
                            <?php if (empty($header_options['home_button'])) $header_options['home_button'] = 'true' ?>
                            <?php if (empty($header_options['prev_button'])) $header_options['prev_button'] = 'true' ?>
                            <div class="page-navi">
                            <?php if ($header_options['home_button'] == 'true') : ?>
                                <?php if (!empty($header_options['home_animation']) && $header_options['home_animation'] != '0') : ?>
                                    <a class="home-page page-transition" href="#" onclick="gotoPage(0, <?php echo $header_options['home_animation'] ?>)" title="<?php _e('Go Home', 'metrika') ?>"></a>
                                <?php else : ?>
                                    <a class="home-page page-transition" href="#" onclick="gotoPage(0, 6)" title="<?php _e('Go Home', 'metrika') ?>"></a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (!empty($header_options['prev_button']) && $header_options['prev_button'] == 'true') : ?>
                                <?php if ($header_options['prev_animation'] != '0') : ?>
                                    <a page="<?php echo $prevPage ?>" class="prev-page page-transition" href="#<?php echo $blog_slug ?>" onclick="gotoPage(<?php echo $_POST['blog_page_id'] ?>, <?php echo $header_options['prev_animation'] ?>)" title="<?php _e('Go To Blog Page', 'metrika') ?>"></a>
                                <?php else : ?>
                                    <a page="<?php echo $prevPage ?>" class="prev-page page-transition" href="#<?php echo $blog_slug ?>" onclick="gotoPage(<?php echo $_POST['blog_page_id'] ?>, 2)" title="<?php _e('Go To Blog Page', 'metrika') ?>"></a>
                                <?php endif; ?>
                            <?php endif; ?>
                            </div>
                            <h1><?php echo get_the_title($blog_page) ?></h1>
                            <?php subMenu($blog_page) ?>
                        </div>
                        <div class="span4">
                        <?php $buttons = get_option('header_social_buttons') ?>
                        <?php if (!empty($buttons)) : ?>
                            <?php $style_a = '' ?>
                            <?php $style_i = '' ?>
                            <?php if (empty($buttons['page_icon_color_type'])) $buttons['page_icon_color_type'] = 'black' ?>
                            <?php if ($buttons['page_icon_color_type'] == 'black') : ?>
                                <ul class="social-bar-black">
                            <?php elseif ($buttons['page_icon_color_type'] == 'white') : ?>
                                <ul class="social-bar-white">
                            <?php elseif ($buttons['page_icon_color_type'] == 'custom') : ?>
                                <ul class="social-bar-black">
                                <?php if (empty($buttons['page_icon_color'])) $buttons['page_icon_color'] = '#50b28a' ?>
                                <?php $style_a = "style='border-color: " . $buttons['page_icon_color'] . "'" ?>
                                <?php $style_i = "style='color: " . $buttons['page_icon_color'] . "'" ?>
                            <?php else : ?>
                                <ul class="social-bar-black">
                            <?php endif; ?>
                            <?php if (!empty($buttons['icons'])) : ?>
                                <?php foreach ($buttons['icons'] as $item) {
                                    echo '<li><a ' . $style_a . ' href="' . $item['url'] . '" target="_blank"><i ' . $style_i . ' class="fa fa-' . $item['type'] . '"></i></a></li>';
                                } ?>
                            <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                        </div>
                    </div>
                </header>
                <!--Content-->
                <section class="row-fluid">
                    <div class="single-post-content">
                        <div class="container">
                            <h2><?php echo $title ?></h2>
                            <?php if (empty($options['single_meta']) or $options['single_meta'] == 'false') : ?>
                            <span class="post-meta"><?php echo $author ?><?php echo $date; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $comments ?></span>
                            <?php endif; ?>
                            <?php echo apply_filters('the_content', $value->post_content); ?>
                        </div>
                        <?php if (comments_open($value->ID)) : ?>
                            <?php $comments = get_comments(array(
                                                'post_id' => $value->ID,
                                                'status'  => 'approve',
                                                'order'   => 'ASC')); ?>
                        <?php if ($comments) : ?>
                        <div class="container comments">
                            <h2><?php _e('Comments', 'metrika') ?></h2>
                            <div class="comments-wrapper clearfix">
                                <div class="timeline"><span class="timeline-track"></span><span class="timeline-arrow"></span></div>
                                <?php $j = 0 ?>
                                <?php foreach ($comments as $comment) : ?>
                                    <?php (++$j % 2) ? $pointer = 'right' : $pointer = 'left' ?>
                                    <?php ($j % 2) ? $col = '' : $col = 'last-col' ?>
                                    <div class="comment <?php echo $col ?>">
                                        <span class="figcap"></span>
                                        <span class="pointer-<?php echo $pointer ?>"></span>
                                        <span class="comment-meta"><?php echo $comment->comment_author ?>, <?php echo $comment->comment_date ?></span>
                                        <?php echo apply_filters('the_content', $comment->comment_content); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="container comment-form">
                        <h2><?php _e('Leave a Reply', 'metrika') ?></h2>
                        <?php comment_form($form_args, $value->ID) ?>
                      </div>
                        <?php endif; ?>
                    </div>
                </section>
                <div class="push"></div>
                <!--Footer-->
                <footer>
                    <div class="container">
                        <?php $copyright = get_option('copyright'); ?>
                        <?php if (!empty($copyright['copyright'])) : ?>
                            <?php if (!empty($copyright['auto_date']) && $copyright['auto_date'] == 'true') $date = date('Y') ?>
                            <?php if (empty($copyright['page_copyright_type'])) $copyright['page_copyright_type'] = 'black' ?>
                            <?php if ($copyright['page_copyright_type'] == 'black') : ?>
                                <p class="dark"><?php echo $copyright['copyright'] ?> <?php echo $date ?></p>
                            <?php elseif ($copyright['page_copyright_type'] == 'white') : ?>
                                <p><?php echo $copyright['copyright'] ?> <?php echo $date ?></p>
                            <?php else : ?>
                                <?php if (empty($copyright['page_copyright_color'])) $copyright['page_copyright_color'] = '#50b28a' ?>
                                <p style="color: <?php echo $copyright['page_copyright_color'] ?>"><?php echo $copyright['copyright'] ?> <?php echo $date ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </footer>
            </div>
        </article>
        <?php
    }
    $posts = ob_get_clean();
    ob_start();
    $post_count = wp_count_posts('post');
    if ($post_count->publish > 4 && $post_count->publish > $_POST['offset'] + 4) :
    ?>
    <div class="container blogpost-row load-more-container">
        <a class="load-more-btn" href="#"><span class="figcap"></span><p><?php _e('Load more', 'metrika') ?></p></a>
    </div>
    <?php
    endif;
    $load_more = ob_get_clean();
    $content = array(
        'list'  => $list,
        'posts' => $posts,
        'more'  => $load_more);
    echo json_encode($content);
    die();
}
add_action('wp_ajax_metrika_blogPosts', 'blogPosts');
add_action('wp_ajax_nopriv_metrika_blogPosts', 'blogPosts');
