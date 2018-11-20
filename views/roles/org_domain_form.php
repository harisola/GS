
<div class='col-md-4'>
	<div class='powerwidget dark-red'  data-widget-editbutton="false" data-widget-deletebutton="false" >
		<header>
			<h2>Roles<small>Org Domain</small></h2>
		</header>
		<div class='inner-spacer'>
			<div class='callout callout-danger' id = 'error' style="display: none;"></div>

			<div class='callout callout-info' id='update_msg' style="display: none">
				<p>Data Update Successfully</p>
			</div>

			<div class='callout callout-danger' id='notupdate_msg' style="display: none">
				<p>Must Contain Unique Value</p>
			</div>

			<div class="callout callout-info" id='insert-msg' style="display: none">
				<p>Data Insert Successfully</p>
			</div>

			<form action='' method='POST' id='insert-role' class='orb-form'>
				<header>Roles Registration Form </header>
				<fieldset>

				<section>
					<label class="input">
						<i class="icon-append fa fa-asterisk"></i>
						<input type="text" placeholder="Enter the Name" name="name" id="name"/>
						<b class="tooltip tooltip-bottom-right">Enter the Name</b>
					</label>
				</section>

				<section>
					<label class="input">
						<i class='icon-append fa fa-asterisk'></i>
						<input type="text" placeholder="Enter the Display Name" name="dname" id="dname"/>
						<b class='tooltip tooltip-bottom-right'>Enter the Display Name</b>
					</label>
				</section>

				<section>
					<label class="input">
						<i class='icon-append fa fa-asterisk'></i>
						<input type="text" placeholder="Enter the Short Name" name="sname" id="sname"/>
						<b class='tooltip tooltip-bottom-right'>Enter the Short Name</b>
					</label>
				</section>

				<section>
					<label class="input">
						<i class="icon-append fa fa-asterisk"></i>
						<input type="text" placeholder="Enter the Code" name="code" id="code"/>
						<b class="tooltip tooltip-bottom-right">Enter the Code</b>
					</label>
				</section>

				</fieldset>

				<fieldset>
				<section>
					<label class='label'>Position</label>
					<label class='select'>
						<select name="position" id="position">
							<option value="" selected disabled>Choose Position</option>
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
						</select><i></i>
					</label>
				</section>
				</fieldset>

				<section>
					<label class="label">Color</label>
					<label class="input">
						<input type="text"  class="jscolor form-control" name='color' id="color" />
					</label>
				</section>
					
				<footer>
					<input type='Submit' value='Save' class="btn btn-primary">
					<input type='reset'  class="btn btn-primary" style="float: right;">
				</footer>	 
					
					
			</form>
		</div>
	</div>
</div>



<div class="col-md-8">
	<div class='powerwidget blue dark-blue' data-widget-editbutton="false" data-widget-deletebutton="false">
		<header>
			<h2>Domain<small>Organization</small></h2>
		</header>
		<div class="inner-spacer">
			<table class="table table-striped table-bordered table-hover" id="view_table">
				<thead>
					<tr>
						<th class="centered-cell">S.No</th>
						<th class="centered-cell">Name</th>
						<th class="centered-cell">Display Name</th>
						<th class="centered-cell">Short Name</th>
						<th class="centered-cell">Code</th>
						<th class="centered-cell">Position</th>
						<th class="centered-cell">Color</th>

					</tr>
				</thead>
				<tbody>
					<?php if(!empty($org_domain)) { ?>
						<?php foreach ($org_domain as  $value) { ?>
					<tr>
						<td class="centered-cell"><?php echo $value->id; ?></td>
						<td class="centered-cell aneditable_org_name"><a href="#" data-type="text" data-name="name" data-pk="<?php echo $value->id;?>" data-placement="top"><?php echo $value->name; ?></td>

						<td class="centered-cell aneditable_org_dname"><a href="#" data-type="text" data-name="dname" data-pk="<?php echo $value->id;?>" data-placement="top"><?php echo $value->dname; ?></td>

						<td class="centered-cell aneditable_org_sname"><a href="#" data-type="text" data-name="sname" data-pk="<?php echo $value->id;?>" data-placement="top"><?php echo $value->sname; ?></td>

						<td class="centered-cell aneditable_org_code"><a href="#" data-type="text" data-name="code" data-pk="<?php echo $value->id;?>" data-placement="top"><?php echo $value->code; ?></td>

						<td class="centered-cell aneditable_org_position"><a href="#" data-type="text" data-name="position" data-pk="<?php echo $value->id;?>" data-placement="top"><?php echo $value->position; ?></td>

						<td class="aneditable_org_color"><input type="text" class="form-control jscolor" value="<?php echo $value->color_hex;?>" id="<?php echo $value->id; ?>" style="width: 90px;"></td>

						


					</tr>
						<?php } ?>
					<?php } else  { ?>
						<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						
						</tr>
					<?php }?>
				</tbody>
				<tfoot>
					<tr>
						
						<th><input type="text" name="filter_game_name" placeholder="Filter S.No Name" class="search_init" /></th>
						<th><input type="text" name="filter_game_name" placeholder="Filter  Name" class="search_init" /></th>
						<th><input type="text" name="filter_game_name" placeholder="Filter Display Name" class="search_init" /></th>
						<th><input type="text" name="filter_game_name" placeholder="Filter Short Name" class="search_init" /></th>
						<th><input type="text" name="filter_game_name" placeholder="Filter Code" class="search_init" /></th>
						<th><input type="text" name="filter_game_name" placeholder="Filter Position" class="search_init" /></th>
						<th><input type="text" name="filter_game_name" placeholder="Filter Color" class="search_init" /></th>


					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>