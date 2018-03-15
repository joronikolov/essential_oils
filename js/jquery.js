
$(document).ready(
		function(){
			$("#addIngr").mouseenter(function(){$("#addIngr").attr("src","img/plus_blue.png")});
			$("#addIngr").mouseleave(function(){$("#addIngr").attr("src","img/plus.png")});
			}
		);
function hidVisStatus(id){var $class=$(id).attr("class")
				if($class=="hidden"){											
			$(id).attr("class","visible");}
											else{$(id).attr("class","hidden");}
										};