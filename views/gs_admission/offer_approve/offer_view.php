



<div class="container" id="BatchListing">
    <!-- Two column layout Start -->
    <div class="row">
        <div class="col-md-12 BatchListing">
            <div class="MaroonBorderBox">
                <h3>Offers</h3>
                <div class="col-md-12 no-padding" style="width: 335px; text-align: center; position: absolute; top: 40%; left: 40%; background: rgb(241, 239, 239); border: 1px solid rgb(204, 204, 204); padding: 10px; z-index: 99999; display: none;" id="Generations_AjaxLoader">
                   <img src="http://10.10.10.50/gs//components/image/gsLoader.gif" width="200"><br><hr style="margin: 7px 0;border-top: 1px solid #ccc;"> Loading. Please Wait...
                </div>
                <div class="inner" style="padding:20px !important;">
                    <select required class="col-md-6 paddingBottom10 paddingLeft10 paddingRight10 paddingTop10" id="grade">
                      <option value="" disabled selected>Select Grade *</option>

                      <?php foreach($grade as $grade_id) { ?>
                        <option value="<?php echo $grade_id->id ?>"><?php echo $grade_id->name ?></option>
                      <?php } ?>

                    </select>
                </div><!-- inner -->
                <hr class="RedHR" />
                <div class="inner paddingLeft20 paddingRight20" style="padding:20px !important;">

                <div class="modal fade in TimeLineModal" id="AddDetails" role="dialog">
                <div class="modal-dialog">
                <div class="modal-content">

                    <div class="add_detail"></div>
                </div>
                </div>
                </div>
                    <div class="modal fade in TimeLineModal" id="OfferPreparation" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">

                            <div class="offer-preperation"></div>
                           
                          </div><!-- modal-content -->
                        </div><!-- modal-dialog -->
                    </div><!-- OfferPreparation -->
                    <div class="modal fade in TimeLineModal" id="OfferSubmission" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                          
                            <div class="offer_submission"></div>
                           

                          </div><!-- modal-content -->
                        </div><!-- modal-dialog -->
                    </div><!-- OfferSubmission -->
                   
                      <div class="offer_table"></div>

                      
            </div><!-- MaroonBorderBox -->
        </div><!-- col-md-12 -->
    </div><!-- row -->
    <!-- Two column layout END -->
</div><!-- container -->

<script>
var DECStatus = jQuery('#DECStatus');
var select = this.value;
DECStatus.change(function () {
    if ($(this).val() == 'WIL') {
        $('.IfWIL').show();
    }
    else $('.IfWIL').hide();
});

DECStatus.change(function () {
    if ($(this).val() == 'OFD') {
        $('.IfOFD').show();
    }
    else $('.IfOFD').hide();
});
</script>
<!-- <script src="js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://vitalets.github.io/x-editable/assets/demo-mock.js"></script>  -->

