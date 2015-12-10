<?php 
$path = plugin_dir_url( dirname(__FILE__) ).'download.php/';
?>

<style type="text/css">
.webtechdevpro-photos-view{
	background: none repeat scroll 0 0 #f5f5f5;
	border: none;
}
.webtechdevpro-photos-view td, .webtechdevpro-photos-view tr{
	border: none;
}
.webtechdevpro-photos-view td a{
	margin-left: 10px;
}
</style>

<table class="webtechdevpro-photos-view" cellpadding="0" cellspacing="0">

<?php foreach ($images as $type => $sizes) { ?>
<tr>
	<td style="padding-left: 20px;">
		<strong><?php echo $type; ?></strong>
	</td>
	<td>:
		<?php foreach ($sizes as $obj) { ?>
			<a href="<?php echo $path.$obj->picture; ?>"><?php echo $obj->size; ?></a>
		<?php } ?>
	</td>
</tr>
<?php } ?>

</table>