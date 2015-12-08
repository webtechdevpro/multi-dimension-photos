<?php

class Webtechdevpro_Post_Types {

	const POST_TYPE = "webtechdevpro_photos";
	private $_post_id;

	public function __construct() {

		add_action('init', array(&$this, 'init'));
    	add_action('admin_init', array(&$this, 'admin_init'));
    	add_action('in_admin_footer', array(&$this, 'admin_script'));
    	add_action('admin_enqueue_scripts', array(&$this, 'wp_admin_scripts'));
	}

	public function wp_admin_scripts() {
		//wp_enqueue_script('media-upload');
		//wp_enqueue_script('thickbox');
		//wp_enqueue_style('thickbox');
		wp_enqueue_script('jquery');
		wp_enqueue_media();
	}

	public function init() {
	    
	    $this->create_post_type();
		add_action('save_post', array(&$this, 'save_post'));
	}

	public function create_post_type()
	{
	    register_post_type(self::POST_TYPE,
	        array(
	            'labels' => array(
	                'name' => __(sprintf('%s', ucwords(str_replace("_", " ", self::POST_TYPE)))),
	                'singular_name' => __(ucwords(str_replace("_", " ", self::POST_TYPE)))
	            ),
	            'public' => true,
	            'has_archive' => true,
	            'description' => __("Multidimensional Photos"),
	            'supports' => array(
	                'title'
	            ),
	        )
	    );
	}

	public function add_meta_boxes()
	{
	    add_meta_box( 
	        sprintf('wp_plugin_template_%s_section', self::POST_TYPE),
	        sprintf('%s', ucwords(str_replace("_", " ", self::POST_TYPE))),
	        array(&$this, 'add_inner_meta_boxes'),
	        self::POST_TYPE,
	        'normal',
	        'high'
	    );                  
	}

	public function admin_init()
	{           
	    add_action('add_meta_boxes', array(&$this, 'add_meta_boxes'));
	}

	public function add_inner_meta_boxes($post)
	{   
		$this->_post_id = $post->ID;
	    include(sprintf("%s/../templates/%s-metaboxes.php", dirname(__FILE__), str_replace('_', '-', self::POST_TYPE)));         
	}

	public function getSizes() {

		global $photo_sizes;

		if(empty($photo_sizes))
			return [];

		return $photo_sizes;
	}

	public function getPostMeta() {

		if(!$this->_post_id)
			return [];

		return get_post_meta($this->_post_id);
	}

	public function save_post($post_id)
	{
	    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
	    {
	        return;
	    }

	    if(isset($_POST['post_type']) && $_POST['post_type'] == self::POST_TYPE && current_user_can('edit_post', $post_id) && is_numeric($_POST['webtechdevpro_image_id']))
	    {
	    	$sizes = $this->getSizes();

	    	foreach ($sizes as $type => $item_sizes) { 
		        foreach($item_sizes as $field)
		        {
		        	//echo $field;
		        	//print_r($_POST[self::POST_TYPE]); exit;
		        	if(!in_array($field, array_keys($_POST[self::POST_TYPE])))    
		        		delete_post_meta($post_id, self::POST_TYPE.'_'.$field);
					else
		            	update_post_meta($post_id, self::POST_TYPE.'_'.$field, $type);
		        }
	    	}

	        update_post_meta($post_id, 'webtechdevpro_image_id', $_POST['webtechdevpro_image_id']);
	    }
	}

	public function admin_script() {
?>

<script>
jQuery(function() {
	
	jQuery('input[name="webtechdevpro_upload"]').click(function(e) {
		
		e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            multiple: false
        }).open()
        .on('select', function(e){
            var uploaded_image = image.state().get('selection').first();
            jQuery('input[name="webtechdevpro_image_id"]').val(uploaded_image.id);
            jQuery('#webtechdevpro_image_url').attr('src', uploaded_image.toJSON().url);
        });
	});

	jQuery('#post').click(function(e){
		
		$('#webtechdevpro_error').remove();

		if(!jQuery('input[name="webtechdevpro_image_id"]').val()) {

			jQuery('#webtechdevpro_image_url').after('<span style="color:red;" id="webtechdevpro_error">Please upload image</span>');
			return false;
		}

		return false;
	});
});
</script>

<?php
	}
}