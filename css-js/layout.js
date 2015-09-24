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
     $(this).find('.btn1').removeClass('headbtnBg');
     $(this).find('.btn1').removeClass('headbtnTxt2');
   });

  });
  //$(".dtBox").DateTimePicker();
});
/*function post(id)
{
           var statu_s = $('.mail'+id).val();
           var email = $('.mail2'+id).val();
           //var statu_s=<?php echo $titName2[0] ?>;//php傳值給javascript
           //console.log(statu_s);
           alert('信件寄出中');
   
           $.post('res2.php',{sta:statu_s, email_name:email},
           function(data,status)
           {
                   //alert("Data: " + data + "\nStatus: " + status);
                   if(status=='success');
                   alert(statu_s+"\nStatus"+status);
           });
}
function post2(id)
{
           var statu_s = $('.mail'+id).val();
           var upload = $('.upload'+id).val();
   
           $.post('upload.php',{sta:statu_s, up:upload},
           function(data,status)
           {
                   document.write("<meta http-equiv='refresh' content='1; url=http://192.168.4.127/demo/download3.php'>");
                   if(status=='success');
                   //alert(statu_s+"\nStatus"+status);
           });
}
function post3(id)
{
         var statu_s = $('.mail'+id).val();
         if(window.XMLHttpRequest){
           // code for IE7+, Firefox, Chrome, Opera, Safari
           xmlhttp2 = new XMLHttpRequest();
           } else {
           // code for IE6, IE5
           xmlhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
           }
           xmlhttp2.onreadystatechange = function() {
                 if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
                         //document.getElementById("").innerHTML = xmlhttp2.responseText;
                         window.location.replace('http://192.168.4.127/demo/download3.php');
                 }
           }
           xmlhttp2.open("POST","download_local.php",true);
           xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
           xmlhttp2.send("sta="+statu_s);
 
}
function post4(id)
{
         var statu_s = $('.mail'+id).val();
         var upload = $('.ftp'+id).val();
         var user = $('.user'+id).val();
         var passwd = $('.passwd'+id).val();
         if(window.XMLHttpRequest){
           // code for IE7+, Firefox, Chrome, Opera, Safari
           xmlhttp2 = new XMLHttpRequest();
           } else {
           // code for IE6, IE5
           xmlhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
           }
           xmlhttp2.onreadystatechange = function() {
                 if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
                         //document.getElementById("").innerHTML = xmlhttp2.responseText;
                         alert("上傳成功");
                 }
           }
           xmlhttp2.open("POST","ftp.php",true);
           xmlhttp2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
           xmlhttp2.send("sta="+statu_s+"&up="+upload+"&user="+user+"&passwd="+passwd);
 
}*/

