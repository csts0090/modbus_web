function add_new_data()
{
  //取得目前row數
  var num = document.getElementById("sch_table").rows.length;
  //建立新的tr 因為是從0開始算 所以目前的row數剛好為目前要增加的第幾個tr
  var Tr = document.getElementById("sch_table").insertRow(num);

  //建立新的td 而Tr.cells.length就是這個tr目前的td數
  var Td = Tr.insertCell(Tr.cells.length);
  //而這個就是要填入td中的innerHTM
  Td.innerHTML='<input name="sch1[]" type="text" size="12">';
  Td = Tr.insertCell(Tr.cells.length);
  Td.innerHTML='<input name="sch2[]" type="text" size="12">';
  Td = Tr.insertCell(Tr.cells.length);
  Td.innerHTML="<input class='datepicker' name='sch3[]' type='text' size='12'  data-field='datetime'>";
  Td = Tr.insertCell(Tr.cells.length);
  Td.innerHTML="<input class='datepicker' name='sch4[]' type='text' size='12'  data-field='datetime'>";
  Td = Tr.insertCell(Tr.cells.length);
  Td.innerHTML='<input name="sch5[]" type="text" size="12">';
//   $(".dtBox").DateTimePicker();

 //$(".datepicker").datepicker();
}

function remove_data()
{
  //取得目前row數
  var num = document.getElementById("sch_table").rows.length;
  //防止把標題跟原本的第一個刪除
  if(num > 2)
  {
    //刪除最後一個
    document.getElementById("sch_table").deleteRow(-1);
  }
}


