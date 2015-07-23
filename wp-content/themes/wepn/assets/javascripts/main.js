

var util = {
    Global: {
        init: function () {
            $( '#toggle-menu' ).dlmenu();
            var menu = new cbpTooltipMenu( document.getElementById( 'nav-primary' ) );
        },
    },

    Front: {
      init: function() {
        this.Global();
        this.Slider();
        this.Forms();
        this.Isotope();
        this.SmoothScroll();
        this.Marquee();
      },


      Global: function(){

          var winsize = $(window).outerHeight();
          var headh = $('.l-header').outerHeight();
          var rsvp = $('#section-rsvp').outerHeight();
          var asideh = $('.l-sidebar').outerHeight();
          var conth = $('.l-content, .l-content-bg');
          var banner = $('.section-banner');
          var adminbar = $('#wpadminbar').outerHeight();
          var footh = $('.l-footer').outerHeight();
          var toth =  winsize - (headh + footh + adminbar);
          conth.css('min-height',toth);
          banner.css('height',(winsize-headh-adminbar-rsvp));
          $('.toggle-menuwrapper').css('top',adminbar+10);

          $( window ).resize(function() {

              winsize = $(window).outerHeight();
              headh = $('.l-header').outerHeight();
              rsvp = $('#section-rsvp').outerHeight();
              adminbar = $('#wpadminbar').outerHeight();
              banner = $('.section-banner');
              asideh = $('.l-sidebar').outerHeight();
              conth = $('.l-content, .l-content-bg');
              footh = $('.l-footer').outerHeight();
              toth =  winsize - (headh + footh + adminbar);
              conth.css('min-height',toth);
              banner.css('height',(winsize-headh-adminbar-rsvp));

          });
          $( window ).scroll(function() {
            var scroll = $(window).scrollTop();

            if (scroll>200) {
               $('.toggle-menuwrapper').fadeIn('fast');
            }else{
              $('.toggle-menuwrapper').fadeOut('fast');
            }
          });          
      },

      Isotope: function(){
        // init Isotope
        var winwidth = $(window).outerWidth();
        var grid = $('.grid-isotope-sm');
        var grid2 = $('.grid-isotope-md');

        $( document ).ready(function() {
          grid.isotope({
            itemSelector: '.grid-item',
            layoutMode: 'masonry',
            resizable: true, 
            masonry: { columnWidth: grid.width() / 3 }
          });
          grid2.isotope({
            itemSelector: '.grid-item',
            layoutMode: 'fitRows',
            resizable: true, 
            masonry: { columnWidth: grid2.width() / 2 }
          });   
        });   

        $( window ).resize(function() {
          $winwidth = $(window).outerWidth();
          if (  winwidth<=820 ) {
            grid.isotope({
              masonry: { columnWidth: grid.width() / 2 }
            });
          }
          else if( winwidth<=580 ){
              grid.isotope({
                masonry: { columnWidth: grid.width() / 1 }
              });
          }          
        });
        
      },
      Forms: function(){
      
       

        $('.form-labeled').find('.form-control').on('keyup blur focus change', function (e) {
  
            var $this = $(this),
                label = $this.parent(".wpcf7-form-control-wrap, .form-control-wrap").prev('label');

              if (e.type === 'keyup') {
                if ($this.val() === '') {
                    label.removeClass('active highlight');
                  } else {
                    label.addClass('active highlight');
                  }
              } else if (e.type === 'blur') {
                if( $this.val() === '' ) {
                  label.removeClass('active highlight'); 
                } else {
                  label.removeClass('highlight');
                }   
              }else if (e.type === 'change') {
                if( $this.val() === '' ) {
                  label.removeClass('active highlight'); 
                } else {
                  label.addClass('active highlight');
                } 
              } else if (e.type === 'focus') {
                
                if( $this.val() === '' ) {
                  label.removeClass('highlight'); 
                } 
                else if( $this.val() !== '' ) {
                  label.addClass('highlight');
                }
              }

          });

        $('.form-control').each(function() {
            var $this_control =  $(this);
            if ($this_control.val() != ''){
              label = $this_control.parent(".wpcf7-form-control-wrap, .form-control-wrap").prev('label');
              label.addClass('active highlight'); 
            }
        });
            


      },

      SmoothScroll: function(){

        $('a.scroll_to[href*=#]:not([href=#])').click(function() {

          var toph = $(".navbar-default").outerHeight();

        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html,body').stop().animate({
              scrollTop: (target.offset().top) - toph
            }, 800);
            return false;
          }
        }
      });
      }, 
  
      Marquee: function(){
        function startMarquee() {

            var menuItemWidth = $(this).width();
            var listItemWidth = $(this).parent().width();
            
            if(menuItemWidth > listItemWidth) {
                var scrollDistance = menuItemWidth - listItemWidth;
                var listItem = $(this).parent();
                listItem.stop();
                
                listItem.animate({scrollLeft: scrollDistance}, 3000, 'linear');
            }
        }

        function stopMarquee() {
            var listItem = $(this).parent();
            listItem.stop();
            listItem.animate({scrollLeft: 0}, 'fast', 'swing');
        }
        $('.marquee a').hover(startMarquee, stopMarquee);
        $('.marquee span').hover(startMarquee, stopMarquee);
      },

      Slider: function(){
          $(window).load(function() {
            $('#carousel-venue').flexslider({
              animation: "slide",
              controlNav: false,
              animationLoop: false,
              slideshow: false,
              itemWidth: 110,
              itemMargin: 5,
              asNavFor: '.slider-venue',              
              prevText: "",        
              nextText: "",
            });
             
            $('.slider-venue').flexslider({
              animation: "slide",
              controlNav: false,
              animationLoop: false,
              slideshow: false,
              sync: "#carousel-venue",
              prevText: "",        
              nextText: "",
            });
            $('.slider-single').flexslider({
              animation: "slide",
              animationLoop: false,
              slideshow: true,
              prevText: "",        
              nextText: "",
            });
          });
      }
    }
};


(function($){

jQuery(document).ready(function() {
    util.Global.init();
    util.Front.init();
});

})(jQuery);



