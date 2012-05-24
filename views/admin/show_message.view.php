<div class="show_message">
    <div class="<?php if ($code>0){echo 'show_message_ok';}elseif($code<0){echo 'show_message_error';}else{echo 'show_message_info';}?>">
        <?php echo $msg;?>
    </div>
</div>