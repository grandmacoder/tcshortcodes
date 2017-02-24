jQuery(document).ready(function($) {
var current_page = $(location).attr('href');
var baseURL = window.location.protocol+"//"+window.location.host;
var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";

$('#area1').click( function(){
//if there is a value in the hidden div then go ahead and allow editing on click
   // var activityid = $(this).attr('data-activityid');
	var title = "";
	title = $(this).attr('data-thetitle');
	$('#statusDiv').html("");
    if ( title){
	 var inputString="<label>You may change your answer for<strong> gender micro-culture</strong> if you wish.</labe><br><textarea cols=90 rows=2 value='"+ title+ "' id=identitywebtext>"+title+"</textarea><input type=hidden id=description value='My identity web-gender'><input type=hidden id=activityOrder value=1><br><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
      $('#inputIdentityWebItems').html(inputString);
      }//end if there is a title  
			 else{
			  var inputString="<label>Briefly describe what the <strong>gender micro-culture</strong> means to you in the space below.</labe><br><textarea cols=90 rows=2 value='' id=identitywebtext></textarea><input type=hidden id=description value='My identity web-gender'><input type=hidden id=activityOrder value=1><br><input type=button id=identityWebSubmit  onclick='submitAnswer()'  onclick='submitAnswer()' value='submit'>";
			  $('#inputIdentityWebItems').html(inputString);
			 }
 });
 
$('#area1').hover(  //gender
   function() {
	         $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_2.png');
	     },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
		}
  );
  
 $('#area2').click( function(){
	var title = $(this).attr('data-thetitle');
	$('#statusDiv').html("");
    if ( title){
	          var inputString="<label>You may change your answer for <strong>nationality micro-culture</strong> if you wish.</labe><br><textarea cols=90 rows=2 value='"+title+"' id=identitywebtext>"+title+"</textarea><input type=hidden id=description value='My identity web-nationality'><input type=hidden id=activityOrder value=2><br><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
			  $('#inputIdentityWebItems').html(inputString);
              
			}//end if there is a title 
		     else{
		    var inputString="<label>Briefly describe what the <strong>nationality micro-culture</strong> means to you in the space below.</labe><br><textarea cols=90 rows=2 value='' id=identitywebtext></textarea><input type=hidden id=description value='My identity web-nationality'><input type=hidden id=activityOrder value=2><br><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
			  $('#inputIdentityWebItems').html(inputString);
		}
 });
$('#area2').hover(
        function() {
	 $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_3.png');
       },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
  }
  );
  
  $('#area3').click( function(){
	var title = $(this).attr('data-thetitle');
	$('#statusDiv').html("");
    if (title){
         var inputString="<label>You may change your answer for <strong>religion micro-culture</strong> if you wish.</labe><br><textarea cols=90 rows=2 value='"+title+"' id=identitywebtext>"+title+"</textarea><input type=hidden id=description value='My identity web-religion'><input type=hidden id=activityOrder value=3><br><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
         $('#inputIdentityWebItems').html(inputString);
		 }else{
		 var inputString="<label>Briefly describe what the <strong>religion micro-culture</strong> means to you in the space below.</labe><br><textarea cols=90 rows=2 value='' id=identitywebtext></textarea><input type=hidden id=description value='My identity web-religion'><input type=hidden id=activityOrder value=3><br><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
         $('#inputIdentityWebItems').html(inputString);
		 }
		
 });
 
  $('#area3').hover(
        function() {
	    $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_4.png');
        },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
        }
  );
  $('#area4').click( function(){
	var title = $(this).attr('data-thetitle');
	$('#statusDiv').html("");
    if ( title){
	     var inputString="<label>If you wish you may change your answer for <strong>ethnicity micro-culture</strong>.</labe><br><textarea cols=90 rows=2 value='"+title+"' id=identitywebtext>"+title+"</textarea><input type=hidden id=description value='My identity web-ethnicity'><input type=hidden id=activityOrder value=4><br><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
	    $('#inputIdentityWebItems').html(inputString);
            }//end if there is a title 
		     else{
		 var inputString="<label>Briefly describe what the <strong>ethnicity micro-culture</strong> means to you in the space below.</labe><br><textarea cols=90 rows=2 value='' id=identitywebtext></textarea><input type=hidden id=description value='My identity web-ethnicity'><input type=hidden id=activityOrder value=4><br><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
	    $('#inputIdentityWebItems').html(inputString);
		}
 });
  $('#area4').hover(
        function() {
	    $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_5.png');
        },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
	
        }
  );
   $('#area5').click( function(){
	var title = $(this).attr('data-thetitle');
	$('#statusDiv').html("");
    if (title){
	    var inputString="<label>If you wish you may change your answer for <strong>age micro-culture</strong>.</labe><br><textarea cols=90 rows=2 value='"+title+"' id=identitywebtext>"+title+"</textarea><input type=hidden id=activityOrder value=5><br><input type=hidden id=description value='My identity web-age'><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
	    $('#inputIdentityWebItems').html(inputString);
         }//end if there is a title 
		     else{
		  var inputString="<label>Briefly describe what the <strong>age micro-culture</strong> means to you in the space below.</labe><br><textarea cols=90 rows=2 value='' id=identitywebtext></textarea><input type=hidden id=description value='My identity web-age'><input type=hidden id=activityOrder value=5><br><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
	    $('#inputIdentityWebItems').html(inputString);
		}
 });
 
  $('#area5').hover(
        function() {
	    $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_6.png');
        },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
        }
  );
  
   $('#area6').click( function(){
	var title = $(this).attr('data-thetitle');
    $('#statusDiv').html("");
    if (title){
	 var inputString="<label>If you wish you may change your answer for <strong>social class micro-culture </strong>.</strong></labe><br><textarea cols=90 rows=2 value='"+title+"' id=identitywebtext>"+title+"</textarea><input type=hidden id=activityOrder value=6><br><input type=hidden id=description value='My identity web-social class'><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
	  $('#inputIdentityWebItems').html(inputString);
         }//end if there is a title 
		     else{
     var inputString="<label>Briefly describe what the <strong>social class micro-culture </strong>means to you in the space below.</strong></labe><br><textarea cols=90 rows=2 value='' id=identitywebtext></textarea><input type=hidden id=description value='My identity web-social class'><input type=hidden id=activityOrder value=6><br><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
	  $('#inputIdentityWebItems').html(inputString);
		
		}
 });
 
 
   $('#area6').hover(
        function() {
	 $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_7.png');
	 },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
        }
  );
  
  $('#area7').click( function(){
	var title = $(this).attr('data-thetitle');
    $('#statusDiv').html("");
    if (title){
	  	 var inputString="<label>If you wish you may change your answer for <strong>education micro-culture </strong>.</labe><br><textarea cols=90 rows=2 value='"+title+"' id=identitywebtext>"+title+"</textarea><input type=hidden id=activityOrder value=7><br><input type=hidden id=description value='My identity web-education'><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
	 $('#inputIdentityWebItems').html(inputString);
         }//end if there is a title 
		     else{
		 var inputString="<label>Briefly describe what the <strong>education micro-culture </strong>means to you in the space below.</labe><br><textarea cols=90 rows=2 value='' id=identitywebtext></textarea><input type=hidden id=activityOrder value=7><br><input type=hidden id=description value='My identity web-education'><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
	 $('#inputIdentityWebItems').html(inputString);
		}
 });
 
  $('#area7').hover(
        function() {
	 $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_8.png');
	 },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
        }
  );
  
  
   $('#area8').click( function(){
	var title = $(this).attr('data-thetitle');
    $('#statusDiv').html("");
    if (title){
	  	  var inputString="<label>If you wish you may change your answer for <strong>occupation micro-culture</strong>.</labe><br><textarea cols=90 rows=2 value='"+title+"' id=identitywebtext>"+title+"</textarea><input type=hidden id=activityOrder value=8><br><input type=hidden id=description value='My identity web-occupation'><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
	 $('#inputIdentityWebItems').html(inputString);
         }//end if there is a title 
		     else{
		var inputString="<label>Briefly describe what the <strong>occupation micro-culture</strong> means to you in the space below.</labe><br><textarea cols=90 rows=2 value='' id=identitywebtext></textarea><input type=hidden id=activityOrder value=8><br><input type=hidden id=description value='My identity web-occupation'><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
	  $('#inputIdentityWebItems').html(inputString);
		}
 });
  
  
  $('#area8').hover(
     function() {
	 $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_9.png');
     },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
        }
  );
  
   $('#area9').click( function(){
	var title = $(this).attr('data-thetitle');
    $('#statusDiv').html("");
    if (title){
	 var inputString="<label>If you wish you may change your answer for <stroing>exceptionality micro-culture </strong></labe><br><textarea cols=90 rows=2 value='"+title+"' id=identitywebtext>"+title+"</textarea><input type=hidden id=description value='My identity web-religion'><input type=hidden id=activityOrder value=9><br><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
	 $('#inputIdentityWebItems').html(inputString);
         }//end if there is a title 
		     else{
		var inputString="<label>Briefly describe what the <strong>exceptionality micro-culture </strong>means to you in the space below.</labe><br><textarea cols=90 rows=2 value='' id=identitywebtext></textarea><input type=hidden id=activityOrder value=9><br><input type=hidden id=description value='My identity web-exeptionality'><input type=button id=identityWebSubmit  onclick='submitAnswer()' value='submit'>";
	 $('#inputIdentityWebItems').html(inputString);
		}
 });
  
  $('#area9').hover(
        function() {
	 $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_10.png');
    },
       function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
        }
  );

});//end document ready

function submitAnswer(){
var baseURL = window.location.protocol+"//"+window.location.host;
var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
var answer = document.getElementById("identitywebtext").value;
var order = document.getElementById("activityOrder").value;
var description = document.getElementById("description").value;

//do ajax here
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    //document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    if (xmlhttp.responseText == 'success'){
	document.getElementById("area"+order).title = answer;
	document.getElementById("area"+order).dataset.thetitle = answer;
	document.getElementById("statusDiv").innerHTML="<p style='font-weight:bold; color:#d50000; text-align:left;'>Your answer was saved!</p>";
	}
    }
}
xmlhttp.open("POST",urltoget,true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
xmlhttp.send("answer="+answer+"&order="+order+"&action=identityWebAnswer&description="+description);



}