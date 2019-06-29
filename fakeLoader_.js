
function fakeLoader() {
      var settings = $.extend({
         targetClass : 'fakeLoader',
         bgColor : '#ffffff',
         spinner : 'spinner7'
      });

      var spinner07 = '<div class="fl fl-spinner spinner7"><div class="circ1"></div><div class="circ2"></div><div class="circ3"></div><div class="circ4"></div></div>';
      var loaderDiv = $('body').find('.' + settings.targetClass);

      loaderDiv.html(spinner07);

      loaderDiv.css({
         'display': "block",
         'backgroundColor' : settings.bgColor
      });
}
