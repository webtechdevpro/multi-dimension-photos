<?php
	$sizes = $this->getSizes();
	$data = $this->getPostMeta();
?>

<table style="width: 100%;">

<tr><td>Photo: </td><td><input type="button" name="webtechdevpro_upload"/ value="Upload"/>
<td>
<img src="<?php echo wp_get_attachment_url( $data['webtechdevpro_image_id'][0] ); ?>" id="webtechdevpro_image_url" style="width: 150px" />
</td>
</td></tr>

<tr><td colspan="3"><strong>Sizes:</strong>
<input type="hidden" name="webtechdevpro_image_id" value="<?php echo isset($data['webtechdevpro_image_id'][0]) ? $data['webtechdevpro_image_id'][0] : ''; ?>"/>
</td></tr>

<?php foreach ($sizes as $type => $item_sizes) { 

		foreach($item_sizes as $size) {
?>
	<tr><td><?php echo '('. $type.') '.$size; ?> </td><td colspan="2"><input <?php echo (isset($data[self::POST_TYPE.'_'.$size])? 'checked="checked"': ''); ?> type="checkbox" name="<?php echo self::POST_TYPE; ?>[<?php echo $size; ?>]" value="<?php echo $type;?>"/></td></tr>
<?php 	} 
	}
?>

</table>



