<script>
    function getStatus() {
        var flag = $('#activity_checkbox ').attr('value');
        if(flag == 1){
            $('#activity_checkbox').attr("value", 0);
        }else if(flag == 0){
            $('#activity_checkbox').attr('value', 1);
        }
    }
</script>
<?php
if($model->$field) {
    $is_checked= 'checked';
    $is_unchecked= 'unchecked';
    $valueBox = 'checked';


}else {
    $is_unchecked = 'unchecked';
    $is_checked = 'checked';
    $valueBox = '';
}
?>
<input type="hidden" id="activity_checkbox" value="<?= $model->$field ? $model->$field : 0 ?>"  name="<?php echo $name ?>">

<div class="container">
    <input type="checkbox" id="order_activity" <?php echo $valueBox; ?>  name="">
    <label onclick="getStatus()"  id="order_activity_status" for="order_activity"><?php echo $title ?>
        <span class=<?php  echo  $is_unchecked ?>>деактивирована</span>
        <span class=<?php  echo $is_checked  ?>>активна</span>
    </label>
</div>