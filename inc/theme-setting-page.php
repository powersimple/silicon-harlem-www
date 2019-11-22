<?php
function register_my_custom_menu_page(){
    add_theme_page( __('Metrika Options', 'metrika'), __('Metrika', 'metrika'), 'administrator', 'metrika_options', 'create_metrika_panel');
}
add_action( 'admin_menu', 'register_my_custom_menu_page' );

function create_metrika_panel(){
    ?>
    <div class="wrap">
        <?php screen_icon('themes'); ?>
        <h2 class="customization-title"><?php _e('Theme Options', 'metrika') ?></h2>

        <div class="metrika">
            <div id="customize_tab">
                <ul>
                    <li><a href="#tabs-1"><?php _e('Menu Customization', 'metrika') ?></a></li>
                    <li><a href="#tabs-2"><?php _e('Header Options', 'metrika') ?></a></li>
                    <li><a href="#tabs-3"><?php _e('Home Options', 'metrika') ?></a></li>
                    <li><a href="#tabs-4"><?php _e('Footer Options', 'metrika') ?></a></li>
                    <li><a href="#tabs-5"><?php _e('Blog Options', 'metrika') ?></a></li>
                    <li><a href="#tabs-6"><?php _e('Contact Information', 'metrika') ?></a></li>
                    <li><a href="#tabs-7"><?php _e('Other', 'metrika') ?></a></li>
                </ul>
                <div id="tabs-1">
                    <?php menuCustomization() ?>
                </div>
                <div id="tabs-2">
                    <div>
                        <h2><?php _e('Header Social Button', 'metrika') ?></h2>
                        <?php headerSocialButton() ?>
                        <hr>
                    </div>
                    <div>
                        <h2><?php _e('Logo', 'metrika') ?></h2>
                        <?php logoCustomization() ?>
                        <hr>
                    </div>
                    <div>
                        <h2><?php _e('Page Header Options', 'metrika') ?></h2>
                        <?php pageHeaderOptions() ?>
                    </div>
                </div>
                <div id="tabs-3">
                    <div>
                        <h2><?php _e('Home Background', 'metrika') ?></h2>
                        <?php homeCustomization() ?>
                        <hr>
                        <h2><?php _e('Home Bottom Block', 'metrika') ?></h2>
                        <?php homeBottomBlock() ?>
                    </div>
                </div>
                <div id="tabs-4">
                    <h2><?php _e('Copyright', 'metrika') ?></h2>
                    <?php copyrightOptions() ?>
                </div>
                <div id="tabs-5">
                    <h2><?php _e('Blog Options', 'metrika') ?></h2>
                    <?php blogOptions() ?>
                </div>
                <div id="tabs-6">
                    <h2><?php _e('Contact Information', 'metrika') ?></h2>
                    <?php contactOptions() ?>
                </div>
                <div id="tabs-7">
                    <h2><?php _e('Other Options', 'metrika') ?></h2>
                    <?php otherOptions() ?>
                </div>
            </div>
        </div>
<?php  
}

function menuCustomization() {
    ?>
    <?php $blog_page = get_option('blog_page'); ?>
    <?php if (empty($blog_page)) $blog_page = 0 ?>
    <div class="select-blog-page">
        <label><?php _e('Select Blog Page:', 'metrika') ?></label>
        <?php wp_dropdown_pages(array('show_option_none' => __('Select Page', 'metrika'),'selected' => $blog_page)) ?>
        <hr> 
    </div>
    <a id="add-new-tile" href="#" class="button-secondary"><?php _e('Add New Tile', 'metrika') ?></a>
    <div class="gridster">
    <?php $metrika_menu = get_option('metrika_menu'); ?>
        <ul>
        <?php if (!empty($metrika_menu)) : ?>
            <?php foreach($metrika_menu as $item) : ?>
                <?php
                if (empty($item['bg_img']))
                    $item['bg_img'] = '';
                if (empty($item['icon']))
                    $item['icon'] = '';
                if (empty($item['page_id']))
                    $item['page_id'] = '';
                if (empty($item['img']))
                    $item['img'] = '';
                if (empty($item['disable_title']))
                    $item['disable_title'] = '';
                if (empty($item['file_id']))
                    $item['file_id'] = '';
                if (empty($item['file_title']))
                    $item['file_title'] = '';
                if (empty($item['external_link_title']))
                    $item['external_link_title'] = '';
                if (empty($item['external_link']))
                    $item['external_link'] = '';
                if (empty($item['tile_type']))
                    $item['tile_type'] = '';
                ?>

                <li style="background-color: <?php echo $item['color'] ?>; 
                            background-image: url(<?php echo wp_get_attachment_url($item['bg_img']) ?>);" 
                    data-row="<?php echo $item['row'] ?>" 
                    data-col="<?php echo $item['col'] ?>" 
                    data-sizex="<?php echo $item['sizex'] ?>" 
                    data-sizey="<?php echo $item['sizey'] ?>"
                    data-color="<?php echo $item['color'] ?>"
                    data-icon="<?php echo $item['icon'] ?>"
                    data-page-id="<?php echo $item['page_id'] ?>"
                    data-img="<?php echo $item['img'] ?>"
                    data-disable-title="<?php echo $item['disable_title'] ?>"
                    data-bg="<?php echo $item['bg_img'] ?>"
                    data-file-id="<?php echo $item['file_id'] ?>"
                    data-file-title="<?php echo $item['file_title'] ?>"
                    data-external-link-title="<?php echo $item['external_link_title'] ?>"
                    data-external-link="<?php echo $item['external_link'] ?>"
                    data-tile-type="<?php echo $item['tile_type'] ?>">
                    <div class="controls">
                        <i class="fa fa-pencil"></i>
                        <i class="fa fa-trash-o"></i>
                    </div>
                    <?php if (!empty($item['icon'])) : ?>
                        <i class="tile-icon fa <?php echo $item['icon'] ?>"></i>
                    <?php else : ?>
                        <i class="fa tile-icon"></i>
                    <?php endif; ?>
                    <?php if ($item['tile_type'] == 'file') : ?>
                        <?php if (!empty($item['file_title'])) : ?>
                            <span class="title"><?php echo $item['file_title'] ?></span>
                        <?php else : ?>
                            <span class="title"></span>
                        <?php endif; ?>
                    <?php elseif ($item['tile_type'] == 'link') : ?>
                        <?php if (!empty($item['external_link_title'])) : ?>
                            <span class="title"><?php echo $item['external_link_title'] ?></span>
                        <?php else : ?>
                            <span class="title"></span>
                        <?php endif; ?>
                    <?php else : ?>
                        <?php if (!empty($item['page_id']) && empty($item['disable_title'])) : ?>
                            <span class="title"><?php echo get_the_title($item['page_id']) ?></span>
                        <?php else : ?>
                            <span class="title"></span>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (!empty($item['img'])) : ?>
                        <div class="img_icon_container">
                            <?php echo wp_get_attachment_image($item['img'], 'full'); ?>
                        </div>
                    <?php else : ?>
                        <div class="img_icon_container"></div>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <li data-row="1" data-col="1" data-sizex="1" data-sizey="1" data-color="#50b2a2" style="background-color: rgb(80, 178, 162);">
                <div class="controls">
                    <i class="fa fa-pencil"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
                <div class="img_icon_container"></div>
                <i class="fa tile-icon"></i>
                <span class="title"></span>
            </li>
            <li data-row="1" data-col="1" data-sizex="1" data-sizey="1" data-color="#50b28a" style="background-color: rgb(80, 178, 138);">
                <div class="controls">
                    <i class="fa fa-pencil"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
                <div class="img_icon_container"></div>
                <i class="fa tile-icon"></i>
                <span class="title"></span>
            </li>
            <li data-row="2" data-col="1" data-sizex="2" data-sizey="1" data-color="#c85141" style="background-color: rgb(200, 81, 65);">
                <div class="controls">
                    <i class="fa fa-pencil"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
                <div class="img_icon_container"></div>
                <i class="fa tile-icon"></i>
                <span class="title"></span>
            </li>
     
            <li data-row="1" data-col="2" data-sizex="2" data-sizey="2" data-color="#0fa2cb" style="background-color: rgb(15, 162, 203);">
                <div class="controls">
                    <i class="fa fa-pencil"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
                <div class="img_icon_container"></div>
                <i class="fa tile-icon"></i>
                <span class="title"></span>
            </li>
     
            <li data-row="1" data-col="5" data-sizex="2" data-sizey="1" data-color="#d8457a" style="background-color: rgb(216, 69, 122);">
                <div class="controls">
                    <i class="fa fa-pencil"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
                <div class="img_icon_container"></div>
                <i class="fa tile-icon"></i>
                <span class="title"></span>
            </li>
            <li data-row="2" data-col="5" data-sizex="1" data-sizey="1" data-color="#d8733b" style="background-color: rgb(216, 115, 59);">
                <div class="controls">
                    <i class="fa fa-pencil"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
                <div class="img_icon_container"></div>
                <i class="fa tile-icon"></i>
                <span class="title"></span>
            </li>
            <li data-row="2" data-col="6" data-sizex="1" data-sizey="1" data-color="#d9912a" style="background-color: rgb(217, 145, 42);">
                <div class="controls">
                    <i class="fa fa-pencil"></i>
                    <i class="fa fa-trash-o"></i>
                </div>
                <div class="img_icon_container"></div>
                <i class="fa tile-icon"></i>
                <span class="title"></span>
            </li>
        <?php endif; ?>
        </ul>
    </div>
    <a id="save-menu" href="#" class="button-primary"><?php _e('Save Menu', 'metrika') ?></a>
    <span class="save-status"></span>
    <div id="tile-edit" style="display: none;">
        <div class="content">
            <a id="close" href="#" class="button-secondary"><?php _e('close', 'metrika') ?></a>
            <h4><?php _e('Edit Tile', 'metrika') ?></h4>
            <hr>
            <label><?php _e('Select Tile Type:', 'metrika') ?></label><br>
            <select id="tile-type">
                <option value="<?php _e('page', 'metrika') ?>"><?php _e('Page', 'metrika') ?></option>
                <option value="<?php _e('file', 'metrika') ?>"><?php _e('File', 'metrika') ?></option>
                <option value="<?php _e('link', 'metrika') ?>"><?php _e('Custom URL', 'metrika') ?></option>
            </select>
            <hr>
            <div>
                <label><?php _e('Select Icon or Upload Image:', 'metrika') ?></label>
                <div class="select-list pull-left">
                    <div class="current-icon"><?php _e('Select Icon', 'metrika') ?></div>
                    <span class="curret"><i class="fa fa-caret-down"></i></span>
                    <?php echo itembrige_icons_list() ?>
                </div>
                <a href="#" class="button-primary pull-left" name="icon_upload_button" id="icon_upload_button"><?php _e('Upload', 'metrika') ?></a>
                <div class="pull-left image_preview" style="display: none;"></div>
                <div class="clearfix"></div>
                <label><?php _e('Select Tile Color or Upload Background Image:', 'metrika') ?></label><br>
                <input id="colorpicker" type="text" value="#50b28a"><div class="clearfix"></div>
                <a href="#" id="upload_bg_image" class="button-primary"><?php _e('Upload Image', 'metrika') ?></a>
                <div class="bg-image-preview" style="display: none;"></div>
                <hr>
                <label><?php _e('Page:', 'metrika'); ?></label><br>
                <?php wp_dropdown_pages(array('show_option_none' => ' ', 'option_none_value' => 0)) ?>
                <label><input class="disable-title" type="checkbox"> <?php _e('disable title', 'metrika') ?></label>
                <hr>
                <label>File:</label><br>
                <input type="text" class="file-title" placeholder="<?php _e('Title', 'metrika') ?>">
                <a href="#" id="file_uploader_button" class="button-primary"><?php _e('Upload File', 'metrika') ?></a>
                <span class="file-preview"></span>
                <hr>
                <label>Custom URL:</label><br>
                <input type="text" class="external-link-title" placeholder="<?php _e('Title', 'metrika') ?>">
                <input type="text" class="external-link" placeholder="<?php _e('URL', 'metrika') ?>">
                <hr>
            </div>
        </div>
    </div>
    <?php
}

function headerSocialButton() {
    socialIconsList();
    ?>
    <input type="text" class="soc-button-url" placeholder="<?php _e('URL', 'metrika') ?>">
    <a href="#" class="add-soc-button button-primary"><?php _e('Add Button', 'metrika') ?></a><br>
    <?php
    $buttons = get_option('header_social_buttons');
    if (!empty($buttons['icons'])) {
        echo '<ul class="header-sb-preview unstyled">';
        foreach ($buttons['icons'] as $item) {
            echo '<li data-type="' . $item['type'] . '" data-url="' . $item['url'] . '"><i class="fa fa-' . $item['type'] . '"></i><a href="#" class="delete-button"><i class="fa fa-trash-o"></i></a></li>';
        }
        echo "</ul>";
    } else {
        echo '<ul class="header-sb-preview unstyled"></ul>';
    }
    ?>
    <br>
    <div class="pull-left">
        <label><?php _e('Select Home Social Buttons Color:', 'metrika') ?></label>
        <?php if (empty($buttons['home_icon_color'])) $buttons['home_icon_color'] = '#50b28a' ?>
        <input value="<?php echo $buttons['home_icon_color'] ?>" type="hidden" id="home-soc-buttons-color">
        <select id="home-soc-buttons-colo-type">
            <?php if (empty($buttons['home_icon_color_type'])) $buttons['home_icon_color_type'] = 'black' ?>
            <option value="black" <?php if ( $buttons['home_icon_color_type'] == 'black' ) echo 'selected="selected"'; ?>><?php _e('Black', 'metrika') ?></option>
            <option value="white" <?php if ( $buttons['home_icon_color_type'] == 'white' ) echo 'selected="selected"'; ?>><?php _e('White', 'metrika') ?></option>
            <option value="custom" <?php if ( $buttons['home_icon_color_type'] == 'custom' ) echo 'selected="selected"'; ?>><?php _e('Custom Color', 'metrika') ?></option>
        </select><br>
        <input id="home-soc-buttons-colorpicker" type="text" value="<?php echo $buttons['home_icon_color'] ?>">
    </div>
    <div class="pull-left last">
        <label><?php _e('Select Page Social Buttons Color:', 'metrika') ?></label>
        <?php if (empty($buttons['page_icon_color'])) $buttons['page_icon_color'] = '' ?>
        <input value="<?php echo $buttons['page_icon_color'] ?>" type="hidden" id="page-soc-buttons-color">
        <select id="page-soc-buttons-colo-type">
        <?php if (empty($buttons['page_icon_color_type'])) $buttons['page_icon_color_type'] = 'black' ?>
            <option value="black" <?php if ( $buttons['page_icon_color_type'] == 'black' ) echo 'selected="selected"'; ?>><?php _e('Black', 'metrika') ?></option>
            <option value="white" <?php if ( $buttons['page_icon_color_type'] == 'white' ) echo 'selected="selected"'; ?>><?php _e('White', 'metrika') ?></option>
            <option value="custom" <?php if ( $buttons['page_icon_color_type'] == 'custom' ) echo 'selected="selected"'; ?>><?php _e('Custom Color', 'metrika') ?></option>
        </select><br>
        <?php if (empty($buttons['page_icon_color'])) $buttons['page_icon_color'] = '#50b28a' ?>
        <input id="page-soc-buttons-colorpicker" type="text" value="<?php echo $buttons['page_icon_color'] ?>">
    </div>
    <div class="clearfix"></div>
    <a href="#" id="save-header-soc-button" class="button-primary"><?php _e('Save Buttons', 'metrika') ?></a>
    <span class="soc-save-status"></span>
    <?php
}

function logoCustomization() {
    $logo = get_option('logo');
    ?>
    <div class="pull-left">
    <?php if (!empty($logo['logo_text'])) : ?>
        <input value="<?php echo $logo['logo_text'] ?>" type="text" id="logo-text" placeholder="<?php _e('Logo Text', 'metrika') ?>"><br>
    <?php else : ?>
        <input type="text" id="logo-text" placeholder="<?php _e('Logo Text', 'metrika') ?>"><br>
    <?php endif; ?>
        <input type="hidden" id="logo-img-id" value="<?php if (!empty($logo['logo_img'])) echo $logo['logo_img']; ?>">
        <label><?php _e('Upload Logo Image:') ?>
            <a href="#" id="logo-upload" class="button-primary"><?php _e('Upload', 'metrika') ?></a>
        </label>
    </div>
    <div class="pull-left">
        <div class="logo-preview">
            <?php if (!empty($logo['logo_img'])) : ?>
                <?php echo wp_get_attachment_image($logo['logo_img'], 'full'); ?>
                <a href="#" id="remove-logo"><i class="fa fa-trash-o"></i></a>
            <?php endif; ?>
        </div>
    </div>
    <div class="pull-left last">
        <label><?php _e('Select Logo Position:', 'metrika') ?></label>
        <?php if (empty($logo['logo_pos'])) $logo['logo_pos'] = 'left'; ?>
        <select id="logo-position">
            <option value="left" <?php if ($logo['logo_pos'] == 'left') echo 'selected="selected"'; ?>><?php _e('Left', 'metrika') ?></option>
            <option value="center" <?php if ($logo['logo_pos'] == 'center') echo 'selected="selected"'; ?>><?php _e('Center', 'metrika') ?></option>
        </select><br>
        <label><?php _e('Select Logo Type', 'metrika') ?></label>
        <?php if (empty($logo['logo_type'])) $logo['logo_type'] = 'text'; ?>
        <select id="logo-type">
            <option value="text" <?php if ($logo['logo_type'] == 'text') echo 'selected="selected"'; ?>><?php _e('Text', 'metrika') ?></option>
            <option value="image" <?php if ($logo['logo_type'] == 'image') echo 'selected="selected"'; ?>><?php _e('Image', 'metrika') ?></option>
        </select>
    </div>
    <div class="clearfix"></div>
    <a href="#" id="save-logo" class="button-primary"><?php _e('Save Logo', 'metrika') ?></a>
    <span class="logo-save-status"></span>
    <?php
}

function homeCustomization() {
    $home_bg = get_option('home_bg');
    ?>
    <div class="pull-left">
        <label><?php _e('Select Background Type:', 'metrika') ?></label>
        <?php if (empty($home_bg['home_bg_type'])) $home_bg['home_bg_type'] = 'color' ?>
        <select id="home-bg-type">
            <option value="color" <?php if ($home_bg['home_bg_type'] == 'color') echo 'selected="selected"'; ?>><?php _e('Color', 'metrika') ?></option>
            <option value="image" <?php if ($home_bg['home_bg_type'] == 'image') echo 'selected="selected"'; ?>><?php _e('Image', 'metrika') ?></option>
        </select>
    </div>
    <div class="pull-left home-bg-options">
        <label><?php _e('Select Background Color:', 'metrika') ?></label>
        <?php if (empty($home_bg['home_bg_color'])) $home_bg['home_bg_color'] = '' ?>
        <input value="<?php echo $home_bg['home_bg_color'] ?>" type="hidden" id="home-bg-color">
        <input id="home-bg-colorpicker" type="text" value="<?php echo $home_bg['home_bg_color'] ?>"><div class="clearfix"></div>
        <label><?php _e('Select Background Image:', 'metrika') ?></label>
        <?php if (empty($home_bg['home_bg_image'])) $home_bg['home_bg_image'] = '' ?>
        <input value="<?php echo $home_bg['home_bg_image'] ?>" type="hidden" id="home-bg-id">
        <a href="#" id="upload-home-bg" class="button-primary"><?php _e('Upload Image', 'metrika') ?></a>
        <div class="home-bg-preview">
        <?php if (!empty($home_bg['home_bg_image'])) : ?>
            <?php echo wp_get_attachment_image($home_bg['home_bg_image'], 'full'); ?>
            <a href="#" id="remove-home-bg"><i class="fa fa-trash-o"></i></a>
        <?php endif; ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <a href="#" id="save-home-bg" class="button-primary"><?php _e('Save Home Background', 'metrika') ?></a>
    <span class="home-bg-save-status"></span>
    <?php
}

function homeBottomBlock() {
    $block = get_option('bottom_block');
    ?>
    <div class="pull-left">
        <label><?php _e('Select Block Type:', 'metrika') ?></label>
        <select id="home-bottom-block">
            <option value="none" <?php if ($block['block_type'] == 'none') echo 'selected="selected"'; ?>><?php _e('None', 'metrika') ?></option>
            <option value="twit" <?php if ($block['block_type'] == 'twit') echo 'selected="selected"'; ?>><?php _e('Latest Twit', 'metrika') ?></option>
            <option value="custom" <?php if ($block['block_type'] == 'custom') echo 'selected="selected"'; ?>><?php _e('Custom Text', 'metrika') ?></option>
        </select><br>
        <label><?php _e('Enter twitter username:', 'metrika') ?></label>
        <input type="text" id="twitter_user" value="<?php if (!empty($block['twitter_user'])) echo $block['twitter_user']; ?>">
    </div>
    <div class="pull-left last">
        <label><?php _e('Enter Custom Text:', 'metrika') ?></label>
        <textarea id="home-custom-text"><?php if (!empty($block['custom_text'])) echo $block['custom_text']; ?></textarea>
    </div>
    <div class="clearfix"></div>
    <a href="#" id="save-home-bottom-block" class="button-primary"><?php _e('Save Home Bottom Block', 'metrika') ?></a>
    <span class="home-bottom-block-save-status"></span>
    <?php
}

function copyrightOptions() {
    $copyright = get_option('copyright');
    ?>
    <label><?php _e('Enter Copyright Text:', 'metrika') ?></label>
    <input type="text" id="copyright-text" value="<?php if (!empty($copyright['copyright'])) echo $copyright['copyright'] ?>">
    <label><input type="checkbox" id="echo-date" <?php if ($copyright['auto_date'] == 'true') echo 'checked' ?>> <?php _e('Automatically add current year') ?></label>
    <div class="clearfix"></div>
    <div class="pull-left">
        <label><?php _e('Select Home Copyright Type:', 'metrika') ?></label>
        <select id="home-copyright-type">
        <?php if (empty($copyright['home_copyright_type'])) $copyright['home_copyright_type'] = 'black' ?>
            <option value="black" <?php if ($copyright['home_copyright_type'] == 'black') echo 'selected="selected"'; ?>><?php _e('Black', 'metrika') ?></option>
            <option value="white" <?php if ($copyright['home_copyright_type'] == 'white') echo 'selected="selected"'; ?>><?php _e('White', 'metrika') ?></option>
            <option value="custom" <?php if ($copyright['home_copyright_type'] == 'custom') echo 'selected="selected"'; ?>><?php _e('Custom Color', 'metrika') ?></option>
        </select><br>
        <?php if (empty($copyright['home_copyright_color'])) $copyright['home_copyright_color'] = '#50b28a' ?>
        <input type="hidden" id="home-copyright-color" value="<?php echo $copyright['home_copyright_color'] ?>">
        <input id="home-copyright-color-colorpicker" type="text" value="<?php echo $copyright['home_copyright_color'] ?>"><div class="clearfix"></div>
    </div>
    <div class="pull-left last">
        <label><?php _e('Select Page Copyright Type:', 'metrika') ?></label>
        <select id="page-copyright-type">
        <?php if (empty($copyright['page_copyright_type'])) $copyright['page_copyright_type'] = 'black' ?>
            <option value="black" <?php if ($copyright['page_copyright_type'] == 'black') echo 'selected="selected"'; ?>><?php _e('Black', 'metrika') ?></option>
            <option value="white" <?php if ($copyright['page_copyright_type'] == 'white') echo 'selected="selected"'; ?>><?php _e('White', 'metrika') ?></option>
            <option value="custom" <?php if ($copyright['page_copyright_type'] == 'custom') echo 'selected="selected"'; ?>><?php _e('Custom Color', 'metrika') ?></option>
        </select><br>
        <?php if (empty($copyright['page_copyright_color'])) $copyright['page_copyright_color'] = '#50b28a' ?>
        <input type="hidden" id="page-copyright-color" value="<?php echo $copyright['page_copyright_color'] ?>">
        <input id="page-copyright-color-colorpicker" type="text" value="<?php echo $copyright['page_copyright_color'] ?>"><div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <a href="#" id="save-copyright" class="button-primary"><?php _e('Save Copyright', 'metrika') ?></a>
    <span class="copyright-save-status"></span>
    <?php
}

function pageHeaderOptions() {
    $header_options = get_option('page_header_options');
    ?>
    <div class="page-header-options">
        <div class="pull-left">
            <label><?php _e('Home Button Options:', 'metrika') ?></label>
            <label><input type="checkbox" id="enable-home-button" <?php if (!empty($header_options['home_button']) && $header_options['home_button'] == 'true') echo 'checked' ?>> <?php _e('Enable Button', 'metrika') ?></label>
            <?php if (empty($header_options['home_animation'])) $header_options['home_animation'] = 0 ?>
            <?php animationList('home-button-animation', $header_options['home_animation']) ?>
        </div>
        <div class="pull-left last">
            <label><?php _e('Prev Page Button Options:', 'metrika') ?></label>
            <label><input type="checkbox" id="enable-prev-button" <?php if (!empty($header_options['prev_button']) && $header_options['prev_button'] == 'true') echo 'checked' ?>> <?php _e('Enable Button', 'metrika') ?></label>
            <?php if (empty($header_options['prev_animation'])) $header_options['prev_animation'] = 0 ?>
            <?php animationList('prev-button-animation', $header_options['prev_animation']) ?>
        </div>
        <div class="pull-left last">
            <label><?php _e('Next Page Button Options:', 'metrika') ?></label>
            <label><input type="checkbox" id="enable-next-button" <?php if (!empty($header_options['next_button']) && $header_options['next_button'] == 'true') echo 'checked' ?>> <?php _e('Enable Button', 'metrika') ?></label>
            <?php if (empty($header_options['next_animation'])) $header_options['next_animation'] = 0 ?>
            <?php animationList('next-button-animation', $header_options['next_animation']) ?>
        </div>
        <div class="clearfix"></div>
        <a href="#" id="save-page-header" class="button-primary"><?php _e('Save Options', 'metrika') ?></a>
        <span class="page-header-save-status"></span>
    </div>
    <?php
}

function blogOptions() {
    $options = get_option('blog_options');
    ?>
    <label><?php _e('Enter custom date format:', 'metrika') ?></label>
    <input type="text" placeholder="d.m.Y" id="data-format" value="<?php echo !empty($options['date']) ? $options['date'] : '' ?>"> 
    <span><a target="_blank" href="http://ua2.php.net/manual/en/function.date.php#refsect1-function.date-parameters"><?php _e('See the formatting options.', 'metrika') ?></a></span>
    <label>
        <input type="checkbox" id="disable_author_meta" <?php echo ($options['author_info'] == 'true') ? 'checked' : '' ?>>
        <?php _e('disable author info', 'metrika') ?>
    </label>
    <label>
        <input type="checkbox" id="disable_list_meta" <?php echo ($options['list_meta'] == 'true') ? 'checked' : '' ?>>
        <?php _e('disable meta information (posts list)', 'metrika') ?>
    </label>
    <label>
        <input type="checkbox" id="disable_single_meta" <?php echo ($options['single_meta'] == 'true') ? 'checked' : '' ?>>
        <?php _e('disable meta information (single post)', 'metrika') ?>
    </label>
    <a href="#" id="save-blog" class="button-primary"><?php _e('Save Options', 'metrika') ?></a>
    <span class="blog-save-status"></span>
    <?php
}

function contactOptions() {
    $options = get_option('contacts_options');
    ?>
    <div class="pull-left">
        <label><?php _e('First Phone Label', 'metrika') ?></label>
        <input type="text" id="first_phone_label" value="<?php echo $options['first_phone_label'] ?>">
        <label><?php _e('First Phone Time', 'metrika') ?></label>
        <input type="text" id="first_phone_time" value="<?php echo $options['first_phone_time'] ?>">
        <label><?php _e('First Phone Number', 'metrika') ?></label>
        <input type="text" id="first_phone_number" value="<?php echo $options['first_phone_number'] ?>">
        <label><?php _e('Second Phone Label', 'metrika') ?></label>
        <input type="text" id="second_phone_label" value="<?php echo $options['second_phone_label'] ?>">
        <label><?php _e('Second Phone Time', 'metrika') ?></label>
        <input type="text" id="second_phone_time" value="<?php echo $options['second_phone_time'] ?>">
        <label><?php _e('Second Phone Number', 'metrika') ?></label>
        <input type="text" id="second_phone_number" value="<?php echo $options['second_phone_number'] ?>">
    </div>
    <div class="pull-left last">
        <label><?php _e('Address', 'metrika') ?></label>
        <input type="text" id="address" value="<?php echo $options['address'] ?>">
        <label><?php _e('First E-mail Label', 'metrika') ?></label>
        <input type="text" id="first_email_label" value="<?php echo $options['first_email_label'] ?>">
        <label><?php _e('First E-mail', 'metrika') ?></label>
        <input type="text" id="first_email" value="<?php echo $options['first_email'] ?>">
        <label><?php _e('Second E-mail Label', 'metrika') ?></label>
        <input type="text" id="second_email_label" value="<?php echo $options['second_email_label'] ?>">
        <label><?php _e('Second E-mail', 'metrika') ?></label>
        <input type="text" id="second_email" value="<?php echo $options['second_email'] ?>">
    </div>
    <div class="pull-left last form_info">
        <h5><?php _e('Feedback Options', 'metrika') ?></h5>
        <label><?php _e('From:', 'metrika') ?></label>
        <input type="text" id="form_from" value="<?php echo $options['form_from'] ?>">
        <label><?php _e('To:', 'metrika') ?></label>
        <input type="text" id="form_to" value="<?php echo $options['form_to'] ?>">
        <label><?php _e('Subject:', 'metrika') ?></label>
        <input type="text" id="form_subject" value="<?php echo $options['form_subject'] ?>">
        <label><?php _e('Title:', 'metrika') ?></label>
        <input type="text" id="form_title" value="<?php echo $options['form_title'] ?>">
    </div>
    <div class="clearfix"></div>
    <a href="#" id="save-contacts" class="button-primary"><?php _e('Save Contacts', 'metrika') ?></a>
    <span class="contacts-save-status"></span>
    <?php
}

function otherOptions() {
    $options = get_option('other_options');
    $fonts   = Metrika_google_fonts();
    ?>
    <input type="hidden" id="favicon-id" value="<?php if (!empty($options['favicon'])) echo $logo['logo_img']; ?>">
    <label class="pull-left"><?php _e('Upload Favicon:', 'metrika') ?>
        <a href="#" id="favicon-upload" class="button-primary"><?php _e('Upload', 'metrika') ?></a>
    </label>
    <div class="favicon-preview pull-left">
        <?php if (!empty($options['favicon'])) : ?>
            <?php echo wp_get_attachment_image($options['favicon'], 'full'); ?>
            <a href="#" id="remove-favicon"><i class="fa fa-trash-o"></i></a>
        <?php endif; ?>
    </div>
    <div class="clearfix"></div>
    <label style="vertical-align: top;"><?php _e('Link Color:', 'metrika') ?>
        <input id="link_colorpicker" type="text" value="<?php echo !empty($options['link_color']) ? $options['link_color'] : '#ffffff' ?>">
    </label>
    <label><?php _e('Enable preloader:', 'metrika') ?>
        <input type="checkbox" id="preloader_enable" <?php echo $options['preloader'] == 'true' ? 'checked' : '' ?>>
    </label>
    <label style="vertical-align: top;"><?php _e('Preloader Color:', 'metrika') ?>
        <input id="preloader_colorpicker" type="text" value="<?php echo !empty($options['preloader_color']) ? $options['preloader_color'] : '#0fa2cb' ?>">
    </label>
    <label id="font"><?php _e('Select Font:', 'metrika') ?>
    <select>
    <?php foreach ($fonts as $key => $font) : ?>
        <option value="<?php echo $key ?>" <?php if ( $key == $options['font'] ) echo 'selected="selected"'; ?>><?php echo $font['name'] ?></option>
    <?php endforeach; ?>
    </select>
    </label>
    <div class="clearfix"></div>
    <a href="#" id="save-other" class="button-primary"><?php _e('Save Other', 'metrika') ?></a>
    <span class="other-save-status"></span>
    <?php
}