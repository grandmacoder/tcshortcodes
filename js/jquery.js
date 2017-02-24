Array.prototype.indexOf = function( v, b, s ) {
for( var i = +b || 0, l = this.length; i < l; i++ ) {
  if( this[i]===v || s && this[i]==v ) { return i; }
 }
 return -1;
};
var droparray = new Array();
var currentlyDragged = null;

function initialize() {

		var draggables = $$('div.draggable');

		var draggableOptions = {
			onComplete:function(el)	{

				el.style.left = 0;

				el.style.top = 0;

			},
onDrop:function(el,droppable) {
gotdropped(el,droppable);
}
		};

		var dropitems = $$('div.droppable');

		draggableOptions.droppables = dropitems;
		draggables.each(function(elm) { elm.makeDraggable(draggableOptions); });

	}
window.onload = function() {
	initialize();
}
  	

	function gotdropped(draggable, droppable) {
		//Okay, store the draggable into the droppable.
		if ( droppable != null)  {
		
			droparray[droppable.id] = draggable.id;
			var t = draggable.parentNode.removeChild(draggable);
			droppable.appendChild(t);			
			//droppable.appendChild(document.createElement("hr"));
			//droppable.appendChild(draggable.childNodes[0].cloneNode(true));
			//draggable.style.visibility = "hidden";
		}
	}
  	function doCheckDrag() {
var correct_count = 0;
var total_draggers = 7;
  		var in_statement_list = document.getElementById('DragContainer3').childNodes;
  		var err_count = 0;
  		var activity_done = true;
  		var statements = new Array('Item1','Item2','Item3','Item4','Item5','Item6','Item7');
  		
  		var examples_correct = new Array('Item2','Item5','Item6');
  		var nonexamples_correct = new Array('Item1','Item3','Item4','Item7');
  		
  		
  		for (var i = 0; i < in_statement_list.length; i++) {
  			if ( statements.indexOf(in_statement_list[i].id) > -1 ) {
				
	  			activity_done = false;
				
  			}
  		}
  		
  		if (!activity_done) {
  			window.alert("Incomplete. Please drag all statements.");
  			
  			return;
  		}
  		
  		var in_examples_list = document.getElementById('DragContainer1').childNodes;
  		
  		var in_nonexamples_list = document.getElementById('DragContainer2').childNodes;
  		
  		for (var i = 0; i < in_examples_list.length; i++) {
  			var tmp = in_examples_list[i];
	  		if (tmp.id) {	
	  			if (examples_correct.indexOf(tmp.id) == -1 ) {
	err_count +=1;  				document.getElementById(tmp.id).style.backgroundColor = '#b50000';
document.getElementById(tmp.id).style.color = 'white';
	  			} else {
	  				document.getElementById(tmp.id).style.backgroundColor = '#bd8c01';
//document.getElementById(tmp.id).style.color = 'white';
correct_count++;
	  			}
	  		}
  		}
  		
  		for (var i = 0; i < in_nonexamples_list.length; i++) {
  			var tmp = in_nonexamples_list[i];
  			if (tmp.id) {
	  			if (nonexamples_correct.indexOf(tmp.id) == -1 ) {
					document.getElementById(tmp.id).style.backgroundColor = '#b50000';
					document.getElementById(tmp.id).style.color = 'white';
	  			} else {
	  				document.getElementById(tmp.id).style.backgroundColor = '#bd8c01';
					//document.getElementById(tmp.id).style.color = 'white';
					correct_count++;
	  			}
	  		}
  		}
  		
  		if ( err_count > 0 ) {
document.getElementById('err_msg').innerHTML = correct_count + ' out of ' + total_draggers + ' correct!<br/><br/>Please fix your errors marked in red.';
 } else { 

document.getElementById('err_msg').innerHTML = 'No Errors!'; }
  	}