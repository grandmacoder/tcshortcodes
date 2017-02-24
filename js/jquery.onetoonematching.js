/*This jquery document handles the matching/dragging activity for modules in transition coalition
*/
jQuery(document).ready(function($) {

$("div.droppableQuiz").droppable({
    accept: function (elm) {
        var $this = $(this);
        if ($this.data("question-id") == elm.data("question-id"))
            return true;
        return false;
    },
    drop: function(e,ui) {
      $("div.draggableQuiz").draggable({ 
			opacity: 0.4,
		});
      $(ui.draggable).detach().css({top: 40,left: 30}).appendTo(this);
	
    }
});

$("div.draggableQuiz").draggable({
    revert: "invalid"
});	
	
});	
