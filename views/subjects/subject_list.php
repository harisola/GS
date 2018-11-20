<div class="col-md-6 bootstrap-grid"> 

	<div class="powerwidget cold-grey" id="nestable-1" data-widget-editbutton="false">
		<header> <h2>School Level<small> Subjects List</small></h2> </header>
		<div class="inner-spacer">
			<menu id="nestable-menu">
				<button data-action="expand-all" class="btn btn-primary" type="button">Expand All</button>
				<button data-action="collapse-all" class="btn btn-primary" type="button">Collapse All</button>
			</menu>
		<div class="dd" id="nestable">
			<?php echo $this->SubjectList; ?>            
		</div>
		</div>
	</div>
</div>	


<script>


$(document).ready(function(){
		
$(".dd a").on("mousedown",function(event) { // mousedown prevent nestable click
	event.preventDefault();
	return false;
});

$(".dd a").on("click", function(event) { // click event
event.preventDefault();
//window.location = $(this).attr("href");
var ID = $(this).attr('id');
var getID = ID.split("_");
var nID = getID[1];
$.ajax({
	type: "POST",
	url : "<?=base_url(); ?>index.php/subjects/ajax_menipulations/editable",
	data: { ID:nID },
	dataType: "HTML",
	success: function( response ){
		var contents = response;
		//alert(contents);
		$("#content_id").html(contents);
	}//
});
return false;
});



		
    $('#nestable').nestable({
        group: 1,
		maxDepth :6
    }).on('change', function () {
		var rtn;
		rtn = 0;
		var solangi = $('.dd').nestable('serialize');
		var postData;
		if (window.JSON) {
			postData = window.JSON.stringify( solangi );
		}
		//console.log( postData );
		
		$.ajax({
			type: "POST",
			url : "<?=base_url(); ?>index.php/subjects/ajax_menipulations/rearangeOrder",
			data: { jsonstring:postData },
			dataType: "JSON",
			success: function( response ){
				rtn = 1;
				console.log(response);
			}//
		});
		
	});
	
	 if ($('#nestable-menu').length) {
	  $('.dd').nestable('collapseAll');
	$('#nestable-menu').on('click', function(e){
		var target = $(e.target),
		action = target.data('action');
		if (action === 'expand-all') {
			$('.dd').nestable('expandAll');
		}
		if (action === 'collapse-all') {
			$('.dd').nestable('collapseAll');
		}
	});
}


});
</script>
