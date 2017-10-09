
jQuery(document).ready(function(){

    /* Function bindings for mouse actions over the portfolio thumbnails. */
    jQuery('.overlay').unbind('mouseover', removeOverlay);
    jQuery('.overlay').bind('mouseover', removeOverlay);

    jQuery('.overlay').unbind('mouseout', restoreOverlay);
    jQuery('.overlay').bind('mouseout', restoreOverlay);

    jQuery('.overlay').unbind('click', lauchSite);
    jQuery('.overlay').bind('click', lauchSite);

    /* Function bindings for mouse actions over the contact icon thumbnails. */
    jQuery('.icons div').unbind('mouseover', updateBanner);
    jQuery('.icons div').bind('mouseover', updateBanner);

    /* Function binding for mouse actions on linkedin icon. */
    jQuery('#linkedin-icon').unbind('click', lauchSite);
    jQuery('#linkedin-icon').bind('click', lauchSite);
});


/* Swap the banner message depending on the icon being hovered. */
function updateBanner(e) {

    if (e.target.id == "phone-icon") {
        jQuery('.banner-text').css('background-position', 'center top');

    } else if (e.target.id == "email-icon") {
        jQuery('.banner-text').css('background-position', 'center -26px');

    } else if (e.target.id == "linkedin-icon") {
        jQuery('.banner-text').css('background-position', 'center -52px');
    }
}


/* Remove the overlay to reveal the thumbnails. */
function removeOverlay(e) {

    jQuery(this).animate(
        {
            'opacity': '0'
        },
        {
            duration: 'slow',
            easing: 'swing',
            queue: false
        }
    );
}


/* Restore the overlay to hide the thumbnails. */
function restoreOverlay(e) {

    jQuery(this).animate(
            {
                'opacity': '0.85'
            },
            {
                duration: 'slow',
                easing: 'swing',
                queue: false
            }
        );
}


/* Launch the site of the thumbnail that was clicked on. */
function lauchSite(e) {

    window.open(jQuery(this).children('p').attr('data-url'));
}
