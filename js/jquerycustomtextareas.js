/*
	handles button clicks on custom text area regions of learning modules
	
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	
*/
jQuery(document).ready(function($) {

var current_page = $(location).attr('href');

//show and hide areas of content with read more
$('.read-more-content').addClass('hide-this-content')

// Set up a link to expand the hidden content:
.before('<a class="read-more-show" href="#">Read More</a>')
  
// Set up a link to hide the expanded content.
.append(' <a class="read-more-hide" href="#">Read Less</a></span>');

// Set up the toggle effect:
$('.read-more-show').on('click', function(e) {
  $(this).next('.read-more-content').removeClass('hide-this-content');
  $(this).addClass('hide-this-content');
  e.preventDefault();
});

$('.read-more-hide').on('click', function(e) {
  $(this).parent('.read-more-content').addClass('hide-this-content').parent().children('.read-more-show').removeClass('hide-this-content');
  e.preventDefault();
});

//see if all the answers have been entered on the dreamsheet page
if (current_page.indexOf('how-to-develop-a-vision-for-the-future') > -1){
//if the user has completed all the items show the compare div
var baseURL = window.location.protocol+"//"+window.location.host;
var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
var userid =  $("#userid1").val();
var postid =  $("#postid1").val();
$.ajax({
type: "POST",
url: urltoget, 
dataType: 'json',  
data: {'action':'get_num_activities','postid':postid,'userid':userid},
        success: function(returndata) {
 	                  var numberofactivities = returndata['num_activities'];
					  var numbercompleted = returndata['num_completed'];
					  if (numberofactivities == numbercompleted){
					  	$("#dreamsheet_compare").show();
					  }
				   
		}
});
}
//edit is submitted
$('#btnViewTextActivity_1,#btnViewTextActivity_2,#btnViewTextActivity_3,#btnViewTextActivity_4,#btnViewTextActivity_5,#btnViewTextActivity_6,#btnViewTextActivity_7,#btnViewTextActivity_8,#btnViewTextActivity_9,#btnViewTextActivity_10,#btnViewTextActivity_11,#btnViewTextActivity_12').on('click', function(e) {
//get the name of the button and get the index off the end of it.
	var btnName = $(this).attr('class');
    //toggle the form if they are viewing and want to edit
		var itemNumber = parseInt(btnName.match(/[0-9]+/)[0], 10);
		    if ($('.toggleoff'+itemNumber).is(':visible')){
		    $(".toggleoff"+itemNumber).hide();	
		    }
		    else{
		    $(".toggleoff"+itemNumber).show();		
		    }
		    if ($('.toggleon'+itemNumber).is(':visible')){
		    $(".toggleon"+itemNumber).hide();	
		    }
		    else{
		    $(".toggleon"+itemNumber).show();		
		    }
	return false;
});//end getting the view buttons

//form is submitted
$('#btnEditTextActivity_1,#btnEditTextActivity_2,#btnEditTextActivity_3,#btnEditTextActivity_4,#btnEditTextActivity_5,#btnEditTextActivity_6,#btnEditTextActivity_7,#btnEditTextActivity_8,#btnEditTextActivity_9,#btnEditTextActivity_10,#btnEditTextActivity_11,#btnEditTextActivity_12').on('click', function() {
//get the name of the button and get the index off the end of it.
	var btnName = $(this).attr('class');
	    var baseURL = window.location.protocol+"//"+window.location.host;
        var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
		var postid = $('#frmEditTextActivity_1').find('input[name="postid"]').val();  	
        var numberofactivities=$('#numActivitiesOnScreen').text();
	     for (var i=0; i<=numberofactivities; i++){
			$('#btnEditTextActivity_'+i).attr("disabled", "disabled");
		 }
		 $.ajax({
		       type: "POST",
		       url: urltoget, 
		       dataType: 'json', 
		       data: {'action':'get_num_activities','postid':postid} ,
                       success: function(returndata) {
                       var numberofactivities = returndata['num_activities'];
		               //loop that many times on and save each box's content if the box is in edit mode 
		               for (var i=1; i <= numberofactivities; i++){
		                var theData = $('#frmEditTextActivity_'+i).serialize();
					    var activityID =  $("#activityid"+i).val();
	                    var formorder =  $("#formorder"+i).val();
						var userid =  $("#userid"+i).val();
						var postid =  $("#postid"+i).val();   
					    var baseURL = window.location.protocol+"//"+window.location.host;
                        var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
						$.ajax({ type: "GET",
								url: urltoget, 
								dataType: 'json', 
								data: theData,
								success: function(returndata) 
								 {
								//console.log(returndata['activitytext'] + returndata['activityid'] + "order " +returndata['formorder']);
								//reset the values on the view form and the edit form
								//hide the edit form and show the view form with a message
								  var formorder=returndata['formorder'];
								  $("input#activityid"+formorder).val(returndata['activityid']);
								  $("input#postid"+formorder).val(returndata['postid']);
								  $("input#userid"+formorder).val(returndata['userid']);
								  $("input#activitytext"+formorder).val(returndata['activitytext']);
								  $("input#formorder"+formorder).val(returndata['formorder']);
								  $("div.textcontent"+formorder).html("<p class=savedActivityText>"+returndata['activitytextbreaks']+"</p>");
								   //if the row was affected with an update or insert toggle the box 
								   if (returndata['rowsaffected'] > 0){
								   //toggle back to the saved version
								   if ($('.toggleoff'+formorder).is(':visible')){
									$(".toggleoff"+formorder).hide();	
									}
									else{
									$(".toggleoff"+formorder).show();		
									}
									if ($('.toggleon'+formorder).is(':visible')){
									$(".toggleon"+formorder).hide();	
									}
									else{
									$(".toggleon"+formorder).show();		
									}
									}
									if (current_page.indexOf('how-to-develop-a-vision-for-the-future') > -1 && returndata['numanswers'] ==  numberofactivities){
									$("#dreamsheet_compare").show();	
									}
							
						 return false;
						 }
						});
		}//end foreach activity item on the screen
		 for (var i=0; i<=numberofactivities; i++){
			$('#btnEditTextActivity_'+i).removeAttr('disabled');
			$('#btnEditTextActivity_'+i).attr("enabled", "enabled");
		 }
return false;
	 }  
   });    ;//end ajax call to get number of activities	
   });//end getting the edit buttons
});
