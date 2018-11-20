

<?php 

$Arr_SProfile=array();
$Arr_TTProfile=array();

if(!empty($tt_profile)):
foreach($tt_profile as $TTP):
array_push($Arr_TTProfile,$TTP->id);
endforeach;
endif;
?>
<table width="" class="table table-striped table-hover table-bordered superProfiles">
	<thead>
	<?php if(!empty($super_profile_desc)):?>
		<tr>
		<?php foreach($super_profile_desc as $p):?>
		<th><?=ucwords($p->cat_name);?></th>
		<?php array_push($Arr_SProfile,$p->ID); ?>
		<?php endforeach;?>
		</tr>
	<?php endif;?>
	</thead>
	<tbody>
	<?php for($b=0; $b < sizeof($Arr_TTProfile); $b++ ): ?>
	<tr>
	<?php for($a=0; $a < sizeof($Arr_SProfile); $a++ ): ?>
	<?php 
		$SPLists=$thisCont->Get_STiming( $Arr_SProfile[$a], $Arr_TTProfile[$b]);
		foreach($SPLists as $super_time ): ?>
			<td> 
			<?php /*echo $Arr_SProfile[$a];?>:<?php echo $Arr_TTProfile[$b];  ?> <?php */ ?>
			<a href="#" class="MonIN" data-placement="bottom" data-title="Morning" data-profile_id ="<?php  echo $super_time->profile_id ?>" data-super_profile="<?php echo $super_time->super_profile_id ?>" data-pk="<?php echo $super_time->id ?>" data-type="combodate">
			<?php if( $super_time->mon_in > 0 ): ?>
			<?php echo date("g:i A",strtotime($super_time->mon_in)) ?>
			<?php else: ?>
			00:00
			<?php endif;?>
			</a> - 
			<a href="#" class="MonOUT" data-placement="bottom" data-title="Afternoon" data-profile_id ="<?php  echo $super_time->profile_id ?>" data-super_profile="<?php echo $super_time->super_profile_id ?>" data-pk="<?php echo $super_time->id ?>" data-type="combodate">
			<?php if( $super_time->mon_out > 0 ): ?>
			<?php echo date("g:i A",strtotime($super_time->mon_out)) ?>
			<?php else: ?>
			00:00
			<?php endif;?>
			</a> 
			</td>
		
	<?php endforeach; ?>
	<?php endfor;?>	
	</tr>
	<?php endfor;?>	
	</tbody>
</table>

<script type="text/javascript">
$(document).ready(function() { ActiviteEditableI(); ActiviteEditableO(); });
function ActiviteEditableI(){
	$.fn.editable.defaults.mode = 'popup';     
    $('.MonIN').editable({
			type: 'text',
            format:'h:mm A',
            viewformat:'h:mm A',
            template: 'h:mm a',
            name:'mon_in',
            url:"<?php echo base_url() ?>index.php/tif_a/super_profile_ajax/get_updated_in",
            success: function(e){
                console.log(e)
            }
        });

}


function ActiviteEditableO(){
	    //toggle `popup` / `inline` mode
   $.fn.editable.defaults.mode = 'popup';     
    
 
    $('.MonOUT').editable({
            type: 'text',
            format:'h:mm A',
            viewformat:'h:mm A',
            template: 'h:mm a',
            name:'mon_out',
            url:"<?php echo base_url() ?>index.php/tif_a/super_profile_ajax/get_updated_out",
            success:function(f){
                console.log(f)
            }

        });
}
</script>