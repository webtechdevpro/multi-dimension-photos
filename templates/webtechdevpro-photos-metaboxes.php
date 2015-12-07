<?php
	$sizes = $this->getSizes();
	$data = $this->getPostMeta();

?>

<table style="width: 100%;">
<tr><td>Photo: </td><td><input type="button" name="webtechdevpro_upload"/ value="Upload"></td></tr>
<tr><td colspan="2"><strong>Sizes:</strong></td></tr>

<?php foreach ($sizes as $size) { ?>
	<tr><td><?php echo $size; ?> </td><td><input <?php echo (isset($data[self::POST_TYPE.'_'.$size])? 'checked="checked"': ''); ?> type="checkbox" name="<?php echo self::POST_TYPE; ?>[]" value="<?php echo $size;?>"/></td></tr>
<?php } ?>

</table>



