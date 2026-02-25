
var Script = function () {

    $(function() {
        
        //vars
        var conveyor = $(".content-conveyor", $("#sliderContent")),
        item = $(".item1", $("#sliderContent"));
        
        //set length of conveyor
        conveyor.css("width", item.length * parseInt(item.css("width")));
                
        //config
        var sliderOpts = {
          max: (item.length * parseInt(item.css("width"))) - parseInt($(".viewer", $("#sliderContent")).css("width")),
          slide: function(e, ui) { 
            conveyor.css("left", "-" + ui.value + "px");
          }
        };

        //create slider
        $("#slider").slider(sliderOpts);
      });

    $('.scroll-infinito').jscroll({
        loadingHtml: '<img src="loading.gif" alt="Loading" /> Loading...',
        padding: 20,
        nextSelector: 'a.nextloadin:last',
        contentSelector: ''
    });


    /*popover*/
    $('.popovertop').popover({trigger: 'click','placement': 'top'});
    $('.popoverbottom').popover({trigger: 'click','placement': 'bottom'});
    $('.popoverleft').popover({trigger: 'click','placement': 'left'});
    $('.popoverright').popover({trigger: 'click','placement': 'right'});
    $('.popovertop-hover').popover({trigger: 'hover','placement': 'top'});
    $('.popoverbottom-hover').popover({trigger: 'hover','placement': 'bottom'});
    $('.popoverleft-hover').popover({trigger: 'hover','placement': 'left'});
    $('.popoverright-hover').popover({trigger: 'hover','placement': 'right'});

    /*Tooltips*/
    $(".tip-top").tooltip({
        placement : 'top'
    });
    $(".tip-right").tooltip({
        placement : 'right'
    });
    $(".tip-bottom").tooltip({
        placement : 'bottom'
    });
    $(".tip-left").tooltip({
        placement : 'left'
    });


    /*-- TABS --*/
    $("a.tab-lista").click(function () {
        $(".active").removeClass("active");
        $(this).addClass("active");
    });


    /*-- lupa animada --*/
    $('.icono-animado').css({
      'margin-top' : -$('.lupa-hidden .img-animada').height()
    });

    $(".lupa-hidden").hover(function() {
        $(this).addClass('animada');
        $('.animada  .icono-animado').css({
                'opacity':1,
        });
        $(this).children().children('.icono-animado').stop().animate({
          'margin-top' : -$('.lupa-hidden .icono-animado').height() / 2,
          'top' : $('.lupa-hidden .img-animada').height() / 2
        },200);
    },function () {
        $(this).children().children('.icono-animado').stop().animate({
          'margin-top' : $('.lupa-hidden .icono-animado').height() / 2,
          'top' : $('.lupa-hidden .img-animada').height()
        },200,function () {
            $(this).css({
                'opacity':0,
                'margin-top' : -$('.lupa-hidden .img-animada').height() * 2
            },50);
        });
        $('.lupa-hidden').removeClass('animada');

    });



    /*-- producto animado --*/

    $('.ov-hidden').css({
      'height' : $('.ov-hidden .img-animada').height() + $('.titulo-animado').height() +10
    });
    $('.ov-hidden .descri-animada').css({
      'margin-top' : $('.ov-hidden .descri-animada').height()
    });

    $(".ov-hidden").hover(function() {
        $('.ov-hidden').removeClass('animada');
        $(this).addClass('animada');
        $(this).children('.texto-destacado').stop().animate({
            'margin-top': -$('.animada .descri-animada').height(),
            'padding-top':10
        },300, function () {
            $('.animada .descri-animada').animate({
                'margin-top': 0
            },150, function () {
                $('.animada .img-animada').animate({
                    'margin-top':-20,
                },50);
                $('.animada .texto-destacado').animate({
                    'padding-top':15,
                    'padding-bottom':15
                },200);
            });
        });
    },function () {
        $('.descri-animada', this).animate({
            'margin-top' : $('.descri-animada').height()
        },200);
        $(this).children('.texto-destacado').stop().animate({
            'margin-top': 0,
            'padding-top':10
        },300, function () {
            $('.img-animada').animate({
                    'margin-top':0
            },200);
        });
    });


    /*-- producto animado --*/
    $('.ti-hidden').css({
      'height' : $('.ti-hidden .img-animada').height()
    });
    $('.texto-destacado').css({
      'margin-top' : -$('.ti-hidden .titulo').height() -5
    });

    $(".ti-hidden").hover(function() {
        $(this).addClass('animada');
        $(this).children('.texto-destacado').stop().animate({
            'margin-top': -$('.animada .texto-destacado').height()
        },300);
    },function () {
        $(this).children('.texto-destacado').stop().animate({
            'margin-top': -$('.ti-hidden .titulo').height() -5
        },300);
        $('.ti-hidden').removeClass('animada');

    });





//    sidebar dropdown menu

    jQuery('#sidebar .sub-menu > a').click(function () {
        var last = jQuery('.sub-menu.open', $('#sidebar'));
        last.removeClass("open");
        jQuery('.arrow', last).removeClass("open");
        jQuery('.sub', last).slideUp(200);
        var sub = jQuery(this).next();
        if (sub.is(":visible")) {
            jQuery('.arrow', jQuery(this)).removeClass("open");
            jQuery(this).parent().removeClass("open");
            sub.slideUp(200);
        } else {
            jQuery('.arrow', jQuery(this)).addClass("open");
            jQuery(this).parent().addClass("open");
            sub.slideDown(200);
        }
        var o = ($(this).offset());
        diff = 200 - o.top;
        if(diff>0)
            $(".sidebar-scroll").scrollTo("-="+Math.abs(diff),500);
        else
            $(".sidebar-scroll").scrollTo("+="+Math.abs(diff),500);
    });

//    sidebar toggle

    $('.icon-reorder').click(function () {
        if ($('#sidebar > ul').is(":visible") === true) {
            $('#main-content').css({
                'margin-left': '0px'
            });
            $('#sidebar').css({
                'margin-left': '-180px'
            });
            $('#sidebar > ul').hide();
            $("#container").addClass("sidebar-closed");
        } else {
            $('#main-content').css({
                'margin-left': '180px'
            });
            $('#sidebar > ul').show();
            $('#sidebar').css({
                'margin-left': '0'
            });
            $("#container").removeClass("sidebar-closed");
        }
    });

// custom scrollbar

    $(".sidebar-scroll").niceScroll({styler:"fb",cursorcolor:"#4A8BC2", cursorwidth: '5', cursorborderradius: '0px', background: '#404040', cursorborder: ''});

    $(".portlet-scroll-1").niceScroll({styler:"fb",cursorcolor:"#4A8BC2", cursorwidth: '5', cursorborderradius: '0px', background: '#404040', cursorborder: ''});

    $(".portlet-scroll-2").niceScroll({styler:"fb",cursorcolor:"#4A8BC2", cursorwidth: '5', cursorborderradius: '0px', autohidemode: false, cursorborder: ''});

    $(".portlet-scroll-3").niceScroll({styler:"fb",cursorcolor:"#4A8BC2", cursorwidth: '5', cursorborderradius: '0px', background: '#404040', autohidemode: false, cursorborder: ''});

    /*$("html").niceScroll({styler:"fb",cursorcolor:"#4A8BC2", cursorwidth: '8', cursorborderradius: '0px', background: '#404040', cursorborder: '', zindex: '1000'});*/


// theme switcher

    var scrollHeight = '60px';
    jQuery('#theme-change').click(function () {
        if ($(this).attr("opened") && !$(this).attr("opening") && !$(this).attr("closing")) {
            $(this).removeAttr("opened");
            $(this).attr("closing", "1");

            $("#theme-change").css("overflow", "hidden").animate({
                width: '20px',
                height: '22px',
                'padding-top': '3px'
            }, {
                complete: function () {
                    $(this).removeAttr("closing");
                    $("#theme-change .settings").hide();
                }
            });
        } else if (!$(this).attr("closing") && !$(this).attr("opening")) {
            $(this).attr("opening", "1");
            $("#theme-change").css("overflow", "visible").animate({
                width: '226px',
                height: scrollHeight,
                'padding-top': '3px'
            }, {
                complete: function () {
                    $(this).removeAttr("opening");
                    $(this).attr("opened", 1);
                }
            });
            $("#theme-change .settings").show();
        }
    });

    jQuery('#theme-change .colors span').click(function () {
        var color = $(this).attr("data-style");
        setColor(color);
    });

    jQuery('#theme-change .layout input').change(function () {
        setLayout();
    });

    var setColor = function (color) {
        $('#style_color').attr("href", "css/style-" + color + ".css");
    }

// widget tools

    jQuery('.widget .tools .icon-chevron-down').click(function () {
        var el = jQuery(this).parents(".widget").children(".widget-body");
        if (jQuery(this).hasClass("icon-chevron-down")) {
            jQuery(this).removeClass("icon-chevron-down").addClass("icon-chevron-up");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("icon-chevron-up").addClass("icon-chevron-down");
            el.slideDown(200);
        }
    });

    jQuery('.widget .tools .icon-remove').click(function () {
        jQuery(this).parents(".widget").parent().remove();
    });

//    tool tips

    $('.element').tooltip();

    $('.tooltips').tooltip();

//    popovers

    $('.popovers').popover();

// scroller

    if ($('.scroller').length) {
        $('.scroller').slimscroll({
            height: 'auto'
        });
    }




}();

$(function() {

    $('.carouFredSe').carouFredSel({
        width: '100%',
        items: {
            visible: '+1'
        },
        auto: {
            items: 1
        },
        prev: '.prevcarousel',
        next: '.nextcarousel'
    });

});


jQuery(document).ready(function() {

   var api=jQuery('.metro-gal-container').megafoliopro(
           {
               filterChangeAnimation:"pagebottom",          // fade, rotate, scale, rotatescale, pagetop, pagebottom,pagemiddle
               filterChangeSpeed:400,                   // Speed of Transition
               filterChangeRotate:99,                   // If you ue scalerotate or rotate you can set the rotation (99 = random !!)
               filterChangeScale:0.6,                   // Scale Animation Endparameter
               delay:20,
               defaultWidth:980,
               paddingHorizontal:10,
               paddingVertical:10,
               layoutarray:[9,11,5,3,7,12,4,6,13]       // Defines the Layout Types which can be used in the Gallery. 2-9 or "random". You can define more than one, like {5,2,6,4} where the first items will be orderd in layout 5, the next comming items in layout 2, the next comming items in layout 6 etc... You can use also simple {9} then all item ordered in Layout 9 type.
           });

   // FANCY BOX ( LIVE BOX) WITH MEDIA SUPPORT
   jQuery(".fancybox").fancybox();

   // THE FILTER FUNCTION
   jQuery('.filter').click(function() {
       jQuery('.filter').each(function() { jQuery(this).removeClass("selected")});
       api.megafilter(jQuery(this).data('category'));
       jQuery(this).addClass("selected");
   });


});