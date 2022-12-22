<div class="col-md-12">
<div class="user-meta">
<?php
if(function_exists("the_field")):
// GET Current User
// $arfa_current_user = "user_".get_the_author_meta("ID");
$arfa_facebook = get_field('facebook');
$arfa_twitter = get_field('twitter');
?>
<h3>
<?php _e('Facebook: ','arfa'); ?>
<?php echo $arfa_facebook; ?>
<br />
<?php _e('Twitter: ','arfa'); ?>
<?php echo $arfa_twitter; ?>
</h3>
<?php
endif;
?>
</div>
</div>