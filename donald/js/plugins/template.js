(function($) {"use strict";

  //Preloader
  $(window).load(function() {
      $('.images-preloader').fadeOut();
  });

  var cur = $('.page-numbers.current').html();
  if(cur < 10 ){
  $('.current-page').html('0'+cur);
  }else{
    $('.current-page').html(cur);
  }
  $('.pagination .prev').parent().hide();
   
  /* 
     Home Search
     ========================================================================== */
    $('.btn-search-header > span').on ('click',function()
      {
          $(this).toggleClass("lnr-cross open");

          $(this).find(' + .search-popup').fadeToggle();
          return false;
    });
  /* Cart List Widget */
    $('.cart-button a').on ('click',function()
      {
          $(this).find('+ .top_cart_list_product').fadeToggle();
          return false;
    });
  
  
  /* Full height 404 */
    var height = $( window ).height();
    var headerHeight = $('header').height();
    var footerHeight = $('footer').height();
    if( headerHeight > 200 ){
      var warp404 = height-footerHeight;
    }else{
      var warp404 = height-headerHeight-footerHeight;
    }
    $(".warp-404").height(warp404);
    $( window ).resize(function() {
        var height = $( window ).height();
        var headerHeight = $('header').height();
        var footerHeight = $('footer').height();
        if( headerHeight > 200 ){
          var warp404 = height-footerHeight;
        }else{
          var warp404 = height-headerHeight-footerHeight;
        }
        $(".warp-404").height(warp404);
    });


  /* 
   Backtotop
   ========================================================================== */
    var offset = 450;
    var duration = 500;   
    $(window).on('scroll', function(){
         if ($(this).scrollTop() > offset) {
                $('#to-the-top').fadeIn(duration);
            } else {
                $('#to-the-top').fadeOut(duration);
            }
    });

    $('#to-the-top').on('click', function(event){
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, duration);
        return false;
    });

    
    /* Fixed Menu HOme 2 */
   
      $(window).on('scroll', function(){
          if ($(this).scrollTop() > 0) {
                $('#header-home-2').addClass("bg-dark");
            } else {
                $('#header-home-2').removeClass("bg-dark");
            }
      });
    
     $(function(){
      $(document).scroll(function(){
          if($(this).scrollTop() <= 0) {
              $("#stick").trigger("sticky_kit:detach");
          } else {
              $("#stick").stick_in_parent({container: $("#page"), offset_top: 0});
          }
      });
  });

  //Blog Slider
  $(".owl-gallery-blog-post").owlCarousel({
           
      autoplay: 4000,
      loop:true,
      items : 1,
      dots:true,
      nav:false,
  });

  //Fun Fact
  $('.counter').counterUp({
      delay: 100,
      time: 3000
  });

  //Popup Video
  $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,

    fixedContentPos: false
  });

  //OT Tabs
  $( '.ot-tabs .vc_tta-tab' ).on( 'click', 'a', function( e ) {

      $( '.ot-tabs .vc_tta-tabs-list' ).find( '.vc_tta-tab' ).removeClass( 'vc_active' );
      $( this ).parent().addClass( 'vc_active' );
      var id = $( this ).attr( 'href' ).replace( '#', '' );
      $( '.ot-tabs .vc_tta-panels' ).find( '.vc_tta-panel' ).removeClass( 'vc_active').hide();
      $( '.ot-tabs .vc_tta-panels' ).find( '#' + id ).addClass( 'vc_active' ).show();

      return false;
  } );


})(jQuery);