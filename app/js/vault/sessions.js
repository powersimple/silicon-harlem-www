function setSessionList() {

    //    console.log("session_data", uploads_path, session_data);
    var session = []
    var sessions = '<h4>Sessions</h4><ul>'
    for (var s = 0; s < session_data.length; s++) {
        session = session_data[s];
        sessions += '<li><a class="section-scroll" href="#session-content" onclick="setSession(' + s + ')">' + session.title + '</a></li>'

    }
    sessions += "</ul>"
    $('#session-list').html(sessions)
    console.log(sessions)



}

function setSessionSlides(slides) {
    var slide = {}
    var slide_wrap = ''
    for (var s = 0; s < slides.length; s++) {
        slide = slides[s]
        slide_wrap += '<div>'
            //        console.log('slide', s, slide)
        slide_wrap += getSlidePath(slide)
        slide_wrap += '</div>'
    }

    return slide_wrap
}

function getSlidePath(slide) {
    var slide_path = uploads_path + slide.path + slide.meta.sizes.session_slide
    console.log(slide_path)
    var slide_tag = '<img src="' + slide_path + '">'


    return slide_tag
}


function setSession(key) {

    var session = session_data[key]

    var template = jQuery('#session-info-template').html()
    var loc = '#session-info'
    jQuery(loc).html(template)

    jQuery(loc + " .title").html('<h3>' + session.title + '</h3>')
    jQuery(loc + " .context").html(session.content)
    jQuery(loc + " .speaker-list").html(speakerList(session.speakers))
    jQuery(loc + " .slideshow").html(setSessionSlides(session.slides))
    setSpeaker(0)
    setSlick();
    console.log("session", session)
    showVideo(session.video_embed_url, "#session-video")

}
var current_speakers = []

function speakerList(speakers_list) {
    var speaker = ''
    var speakers = '<div class="col-sm-3 speaker-listing"><h4>Speakers</h4><ul>'
    current_speakers = []
    for (var s = 0; s < speakers_list.length; s++) {
        speaker = speakers_list[s];
        speakers += '<li><a  class="section-scroll" href="#session-info" onclick="setSpeaker(' + s + ')">' + speaker.speaker_name + '</a></li>'
        current_speakers[s] = speaker
    }
    speakers += '</ul></div>'
    speakers += '<div class="col-sm-9" id="speaker-vitals">'

    speakers += '</div>'
    console.log(speakers)
    return speakers

}

function speakerSocial(speaker) {
    var social_links = ''
    if (speaker.speaker_website != "") {
        social_links += '<a href="' + speaker.speaker_website + '"target="_blank"><i class="fa fa-link"></i></a>';
    }
    if (speaker.speaker_wikipedia) {
        social_links += '<a href="' + speaker.speaker_wikipedia + '"target="_blank"><i class="fa fa-wikipedia-w"></i></a>';
    }
    if (speaker.speaker_linkedin) {
        social_links += '<a href="' + speaker.speaker_linkedin + '"target="_blank"><i class="fa fa-linkedin"></i></a>';
    }
    if (speaker.speaker_twitter) {
        social_links += '<a href="' + speaker.speaker_twitter + '"target="_blank"><i class="fa fa-twitter"></i></a>';
    }
    if (speaker.speaker_facebook) {
        social_links += '<a href="' + speaker.speaker_facebook + '"target="_blank"><i class="fa fa-facebook"></i></a>';
    }

    if (speaker.speaker_instagram) {
        social_links += '<a href="' + speaker.speaker_instagram + '"target="_blank"><i class="fa fa-instagram"></i></a>';
    }
    if (speaker.speaker_flickr) {
        social_links += '<a href="' + speaker.speaker_flickr + '"target="_blank"><i class="fa fa-flickr"></i></a>';
    }
    return social_links

}

function getSpeakerInfo(speaker) {
    console.log(speaker)
    var speaker_info = '<div class="col-sm-4">' + getSlidePath(speaker.featured_image) + '</div>'
    speaker_info += '<div class="col-sm-8">'
    speaker_info += '<h4>' + speaker.speaker_name + '</h4>'
    speaker_info += '<span>' + speaker.speaker_title + ', ' + speaker.speaker_company + '</span>'
    speaker_info += '<div class="social">' + speakerSocial(speaker) + '</div>'
    speaker_info += '<div class="excerpt">' + speaker.excerpt + '</div>'
    speaker_info += '</div>'





    return speaker_info
}



function setSpeaker(id) {
    var speaker = current_speakers[id]
    var slide = getSpeakerInfo(speaker)


    console.log(slide)
    $('#speaker-vitals').html(slide)
        //   getSlidePath(slide)

}