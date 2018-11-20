
<?php foreach ($slot as  $slots) {
    ?>
  <option value="<?= $slots['slot_id'] ?>"><?= date('h:i A',strtotime($slots['time_start'])) ?></option>
<?php } ?>