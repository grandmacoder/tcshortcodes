/*This jquery document handles the matching/dragging activity for modules in transition coalition
*/
jQuery(document).ready(function($) {
	//get the settings from the database
	//get the array for col 1
	//get the array for col 2
	//get the total items to drop (count of 1 and 2)
	 //arrays of items that belong in each list
	var sValidDroppable1 ="";
	var sValidDroppable2 ="";
	var validDroppable1= new Array();
	var validDroppable2= new Array();
	var totalDraggable = 0;
	var matrix_name = $('#matrix_name').attr('class');
        var baseURL = window.location.protocol+"//"+window.location.host;
        var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
	$.ajax({
             	type: "POST",
		       url: baseURL +'/wp-content/plugins/tcshortcodes/processShortcodesAjax.php', 
		       dataType: 'json', 
		       data: {'action':'get_vertical_matrix_data','matrix_name': matrix_name} ,
                success: function(returndata) {
		sValidDroppable1 =returndata['col1items'];
		sValidDroppable2 =returndata['col2items'];
		totalDraggable=returndata['totalDraggable'];
		//split string to arrays
		validDroppable1 =sValidDroppable1.split(',');
		validDroppable2 =sValidDroppable2.split(',');
		
		//Variables are set up so now create css and set up the droppable areas
		//set up the css for the draggable items
		 var draggable_css = "";
		 for (var i=1; i <= totalDraggable; i++){

		 draggable_css += "#draggable-"+i + " { width: 170px; height: auto;padding: 0.5em; margin: 5px 5px 5px 5px; font-size: 15px;font-family: Calibri, Arial Narrow, Optima, Tahoma;background:#d2dbe1; line-height: 14px;}";
		 $("<style type='text/css'>" + draggable_css + "</style>").appendTo("body"); 
		 }
		 //set each draggable div as draggable
		 for (var i=1; i <= totalDraggable; i++){
		   $( "#draggable-" + i ).draggable({
		    snap: "#droppable-1, #droppable-2",
		    snapMode: "outter",
	
		   });
		  }
		 //set up droppable area 1 with drop event
		 //keeping track of the dropped items in a hidden div (list1text) comma separated string
		 $( "#droppable-1" ).droppable({
		      drop: function(event, ui) {
		       var dragID = ui.draggable.attr('id');
		       var dropID = event.target.id; 
		       var list2text = $("#list2_selected").text();
		       var list1text = $("#list1_selected").text();
          
		      //see if dragID is in that list 2 and remove it
			 if ( list2text.indexOf(dragID) !== -1 ){
				  $( "#droppable-1" ).css( "height", "-=30px" );
			  //delete it from list text 2 and append it to list text 1
			       var replacethis = dragID+',';
			       list2text=list2text.replace(replacethis,'');
			       $("#list2_selected").html(list2text);
				  
			       }
			$("#list1_selected").html(list1text + dragID+",");
			 $( "#droppable-1" ).css( "height", "+=30px" );
			$(ui.draggable).detach().css({top: 0,left: -6}).appendTo(this);
		
		   return false;
		   } //end drop function
		   });
		   //set up droppable area 2 with drop event
		  //keeping track of the dropped items in a hidden div (list2text) comma separated string
		   $( "#droppable-2" ).droppable({
		       drop: function(event, ui) {
		       var dragID = ui.draggable.attr('id');
		       var dropID = event.target.id;  
		       var list2text = $("#list2_selected").text();
		       var list1text = $("#list1_selected").text();
			 
			//see if dragID is in that list 2 and remove it
		       if ( list1text.indexOf(dragID) !== -1 ){
				$( this ).css( "height", "-=30px" );
		       //delete it from list text 2 and append it to list text 1
				var replacethis = dragID+',';
				list1text=list1text.replace(replacethis,'');
				$("#list1_selected").html(list1text);
				
				}
			var replacethis = dragID+',';
			list2text=list2text.replace(replacethis,'');
			 $("#list2_selected").html(list2text + dragID+",");
			 $( this ).css( "height", "+=30px" );
			$(ui.draggable).detach().css({top: 0,left: -6}).appendTo(this);
		    return false;
		   } //end drop function
		   });
		 }
		 
	}); //end the ajax call that sets up the screen
	
         //capture the submit and compare the list strings (converted to array) with the validDroppable arrays 
	 $("#btn_submit_items").click(function() {
		 var list2text = $("#list2_selected").text();
	         var list1text = $("#list1_selected").text();
		 var selectedList1Array =list1text.split(',');
		 var selectedList2Array =list2text.split(',');
		 var num_correct_list1=0;
		 var num_correct_list2=0;
		 //do list number 1
		 for(i = 0; i < (selectedList1Array.length); i++){
		         if ( ($.inArray(selectedList1Array[i],validDroppable1)) > -1 ){
			 var correct = selectedList1Array[i];
			 $("#"+correct).css('background','#d2dbe1');
			 $("#"+correct).css('font-weight','normal');
			 $("#"+correct).css('border', 'none');
			 num_correct_list1++;			 
			 }
			 else{
			 var notcorrect=selectedList1Array[i];
                           $("#"+notcorrect).css('background','#fad296');
                           $("#"+notcorrect).css('font-weight','bold');	
		           $("#"+notcorrect).css('border', '3px solid #e63619');			   
			 }
		 }
		 //do list 2
		  for(i = 0; i < (selectedList2Array.length); i++){
		         if ( ($.inArray(selectedList2Array[i],validDroppable2)) > -1 ){
			 var correct = selectedList2Array[i];
			 $("#"+correct).css('background','#d2dbe1');
			 $("#"+correct).css('font-weight','normal');
			 $("#"+correct).css('border', 'none');
			  num_correct_list2++;		 
			 }
			 else{
			 var notcorrect=selectedList2Array[i];
                          $("#"+notcorrect).css('background','#fad296');
                          $("#"+notcorrect).css('font-weight','bold');	
			  $("#"+notcorrect).css('border', '3px solid #e63619');			  
			 }
		 }
		
		 if ( validDroppable1.length == num_correct_list1  && validDroppable2.length == num_correct_list2){
		 var totalCorrect=num_correct_list1+num_correct_list2;
		  $(".draggable_message").html("<p><span style='color:#e63619; font-weight:bold;'>Success! You have answered " + totalCorrect + "/" + totalDraggable + " correctly.</spam></p>");
		  totalCorrect==0;
		}
		 else{
		 var totalCorrect=num_correct_list1+num_correct_list2;
		 $(".draggable_message").html("<p><span style='color:#e63619;font-weight:bold;'> You have answered " + totalCorrect + "/" + totalDraggable + " correctly. Please re-arrange the highlighted items and/or complete the activity.</spam></p>");
		  totalCorrect==0;
		 }
                 });
         });