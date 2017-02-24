/*
	jquery.custom.js
	
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	
*/
jQuery(document).ready(function($) {
//get click and reveal clicks bases on the class name of the link
$('img#imgWeight1').click(function(e) { 
 e.preventDefault();
           var el = $('img#imgWeight1');
           el.css("position", "absolute");
           el.animate({ top: "-=150px" ,left :"+=450px"}, 1300, undefined, function () {
		   el.remove().appendTo(".mobile_functions_weight").css("position", "relative");
		         $('.mobilepiece').animate({  borderSpacing: + 4 }, {
				 step: function(now,fx) {
				  $('.mobilepiece').css('-webkit-transform','rotate('+now+'deg)'); 
				  $('.mobilepiece').css('-moz-transform','rotate('+now+'deg)');
				  $('.mobilepiece').css('transform','rotate('+now+'deg)');
				},
				duration:'slow'
			     },'linear');
				setTimeout(function() {
				$('.mobilepiece').animate({  borderSpacing: 0 }, {
				 step: function(now,fx) {
				  $('.mobilepiece').css('-webkit-transform','rotate('+now+'deg)'); 
				  $('.mobilepiece').css('-moz-transform','rotate('+now+'deg)');
				  $('.mobilepiece').css('transform','rotate('+now+'deg)');
				},
				duration:'slow'
			    },'linear');
			    }, 2000);	
				setTimeout(function() {
				el.remove();
				//set the contents inside the receiving div = '' set the contents of the weight1 div = image
			    }, 3000);
			});
});
$('img#imgWeight2').click(function(e) { 
 e.preventDefault();
           var el = $('img#imgWeight2');
           el.css("position", "absolutes");
           el.animate({ top: "-=140px" ,left :"+=420px"}, 1300, undefined, function () {
		   el.remove().appendTo(".mobile_interactions_weight").css("position", "relative");
		         $('.mobilepiece').animate({  borderSpacing: + -4 }, {
				 step: function(now,fx) {
				  $('.mobilepiece').css('-webkit-transform','rotate('+now+'deg)'); 
				  $('.mobilepiece').css('-moz-transform','rotate('+now+'deg)');
				  $('.mobilepiece').css('transform','rotate('+now+'deg)');
				},
				duration:'slow'
			     },'linear');
				setTimeout(function() {
				$('.mobilepiece').animate({  borderSpacing: 0 }, {
				 step: function(now,fx) {
				  $('.mobilepiece').css('-webkit-transform','rotate('+now+'deg)'); 
				  $('.mobilepiece').css('-moz-transform','rotate('+now+'deg)');
				  $('.mobilepiece').css('transform','rotate('+now+'deg)');
				},
				duration:'slow'
			    },'linear');
			    }, 2000);	
				setTimeout(function() {
				el.remove();
				//set the contents inside the receiving div = '' set the contents of the weight1 div = image
			    }, 3000);
			});
});

$('img#imgWeight3').click(function(e) {  
 e.preventDefault();
           var el = $('img#imgWeight3');
           el.css("position", "absolutes");
           el.animate({ top: "-=150px" ,left :"+=470px"}, 1300, undefined, function () {
		   el.remove().appendTo(".mobile_lifestyle_weight").css("position", "relative");
		         $('.mobilepiece').animate({  borderSpacing: + 6 }, {
				 step: function(now,fx) {
				  $('.mobilepiece').css('-webkit-transform','rotate('+now+'deg)'); 
				  $('.mobilepiece').css('-moz-transform','rotate('+now+'deg)');
				  $('.mobilepiece').css('transform','rotate('+now+'deg)');
				},
				duration:'slow'
			     },'linear');
				setTimeout(function() {
				$('.mobilepiece').animate({  borderSpacing: 0 }, {
				 step: function(now,fx) {
				  $('.mobilepiece').css('-webkit-transform','rotate('+now+'deg)'); 
				  $('.mobilepiece').css('-moz-transform','rotate('+now+'deg)');
				  $('.mobilepiece').css('transform','rotate('+now+'deg)');
				},
				duration:'slow'
			    },'linear');
			    }, 2000);	
				setTimeout(function() {
				el.remove();
			    }, 3000);
			});
});

$('img#imgWeight4').click(function(e) {  
 e.preventDefault();
           var el = $('img#imgWeight4');
           el.css("position", "absolutes");
           el.animate({ top: "-=140px" ,left :"+=400px"}, 1300, undefined, function () {
		   el.remove().appendTo(".mobile_characteristics_weight").css("position", "relative");
		         $('.mobilepiece').animate({  borderSpacing: + -6 }, {
				 step: function(now,fx) {
				  $('.mobilepiece').css('-webkit-transform','rotate('+now+'deg)'); 
				  $('.mobilepiece').css('-moz-transform','rotate('+now+'deg)');
				  $('.mobilepiece').css('transform','rotate('+now+'deg)');
				},
				duration:'slow'
			     },'linear');
				setTimeout(function() {
				$('.mobilepiece').animate({  borderSpacing: 0 }, {
				 step: function(now,fx) {
				  $('.mobilepiece').css('-webkit-transform','rotate('+now+'deg)'); 
				  $('.mobilepiece').css('-moz-transform','rotate('+now+'deg)');
				  $('.mobilepiece').css('transform','rotate('+now+'deg)');
				},
				duration:'slow'
			    },'linear');
			    }, 2000);	
				setTimeout(function() {
				el.remove();
			    }, 3000);
			});
});

$('img#imgWeight5').click(function(e) { 
 e.preventDefault();
           var el = $('img#imgWeight5');
           el.css("position", "absolute");
           el.animate({ top: "-=150px" ,left :"+=450px"}, 1300, undefined, function () {
		   el.remove().appendTo(".mobile_functions_weight").css("position", "relative");
		         $('.mobilepiece').animate({  borderSpacing: + 4 }, {
				 step: function(now,fx) {
				  $('.mobilepiece').css('-webkit-transform','rotate('+now+'deg)'); 
				  $('.mobilepiece').css('-moz-transform','rotate('+now+'deg)');
				  $('.mobilepiece').css('transform','rotate('+now+'deg)');
				},
				duration:'slow'
			     },'linear');
				setTimeout(function() {
				$('.mobilepiece').animate({  borderSpacing: 0 }, {
				 step: function(now,fx) {
				  $('.mobilepiece').css('-webkit-transform','rotate('+now+'deg)'); 
				  $('.mobilepiece').css('-moz-transform','rotate('+now+'deg)');
				  $('.mobilepiece').css('transform','rotate('+now+'deg)');
				},
				duration:'slow'
			    },'linear');
			    }, 2000);	
				setTimeout(function() {
				el.remove();
				//set the contents inside the receiving div = '' set the contents of the weight1 div = image
			    }, 3000);
			});
});
//end document ready
});

