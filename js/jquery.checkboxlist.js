jQuery(document).ready(function($) {
$('#btn_submit_items').on('click', function(e) {
var activity_id = $('#activity_id').val();
var post_id = $('#post_id').val();
var num_checklist_items = $('#num_checklist_items').val();
var selectedItems = "";
var baseURL = window.location.protocol+"//"+window.location.host;
var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
$("#frmMakeChoices input:checkbox:checked").each(function() {
    selectedItems+=$(this).attr("id") +",";
});

 $.ajax({
               type: "POST",
		       url: urltoget, 
		       dataType: 'json', 
		       data: {'action':'save_checklist','selected_items': selectedItems,'post_id': post_id,'activity_id': activity_id,'num_checklist_items': num_checklist_items  } ,
               success: function(returndata) {
	       //set the message and the activity id
	        var selectedItems = returndata["selected_items"];
                $("input#activity_id").val(returndata['activity_id']);
		//check with attribute so when the user clicks print the checkbox is checked
		for (var i = 0; i < returndata["num_checklist_items"]; i++){
		  if (selectedItems.indexOf(i) != -1){
		  $("input:checkbox#"+i).attr('checked', true);
		  }
		  else{
		  $("input:checkbox#"+i).attr('checked', false);
		  }
		}
		$("#messageArea").html("<p style='background-color:#F8EB97;'>" + returndata['message'] + "</p>");
		}
    });

});

//handle the print post test click
$(".printchecklist" ).click(function() {
w=window.open();
w.document.write('<h3>Checkbox Selection List</h3><div id="checklist">' + $('#checklist').html()+'</div>');
w.print();
w.close();
});


});