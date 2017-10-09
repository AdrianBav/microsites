

/* Size of project elements. */

THUMB_HEIGHT = 228;

INFO_WIDTH = 519;

TOOLTIP_TOP_OFFSET = 40;

TOOLTIP_LEFT_OFFSET = -40;



/* These global definitions represent the projects in the portfolio. */

var projectIds = ["dse", "soccer", "reg2buy", "dwdp", "hp"];

var lastProjectIndex = projectIds.length - 1;

var projectIndex = 0;



/* Define the HTML that appears on the thumbnail overlay. */

var overlayText = [

    "View project development...",

    "View project development...",

    "View project development...",

    "Visit Website...",

    "Visit Website..."

];





$(document).ready(function() {



    /* Initialise the overlay text. */

    jQuery('#navigation .overlay p').html(overlayText[projectIndex]);



    /* Function bindings for mouse clicks on the navigation buttons. */

    jQuery('#left-bracket').unbind('click', changeProject);

    jQuery('#left-bracket').bind('click', changeProject);



    jQuery('#right-bracket').unbind('click', changeProject);

    jQuery('#right-bracket').bind('click', changeProject);



    /* Function bindings for mouse actions over the portfolio thumbnail. */

    jQuery('.overlay').unbind('mouseover', restoreOverlay);

    jQuery('.overlay').bind('mouseover', restoreOverlay);



    jQuery('.overlay').unbind('mouseout', removeOverlay);

    jQuery('.overlay').bind('mouseout', removeOverlay);



    jQuery('.overlay').unbind('click', lauchSite);

    jQuery('.overlay').bind('click', lauchSite);



    /* Function bindings for mouse click on the download resume icon. */

    jQuery('#banner .download-resume').unbind('click', downloadResume);

    jQuery('#banner .download-resume').bind('click', downloadResume);



    /* Generate a tool-tip when hovering over the left and right brackets. */

    jQuery('#left-bracket, #right-bracket').hover(function(e) {



        /* Handler In Event. */



        /* Get the tool-tip text from the element. */

        var titleText = jQuery(this).attr('data-tooltip');



        /* Store the tool-tip text and remove any previously added title attribute. */

        jQuery(this)

            .data('tipText', titleText)

            .removeAttr('title');



        /* Generate a tool-tip and append to the document body. */

        jQuery('<p class="tooltip"></p>')

            .text(titleText)

            .appendTo('body')

            .css('top', (e.pageY - TOOLTIP_TOP_OFFSET) + 'px')

            .css('left', (e.pageX + TOOLTIP_LEFT_OFFSET) + 'px')

            .fadeIn('slow');



    }, function() {



        /* Handler Out Event. */



        /* Store the tool-tip text in the title attribute and remove the tool-tip. */

        jQuery(this).attr('title', jQuery(this).data('tipText'));

        jQuery('.tooltip').remove();



    }).mousemove(function(e){



        /* Mouse Move Event (While hovering over bracket). */



        /* Update the position of the tool-tip. */

        jQuery('.tooltip')

            .css('top', (e.pageY - TOOLTIP_TOP_OFFSET) + 'px')

            .css('left', (e.pageX + TOOLTIP_LEFT_OFFSET) + 'px');

      });

});





function changeProject(e) {



    /* Determine the new project index. */

    if (e.target.id == "left-bracket") {



        if (projectIndex <= 0) {

            projectIndex = lastProjectIndex;

        } else {

            projectIndex--;

        }



    } else if (e.target.id == "right-bracket") {



        if (projectIndex >= lastProjectIndex) {

            projectIndex = 0;

        } else {

            projectIndex++;

        }

    }



    /* Shift the thumb background image to represent the desired project.

     * Note: The animate function can only animate one property at a time,

     * therefore the background positions x and y values can not be changed simultaneously without using the step function. */

    var thumbPosition = THUMB_HEIGHT * projectIndex;



    jQuery('#navigation .project-thumb').animate(

        {

            /* This is a dummy property that will not be noticed. The value of thumbPosition will be passed into the step function. */

            'border-spacing': thumbPosition

        },

        {

            step: function(now, fx) {

                jQuery(fx.elem).css("background-position", "0px -"+now+"px");

            },

            duration: 'slow',

            easing: 'swing',

            queue: false

        });



    /* Shift the info text background image to represent the desired project. */

    var infoPosition = "-" + (INFO_WIDTH * projectIndex) + "px";



    jQuery('#information-text').animate(

        {

            'background-position': infoPosition

        },

        {

            duration: 'slow',

            easing: 'swing',

            queue: false

        });



    /* Update the overlay text. */

    jQuery('#navigation .overlay p').html(overlayText[projectIndex]);

}





/* Remove the overlay to reveal the thumbnails. */

function removeOverlay(e) {



    jQuery(this).animate(

        {

            'opacity': 0.75

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

                'opacity': 0.0

            },

            {

                duration: 'slow',

                easing: 'swing',

                queue: false

            }

        );

}





function lauchSite(e) {



    var project_id = projectIds[projectIndex];



    switch (project_id) {



        case "dse":

          jQuery.get("projects/dse/main.html", function(html) {

              jQuery(html).appendTo('body').modal({zIndex: 1000});

          });

          break;



        case "soccer":

            jQuery.get("projects/soccer/main.html", function(html) {

                jQuery(html).appendTo('body').modal({zIndex: 1000});

            });

            break;



        case "reg2buy":

            jQuery.get("projects/reg2buy/main.html", function(html) {

                jQuery(html).appendTo('body').modal({zIndex: 1000});

            });

            break;



        case "dwdp":

          window.open("http://dev.bavanco.co.uk/dw/");

          break;



        case "hp":

          window.open("http://helenapluskowska.co.uk/");

          break;

    }

}





function downloadResume(e) {



    window.open("http://archives.bavanco.co.uk/webdesignservices/personalportfolio/resume.pdf");

}

