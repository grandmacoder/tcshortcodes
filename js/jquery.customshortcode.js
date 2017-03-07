/*
	jquery.custom.js
	
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	
*/
jQuery(document).ready(function($) {
var $= jQuery.noConflict();
var current_page = $(location).attr('href');
 setTimeout(function() {
	$('#openModal').fadeIn(1000);
    }, 5000); // milliseconds
   $(".close").on('click',function(){
   $(".modalDialog").css({"opacity":"0","pointer-events":"none"});
   });
//grow a div
$( "a.go" ).hover (function(e) {
e.preventDefault();
var d = $(this).data('id'); 
  $( "#grow"+d ).animate({
    width: "90%",
    opacity: 0.7,
    marginLeft: "0.6in",
    fontSize: "1.1em",
    borderWidth: "8px"
  }, 1500 );
return false;
});

 //show generic fancybox
$('.fancyboxorder').click(function(e){
e.preventDefault();
var d = $(this).data('order');     
if ( d > 0){var popupdiv='#fancypopup'+d;}
$.fancybox({
		'padding':  20,
		'autoScale':true,
		'autoDimensions':true,
		'showCloseButton':true,
        'href': popupdiv,		
        'modal': false,
		
    });
    return false;
});
//save a thumbsup vote on a resource
$(".resource-vote-link").click(function(e){
e.preventDefault();
var baseURL = window.location.protocol+"//"+window.location.host;
var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
var resourceid = $(this).attr('data-resourceid');
            $.ajax({
                   type: "POST",
                   url: urltoget,
                   dataType: 'json', 
                   data: {'action':'like_a_resource', 'post_id':resourceid},
                   success: function(response){
					   var numlikes=response['numlikes'];
					   var post_id=response['post_id'];
					   var alreadyvoted = response['alreadyvoted'];
					    if (alreadyvoted == 1){alert("It looks like you already voted for this resource. Thanks!");}
			           $('span.'+post_id).html(numlikes);
				 	},
					error: function(xhr, textStatus, errorThrown){
						alert(textStatus);
					},
					
            });//end ajax call 
		
return false;
})	
//save a website resource click
$('#submitsharedwebsite').click(function(e){
e.preventDefault();
var baseURL = window.location.protocol+"//"+window.location.host;
var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
var googletracking =$('#track_with_google').text();
var userid = $('#userid').text();
var validatemsg="";
			if ($('#website').val() == "" ){validatemsg+="Please enter the url of the website.<br>";}
			var re = /^(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})/;
            if ($('#website').val() != "" ){
				if (re.test($('#website').val()) !=  true){validatemsg+="Please enter a valid website address.<br>";}
			}
			if ($('#resource-title').val() == "" ){validatemsg+="Please enter a short title<br>";}
			if ($('#resource-description').val() == "" ){validatemsg+="Please enter a short description of the resource<br>";}
			if (validatemsg !=""){
				$('#validatearea').html( validatemsg );
			}
           else{   //form was valid so process it
							var data = $('#shareresourceform').serialize();
						    data+="&action=createwebsiteresource&userid=" +userid+"&googletracking="+googletracking;
							console.log(urltoget +data);
									$.ajax({
									   type: "POST",
									   url: urltoget ,
									   dataType: 'json', 
									   data: data,
									   success: function(response){
										 var resourcecategory=response['resourcecategory'];
										 $("#validatearea").html("You have successfully added a website! Thank you.");
										 var appendtotable="<tr><td><abbr title='"+ response['userfirstname'] + " "+response['userlastname']+"' rel='tooltip'><img src='"+response['avatarpath']+"' height=30 width=30></abbr></td><td><p>"+ response['resourcecategory']+"</p></td><td><li class='"+response['linkstyle']+"'><a href='"+response['resourcelink']+"' title='"+response['resourcetitle']+"' target=_blank >"+response['resourcetitle']+"</a></li></td><td><p>"+response['resourcedescription']+"</p></td><td><div class='resource-vote-result'><span class="+response['resourcepostid']+">"+response['numlikes']+"</span></div><span class='resource-vote-link' data-resourceid="+response['resourcepostid']+"><i class='fa fa-thumbs-up fa-flip-horizontal resource-thumbs-up' ></i></span></td></tr>";
										 console.log(appendtotable);
										 $('#sharedresourcestable tbody').append(appendtotable);
										},
										error: function(xhr, textStatus, errorThrown){
											alert(textStatus);
										},
								});//end ajax call   
			 }//end else the data is valid
						
    return false;

});

//save a website resource click
$('#sharefileform').on( "submit", function( e ) {
$( "#filevalidatearea" ).html("Please wait while your file uploads, this might take a few....");
	e.preventDefault();
	var fileform = document.getElementById('sharefileform');
	var formData = new FormData(fileform);
	var baseURL = window.location.protocol+"//"+window.location.host;
	var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
	$.ajax({
		url:  urltoget,
		type: 'POST',
		data: formData,
		contentType: false,
		dataType: 'json', 
		cache: false,
		processData: false,
		success: function(response) {
		    if(response['attachment_id'] > 0 ){
            $("#filevalidatearea" ).html("Your file was uploaded successfully. Thank you.");
			$('#share-file-upload').val('');
			 var appendtotable="<tr><td><abbr title='"+ response['userfirstname'] + " "+response['userlastname']+"' rel='tooltip'><img src='"+response['avatarpath']+"' height=30 width=30></abbr></td><td><p>"+ response['resourcecategory']+"</p></td><td><li class='"+response['linkstyle']+"'><a href='"+response['resourcelink']+"' title='"+response['resourcetitle']+"' target=_blank >"+response['resourcetitle']+"</a></li></td><td><p>"+response['resourcedescription']+"</p></td><td><div class='resource-vote-result'><span class="+response['resourcepostid']+">0</span></div><span class='resource-vote-link' data-resourceid="+response['resourcepostid']+"><i class='fa fa-thumbs-up fa-flip-horizontal resource-thumbs-up' ></i></span></td></tr>";
			console.log(appendtotable);
			$('#sharedresourcestable tbody').append(appendtotable);
            }else if (response['attachment_id'] == 0){
			$( "#filevalidatearea" ).html("<span style='color:red; font-size: 90%;font-weight:bold;'>Your file failed to upload.</span>");
			$('#share-file-upload').val('');
			}	
		}
	});	
});
//save a file with a rename option
$('#uploadfileform1').on( "submit", function( e ) {
$( "#filevalidatearea" ).html("Please wait while your file uploads, this might take a while, be patient....");
	e.preventDefault();
	var fileform = document.getElementById('uploadfileform1');
	var formData = new FormData(fileform);
	var baseURL = window.location.protocol+"//"+window.location.host;
	var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
	$.ajax({
		url:  urltoget,
		type: 'POST',
		data: formData,
		contentType: false,
		dataType: 'json', 
		cache: false,
		processData: false,
		success: function(response) {
			if(response['attachment_id'] > 0 ){
            $("#filevalidatearea" ).html("Your file was uploaded successfully. Thank you.");
			$('#file-upload').val('');
			location.reload(); 
			return false;
            }else if (response['attachment_id'] == 0){
			$( "#filevalidatearea" ).html(response['errormsg']);
			$('#file-upload').val('');
			return false;
			}	
		}
	});	
});
$('#uploadfileform2').on( "submit", function( e ) {
$( "#filevalidatearea" ).html("Please wait while your file uploads, this might take a while, be patient....");
	e.preventDefault();
	var fileform = document.getElementById('uploadfileform2');
	var formData = new FormData(fileform);
	var baseURL = window.location.protocol+"//"+window.location.host;
	var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
	$.ajax({
		url:  urltoget,
		type: 'POST',
		data: formData,
		contentType: false,
		dataType: 'json', 
		cache: false,
		processData: false,
		success: function(response) {
			if(response['attachment_id'] > 0 ){
            $("#filevalidatearea" ).html("Your file was uploaded successfully. Thank you.");
			$('#file-upload').val('');
			location.reload(); 
			return false;
            }else if (response['attachment_id'] == 0){
			$( "#filevalidatearea" ).html(response['errormsg']);
			$('#file-upload').val('');
			return false;
			}	
		}
	});	
});
$('#uploadfileform3').on( "submit", function( e ) {
$( "#filevalidatearea" ).html("Please wait while your file uploads, this might take a while, be patient....");
	e.preventDefault();
	var fileform = document.getElementById('uploadfileform3');
	var formData = new FormData(fileform);
	var baseURL = window.location.protocol+"//"+window.location.host;
	var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
	$.ajax({
		url:  urltoget,
		type: 'POST',
		data: formData,
		contentType: false,
		dataType: 'json', 
		cache: false,
		processData: false,
		success: function(response) {
			if(response['attachment_id'] > 0 ){
            $("#filevalidatearea" ).html("Your file was uploaded successfully. Thank you.");
			$('#file-upload').val('');
			location.reload(); 
			return false;
            }else if (response['attachment_id'] == 0){
			$( "#filevalidatearea" ).html(response['errormsg']);
			$('#file-upload').val('');
			return false;
			}	
		}
	});	
});
$('#uploadfileform4').on( "submit", function( e ) {
$( "#filevalidatearea" ).html("Please wait while your file uploads, this might take a while, be patient....");
	e.preventDefault();
	var fileform = document.getElementById('uploadfileform4');
	var formData = new FormData(fileform);
	var baseURL = window.location.protocol+"//"+window.location.host;
	var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
	$.ajax({
		url:  urltoget,
		type: 'POST',
		data: formData,
		contentType: false,
		dataType: 'json', 
		cache: false,
		processData: false,
		success: function(response) {
			if(response['attachment_id'] > 0 ){
            $("#filevalidatearea" ).html("Your file was uploaded successfully. Thank you.");
			$('#file-upload').val('');
			location.reload(); 
			return false;
            }else if (response['attachment_id'] == 0){
			$( "#filevalidatearea" ).html(response['errormsg']);
			$('#file-upload').val('');
			return false;
			}	
		}
	});	
});
$('#uploadfileform5').on( "submit", function( e ) {
$( "#filevalidatearea" ).html("Please wait while your file uploads, this might take a while, be patient....");
	e.preventDefault();
	var fileform = document.getElementById('uploadfileform5');
	var formData = new FormData(fileform);
	var baseURL = window.location.protocol+"//"+window.location.host;
	var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
	$.ajax({
		url:  urltoget,
		type: 'POST',
		data: formData,
		contentType: false,
		dataType: 'json', 
		cache: false,
		processData: false,
		success: function(response) {
			if(response['attachment_id'] > 0 ){
            $("#filevalidatearea" ).html("Your file was uploaded successfully. Thank you.");
			$('#file-upload').val('');
			location.reload(); 
			return false;
            }else if (response['attachment_id'] == 0){
			$( "#filevalidatearea" ).html(response['errormsg']);
			$('#file-upload').val('');
			return false;
			}	
		}
	});	
});

$('#uploadfileform6').on( "submit", function( e ) {
$( "#filevalidatearea" ).html("Please wait while your file uploads, this might take a while, be patient....");
	e.preventDefault();
	var fileform = document.getElementById('uploadfileform6');
	var formData = new FormData(fileform);
	var baseURL = window.location.protocol+"//"+window.location.host;
	var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
	$.ajax({
		url:  urltoget,
		type: 'POST',
		data: formData,
		contentType: false,
		dataType: 'json', 
		cache: false,
		processData: false,
		success: function(response) {
			if(response['attachment_id'] > 0 ){
            $("#filevalidatearea" ).html("Your file was uploaded successfully. Thank you.");
			$('#file-upload').val('');
			location.reload(); 
			return false;
            }else if (response['attachment_id'] == 0){
			$( "#filevalidatearea" ).html(response['errormsg']);
			$('#file-upload').val('');
			return false;
			}	
		}
	});	
});
$('#uploadfileform7').on( "submit", function( e ) {
$( "#filevalidatearea" ).html("Please wait while your file uploads, this might take a while, be patient....");
	e.preventDefault();
	var fileform = document.getElementById('uploadfileform7');
	var formData = new FormData(fileform);
	var baseURL = window.location.protocol+"//"+window.location.host;
	var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
	$.ajax({
		url:  urltoget,
		type: 'POST',
		data: formData,
		contentType: false,
		dataType: 'json', 
		cache: false,
		processData: false,
		success: function(response) {
			if(response['attachment_id'] > 0 ){
            $("#filevalidatearea" ).html("Your file was uploaded successfully. Thank you.");
			$('#file-upload').val('');
			location.reload(); 
			return false;
            }else if (response['attachment_id'] == 0){
			$( "#filevalidatearea" ).html(response['errormsg']);
			$('#file-upload').val('');
			return false;
			}	
		}
	});	
});

$('#uploadfileform8').on( "submit", function( e ) {
$( "#filevalidatearea" ).html("Please wait while your file uploads, this might take a while, be patient....");
	e.preventDefault();
	var fileform = document.getElementById('uploadfileform8');
	var formData = new FormData(fileform);
	var baseURL = window.location.protocol+"//"+window.location.host;
	var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
	$.ajax({
		url:  urltoget,
		type: 'POST',
		data: formData,
		contentType: false,
		dataType: 'json', 
		cache: false,
		processData: false,
		success: function(response) {
			if(response['attachment_id'] > 0 ){
            $("#filevalidatearea" ).html("Your file was uploaded successfully. Thank you.");
			$('#file-upload').val('');
			location.reload(); 
			return false;
            }else if (response['attachment_id'] == 0){
			$( "#filevalidatearea" ).html(response['errormsg']);
			$('#file-upload').val('');
			return false;
			}	
		}
	});	
});






$('a.deleteafile').click(function(e) {
e.preventDefault();
var attachmentid=$(this).attr('id');
var baseURL = window.location.protocol+"//"+window.location.host;
var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
        $.ajax({
		type: "POST",
		url: urltoget,
		dataType: 'json',
		data:{'action':'deleteUploadedFile','attachmentid':attachmentid },
		success: function(response) {
			var attachmentid=response['attachmentid'];
			        $( "#filedisplayarea" ).html(response['deletemessage']);
					$('#row-'+attachmentid).children('td')
					$('#row-'+attachmentid).children().css({backgroundColor:'#f8eb97'}, 300)
					$('#row-'+attachmentid).children('td')
					.slideUp(function() {$('#row-'+attachmentid).remove(); });
					return false;
				},
				error: function(xhr, textStatus, errorThrown){
						alert(textStatus);
				},
	        });
});
$('#zipattachments').click(function(e) {
e.preventDefault();
var postid = $(this).attr("class");	
var baseURL = window.location.protocol+"//"+window.location.host;
var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
var data="postid=" + postid+"&action=zipattachments";
window.open(urltoget+'/?'+data,'_blank' );
});
   
//dialog checklist items
$('a.lernchecklistresults').click(function(e){
$("#lernchecklistresults" ).dialog({
            resizable: true,
            modal: true,
			width:600,
			position: { my: "left top+50", at: "left top", of: window },
    });
    return false;
});
/*dialog challenges list*/
$('a.lernchallenges').click(function(e){
e.preventDefault();
$("#lernchallenges" ).dialog({
            resizable: true,
            modal: true,
			width:550,
			 position: { my: "left top+50", at: "left top", of: window },
    });
    return false;
});

/*dialog nest steps list*/
$('a.lernnextsteps').click(function(e){
e.preventDefault();
$("#lernnextsteps" ).dialog({
            resizable: true,
            modal: true,
			width:550,
			position: { my: "left top+50", at: "left top", of: window },

    });
    return false;

});


/*fancybox modal resource upload form*/
$('#share-website').click(function(e){
$.fancybox({
		'padding':  20,
		'autoScale':true,
		'autoDimensions':true,
		'showCloseButton':true,
        'href': '#sharewebsite', 
        'modal': false,
		
    });
    return false;

});
/*fancybox for remamable file upload*/
$('#upload-rename-file1').click(function(e){
e.preventDefault();
$.fancybox({
		'padding':  20,
		'autoScale':true,
		'autoDimensions':true,
		'showCloseButton':true,
        'href': '#uploadfile1', 
        'modal': false,
		
    });
    return false;
});	
$('#upload-rename-file2').click(function(e){
e.preventDefault();
$.fancybox({
		'padding':  20,
		'autoScale':true,
		'autoDimensions':true,
		'showCloseButton':true,
        'href': '#uploadfile2', 
        'modal': false,
		
    });
    return false;
});
$('#upload-rename-file3').click(function(e){
e.preventDefault();
$.fancybox({
		'padding':  20,
		'autoScale':true,
		'autoDimensions':true,
		'showCloseButton':true,
        'href': '#uploadfile3', 
        'modal': false,
		
    });
    return false;
});
$('#upload-rename-file4').click(function(e){
e.preventDefault();
$.fancybox({
		'padding':  20,
		'autoScale':true,
		'autoDimensions':true,
		'showCloseButton':true,
        'href': '#uploadfile4', 
        'modal': false,
		
    });
    return false;
});

$('#upload-rename-file5').click(function(e){
e.preventDefault();
$.fancybox({
		'padding':  20,
		'autoScale':true,
		'autoDimensions':true,
		'showCloseButton':true,
        'href': '#uploadfile5', 
        'modal': false,
		
    });
    return false;
});
$('#upload-rename-file6').click(function(e){
e.preventDefault();
$.fancybox({
		'padding':  20,
		'autoScale':true,
		'autoDimensions':true,
		'showCloseButton':true,
        'href': '#uploadfile6', 
        'modal': false,
		
    });
    return false;
});
$('#upload-rename-file7').click(function(e){
e.preventDefault();
$.fancybox({
		'padding':  20,
		'autoScale':true,
		'autoDimensions':true,
		'showCloseButton':true,
        'href': '#uploadfile7', 
        'modal': false,
		
    });
    return false;
});
$('#upload-rename-file8').click(function(e){
e.preventDefault();
$.fancybox({
		'padding':  20,
		'autoScale':true,
		'autoDimensions':true,
		'showCloseButton':true,
        'href': '#uploadfile8', 
        'modal': false,
		
    });
    return false;
});

/*fancybox modal file upload form*/
$('#share-file').click(function(e){
e.preventDefault();
$.fancybox({
		'padding':  20,
		'autoScale':true,
		'autoDimensions':true,
		'showCloseButton':true,
        'href': '#sharefile', 
        'modal': false,
		
    });
    return false;
});



/*fancybox roster list*/
$('a.rosterfancybox').click(function(e){
e.preventDefault();
$.fancybox({
		'padding':  20,
		'autoScale':true,
		'autoDimensions':true,
		'showCloseButton':true,
        'href': '#lerncourseroster', 
        'modal': false,
		'onComplete': function(){ // for v2.0.6+ use : 'beforeShow' 
				var win=null;
				var content = $('#fancybox-content'); // for v2.x use : var content = $('.fancybox-inner');
				$('#fancybox-outer').append('<div id="fancy_print"></div>'); // for v2.x use : $('.fancybox-wrap').append(...
				$('#fancy_print').bind("click", function(){
				$('#fancy_print').hide();
				  win = window.open("width=200,height=200");
				  self.focus();
				  win.document.open();
				  win.document.write('<'+'html'+'><'+'head'+'><'+'style'+'>');
				  win.document.write('body, td { font-family: Verdana; font-size: 10pt;}');
				  win.document.write('<'+'/'+'style'+'><'+'/'+'head'+'><'+'body'+'>');
				  win.document.write(content.html());
				  win.document.write('<'+'/'+'body'+'><'+'/'+'html'+'>');
				  win.document.close();
				  win.print();
				  win.close();
				}); // bind
			  } //onComplete
    });
    return false;
});

//get click for file uploader
$('#featured_upload').on( "submit", function( e ) {
	e.preventDefault();
	var form = document.getElementById('featured_upload');
	var formData = new FormData(form);
	var baseURL = window.location.protocol+"//"+window.location.host;
	var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
	$.ajax({
		url:  urltoget,
		type: 'POST',
		data: formData,
		contentType: false,
		cache: false,
		processData: false,
		success: function(returndata) {
			if(returndata == 1){
			alert("Great! Your file was uploaded.");
			$( "#fileUploadSuccess" ).html("<span style='color:red; font-size: 90%;font-weight:bold;'>Your file was uploaded successfully.</span>");
			$('#tc_file_upload').val('');
			}else if (returndata == 0){
			alert("Oops! Your file did not upload.");
			$( "#fileUploadSuccess" ).html("<span style='color:red; font-size: 90%;font-weight:bold;'>Your file failed to upload.</span>");
			$('#tc_file_upload').val('');
			}	
		}
	});	
});

//get click and reveal clicks bases on the class name of the link
$('a.clickToShow').mouseover(function() { 
    var id = $(this).attr('id');
    if ($('#reveal'+id).css('display') == 'none'){
    $('#reveal'+id).show('fast');
    return false;
    }
    //else{
   // $('#reveal'+id).hide('fast');
   // return false;
   //  }
});


$('a.clickTextShow').click(function() { 
    var id = $(this).attr('id');
    if ($('#reveal'+id).css('display') == 'none'){
    $('#reveal'+id).show('fast');
    return false;
    }
    else{
    $('#reveal'+id).hide('fast');
    return false;
     }
});

$('a.clickToShowPic').click(function() {
var id = $(this).attr('id');
     if ($('#reveal'+id).css('display') == 'none'){
     $('#reveal'+id).show();
     $('#click'+id).hide();
     return false;
    }  
});
$('a.revealClickReturn').click(function() { 
var id = $(this).attr('id');
    
     $('#click'+id).show();
     $('#reveal'+id).hide();
     return false;
    
})

$('a.clickToShowPicNoreplace').click(function() {

var id = $(this).attr('id');
     if ($('#reveal'+id).css('display') == 'none'){
     $('#reveal'+id).show();
     } 
    return false;    
});

$('input.yesnocbo').click(function() { 
var id = $(this).attr('id');
var id_num = id.replace( /[^0-9]/g, '' );
if ($('#yesnoanswer'+id_num).css('display') == 'none'){
   $('#yesnoanswer'+id_num).show('fast');
   $('#yescbo'+id_num).attr('checked', true);
   }
else{
$('input:radio[class="yesnordo"]').removeAttr('checked');
}
});

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

//handle meet marie text boxes with content saved for the activity
//don't load this unless we are on specific pages that use it. why? because the button names are 
//created dynamically and we do not know which ones will be clicked so we have to get input button

//handle the qi role user meta 
if(current_page.indexOf('qi-survey') > -1){
var baseURL = window.location.protocol+"//"+window.location.host;
var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
$("#qi-role-select" ).change(function() {
  var selectedValue =$("#qi-role-select" ).val();
  var otherValue = $("#otherQiRole").val();
  if (selectedValue == 'Other'){
	$(".tc_inline_label").css('display','block');
	$("#otherQiRole").css('display','block');
  }
  else{
    $(".tc_inline_label").css('display','none');
	$("#otherQiRole").css('display','none');
  }
$.post(urltoget, {'action':'set_qi_role_meta','qi_role': selectedValue }, function(ret){        
});
});
$(document).off('keypress').on('keypress',function (e) {
        //enter key 
		var keyCode = e.keyCode || e.which;
        if (keyCode == 13) {
	    var otherSelectedValue = $("#otherQiRole").val();
		$.post(urltoget, {'action':'set_qi_otherrole_meta', 'other_val': otherSelectedValue }, function(ret){        
        });
         }
});
$("#tc_district_ks" ).change(function() {
var district = $("#tc_district_ks" ).val();
var baseURL = window.location.protocol+"//"+window.location.host;
var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
$.post(urltoget, {'districtaction':'set_district_meta','district':district,'state':'KS' }, function(ret){   
var obj = jQuery.parseJSON(ret); 
});
});
$("#tc_district_mo" ).change(function() {
var baseURL = window.location.protocol+"//"+window.location.host;
var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
var district = $("#tc_district_mo" ).val();
$.post(urltoget, {'districtaction':'set_district_meta','district':district,'state':'MO' }, function(ret){   
var obj = jQuery.parseJSON(ret);    
});
});
$("#tc_district_ga" ).change(function() {
var baseURL = window.location.protocol+"//"+window.location.host;
var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
var district = $("#tc_district_ga" ).val();
$.post(urltoget, {'districtaction':'set_district_meta','district':district,'state':'GA' }, function(ret){ 
var obj = jQuery.parseJSON(ret);      
});
});
}//end if it is the qi role selector on the qi survey page
//end document ready
});

