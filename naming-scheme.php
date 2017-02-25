<?php include('scheme.php');?>
<script>
	
	function setLastSelected(selected_id){
		document.getElementById('last_selected').value=selected_id;
	}
	
</script>
<form id="scheme-form" class="scheme-selector">
    <input type="hidden" id="last_selected" name="last-selected" value="<?php echo $last_selected; ?>" />
    <input type="text" name="tfield1" id="tfield1" onfocus="setLastSelected('tfield1');" list="tfield1_history" value="<?php echo $tfield1; ?>"/>
    <input type="text" name="tfield2" id="tfield2" onfocus="setLastSelected('tfield2');" list="tfield2_history" value="<?php echo $tfield2; ?>"/>
    <input type="text" name="tfield3" id="tfield3" onfocus="setLastSelected('tfield3');" list="tfield3_history" value="<?php echo $tfield3; ?>"/>
    <input type="text" name="tfield4" id="tfield4" onfocus="setLastSelected('tfield4');" list="tfield4_history" value="<?php echo $tfield4; ?>"/>
    <input type="text" name="tfield5" id="tfield5" onfocus="setLastSelected('tfield5');" list="tfield5_history" value="<?php echo $tfield5; ?>"/>
    <input type="text" name="file_ext" id="file_ext" value="<?php echo $file_ext; ?>"/>
    <input type="submit" id="rename_file" value="Rename" onclick="event.preventDefault();renameFile();" />
    <button id="ignore_file" value="Ignore" onclick="event.preventDefault();ignoreFile();">Ignore</button>
	<datalist id="tfield1_history">
		<?php foreach($tfield1_history as $item){ ?>
		<option value="<?php echo $item;?>">
		<?php } ?>
	</datalist>
	<datalist id="tfield2_history">
		<?php foreach($tfield2_history as $item){ ?>
		<option value="<?php echo $item;?>">
		<?php } ?>
	</datalist>
	<datalist id="tfield3_history">
		<?php foreach($tfield3_history as $item){ ?>
		<option value="<?php echo $item;?>">
		<?php } ?>
	</datalist>
	<datalist id="tfield4_history">
		<?php foreach($tfield4_history as $item){ ?>
		<option value="<?php echo $item;?>">
		<?php } ?>
	</datalist>
	<datalist id="tfield5_history">
		<?php foreach($tfield5_history as $item){ ?>
		<option value="<?php echo $item;?>">
		<?php } ?>
	</datalist>
</form>