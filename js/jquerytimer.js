/*
	handles timer 
	
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	
*/
jQuery(document).ready(function($) {
$(".example_stopwatch").TimeCircles({
    "animation": "smooth",
    "bg_width": 2.1,
    "fg_width": 0.09,
    "start": false,
    "count_past_zero": false,
    "circle_bg_color": "#EEEEEE",
    "time": {
        "Days": {
            "text": "Days",
            "color": "#CCCCCC",
            "show": false
        },
        "Hours": {
            "text": "Hours",
            "color": "#CCCCCC",
            "show": false
        },
        "Minutes": {
            "text": "Minutes",
            "color": "#CCCCCC",
            "show": false
        },
        "Seconds": {
            "text": "Seconds",
            "color": "#90abea",
            "show": true
        }
    }
});
$(".start").click(function(){ 
$(".example_stopwatch").TimeCircles().start(); 
}); 
$(".stop").click(function(){ 
$(".example_stopwatch").TimeCircles().stop(); 
}); 
$(".restart").click(function(){ $(".example_stopwatch").TimeCircles().restart(); 
}); 
});
