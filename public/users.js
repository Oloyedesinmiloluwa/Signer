$('document').ready(function(){
  $('button.delete-btn').click(function(){
    // debugger;
    $('.modal').show();
});
$(document).scroll(function(){
  if ($(this).scrollTop() > 5) {
  $('.nav').css({'position': 'fixed', 'min-width': '100vw', 'background-color': '#15437F'});
  $('.nav').animate({
    'opacity': '0.8'
  });
} else
  {
    $('.nav').css({'position': 'relative', 'min-width': '100vw', 'background-color': '#15437F', 'opacity': '1'});
  }
  // console.log($(this).scrollTop());
  $('.reset-password-wrapper').slideIn();
})
});
