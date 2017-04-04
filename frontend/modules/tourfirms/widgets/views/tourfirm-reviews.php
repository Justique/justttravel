<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>


<style>
    .img_button_upload{
        display:none!important;
    }
    .button {
        display: inline-block;
    }

</style>
<script>
    $(document).ready(function(){
        $('#load1').click(function() {
            $('.img_button_upload .upload-kit-item .remove').click();
            $('#w0').click();
        });
    });
</script>
<?php
if(!user()->id){ ?>
<a href="/tourfirm/createreviews" class="button yellow login">оставить отзыв</a>

 <?php }else{ ?>
<a href="/tourfirms/isvotestourfirm?tourfirm_id=<?php echo $id ?>" class="button yellow ajax-link report-trigger">оставить отзыв</a>
<?php }?>

