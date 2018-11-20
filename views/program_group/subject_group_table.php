<div id = 'table'>
 <div class='col-md-12'>
  <div class="powerwidget dark-red"  data-widget-editbutton="false" data-widget-deletebutton="false" >
      <header>
        <h2>Subject Group<small>Detail</small></h2>  	
      </header>
      <div class="inner-spacer">
        <table class="table table-striped table-bordered table-hover" id='subject-group-table'>
        	<div class="row">
        		<div class='col-md-12'>

        			<div class='btn btn-primary btn-insert' data-toggle="modal" style="float: right; margin: 0px 0px 10px 0px;">Insert Record</div> 
        		</div>
        	</div>
          <thead>
            <tr>
              <!-- <th width="55%" colspan="2">Game Name</th> -->
              <th class="centered-cell" >S.No</th>
              <th class="centered-cell">Name</th>
              <th class="centered-cell">Display Name</th>
              <th class="centered-cell">Short Name</th>
              <th class="centered-cell">Code</th>
              <th class="centered-cell">Position</th>
              <th class="centered-cell">Action</th> 
            </tr>
          </thead>
          <tbody>
            
            <?php if($table_data != Null) {?>
            	<?php foreach ($table_data as $value) { ?>
            <tr>
              <td class="centered-cell"><span class="num"><?php echo $value->id; ?></span></td>
              <td class="centered-cell cell-style"><strong><?php echo $value->name;   	?></strong></td>
              <td class="centered-cell cell-style"><strong><?php echo $value->dname; 	?></strong></td>
              <td class="centered-cell cell-style"><strong><?php echo $value->sname;  	?></strong></td>
              <td class="centered-cell cell-style"><strong><?php echo $value->code;     ?></strong></td>
              <td class="centered-cell"><span class='num'><?php echo $value->position;?></span></td>
              <td class="centered-cell btn-edit" id="<?php echo $value->id ?>" ><a href='javascript:void(0)'><button class='btn btn-primary btn-style'>Edit</button></a></td>
            </tr>
            	<?php } ?>
            <?php } ?>

          </tbody>
          <tfoot>
          </tfoot>
        </table>
      </div>
    </div>
</div>
</div>
<style type="text/css">
.btn-insert{
	float: right;
	margin: 0px 0px 10px 0px;
}
.modal-dialog {
  width: 50%;
  height: 50%;
  padding: 0;

  overflow-y: initial !important;
}
.modal-body{
    height: 640px;
    overflow-y: auto;
}
code{
	font-size: 15px;
}
.table .num{
	background-color: #7F7C7C;
	color:#ffffff;
}
.btn-style{
	padding: 4px 10px
}
.cell-style{
color: #357ebd;
}
	
</style>