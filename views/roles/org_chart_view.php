<link href="<?php echo base_url(); ?>components/primitive/css/bporgeditor.latest.css" rel='stylesheet' />
<link href="<?php echo base_url(); ?>components/primitive/css/primitives.latest.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>components/primitive/css/jquery-ui-1.10.2.custom.css" rel="stylesheet" />



<script type="text/javascript" src="<?php echo base_url(); ?>components/primitive/js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>components/primitive/js/jquery-ui-1.10.2.custom.min.js"></script>
<!-- <script type="text/javascript" src="js/bporgeditor.latest.js"></script>
<script type="text/javascript" src="js/bporgeditor.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>components/primitive/js/primitives.latest.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>components/primitive/js/primitives.min.js"></script>

 <!-- <input id="buttonUnselect" type="button" value="Unselect" class="btn btn-primary" /> -->
 <input id="buttonUnselect" type="button" value="Unselect" class="btn btn-primary" />
<div id="basicdiagram" style="width: 100%; height: 2000px; border-style: dotted; border-width: 1px;"></div>


	


		
	  


   
<script type="text/javascript">

  $(window).load(function(){

    var options = new primitives.orgdiagram.Config();

    jQuery('#basicdiagram').orgDiagram({
      items: [
                    /* JSON noname objects equivalent to primitives.orgdiagram.ItemConfig */


              <?php foreach($all_roles as $role) { ?>

                <?php  
                  $ImageName = base_url() . $this->data['staff_150_photo_path'] . $role['employee_id'] . $this->data['photo_file'];
                  $ImageMale = base_url() . $this->data['staff_150_photo_path'] . "male.png";
                  $ImageFemale = base_url() . $this->data['staff_150_photo_path'] . "female.png";
                  $ImageFound = "Yes";

                  if (!file_exists($this->data['staff_150_photo_path'] . $role['employee_id'] . $this->data['photo_file'])) {
                      if($role['staff_gender'] == 'M'){
                          $ImageName = $ImageMale;
                      }else if($role['staff_gender'] == 'F'){
                          $ImageName = $ImageFemale;
                      }

                      $ImageFound = "No";
                  }
                ?>

                  { 
                    id: <?php echo $role['id']; ?>,
                    parent: <?php if($role['pm_report_to'] == 0 )
                    {
                     echo 'null';
                    }
                    else{
                     echo $role['pm_report_to'];
                    }

                    ?>,
                    title: "<?php echo $role['gp_id'] ?>", 
                    description: "<?php echo $role['abridged_name'].'\n'. $role['role_title_tl'] .'\n'. $role['role_title_bl'] ?>",
                    groupTitle:"<?php echo $role['role_title_bl'] ?>",
                    image:"<?php echo $ImageName; ?>",
                    itemTitleColor:"#ff0000",
                    groupTitleColor:"#bc9898",
                    secondary_reporting:"<?php echo $role['sc_report_to'] ?>"
                     },

                    <?php } ?>
                    
            ],

            cursorItem: 0,
            hasSelectorCheckbox: primitives.common.Enabled.False,
            onMouseClick:cursor1,
            arrowsDirection :primitives.common.GroupByType.Children,
    });

    function cursor1(e,data){
      var id = data.context.id;
      var secondary_report = data.context.secondary_reporting;
      var annotations = jQuery("#basicdiagram").orgDiagram("option", "annotations");

      annotations.push(new primitives.orgdiagram.ConnectorAnnotationConfig({
              fromItem: id,
              toItem: secondary_report,
              label: "Secondary Reporting",
              labelSize: new primitives.common.Size(80, 30),
              connectorShapeType: primitives.common.ConnectorShapeType.OneWay,
              color: primitives.common.Colors.Green,
              offset: 0,
              lineWidth: 2,
              lineType: primitives.common.LineType.Dashed,
              selectItems: false
          }));

    }



  });




 jQuery("#buttonUnselect").click(function (e) {
    var annotations = jQuery("#basicdiagram").orgDiagram({
    annotations:[
      {


      }
      ]

    });
        
      //jQuery("#basicdiagram").orgDiagram({annotations:annotations});

      jQuery("#basicdiagram").orgDiagram("update", primitives.orgdiagram.UpdateMode.Refresh);

      });

</script>