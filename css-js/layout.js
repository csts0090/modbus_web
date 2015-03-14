/*下拉式選單*/
$(document).ready(function(){
  $('#headBtn li').each(function()
  {
   $(this).find('.btn1').addClass('headbtnTxt1');
   $(this).mouseover(function(){
     $(this).find('.headBtn-items').stop().slideDown(200);
     $(this).find('.btn1').addClass('headbtnBg');
     $(this).find('.btn1').addClass('headbtnTxt2');
   });
   $(this).mouseout(function(){
     $(this).find('.headBtn-items').stop().slideUp(200);
     $(this).find('.btn1').addClass('headbtnBg');
     $(this).find('.btn1').addClass('headbtnTxt2');
   });

  });
});
