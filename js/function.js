
var uri       = 'data:application/vnd.ms-excel;base64,';
var template  = '<html xmlns:o="urn:schemas-microsoft-com:office:office" '+
                'xmlns:x="urn:schemas-microsoft-com:office:excel" '+
                'xmlns="http://www.w3.org/TR/REC-html40"> '+
                '<head><!--[if gte mso 9]>'+
                '<xml>'+
                ' <x:ExcelWorkbook>'+
                '   <x:ExcelWorksheets>'+
                '      <x:ExcelWorksheet>'+
                '       <x:Name>{worksheet}</x:Name>'+
                '       <x:WorksheetOptions>'+
                '         <x:DisplayGridlines/>'+
                '       </x:WorksheetOptions>'+
                '     </x:ExcelWorksheet>'+
                '   </x:ExcelWorksheets>'+
                ' </x:ExcelWorkbook>'+
                '</xml>'+
                '<![endif]-->'+
                '<meta http-equiv="content-type" content="text/plain; charset=UTF-8"/>'+
                '</head>'+
                '<body>'+
                '  <table>{table}</table>'+
                '</body>'+
                '</html>';
function base64(s) { 
  return window.btoa(unescape(encodeURIComponent(s))); 
}
      
function format(s, c) { 
  return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }); 
}
      
function tableToExcel (table, name) {
  if (!table.nodeType) 
    table = document.getElementById(table);
  var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML};
  window.location.href = uri + base64(format(template, ctx));
}

function getInArrayMulti(a,v) {
  var l = a.length;
  for (var k=0;k<l;k++) {
    if (a[k].color==v) {
        return k;
      }
  }                      
  return false;
}

function validateEmail(email) {
    var x = email;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
      return false;
    else
      return true;
}

function numberWithCommas(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function getScreenSize(mode){
  if(mode == 'h') 
    return $(window).height(); 
  else 
    return $(window).width();
}

function changeUnit(){
  if($('#unit_id').find(":selected").val() == 1){
    $('#div_division_id').css("display","");
    $('#branch_id').val("");
    $('#div_branch_id').css("display","none");
  }
  
  if($('#unit_id').find(":selected").val() == 2){
    $('#division_id').val("");
    $('#div_division_id').css("display","none");
    $('#div_branch_id').css("display","");
  }
}

function changeUnitView(x){
  if(x == 1){
    $('#div_division_id').css("display","");
    $('#div_branch_id').css("display","none");
  }else{
    $('#div_division_id').css("display","none");
    $('#div_branch_id').css("display","");
  }
}

  
function branchChange(x, y){

  if(x != y){
    $('#division_id').html(getSelectBox('division_id', 'division', '', 'a.unit_id='+$('#unit_id').val()));
    resetPettycashUser();
  }
}

function delConfirm(msg,url)
{
  if(confirm(msg))
    window.location.href=url;
  else
    false;
}

function getIPAddress(){
  var msg = $.ajax({type: "GET", url: "server/response.php?com=getipclient", async: false}).responseText;
  //alert(msg);
  return msg;
}

function getServerDate(){
  var msg = $.ajax({type: "GET", url: "server/response.php?com=getserverdate", async: false}).responseText;
  //alert(msg);
  return msg;
}

function getCurrentKurs(currency){
  var msg = $.ajax({type: "GET", url: "server/response.php?com=getcurrentkurs&currency="+currency, async: false}).responseText;
  //alert(msg);
  return msg;
}

function FormatCurrency(ctrl, event) {
  //Check if arrow keys are pressed - we want to allow navigation around textbox using arrow keys
  //alert(event.keyCode);
  var code = (event.keyCode) ? event.keyCode : event.which;

  if (code == 9 || code == 8 || code == 37 || code == 38 || code == 39 || code == 40)
  {
      return;
  }

  var val = ctrl.value;
  //alert(val);
  val = val.replace(/,/g, "");
  ctrl.value = "";
  val += '';
  x = val.split('.');
  
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  
  var rgx = /(\d+)(\d{3})/;
  
  while (rgx.test(x1)) {
      x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  
  x3 = x2.length > 2 ? x2.substring(0,3) : x2;
  ctrl.value = x1 + x3;
  //alert(x1 + '======' + x3);
}

function CheckNumeric(event) {

  //alert(event.which);
  /*
  if (e >=48 && e < 58 || e==8 || e==9 || e==37 || e==39)
  {
  }else{
    event.returnValue = false;
    event.preventDefault();
  }
  
*/

  //alert(window.event ? event.keyCode : e.which);
  //var browser=navigator.userAgent.toLowerCase();
  
  //alert(event.keyCode);
  
  var code = (event.keyCode) ? event.keyCode : event.which;

  return code == 9 || code == 8 || code == 46 || code >= 48 && code <= 57;
  
  /*
  if(browser.indexOf('firefox') > -1) {
    //Key = event.charCode;
    //alert(event.which);
  return event.which == 46 || event.which >= 48 && event.which <= 57;
  }else{
    Key = event.keyCode;
    //return event.keyCode == 46 || event.keyCode >= 48 && event.keyCode <= 57;
  }
  alert(Key);
  */
  

}

function popupModal(id, title, body=null){

  var html = "<div class='modal fade' id='" + id + "' tabindex='-1' role='dialog' aria-labelledby='popupModalLabel'>" +
              "<div class='modal-dialog' role='document'>" +
                "<div class='modal-content'>" +
                  "<div class='modal-header' id='popupModalHeader2'>" +
                    "<h4 class='modal-title' id='popupModalLabel2'>" +title+ "</h4>" +
                  "</div>" +
                  "<div class='modal-body' style='margin:0;overflow-y:scroll'>" +
                    "<div id='popupModalBody2'>"+body+"</div>" +
                  "</div>" +
                  "<div class='modal-footer' id='popupModalFooter2'>" +
                  "</div>" +
                "</div>" +
              "</div>" +
             "</div>";
  return html;
}

function previewPopupModel(mode, preview, title=null){
  getModal();
  
  var img = "";
  if(mode == "image")
    img = "<img class='img-responsive' style='width:100%;max-width:600px' src='"+preview+"' width='100%'>";
  else
    img = "<div style='text-align:left;font-size:12px'>"+preview+"</div>";
    
  $('#popupModalLabel').html(title);
  $('#popupModalBody').html(img);
  $('#popupModal').modal('show');
}

function number_format(number, decimals, dec_point, thousands_sep) {
  //  discuss at: http://phpjs.org/functions/number_format/
  // original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: davook
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Theriault
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Michael White (http://getsprink.com)
  // bugfixed by: Benjamin Lupton
  // bugfixed by: Allan Jensen (http://www.winternet.no)
  // bugfixed by: Howard Yeend
  // bugfixed by: Diogo Resende
  // bugfixed by: Rival
  // bugfixed by: Brett Zamir (http://brett-zamir.me)
  //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
  //  revised by: Luke Smith (http://lucassmith.name)
  //    input by: Kheang Hok Chin (http://www.distantia.ca/)
  //    input by: Jay Klehr
  //    input by: Amir Habibi (http://www.residence-mixte.com/)
  //    input by: Amirouche
  //   example 1: number_format(1234.56);
  //   returns 1: '1,235'
  //   example 2: number_format(1234.56, 2, ',', ' ');
  //   returns 2: '1 234,56'
  //   example 3: number_format(1234.5678, 2, '.', '');
  //   returns 3: '1234.57'
  //   example 4: number_format(67, 2, ',', '.');
  //   returns 4: '67,00'
  //   example 5: number_format(1000);
  //   returns 5: '1,000'
  //   example 6: number_format(67.311, 2);
  //   returns 6: '67.31'
  //   example 7: number_format(1000.55, 1);
  //   returns 7: '1,000.6'
  //   example 8: number_format(67000, 5, ',', '.');
  //   returns 8: '67.000,00000'
  //   example 9: number_format(0.9, 0);
  //   returns 9: '1'
  //  example 10: number_format('1.20', 2);
  //  returns 10: '1.20'
  //  example 11: number_format('1.20', 4);
  //  returns 11: '1.2000'
  //  example 12: number_format('1.2000', 3);
  //  returns 12: '1.200'
  //  example 13: number_format('1 000,50', 2, '.', ' ');
  //  returns 13: '100 050.00'
  //  example 14: number_format(1e-8, 8, '.', '');
  //  returns 14: '0.00000001'

  number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}

function popitup(url, w="", h="") {
  if(w=="")
    w = screen.width;
  if(h=="")
    h = screen.height;
	newwindow=window.open(url, 'Voucher', 'toolbar=no ,location=0, status=no,titlebar=no,menubar=no,width='+w +',height=' +h);
	if (window.focus) {
    newwindow.focus();
  }
  
  //alert(document.readyState);
  newwindow.print();
  	  
  //if (newwindow.document.readyState == 'complete') {
    //newwindow.close();
    //return false;
  //}
}

function str_pad (input, pad_length, pad_string, pad_type) {

  // *     example 1: str_pad('', 30, '-=', 'STR_PAD_LEFT');
  // *     returns 1: '-=-=-=-=-=-foo bar milk'
  // *     example 2: str_pad('foo bar milk', 30, '-', 'STR_PAD_BOTH');
  // *     returns 2: '------foo bar milk-----'

  var half = '',
    pad_to_go;

  var str_pad_repeater = function (s, len) {
    var collect = '',
      i;

    while (collect.length < len) {
      collect += s;
    }
    collect = collect.substr(0, len);

    return collect;
  };

  input += '';
  pad_string = pad_string !== undefined ? pad_string : ' ';

  if (pad_type != 'STR_PAD_LEFT' && pad_type != 'STR_PAD_RIGHT' && pad_type != 'STR_PAD_BOTH') {
    pad_type = 'STR_PAD_RIGHT';
  }
  if ((pad_to_go = pad_length - input.length) > 0) {
    if (pad_type == 'STR_PAD_LEFT') {
      input = str_pad_repeater(pad_string, pad_to_go) + input;
    } else if (pad_type == 'STR_PAD_RIGHT') {
      input = input + str_pad_repeater(pad_string, pad_to_go);
    } else if (pad_type == 'STR_PAD_BOTH') {
      half = str_pad_repeater(pad_string, Math.ceil(pad_to_go / 2));
      input = half + input + half;
      input = input.substr(0, pad_length);
    }
  }

  return input;
}
