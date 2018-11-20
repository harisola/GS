

<style>
.specialInput {
        border: 0 none;
    border-bottom: 1px solid #ccc;
    border-radius: 0 !important;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    width: 110px;
    display: inline-block;
}
.panel-default > .panel-heading {
    color: #fff;
    background-color: #c4c5c5;
    padding: 18px 10px 30px !important;
    border: 0;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
}
.SpecialSmall {
        margin-bottom: 4px !important;
    float: left;
    width: 100%;
    color: #404040;
}
.SpecialSmall:before {
    display: none;
}
.table {
    border: 1px solid #ccc;
}
.panel-title {
    margin-top: 0;
    margin-bottom: 0;
    font-weight: 600;
    font-family: 'Open Sans', sans-serif;
    font-size: 16px;
    letter-spacing: 1px;
}
.marginTop20 {margin-top: 20px !important;}
.float-right .btn.green {margin-top: -3px;padding: 10px;border-radius: 0;}
.btn.green {
    background: green;
    color: #fff;
}
.powerwidget > header h2 {
    height: 75% !important;
}
.float-right {
    float: right;
}
.panel-body {
    border: 1px solid #888;
    border-top: 0 none;
}
table tbody td,
table thead th {
    text-align: center;
}
</style>

<div style="display: none;">
    <?php 
        $min_date = '';
        $min_date2 = '';
        if(!empty($Session_List)) : ?>
        <?php foreach ($Session_List as $value) : ?>
            <input type="hidden" name="PStartDate[]" class="PStartDate" value="<?=$value["start_date"];?>" />
            <input type="hidden" name="PEndDate[]" class="PEndDate" value="<?=$value["end_date"];?>" />
            <?php 
                $min_date_s = $value["start_date"]; 
                $min_date = $value["end_date"]; 
           endforeach; ?>
     <?php endif; ?>
</div>

<div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
    <div class="powerwidget dark-red" id="duplicate_feebill_info_bar" data-widget-editbutton="false" role="widget" style="">
        <header role="heading">
            <h2 style="width: 100%;">Academic Session <span class="float-right"><a href="javascript:void" data-toggle="modal" data-target="#myModal" class="btn green">Add New Session</a></span></h2>
            <div class="powerwidget-ctrls" role="menu">          
            </div>
            <span class="powerwidget-loader"></span>
        </header><!-- header -->


        <div class="inner-spacer" role="content">    

            <div class="panel-group accordion" id="accordion3">
                <?php echo $fee_definition; ?>
            </div><!-- panel-group accordion -->


        </div><!-- inner-spacer -->
    </div><!-- powerwidget -->
</div><!-- col-md-12 -->













<div class="modal fade" id="myModal" role="dialog" style=" padding-right: 17px;">
     <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close floatClose" data-dismiss="modal">X</button>
              <h4 class="modal-title">New Session</h4>
           </div>
        
            <form action="<?=base_url();?>index.php/accounts/structure_ajax/add_Session" method="POST" name="issuance" id="issuance" class="issuance"> 
        

           <div class="modal-body">
            <div class="row">
                <div class="col-md-6"><label>Session Name</label>
                    <input type="text" name="Session_Name" id="Session_Name" class="form-control" placeholder="2018-2019" />
                </div>
                <div class="col-md-6"><label>Display Name</label>
                    <input type="text" class="form-control" placeholder="2018-19" id="Display_Name" name="Display_Name" />
                </div>
            </div>
            <div class="row marginTop20">
                <div class="col-md-6"><label>Start Date</label>
                    <input type="date" class="form-control" placeholder="Start Date" id="Start_Date" name="Start_Date" min="<?=$min_date;?>" />
                </div>
                <div class="col-md-6"><label>End Date</label>
                    <input type="date" class="form-control" placeholder="End Date" name="End_Date" id="End_Date" min="<?=$min_date;?>" />
                </div>
            </div>
           </div>
           <div class="modal-footer text-center" style="text-align: center;">
              <input type="submit" class="btn btn-success" value="Launch" id="btn_new_session" />
               <div class="row marginTop20" style="display: none;" id="Errer_mgs">
                <div class="col-md-6"><label>Please wait..</label></div></div>
           </div>

          


           </form>
           <!-- Modal content-->     
        </div>
     </div>
     <!-- modal-dialog -->
  </div>

