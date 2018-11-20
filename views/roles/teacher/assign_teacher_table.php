<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;width:100%;position:inherit !important;clear:both;}
.tg td{font-family:Arial, sans-serif;font-size:13px;padding:13px 13px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:13px;font-weight:normal;padding:13px 13px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg .tg-0ord{text-align:right;font-weight:bold;}
.tg .tg-s6z2{text-align:center;font-weight:bold;}
.tg .tg-031e{text-align:center;}
</style>

<div class="col-md-12">
  <div class="callout callout-info" id = 'update' style="display: none;"><h4>Data Update Successfully</h4></div>
  <div class="callout callout-info" id = 'insert' style="display: none;"><h4>Data Insert Successfully</h4></div>
</div>

<div class="col-md-12">
	<div class="powerwidget dark-red">
		<header>
			<h2>Roles<small>Teacher</small></h2>
		</header>
		<div class="inner-spacer">
     <form action="" method="POST" id="check"> 
			<table class="table table-striped table-hover tg">
				<tr>
          		
              	<th class="tg-s6z2">Grade</th>
          			<th class="tg-s6z2">Section</th>
          			<th class="tg-s6z2">Class Teacher</th>
          			<th class="tg-s6z2">Co Teacher</th>
          			<th class="tg-s6z2">Reading Teacher</th>

               
               <!-- <?php foreach($subject as $value)  { ?>
                  <th class="tg-s6z2"><?php echo $value->subject_name; ?></th>
                  <input type="hidden" value="<?php echo $value->subject_id ?>" name="subect[]" >
               <?php } ?>

 -->
        <?php $no_of_row = count($section)+1; ?>
        </tr>
          		<tr>
          						<!-- Academic Session  -->
          			<input type="hidden" value="<?php echo $academic ?>" name="academic_session_id" id="academic_session_id">

          			<td class="tg-031e grade_name" rowspan="<?php echo $no_of_row ?>"><?php echo $grade[0]->name; ?><input type="hidden" value="<?php echo $grade[0]->id ?>" name="grade" id="grade"></td>
          			
          			<td class="tg-s6z2" colspan="1">Blocks / wk &gt;&gt;</td>
          			
          			<td class='tg-031e' col-span="1">
          				<select name='class_teacher_block' id='class_teacher_block'>
          					<option value = '1'>1</option>
          					<option value = '2'>2</option>
          					<option value = '3'>3</option>
          					<option value = '4'>4</option>
          					<option value = '5'>5</option>
          					<option value = '6'>6</option>
          					<option value = '7'>7</option>
          					<option value = '8'>8</option>
          					<option value = '9'>9</option>
          					<option value = '10'>10</option>
          					<option value = '11'>11</option>
          					<option value = '12'>12</option>
          					<option value = '13'>13</option>
          					<option value = '14'>14</option>
          					<option value = '15'>15</option>
          				</select>
          			</td>

          			<td class='tg-031e'>
          				<select name='co_teacher_block' id="co_teacher_block">
          					<option value = '1'>1</option>
          					<option value = '2'>2</option>
          					<option value = '3'>3</option>
          					<option value = '4'>4</option>
          					<option value = '5'>5</option>
          					<option value = '6'>6</option>
          					<option value = '7'>7</option>
          					<option value = '8'>8</option>
          					<option value = '9'>9</option>
          					<option value = '10'>10</option>
          					<option value = '11'>11</option>
          					<option value = '12'>12</option>
          					<option value = '13'>13</option>
          					<option value = '14'>14</option>
          					<option value = '15'>15</option>
          				</select>
          			</td>

          			<td class='tg-031e'>
          				<select name='reading_teacher_block' id="reading_teacher_block">
          					<option value = '1'>1</option>
          					<option value = '2'>2</option>
          					<option value = '3'>3</option>
          					<option value = '4'>4</option>
          					<option value = '5'>5</option>
          					<option value = '6'>6</option>
          					<option value = '7'>7</option>
          					<option value = '8'>8</option>
          					<option value = '9'>9</option>
          					<option value = '10'>10</option>
          					<option value = '11'>11</option>
          					<option value = '12'>12</option>
          					<option value = '13'>13</option>
          					<option value = '14'>14</option>
          					<option value = '15'>15</option>
          				</select>
          			</td>
          		</tr>
          		<?php foreach($section as $value)  { ?>

          		<tr>

     					<td class="tg-s6z2"><?php echo $value->section_name; ?><input type="hidden" value="<?php echo $value->section_id ?>" name="section[]" id="section" ></td>
     					
     					<td class="tg-s6z2 aneditable_class_teacher"><a href="javascript:void(0)" data-name='staff_id_class' data-type="select2" data-pk="<?php echo $value->section_id ?>" data-section="<?php echo $value->section_id ?>" data-secname=<?php echo $value->section_name; ?> data-title="Select Class Teacher"  ><input type="hidden" value="<?php echo $teacher_type[0]->id ?>" name="class_teacher_type" id='class_teacher_type'>Empty</a></td>

     					<td class="tg-s6z2 aneditable_co_teacher"><a href="javascript:void(0)" data-name='staff_id_co' data-type="select2" data-pk="<?php echo $value->section_id; ?>" data-section="<?php echo $value->section_id ?>" data-secname=<?php echo $value->section_name; ?> data-title="Select Co Teacher"><input type="hidden" value="<?php echo $teacher_type[1]->id ?>" name="co_teacher_type" id="co_teacher_type" >Empty</a></td>

     					<td class="tg-s6z2 aneditable_reading_teacher"><a href="javascript:void(0)" data-name='staff_id_reading' data-type="select2" data-title="Select Reading Teacher" data-pk="<?php echo $value->section_id; ?>" data-section="<?php echo $value->section_id ?>" data-secname=<?php echo $value->section_name; ?> ><input type="hidden" value="<?php echo $teacher_type[2]->id ?>" name="reading_teacher_type" id="reading_teacher_type" >Empty</a></td>

             <!--  <td class="tg-s6z2"><a href="javascript:void(0)">Empty</a></td> -->

          		</tr>

          		<?php } ?>



			</table>

      

    </form>
		</div>
	</div>
</div>

<div class="col-md-12">
 <div class="powerwidget dark-red">
  <header>
    <h2>Roles<small>Compulsory Teacher</small></h2>
  </header>
    <div class="inner-spacer">
      <table class="table table-striped table-hover tg">
              <th class="tg-s6z2">Section</th>


                <?php foreach($subject as $value)  { ?>
                  <th class="tg-s6z2"><?php echo $value->subject_name; ?></th>
                  <input type="hidden" value="<?php echo $value->subject_id ?>" name="subect[]" >
                <?php } ?>

                <?php foreach($section as $sec) { ?>
                  <tr>
                    <td class="tg-s6z2"><?php echo $sec->section_name; ?><input type="hidden" value="<?php echo $sec->section_id ?>" name="section[]" id="section" ></td>

                  <?php foreach($subject as $value) { ?>

                    <td class="tg-s6z2 aneditable_subject"><a href="javascript:void(0)" data-name="subject" data-type="select2" data-title="Select Subject Teacher" data-pk="<?php echo $sec->section_id; ?>"  data-section="<?php echo $sec->section_id ?>" data-secname="<?php echo $sec->section_name; ?>" data-program = "<?php echo $value->id; ?>" data-subjectname="<?php echo $value->subject_name ?>" data-subjectid="<?php echo $value->subject_id ?>">Empty</a></td>
                  <?php } ?>


                  </tr>
                <?php } ?>

      </table>
    </div>
  </div>
</div>


<?php if($subject_optional != null) { ?>

<div class="col-md-12">
  <div class="powerwidget dark-red">
    <header>
      <h2>Roles<small>Optional Teacher</small></h2>
    </header>
    <div class="inner-spacer">
<!--       <table class="table table-striped table-hover tg">
        <th class="tg-s6z2">Group</th>
        <?php foreach($subject_optional as $value) { ?>
          <th class="tg-s6z2"><?php echo $value->subject_name; ?></th>
        <?php } ?>

        <?php for($i = 1 ; $i <= $group_block[0]->no_of_group_block ; $i++ ) { ?>
          <tr>
            <td class="tg-s6z2"><?php echo $i ?></td>

            <?php foreach($subject_optional as $subject) { ?>


              <?php foreach($subjectblock as $block) { ?>

              


                 <?php if($subject->subject_id == $block->subject) { ?>
                    <?php $count = 1 ?>
                      <?php for($j=$count; $j <= $block->block ; $j++) { ?>
                        <td><?php echo $block->key ?></td>
                      <?php } ?>


                 <?php } ?> 

              <?php } ?>

            <?php } ?>

          </tr>
        <?php } ?>

      </table> -->

      


      <?php if(!empty($subjectblock))  {?>
      <table class="table table-striped table-hover tg">

      <?php /*
        <th class="tg-s6z2">Subject</th>
        
        <?php for($i = 1 ; $i <= $group_block[0]->no_of_group_block ; $i++) { ?>
          <th class="tg-s6z2"><?php echo $i; ?></th>
        <?php } ?>
         */ ?>


        <?php foreach($subject_optional as $subject)  { ?>
          <tr>
            <td class="tg-s6z2"><?php echo $subject->subject_name; ?></td>
            <?php foreach($subjectblock as $block) { ?>

            <!-- For Group Like A,B,C,D  -->
             <?php $key = explode('_',$block->key); ?>
              <?php $group = $key[7]; ?>
              <?php if($group == 1){
                $group_name =  'A';
              }
              else if ($group == 2){
                $group_name ='B';
              }
              else if($group == 3){
                $group_name = 'C';
              }
              else if($group == 4)
              {
                $group_name = 'D';
              }
              else if($group == 5){
                $group_name = 'E';
              }
              else if($group == 6){
                $group_name = 'F';
              }



              ?>
              <!-- End -->

              <?php if($subject->subject_id == $block->subject) { ?>
                <?php $count = 1; ?>
                <?php for($j=$count ; $j <= $block->block ; $j++) { ?>
                  <td class="tg-s6z2 aneditable_optional"><a href="javascript:void(0)" data-name="optional_subject" data-type="select2" data-title="Select Optional Subject Teacher" data-pk="<?php echo $j; ?>" data-subjectname="<?php echo $subject->subject_name ?>" data-subjectid="<?php echo $subject->subject_id ?>" data-key="<?php echo $block->key ?>" data-program="<?php echo $subject->id ?>">Empty</a><?php echo " ".$group_name.$j; ?></td>
                <?php } ?>
              <?php } ?>
            <?php } ?>
          </tr>
        <?php } ?>

      </table>
      <?php } ?>
    </div>
  </div>
</div>

<?php } ?>


<!-- <div class="row">
 <div class="col-md-2">
  <div class="powerwidget cold-grey">
  
  <header>
    <h2>Position<small>Class Teacher</small></h2>
  </header>
 <div class="inner-spacer">
    <table class="table table-striped table-hover tg" id="view-table">
         <tr> 
          <th class="tg-s6z2">Class Teacher Position</th>
         </tr>

       </table>
     </div>  
  </div>
</div>

<div class="col-md-2">
  <div class="powerwidget cold-grey">
  
  <header>
    <h2>Position<small>CO Teacher</small></h2>
  </header>
 <div class="inner-spacer">
       <table class="table table-striped table-hover tg" id="view-table2">
         <tr>
          <th class="tg-s6z2" >Co Teacher Position</th>
         </tr>
       </table>
     </div>  
  </div>
</div>


<div class="col-md-2">
  <div class="powerwidget cold-grey">
  
  <header>
    <h2>Position<small>Reading Teacher</small></h2>
  </header>
 <div class="inner-spacer">
       <table class="table table-striped table-hover tg" id="view-table3">
         <tr>
          <th class="tg-s6z2">Reading Teacher Position</th>
         </tr>
       </table>
     </div>  
  </div>
</div>
</div> -->
<script type="text/javascript">
	$(document).ready(function(){


    //Class Teacher

    
    var grade_name;
    $(document).on('click','.editable-submit',function(){
       
       //chosen_name = $('.select2-chosen').text();
       grade_name = $('.grade_name').text();
      

    });

    var section;
    var section_name;

    $(document).on('click','.aneditable_class_teacher a',function(){
       
       section = $(this).attr('data-section');
       section_name = $(this).attr('data-secname');

    });

    var academic_session_id = $('#academic_session_id').val();
    var grade_id = $('#grade').val();
    var class_teacher_type = $('#class_teacher_type').val();

    var class_teacher_bpw = 1;
    $('#class_teacher_block').on('change',function(){
      class_teacher_bpw = $('#class_teacher_block').val();
    });





		$('.aneditable_class_teacher a').editable({
			type:'select2',
			source:[
				{value:0, text:'Undefined'},
				 <?php foreach ($staff as $value) { ?>
            {value: '<?php echo $value->id; ?>', text: '<?php echo $value->name_code . "-" . $value->name; ?>'},
         <?php } ?>

			],

      params: function(params) {
        //originally params contain pk, name and value
        params.grade_name = grade_name;
        params.section_name = section_name;
        params.section_id = section;
        params.academic_session_id = academic_session_id;
        params.grade_id = grade_id;
        params.teacher_type_id = class_teacher_type;
        params.blocks_per_week = class_teacher_bpw;
        return params;
      },

            validate: function(value) {
          if($.trim(value) == '') {
          return 'This field is required';
      }
  },


			url: '<?php echo base_url(); ?>index.php/roles/assign_teacher_ajax/insert_teacher',
			select2: {
                  width: 200,
                  placeholder: 'Select Staff',
                  allowClear: true
               },
      success:function(){

        var position = grade_name + "-" + "CLTR" + "-" +"0" + "-" + section_name;
        
        $('#view-table tr:last ').after('<tr><td id='+section+' class="tg-s6z2">'+position+'</td></tr>');
        $('#insert').css('display','');
        $('#insert').fadeOut(5000);

      }



		});


    // =======================
    // Co Teacher Type 
    // =======================


    var grade_name;
    $(document).on('click','.editable-submit',function(){
       //chosen_name = $('.select2-chosen').text();
        grade_name = $('.grade_name').text();

    });



    var section;
    var section_name_co;
    $(document).on('click','.aneditable_co_teacher a',function(){
       section = $(this).attr('data-section');
       section_name_co = $(this).attr('data-secname');
    });

    var co_teacher_type = $('#co_teacher_type').val();
    var co_teacher_bpw = 1;

    $('#co_teacher_block').on('change',function(){
      co_teacher_bpw  = $('#co_teacher_block').val();
      // alert(bpw);
    });

		$('.aneditable_co_teacher a').editable({
			type:'select2',
			source:[
				{value:0, text:'Undefined'},
				 <?php foreach ($staff as $value) { ?>
                        {value: '<?php echo $value->id; ?>', text: '<?php echo $value->name_code . " - " . $value->name; ?>'},
                <?php } ?>
			],


      params: function(params) {
        //originally params contain pk, name and value
        params.grade_name = grade_name; 
        params.section_id = section;
        params.section_name = section_name_co;
        params.academic_session_id = academic_session_id;
        params.grade_id = grade_id;
        params.teacher_type_id = co_teacher_type;
        params.blocks_per_week = co_teacher_bpw;
        return params;
      },

			url: '<?php echo base_url(); ?>index.php/roles/assign_teacher_ajax/insert_teacher',
			select2: {
                  width: 200,
                  placeholder: 'Select Staff',
                  allowClear: true
                },
      validate: function(value) {
      if($.trim(value) == '') {
        return 'This field is required';
      }
    },
    success:function(){
     
      var position = grade_name + "-" + "COTR" + "-" +"0" + "-" + section_name_co;;
      $('#view-table2 tr:last ').after('<tr><td class="tg-s6z2">'+position+'</td></tr>');
      $('#insert').css('display','');
      $('#insert').fadeOut(5000);   
    }
		});


    //=============================
    // Reading Teacher Type 
    //=============================

    var grade_name;
    $(document).on('click','.editable-submit',function(){
       grade_name = $('.grade_name').text();
    });



    var section;
    var section_name_reading;
    $(document).on('click','.aneditable_reading_teacher a',function(){
       section = $(this).attr('data-section');
       section_name_reading = $(this).attr('data-secname');
      });


    var reading_teacher_type = $('#reading_teacher_type').val();
    var reading_teacher_bpw = 1;

    $('#reading_teacher_block').on('change',function(){
      reading_teacher_bpw = $('#reading_teacher_block').val();
    });

		$('.aneditable_reading_teacher a').editable({
			type:'select2',
			source:[
				{value:0, text:'Undefined'},
				 
         <?php foreach ($staff as $value) { ?>
              {value: '<?php echo $value->id; ?>', text: '<?php echo $value->name_code . " - " . $value->name; ?>'},
         <?php } ?>
			],
      params: function(params) {
        //originally params contain pk, name and value
        params.grade_name = grade_name;
        params.section_id = section;
        params.section_name = section_name_reading;
        params.academic_session_id = academic_session_id;
        params.grade_id = grade_id;
        params.teacher_type_id = reading_teacher_type;
        params.blocks_per_week = reading_teacher_bpw;
        return params;
      },

			url: '<?php echo base_url(); ?>index.php/roles/assign_teacher_ajax/insert_teacher',
			select2: {
                  width: 200,
                  placeholder: 'Select Staff',
                  allowClear: true
                },
      validate: function(value) {
       if($.trim(value) == '') {
        return 'This field is required';
     }
      },
      success:function(){
        
        var position = grade_name + "-" + "RGTR" + "-" +"0" + "-" + section_name_reading;
        $('#view-table3 tr:last ').after('<tr><td class="tg-s6z2">'+position+'</td></tr>');
        $('#insert').css('display','');
        $('#insert').fadeOut(5000);
      }
		});


    // ==============================
    //  Teacher Subject Name 
    // ==============================

    var subject;
    var program_id;
    var subject_id;

   $(document).on('click','.aneditable_subject a',function(){
       section = $(this).attr('data-section');
       section_name_subject = $(this).attr('data-secname');
       subject = $(this).attr('data-subjectname');
       program_id = $(this).attr('data-program');
       subject_id = $(this).attr('data-subjectid');
      
       
      });

    $('.aneditable_subject a').editable({

      type:'select2',
      source:[
        {value:0, text:'Undefined'},
         
         <?php foreach ($staff as $value) { ?>
              {value: '<?php echo $value->id; ?>', text: '<?php echo $value->name_code . " - " . $value->name; ?>'},
         <?php } ?>
      ],
     params: function(params) {
        //originally params contain pk, name and value
        params.grade_name = grade_name;
        params.subject_name = subject;
        params.section_id = section;
        params.section_name = section_name_subject;
        params.academic_session_id = academic_session_id;
        params.grade_id = grade_id;
        params.program_id = program_id;
        params.subject_id = subject_id;
        return params;
      },
      url: '<?php echo base_url(); ?>index.php/roles/assign_teacher_ajax/insert_subject_teacher',

      select2: {
                  width: 200,
                  placeholder: 'Select Staff',
                  allowClear: true
                },


    });


    // ===============================
    // Optianl Subject Teacher 
    //================================

    var subject_name;
    var subject_id;
    var program_id;
    var key;

    $(document).on('click','.aneditable_optional a',function(){
      subject_name = $(this).attr('data-subjectname');
      subject_id = $(this).attr('data-subjectid');
      program_id = $(this).attr('data-program');
      key = $(this).attr('data-key');
    });

    $('.aneditable_optional a').editable({
      
      type:'select2',
      source:[
        {value:0, text:'Undefined'},
         
         <?php foreach ($staff as $value) { ?>
              {value: '<?php echo $value->id; ?>', text: '<?php echo $value->name_code . " - " . $value->name; ?>'},
         <?php } ?>
      ],
      params:function(params){
        
        params.grade_name = grade_name;
        params.subject_name = subject_name;
        params.program_id = program_id;
        params.academic_session_id = academic_session_id;
        params.key = key;
        params.subject_id = subject_id;
        return params;

      },
      url:"<?php echo base_url(); ?>index.php/roles/assign_teacher_ajax/insert_optional_subject_teacher",
      select2: {
            width: 200,
            placeholder: 'Select Staff',
            allowClear: true
          }

    });


		
	});



</script>