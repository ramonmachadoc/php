(function( $ ) {
   $("#menu").mmenu({
      "extensions": [
         "pagedim-black",
         "theme-white",
         "effect-menu-slide",
         "effect-listitems-slide",
         "shadow-page",
      ],
      "offCanvas": {
         zposition   : "front",
         position    : "right"
      },
      "counters": true,
   });
})(jQuery);