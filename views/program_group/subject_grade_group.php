<div class='row'>
 	<div class='col-md-12'>
		<div class='powerwidget green' >
			<header><h2>Select Group</h2></header>
			<div class='row'>
				<div class='inner-spacer'>

						<!-- Success Msg -->

			    <div class="callout callout-info" id='success' style="display: none">
                  <h4>Data Insert Successfully</h4>
                </div>	

			<form  action='' id="sub-group-insert" class="orb-form" method='POST'>

						<!-- Academic Session And Grade ID -->			

		<?php if(!empty($group)) { ?>
			<?php foreach ($group as $value) { ?>
				
				<div class='col-md-2'>
					<div class='drop'>
					<input type="hidden" value="<?php echo $academic_id ?>" name='academic_id'/>
					<input type="hidden" value="<?php echo $grade_id ?>" name='grade_id' />	
					<input type="hidden"  value='<?php echo $value->id ?>' name='group_id[]' />
					<h4><?php echo $value->name; ?></h4>
					<select style="margin-top: 10px;" name='bpw[]' id='check'>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
					</select>
					<ol id='drop-list' class="droppable" data-id='<?php echo $value->id ?>'  >
					</ol>
					</div>
				</div>
			<?php  } ?>
		<?php } ?>
				<footer>
				<div class='col-md-12'>
					<button class='btn btn-primary btn-group-insert' id='btn-group-insert'>Insert</button>
				</div>
				</footer>
		 </form>
		 </div>
		</div>
		</div>
</div>
</div>

<style type="text/css">
/* css FOR sUBJECT GRADE GROUP*/

.drop{
	padding-top: 10px;
    margin-top: 13px; 
    padding-bottom: 20px;
    text-align: center;
    width: 200px;
    background-color:#dbd9d9;
    height: 216px;
    border-radius:20px;
}   
li{
	/*list-style: none;*/
}

#drop-list{
	padding: 0px;
	margin-top: 10px;
	background: #fafafa none repeat scroll 0 0;
    border: 2px solid #ddd;
    border-radius: 3px;
    box-sizing: border-box;
    color: #333;
    display: block;
    font-weight: 700;
    margin: 5px 0;
    padding: 0px 10px;
    text-decoration: none;
}

#drop-list li{
	font-size:15px;
	color: #c7254e;
}

.ui-state-hover{
	background-color: #babbbc;
}
.btn-group-insert{
	margin-top:20px;
}

</style>

<script type="text/javascript">
	$('.drop').droppable({
        activeClass	: "ui-state-default",
        hoverClass	: "ui-state-hover",
        accept		: ":not(.ui-sortable-helper)",
		drop:handleDropEvent,
	});
	function handleDropEvent(event,ui){

		var value='';
		var input='';
		var group='';
		var test='';


		var draggable = ui.draggable;

			// Adding Class Active to get the Group ID
		if($('#drop-list').find('.ui-state-hover')){
			$(this).addClass('active');
			var c = $('.active').find('#drop-list').attr('data-id');
			
			
			//GettIng Subject ID uiIndex
			var uiIndex = ui.draggable.attr('data-id');
			var group = $('.drop').find('[subject-id=' + uiIndex + ']');


			//Duplicate Entry of the subject on same Group can be Restricted
			var item =  $(this).find('[subject-id=' + uiIndex + ']');
			//alert(item.length);


			// Adding the Element and the input box to get the value 
			if($('.drop').hasClass('active')){

				value += '<li  subject-id ='+uiIndex+ '>' +draggable.text()+ "<i class='fa fa-plus pull-right'></i><input type=hidden name=subject[] value="+uiIndex+" id=i"+uiIndex+" class='hiddenSubject' /><input type=hidden name=group[] value="+c+" id=g"+c+" /></li>";
				//input += '<input type=hidden name=subject[] value="'+uiIndex+'" id="i'+uiIndex+'" class="hiddenSubject" />';
				//group += '<input type=hidden name=group[] value="'+c+'" id="g'+c+'" />';
				

				
				$('.active #drop-list').append(value);
				//$('.active #drop-list').append(input);
				//$('.active #drop-list').append(group);
				

				//Restricted the Duplicate Entry
				if (item.length > 0) {
		  			item.last().remove();
		  			// $('#i'+uiIndex).remove();
		  			// $('#g'+c).remove();
		 			$('#subject-modal').modal('show');
		 			}

		 		//Restriction the Duplicate Group

		 		if(group.length > 0){
		 			//group.last().remove();
		 			//$('#i'+uiIndex).remove();
		 		}
				

			}


				// Remove The class Active
			$(this).removeClass('active');
			


		}


		
	}

$(document).on("click", ".droppable li", function(){

	var r = confirm("Do you want to remove " + $.trim($(this).closest('li').text()) + " ?");
	if (r == true) {
	    $(this).closest('li').remove();
	}
	//$(this).closest('li').remove();
	});

	if($('#sub-group-insert').length){
		$('#sub-group-insert').validate({
			rules:{

			},
			messages:{

			},
			 submitHandler: function (form) {
                    $(form).ajaxSubmit({
                        type: "POST",
                        url:"<?php echo base_url() ?>index.php/program_group/subject_grade_ajax/save_group_subject",
                        cache:false,
                        datatype: "html",
                        success: function (data) {

                           $('#success').css('display','');
                           $('#success').fadeOut(5000);
                        }
                    });
                }
		});
	}

</script>