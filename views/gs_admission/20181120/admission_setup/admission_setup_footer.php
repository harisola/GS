
<link rel="stylesheet" href="<?=base_url();?>components/gs_theme/css/jquery-ui.css">
<script src="<?=base_url();?>components/gs_theme/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.form.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/forms/jquery.maskedinput.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>components/orb/js/vendors/jquery-steps/jquery.steps.min.js"></script>


<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/custom.js"></script>

</body>
</html>

<script type="text/javascript">
$('#IssuaceListing').dataTable({
	  "bLengthChange": false,
	  "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
  	"aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
    "iDisplayLength": 20
  });
$('#SubmissionFormListing').dataTable({
	  "bLengthChange": false,
	  "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ],
  	"aLengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
    "iDisplayLength": 20
  });



</script>