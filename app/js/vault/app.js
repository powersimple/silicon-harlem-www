"use strict";

function setVideo(url) {
    jQuery('#video-player').attr("src", url);
}
var _w = jQuery(window).width(),
    _h = jQuery(window).height()

var deck_width = $("#sponsor-deck").css('width');
console.log(deck_width);

function setDeckWidth() {
    var deck_width = jQuery("#sponsor-deck").css('width'),
        deck_height = (parseInt(deck_width) * 0.8) + "px"
    jQuery("#sponsor-deck").css('height', deck_height)
    console.log("deck", deck_width, deck_height)
}
jQuery(document).ready(function() {
    //setDeckWidth()

    setHeroSlides();
    setSessionList();

    console.log('loaded');

})
jQuery(window).resize(function() {
    // setDeckWidth()
    _w = jQuery(window).width(),
        _h = jQuery(window).height()
    setHeroSlides();
})

if (_w > 1680) {
    $("#sponsor-deck").css('width', '800px');
    $("#sponsor-deck").css('width', '644px');
} else {

}

function setHeroSlides() {
    var size = 'original'
    for (var s = 0; s < hero_slides.length; s++) {
        //   console.log(hero_slides[s]);

        if (_w < 540) {
            size = 'handheld';
        } else if (_w >= 540 && _w < 768) {
            size = 'mobile'
        } else if (_w >= 768 && _w < 1025) {
            size = 'large'
        } else if (_w >= 1025 && _w < 1281) {
            size = 'laptop'
        } else if (_w >= 1281 && _w < 2000) {
            size = 'hd'
        }

        jQuery('#slide-' + s).css("background-image", "url(" + hero_slides[s][size] + ")")

        //    console.log("slide-" + s, _w, size, hero_slides[s][size])
    }


}

function showVideo(url, id) {
    $(id).attr("src", url);

}