<?php if(!empty( $singleCat) ) { ?>
<div class="inner-spacer">
<div class="callout callout-info" id="successMsg" style="display:none;">
Thank you! Category Created.
</div>
<form action="" method="post" enctype="multipart/form-data" id="updateCategory"  class="orb-form">
<input type="hidden" name="screteID" value="<?=$singleCat->id;?>" />
<fieldset>
<div class="row">
  <section class="col col-6">
	<label class="input"> <i class="icon-append fa fa-asterisk"></i>
	  <input type="text" name="ass_cat_title" value="<?=$singleCat->name;?>" id="catTitle">
	</label>
  </section>
   <section class="col col-6">
	<label class="input"> <i class="icon-append fa fa-asterisk"></i>
	  <input type="text" name="catDisplayName" value="<?=$singleCat->dname;?>"  id="catDisplayName">
	</label>
  </section>
</div>
</fieldset>


<fieldset>

<div class="row">
  
  <section class="col col-6">
	<label class="input"> <i class="icon-append fa fa-asterisk"></i>
	  <input type="text" name="catShortName" value="<?=$singleCat->sname;?>"  id="catShortName">
	</label>
  </section>
  <section class="col col-6">
	<label class="input">  <i class="icon-append fa fa-asterisk"></i>
	  <input type="text" name="ass_cat_weightage" value="<?=$singleCat->weightage;?>" id="ass_cat_weightage">
	</label>
  </section>
</div>


<section>
  <label class="textarea"> <i class="icon-append fa fa-comment"></i>
	<textarea rows="5" name="ass_cat_comment" id="ass_cat_comment"><?=$singleCat->comments;?></textarea>
  </label>
</section>
</fieldset>
<footer>
<button type="submit" class="btn btn-default" id="send"> Update Category </button>
<div class="progress"></div>
</footer>

<div class="message"> <i class="fa fa-check"></i>
<p>Thank you<br>
  Category Created.</p>
</div>

</form>
</div>


<script>
   $(document).ready(function() {
   //Order Form Validation
	   if ($('#updateCategory').length) {
		   $("#updateCategory").validate({
                // Rules for form validation
                rules: {
                    ass_cat_title : {
                        required: true
                    },
                    
                    ass_cat_weightage: {
						required: true,
						max: 100
                    },
                    catDisplayName: {
                    required: true
					
                    },
                    catShortName: {
                        required: true,
						rangelength: [2, 3]
						
                    }
                },

                // Messages for form validation
                messages: {
                    ass_cat_title: {
						required: 'Please enter category name title'
                    },
                    catDisplayName: {
						required: 'Please enter category display name'
                    },
                    catShortName: {
						required: 'Please enter category short name'
                    },
                    
                    ass_cat_weightage: {
						required: 'Please enter category short name'
                    }
                },

                // Ajax form submition
                submitHandler: function (form) {
                    $(form).ajaxSubmit({
						type: "POST",
						url : "<?=base_url();?>index.php/automcomplete/autocomplete/updateCategory",
						cache: false,               
						data: $('#updateCategory').serialize(),
						dataType: "json",
						beforeSend: function () {
                            $('#updateCategory button[type="submit"]').addClass('button-uploading').attr('disabled', true);
                        },
                        uploadProgress: function (event, position, total, percentComplete) {
                            $("#updateCategory .progress").text(percentComplete + '%');
                        },
                        success: function ( data ) {
						  $.ajax({
								 type: "POST",
								 url : "<?=base_url(); ?>index.php/automcomplete/autocomplete/getCreatedCategories",
								 dataType: "html",
								 success: function(data){
									$('#createdCategories2').html(data);
								  }

								 });
						$("#updateCategory").addClass('submited');
                        $('#updateCategory button[type="submit"]').removeClass('button-uploading').attr('disabled', false);
                        },
						complete:function(){
							$( '#updateCategory' ).each(function(){
								this.reset();
							});
							$('#successMsg').show();
							$('#successMsg	').fadeOut(5000);
							$("#updateCategory .progress").hide();
							$("#updateCategory").removeClass('submited');
							$("#updateCategory").addClass('orb-form');
						}
                    });
                },

                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        }
		

		
   });
</script>


<?php }?>



