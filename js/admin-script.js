(function($){
    $(document).ready(function() {

        /*---------------------------------------------------------------------------------------------------------
         * Team Social Icon
         --------------------------------------------------------------------------------------------------------*/
        $('.team_social_preview ul').sortable({
            placeholder: "ui-state-highlight",
            beforeStop: function( event, item ) {
                var value = '';
                $('.team_social_preview li').not('.ui-state-highlight').each(function() {
                    value += '[social type_icon=' + $('i', this).attr('class').replace('fa fa-', '') + ' href=' + $('a', this).attr('href') + ']';
                });
                $('#social_team_input').val(value);
            }
        });
        
        $('.team_social_preview').on('click', ".team_social_remove", function () {
            $('#social_team_input').val($('#social_team_input').val().replace(new RegExp('\\[[^\\]]+type_icon=' + $(this).closest("li").remove().find("i").attr('class').replace('fa fa-', '') + '[^\\]]+\\]', 'gi'), ''));
            $(this).closest('li').remove();
            return false;
        });

        $('.team_social_preview a').each(function() {
            $('<a href="#" class="team_social_remove button-secondary">Remove</a><br><div class="clearfix"></div>').insertAfter($(this));
        });

        $('#team_social_add').click(function() {
            if ($('.team_social_preview a').is(".icon-" + $(".team_social_select").val())) {
                alert("Such a social network is already added");
                return false;
            } else {
                $('<li><a href="' + $('.team_social_link').val() + '" target="_blank"><i class="fa fa-' + $(".team_social_select").val() + '"></i></a><a href="#" class="team_social_remove button-secondary">Remove</a></li>').appendTo($(".team_social_preview > ul"));
                $("#social_team_input").val($("#social_team_input").val() + '[social type_icon=' + $(".team_social_select").val() + ' href=' + $('.team_social_link').val() + ']');
            }
            return false;
        });
        /*-------------------------------------------------------------------------------------------------------*/
        
        
        /*---------------------------------------------------------------------------------------------------------
         * header Social Icon
         --------------------------------------------------------------------------------------------------------*/
        $('.header-sb-preview').sortable({
            placeholder: "ui-state-highlight",
        });
        
        $('.add-soc-button').click(function() {
            type = $('.soc-icon-list option:selected').val();
            url  = $('.soc-button-url').val();
            $('.header-sb-preview').append('<li data-type="' + type + '" data-url="' + url + '"><i class="fa fa-' + type + '"></i><a href="#" class="delete-button"><i class="fa fa-trash-o"></i></a></li>');
            return false;
        });

        $('.header-sb-preview').on('click', '.delete-button', function() {
            $(this).closest('li').remove();
            return false;
        });

        $('#save-header-soc-button').click(function() {
            object = {},
            icons  = {},
            i      = 0;
            $('.header-sb-preview li').each(function() {
                icons[++i] = {
                    type : $(this).attr('data-type'),
                    url  : $(this).attr('data-url')
                };
            });
            object = {
                icons               : icons,
                home_icon_color     : $('#home-soc-buttons-color').val(),
                page_icon_color     : $('#page-soc-buttons-color').val(),
                home_icon_color_type: $('#home-soc-buttons-colo-type option:selected').val(),
                page_icon_color_type: $('#page-soc-buttons-colo-type option:selected').val(),
            }
            data = {
                action: 'metrika_saveSocialButton',
                object: object
            };
            ajaxSave('.soc-save-status', data);
            return false;
        });

        $('#home-soc-buttons-colorpicker').wpColorPicker({
            palettes: false,
            change : function() {
                $('#home-soc-buttons-color').val($(this).val());
            }
        });

        $('#page-soc-buttons-colorpicker').wpColorPicker({
            palettes: false,
            change : function() {
                $('#page-soc-buttons-color').val($(this).val());
            }
        });
        /*-------------------------------------------------------------------------------------------------------*/

        /*---------------------------------------------------------------------------------------------------------
         * Menu Uploader Icon and File
         --------------------------------------------------------------------------------------------------------*/
        var custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Select the image',
            multiple: false,
            button: { 
                text: 'Add selected images'
            },
            library: {
                type: 'image'
            }
	    });

        var bg_image_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Select the image',
            multiple: false,
            button: { 
                text: 'Add selected images'
            },
            library: {
                type: 'image'
            }
        });

        var logo_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Select the image',
            multiple: false,
            button: { 
                text: 'Add selected images'
            },
            library: {
                type: 'image'
            }
        });

        var favicon_upload = wp.media.frames.file_frame = wp.media({
            title: 'Select the image',
            multiple: false,
            button: { 
                text: 'Add selected images'
            },
            library: {
                type: 'image'
            }
        });

        var home_bg_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Select the image',
            multiple: false,
            button: { 
                text: 'Add selected images'
            },
            library: {
                type: 'image'
            }
        });
        
        var file_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Select the file',
            multiple: false,
            button: { 
                text: 'Add selected file'
            },
            library: {
                type: 'image'
            }
	    });
        
        var gallery_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Select the images',
            multiple: true,
            button: { 
                text: 'Add selected images'
            },
            library: {
                type: 'image'
            }
	    });
        
        custom_uploader.on('select', function() {
            image = custom_uploader.state().get('selection').toArray();
            $.each(image, function( index, value ) {
                addIcon(value.toJSON().id, value.toJSON().url, item_edit);
            });
        });
        
        file_uploader.on('select', function() {
            file = file_uploader.state().get('selection').toArray();
            $.each(file, function( index, value ) {
                addFile(value.toJSON().id, value.toJSON().url, item_edit, value.toJSON().filename);
            });
        });

        bg_image_uploader.on('select', function() {
            image = bg_image_uploader.state().get('selection').toArray();
            $.each(image, function( index, value ) {
                addBgImage(value.toJSON().id, value.toJSON().url, item_edit);
            });
        });

        logo_uploader.on('select', function() {
            image = logo_uploader.state().get('selection').toArray();
            $.each(image, function( index, value ) {
                addLogoImage(value.toJSON().id, value.toJSON().url);
            });
        });

        favicon_upload.on('select', function() {
            image = favicon_upload.state().get('selection').toArray();
            $.each(image, function( index, value ) {
                addFaviconImage(value.toJSON().id, value.toJSON().url);
            });
        });

        home_bg_uploader.on('select', function() {
            image = home_bg_uploader.state().get('selection').toArray();
            $.each(image, function( index, value ) {
                addHomeBgImage(value.toJSON().id, value.toJSON().url);
            });
        });
        
        $('#file_uploader_button').click(function(e) {
            file_uploader.open();
            return false;
        });
        
        $('#icon_upload_button').click(function(e) {
            custom_uploader.open();
            return false;
        });

        $('#upload_bg_image').click(function() {
            bg_image_uploader.open();
            return false; 
        });

        $('#logo-upload').click(function() {
            logo_uploader.open();
            return false;
        });

        $('#favicon-upload').click(function() {
            favicon_upload.open();
            return false;
        });

        $('#upload-home-bg').click(function() {
            home_bg_uploader.open();
            return false;
        });

        /*-------------------------------------------------------------------------------------------------------*/
        
        /*---------------------------------------------------------------------------------------------------------
         * Portfolio Gallery
         --------------------------------------------------------------------------------------------------------*/
        $('#add_gallery_img').click(function() {
            gallery_uploader.open();
            return false;
        });
        
        gallery_uploader.on('select', function() {
            image = gallery_uploader.state().get('selection').toArray();
            $.each(image, function( index, value ) {
                addGallery(value.toJSON().id);
            });
            galleryList();
        });

        $('#gallery_list').sortable({
            placeholder: "ui-state-highlight",
            beforeStop : function() {
                galleryList();
            }
        });
        
        $('#gallery_list').on('click', '.remove_gallery_img', function() {
            $(this).closest('li').remove();
            galleryList();
            return false;
        });
        /*-------------------------------------------------------------------------------------------------------*/

        /*---------------------------------------------------------------------------------------------------------
         * Menu Customization
         --------------------------------------------------------------------------------------------------------*/
        $('#customize_tab').tabs();

        $('#colorpicker').keyup(function() {
            $(item_edit).css('background-color', $(this).val());
            color_change(item_edit, $(this).val());
        });
        
        $('#colorpicker').wpColorPicker({
            palettes: ['#50b2a2', '#50b28a', '#c85141', '#0fa2cb', '#d8457a', '#d8733b', '#d9912a'],
            change : function(event, ui) {
                if (event.originalEvent.type == 'square')
                    color_change(item_edit, $(this).val());
            }
        });

        gridster = $(".gridster > ul").gridster({
            widget_margins: [10, 10],
            widget_base_dimensions: [140, 140],
            max_size_x: 6,
            max_size_y: 6,
            min_cols: 6,
            max_cols: 6,
            resize: {
                max_size: [6, 2],
                enabled: true
            }
        }).data('gridster');

        $('#add-new-tile').click(function() {
            gridster.add_widget('<li data-row="1" data-col="1" data-sizex="1" data-sizey="1"><div class="controls"><i class="fa fa-pencil"></i><i class="fa fa-trash-o"></i></div><i class="fa tile-icon"></i><span class="title"></span><div class="img_icon_container"></div></li>', 1, 1);
            return false;
        });

        $('.gridster').on('click', '.fa-trash-o', function() {
            gridster.remove_widget($('.gridster li').eq($('.gridster li').index($(this).closest('li'))));
            return false;
        });

        $('.gridster').on('click', '.fa-pencil', function() {
            item_edit = $(this).closest('li');
            if ($(item_edit).attr('data-page-id'))
                $('#tile-edit #page_id [value="' + $(item_edit).attr('data-page-id') + '"]').attr('selected', 'selected');
            else
                $('#tile-edit #page_id [value="0"]').attr('selected', 'selected');
            if ($(item_edit).attr('data-disable-title'))
                $('.disable-title').attr('checked', 'checked');
            else
                $('.disable-title').removeAttr("checked");
            if ($(item_edit).attr('data-icon'))
                $('.select-list .current-icon').html('<i class="fa ' + $(item_edit).attr('data-icon') + '"></i><span class="i-name"> ' + $(item_edit).attr('data-icon') + '</span>');
            else
                $('.select-list .current-icon').html(metrikaParams.select_icon_text);
            if ($(item_edit).attr('data-bg')) {
                $('.bg-image-preview').fadeIn();
                $.ajax({
                    type: "POST",
                    url: metrikaParams.site_url + "/wp-admin/admin-ajax.php",
                    data: {
                        action: 'metrika_getPreviewImage',
                        id: $(item_edit).attr('data-bg')
                    },
                    beforeSend: function(XMLHttpRequest) {
                        $('.bg-image-preview').html('<span style="color: #000;">' + metrikaParams.loading + '</span>');
                    },
                    success: function(data) {
                        $('.bg-image-preview').html(data + '<a href="#" class="remove-bg-img"><i class="fa fa-trash-o"></i></a>');
                    },
                    error: function() {
                        $('.bg-image-preview').html(metrikaParams.error_save);
                    }
                });
            } else
                $('.bg-image-preview').html('').fadeOut();
            if ($(item_edit).attr('data-color'))
                $('#colorpicker').wpColorPicker('color', $(item_edit).attr('data-color'));
            else
                $('#colorpicker').wpColorPicker('color', '#50b28a');
            if ($(item_edit).attr('data-img')) {
                $('.image_preview').fadeIn();
                $.ajax({
                    type: "POST",
                    url: metrikaParams.site_url + "/wp-admin/admin-ajax.php",
                    data: {
                        action: 'metrika_getPreviewImage',
                        id: $(item_edit).attr('data-img')
                    },
                    beforeSend: function(XMLHttpRequest) {
                        $('.image_preview').html(metrikaParams.loading);
                    },
                    success: function(data) {
                        $('.image_preview').html(data + '<a href="#" class="remove-img"><i class="fa fa-trash-o"></i></a>');
                    },
                    error: function() {
                        $('.image_preview').html(metrikaParams.error_save);
                    }
                });
            } else
                $('.image_preview').html('').fadeOut();
            if ($(item_edit).attr('data-file-id')) {
                $.ajax({
                    type: "POST",
                    url: metrikaParams.site_url + "/wp-admin/admin-ajax.php",
                    data: {
                        action: 'metrika_getFileTitle',
                        id: $(item_edit).attr('data-file-id')
                    },
                    beforeSend: function(XMLHttpRequest) {
                        $('.file-preview').html(metrikaParams.loading);
                    },
                    success: function(data) {
                        $('.file-preview').html(data + '<a href="#" class="remove-file"><i class="fa fa-trash-o"></i></a>');
                    },
                    error: function() {
                        $('.file-preview').html(metrikaParams.error_save);
                    }
                });
            } else
                $('.file-preview').html('');
            if ($(item_edit).attr('data-file-title'))
                $('.file-title').val($(item_edit).attr('data-file-title'));
            else
                $('.file-title').val('');
            if ($(item_edit).attr('data-external-link-title'))
                $('.external-link-title').val($(item_edit).attr('data-external-link-title'));
            else
                $('.external-link-title').val('');
            if ($(item_edit).attr('data-external-link'))
                $('.external-link').val($(item_edit).attr('data-external-link'));
            else
                $('.external-link').val('');
            if ($(item_edit).attr('data-tile-type'))
                $('#tile-type [value="' + $(item_edit).attr('data-tile-type') + '"]').attr('selected', 'selected');
            else
                $('#tile-type [value="page"]').attr('selected', 'selected');

            $('#tile-edit').show();
            return false;
        });

        $('#tile-type').change(function() {
            if ($('option:selected', this).val() == 'page') {
                $(item_edit).attr('data-tile-type', 'page');
                $('.title', item_edit).html($('#page_id option[value=' + $('#page_id').val() +']').text());
            } else if ($('option:selected', this).val() == 'file') {
                $(item_edit).attr('data-tile-type', 'file');
                $('.title', item_edit).html($('.file-title').val());
            } else if ($('option:selected', this).val() == 'link') {
                $(item_edit).attr('data-tile-type', 'link');
                $('.title', item_edit).html($('.external-link-title').val());
            }
        });

        $('#tile-edit #close').click(function() {
            $('#tile-edit').hide();
            if ($('.select-list').is('.open')) {
                $('.select-list').removeClass('open');
            }
            return false;
        });

        $('.select-list .current-icon').click(function() {
            $(this).closest('.select-list').toggleClass('open');
        });

        $('.select-list li').click(function() {
            $('.select-list .current-icon').html($(this).html());
            $('.tile-icon', item_edit).attr('class', 'fa tile-icon ' + $('span', this).text().trim());
            $(item_edit).attr('data-icon', $('span', this).text().trim());
            if ($('.select-list').is('.open')) {
                $('.select-list').removeClass('open');
            }
            $('.remove-img').trigger('click');
        });

        $('#tile-edit #page_id').change(function() {
            $(item_edit).attr('data-page-id', $.trim($('option:selected', this).val()));
            $('span.title', item_edit).text($('option:selected', this).text());
        });

        $('.file-title').keyup(function() {
            $(item_edit).attr('data-file-title', $(this).val());
            $('.title', item_edit).text($(this).val());
        });

        $('.external-link-title').keyup(function() {
           $(item_edit).attr('data-external-link-title', $(this).val()); 
           $('.title', item_edit).text($(this).val());
        });

        $('.external-link').keyup(function() {
           $(item_edit).attr('data-external-link', $(this).val()); 
        });

        $('.disable-title').change(function() {
            if ($(this).is(':checked')) {
                $(item_edit).attr('data-disable-title', '1');
                $('.title', item_edit).text('');
            } else {
                $(item_edit).removeAttr('data-disable-title');
                $.ajax({
                    type: "POST",
                    url: metrikaParams.site_url + "/wp-admin/admin-ajax.php",
                    data: {
                        action: 'metrika_getPageTitle',
                        id: $(item_edit).attr('data-page-id')
                    },
                    beforeSend: function(XMLHttpRequest) {
                        $('.title', item_edit).html(metrikaParams.loading);
                    },
                    success: function(data) {
                        $('.title', item_edit).html(data);
                    },
                    error: function() {
                        $('.title', item_edit).html(metrikaParams.error_save);
                    }
                });
            }
        });

        $('#tile-edit').on('click', '.remove-file', function() {
            $(item_edit).removeAttr('data-file-id');
            $('.file-preview').html('');
        });

        $('#tile-edit').on('click', '.remove-img', function() {
            $('.image_preview').html('');
            $('.img_icon_container', item_edit).html('');
            $(item_edit).removeAttr('data-img');
            return false;
        });

        $('#tile-edit').on('click', '.remove-bg-img', function() {
            $('.bg-image-preview').html('');
            $(item_edit).removeAttr('data-bg').css('backgroundImage', '');
            return false;
        });

        $('.iris-palette').click(function() {
            setTimeout(function() {
                color_change(item_edit, $('#colorpicker').val());
            }, 100);
        });

        $('#save-menu').click(function() {
            var object = {},
                i = 0;
            $('.gridster > ul > li').each(function() {
                object[++i] = {
                    row                : $(this).attr('data-row'),
                    col                : $(this).attr('data-col'),
                    sizex              : $(this).attr('data-sizex'),
                    sizey              : $(this).attr('data-sizey'),
                    icon               : $(this).attr('data-icon'),
                    color              : $(this).attr('data-color'),
                    page_id            : $(this).attr('data-page-id'),
                    img                : $(this).attr('data-img'),
                    disable_title      : $(this).attr('data-disable-title'),
                    bg_img             : $(this).attr('data-bg'),
                    file_id            : $(this).attr('data-file-id'),
                    file_title         : $(this).attr('data-file-title'),
                    external_link_title: $(this).attr('data-external-link-title'),
                    external_link      : $(this).attr('data-external-link'),
                    tile_type          : $(this).attr('data-tile-type')
                }
            });
            var data = {
                action: 'metrika_menuSave',
                object: object,
                blog_page: $('.select-blog-page #page_id option:selected').val()
            }
            ajaxSave('.save-status', data);
            return false;
        });
        /*-------------------------------------------------------------------------------------------------------*/

        /*---------------------------------------------------------------------------------------------------------
         * Header Customization
         --------------------------------------------------------------------------------------------------------*/
        $('#save-logo').click(function() {
            var object = {
                logo_text: $('#logo-text').val(),
                logo_img : $('#logo-img-id').val(),
                logo_pos : $('#logo-position option:selected').val(),
                logo_type: $('#logo-type option:selected').val()
            };
            var data = {
                action: 'metrika_saveLogo',
                object: object
            }
            ajaxSave('.logo-save-status', data);
            return false;
        });

        $('#remove-logo').click(function() {
            $('.logo-preview > *').remove();
            $('#logo-img-id').val('');
            return false;
        });

        $('#save-page-header').click(function() {
            var object = {
                home_button: $('#enable-home-button').prop("checked"),
                prev_button: $('#enable-prev-button').prop("checked"),
                next_button: $('#enable-next-button').prop("checked"),
                home_animation: $('#home-button-animation option:selected').val(),
                prev_animation: $('#prev-button-animation option:selected').val(),
                next_animation: $('#next-button-animation option:selected').val()
            };
            var data = {
                action: 'metrika_savePageHeaderOptions',
                object: object
            }
            ajaxSave('.page-header-save-status', data);
            return false;
        });

        /*-------------------------------------------------------------------------------------------------------*/

        /*---------------------------------------------------------------------------------------------------------
         * Home Customization
         --------------------------------------------------------------------------------------------------------*/
        $('#home-bg-colorpicker').wpColorPicker({
            palettes: false,
            change : function() {
                $('#home-bg-color').val($(this).val());
            }
        });

        $('#save-home-bg').click(function() {
            var object = {
                home_bg_type : $('#home-bg-type option:selected').val(),
                home_bg_color: $('#home-bg-color').val(),
                home_bg_image: $('#home-bg-id').val()
            };
            var data = {
                action: 'metrika_saveHomeBg',
                object: object
            }
            ajaxSave('.home-bg-save-status', data);
            return false;
        });

        $('#remove-home-bg').click(function() {
            $('.home-bg-preview > *').remove();
            $('#home-bg-id').val('');
        });

        $('#save-home-bottom-block').click(function() {
            var object = {
                twitter_user : $('#twitter_user').val(),
                block_type   : $('#home-bottom-block option:selected').val(),
                custom_text  : $('#home-custom-text').val()
            };
            var data = {
                action: 'metrika_saveHomeBotomBlock',
                object: object
            }
            ajaxSave('.home-bottom-block-save-status', data);
            return false;
        });
        /*-------------------------------------------------------------------------------------------------------*/

        /*---------------------------------------------------------------------------------------------------------
         * Footer Customization
         --------------------------------------------------------------------------------------------------------*/
        $('#home-copyright-color-colorpicker').wpColorPicker({
            palettes: false,
            change : function() {
                $('#home-copyright-color').val($(this).val());
            }
        });

        $('#page-copyright-color-colorpicker').wpColorPicker({
            palettes: false,
            change : function() {
                $('#page-copyright-color').val($(this).val());
            }
        });

        $('#save-copyright').click(function() {
            var object = {
                copyright            : $('#copyright-text').val(),
                auto_date            : $('#echo-date').prop("checked"),
                home_copyright_type  : $('#home-copyright-type option:selected').val(),
                page_copyright_type  : $('#page-copyright-type option:selected').val(),
                home_copyright_color : $('#home-copyright-color').val(),
                page_copyright_color : $('#page-copyright-color').val()
            };
            var data = {
                action: 'metrika_saveCopyright',
                object: object
            }
            ajaxSave('.copyright-save-status', data);
            return false;
        });
        /*-------------------------------------------------------------------------------------------------------*/

        /*---------------------------------------------------------------------------------------------------------
         * Footer Customization
         --------------------------------------------------------------------------------------------------------*/
        $('#save-blog').click(function() {
            var object = {
                date        : $('#data-format').val(),
                author_info : $('#disable_author_meta').prop("checked"),
                list_meta   : $('#disable_list_meta').prop("checked"),
                single_meta : $('#disable_single_meta').prop("checked")
            };
            var data = {
                action: 'metrika_saveBlog',
                object: object
            }
            ajaxSave('.blog-save-status', data);
            return false;
        });
        /*-------------------------------------------------------------------------------------------------------*/

        /*---------------------------------------------------------------------------------------------------------
         * Contacts Options
         --------------------------------------------------------------------------------------------------------*/
        $('#save-contacts').click(function() {
            var object = {
                first_phone_label   : $('#first_phone_label').val(),
                first_phone_time    : $('#first_phone_time').val(),
                first_phone_number  : $('#first_phone_number').val(),
                second_phone_label  : $('#second_phone_label').val(),
                second_phone_time   : $('#second_phone_time').val(),
                second_phone_number : $('#second_phone_number').val(),
                address             : $('#address').val(),
                first_email_label   : $('#first_email_label').val(),
                first_email         : $('#first_email').val(),
                second_email_label  : $('#second_email_label').val(),
                second_email        : $('#second_email').val(),
                form_from           : $('#form_from').val(),
                form_to             : $('#form_to').val(),
                form_subject        : $('#form_subject').val(),
                form_title          : $('#form_title').val()
            };
            var data = {
                action: 'metrika_saveContacts',
                object: object
            }
            ajaxSave('.contacts-save-status', data);
            return false;
        });
        /*-------------------------------------------------------------------------------------------------------*/

        /*---------------------------------------------------------------------------------------------------------
         * Other Options
         --------------------------------------------------------------------------------------------------------*/
        $('#save-other').click(function() {
            var object = {
                favicon        : $('#favicon-id').val(),
                link_color     : $('#link_colorpicker').val(),
                preloader      : $('#preloader_enable').prop("checked"),
                preloader_color: $('#preloader_colorpicker').val(),
                font           : $('#font select option:selected').val()
            };
            var data = {
                action: 'metrika_saveOthers',
                object: object
            }
            ajaxSave('.other-save-status', data);
            return false;
        });

        $('#remove-favicon').click(function() {
            $('.favicon-preview').html('');
            $('#favicon-id').val('');
            return false;
        });

        $('#link_colorpicker, #preloader_colorpicker').wpColorPicker({
            palettes: false
        });
        /*-------------------------------------------------------------------------------------------------------*/


    });
})(jQuery);

function saveAnimation(className) {
    $ = jQuery;
    setTimeout(function() {
        $(className + ' > *').fadeOut(400, function() {
            $(className + ' > *').remove();
        });
    }, 1000);
}

function ajaxSave(className, data) {
    $ = jQuery;
    $.ajax({
        type: "POST",
        url: metrikaParams.site_url + "/wp-admin/admin-ajax.php",
        data: data,
        beforeSend: function(XMLHttpRequest) {
            $(className).html(metrikaParams.loader);
        },
        success: function(data) {
            console.log(data);
            $(className).html(metrikaParams.success_save);
            saveAnimation(className);
        },
        error: function() {
            $(className).html(metrikaParams.error_save);
            saveAnimation(className);
        }
    });
}

function color_change(item, color) {
    $ = jQuery;
    $(item).css('background', color);
    $(item).attr('data-color', color);
}

function addIcon(id, url, item) {
    $ = jQuery;
    $('.tile-icon', item).attr('class', 'fa tile-icon');
    $(item).attr('data-img', id).removeAttr('data-icon');
    $('.select-list .current-icon').html(metrikaParams.select_icon_text);
    $('.content .image_preview').html('<img class="icon_img" src="' + url + '"><a href="#" class="remove-img"><i class="fa fa-trash-o"></i></a>');
    $('.img_icon_container', item).html('<img class="icon_img" src="' + url + '">');
    $('.image_preview').fadeIn();
}

function addBgImage(id, url, item) {
    $ = jQuery;
    $('.content .bg-image-preview').html('<img class="icon_img" src="' + url + '"><a href="#" class="remove-bg-img"><i class="fa fa-trash-o"></i></a>');
    $(item).attr('data-bg', id).css('backgroundImage', 'url(' + url + ')');
    $('.bg-image-preview').fadeIn();
}

function addLogoImage(id, url) {
    $ = jQuery;
    $('#logo-img-id').val(id);
    $('.logo-preview').html('<img src="' + url + '"><a href="#" id="remove-logo"><i class="fa fa-trash-o"></i></a>');
}

function addFaviconImage(id, url) {
    $ = jQuery;
    $('#favicon-id').val(id);
    $('.favicon-preview').html('<img src="' + url + '"><a href="#" id="remove-favicon"><i class="fa fa-trash-o"></i></a>');
}

function addHomeBgImage(id, url) {
    $ = jQuery;
    $('#home-bg-id').val(id);
    $('.home-bg-preview').html('<img src="' + url + '"><a href="#" id="remove-home-bg"><i class="fa fa-trash-o"></i></a>');
}

function addFile(id, url, item, name) {
    $ = jQuery;
    $(item).attr('data-file-id', id);
    $('.file-preview').html(name + ' <a href="#" class="remove-file"><i class="fa fa-trash-o"></i></a>');
}

function galleryList() {
    var $           = jQuery,
        images_list = {},
        i           = 0;
    $('#gallery_list li').each(function() {
        images_list[i++] = {
            id : $(this).attr('data-img-id')
        }
    });
    $('#portfolio_gallery').val(JSON.stringify(images_list));
}

function addGallery(id) {
    jQuery('#gallery_list').prepend(getImage(id));
}

function getImage(id) {
    var result;
    jQuery.ajax({
        async  : false,
        type   : "POST",
        url    : metrikaParams.site_url + "/wp-admin/admin-ajax.php",
        data   : {  
            action: 'metrika_getImage',
            img_id: id
        },
        success: function(data){
            result = data;
        }
    });
    return result;
}