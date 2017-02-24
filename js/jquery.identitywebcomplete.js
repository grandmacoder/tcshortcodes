jQuery(document).ready(function($) {
var current_page = $(location).attr('href');
var baseURL = window.location.protocol+"//"+window.location.host;
var urltoget = baseURL+"/wp-content/plugins/tcshortcodes/processShortcodesAjax.php";
 $('#area1').hover(  //gender
   function() {
	         $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_2.png');
	     },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
		}
  );
  

$('#area2').hover(
        function() {
	 $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_3.png');
       },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
  }
  );
  
 
 
  $('#area3').hover(
        function() {
	    $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_4.png');
        },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
        }
  );
  $('#area4').hover(
        function() {
	    $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_5.png');
        },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
	
        }
  );
  $('#area5').hover(
        function() {
	    $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_6.png');
        },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
        }
  );
  
 
 
   $('#area6').hover(
        function() {
	 $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_7.png');
	 },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
        }
  );
  
 
  $('#area7').hover(
        function() {
	 $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_8.png');
	 },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
        }
  );
  
  $('#area8').hover(
     function() {
	 $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_9.png');
     },
        function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
        }
  );
  
  $('#area9').hover(
        function() {
	 $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_10.png');
    },
       function() {
          $('img[usemap]').attr('src', baseURL + '/wp-content/originalSiteAssets/images/modules/identWeb_1.png');
        }
  );

});//end document ready
