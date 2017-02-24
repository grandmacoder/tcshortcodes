jQuery(document).ready(function($) {
$('#btn_submit_items').on('click', function(e) {
var matrix_name = $('#matrix_name').attr('class');
var selectedItems = "";
var baseURL = window.location.protocol+"//"+window.location.host;
var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
var incorrectColor='#f66455';
var correctColor ='#9bd596';
$("#frmMakeChoices input:checkbox:checked").each(function() {
    selectedItems+=$(this).attr("id") +",";
});
 $.ajax({
         type: "POST",
		 url: urltoget, 
		 dataType: 'json', 
		 data: {'action':'compare_checkbox_items','selected_items': selectedItems,'matrix_name': matrix_name } ,
         success: function(returndata) {
		//set the message
		$("#messageArea").html("<p style='background-color:#F8EB97;'>" + returndata['message'] + "</p>");
		
		//break the string on correct items and set the bg color on the label
		var aCorrect = returndata['correctIDs'] .split(',');
		for (var i=0; i< aCorrect.length; i++){
		$("#label_" + aCorrect[i]).css('background-color', correctColor);
		}
		//break the string on incorrect items and set the bg color on the label
		var aIncorrect = returndata['incorrectIDs'] .split(',');
		for (var i=0; i< aIncorrect.length; i++){
		$("#label_" + aIncorrect[i]).css('background-color', incorrectColor);
		}
		//show the explanation td and explanation header
		  if ($('.checkboxExplanation').css('display') == 'none'){
          $('.checkboxExplanation').show('fast');
          }
          if ($('.tdExplanation').css('display') == 'none'){
          $('.tdExplanation').show('fast');
          }
         
		return false;
		}
     });
});
});