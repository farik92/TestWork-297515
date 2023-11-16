<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';
	require 'inc/nux/class-storefront-nux-starter-content.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */

/**
 * Custom Front-End Product Submission Form
 */

add_shortcode( 'woo_frontend_post', 'woo_frontend_post' );
function woo_frontend_post() {
	woo_save_post_if_submitted();
	?>
	<div id="postbox">
		<form id="new_post" name="new_post" method="post" enctype="multipart/form-data">

			<p>
				<label for="title">Title</label>
				<br/>
				<input type="text" id="title" value="" tabindex="1" size="20" name="title"/>
			</p>

			<p>
				<label for="p_content">Post Content</label>
				<br/>
				<textarea id="p_content" tabindex="3" name="p_content" cols="50" rows="6"></textarea>
			</p>

			<p>
				<label for="cat">Product Category</label>
				<br/>
				<?php wp_dropdown_categories( 'show_option_none=--Product Category--&tab_index=4&taxonomy=product_cat' ); ?>
			</p>

			<p>
				<label for="post_tags">Price</label>
				<br/>
				<input type="text" value="" tabindex="5" size="16" name="post_tags" id="post_tags"/>
			</p>

			<p>
				<label for="post_tags">Thumbnail</label>
				<br/>
				<input type="file" name="thumbnail" id="thumbnail">
			</p>

			<?php wp_nonce_field( 'wps-frontend-post' ); ?>

			<p><input type="submit" value="Publish" tabindex="6" id="submit" name="submit"/></p>

		</form>
	</div>
	<?php
}
function woo_save_post_if_submitted() {

	global $wpdb;
	require_once ABSPATH . 'wp-admin/includes/image.php';
	require_once ABSPATH . 'wp-admin/includes/file.php';
	require_once ABSPATH . 'wp-admin/includes/media.php';

	// Stop running function if form wasn't submitted
	if ( ! isset( $_POST['title'] ) ) {
		return;
	}

	// Check that the nonce was set and valid
	if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'wps-frontend-post' ) ) {
		echo 'Did not save because your form seemed to be invalid. Sorry';

		return;
	}

	// Do some minor form validation to make sure there is content
	if ( strlen( $_POST['title'] ) < 3 ) {
		echo 'Please enter a title. Titles must be at least three characters long.';

		return;
	}

	if ( strlen( $_POST['p_content'] ) < 10 ) {
		echo 'Please enter content more than 10 characters in length';

		return;
	}

	$product = new WC_Product_Simple();

	$product_name = $_POST['title'];
	$product_price = $_POST['post_tags'];
	$product_content = $_POST['p_content'];

	$product->set_name( $product_name ); // product title
	//$product->set_slug( 'medium-size-wizard-hat-in-new-york' );

	$product->set_regular_price( $product_price ); // in current shop currency

	$product->set_short_description( $product_content );
	$attachment_id = media_handle_upload( 'thumbnail', $_POST['post_id'] );

	if ( is_wp_error( $attachment_id ) ) {
		echo 'error media file upload';
	} else {
		$product->set_description( 'Медиафайл: ' . $attachment_id );
		$product->set_image_id( $attachment_id );
		$product->update_meta_data('second_featured_img', $attachment_id);
		$product->update_meta_data('_custom_test', $attachment_id);
	}

	$product->save();
	echo 'Saved your post successfully! :)';
}

/**
 * Custom meta box with image with wordpress native functions
 */
function woo_include_image_uploader_scripts() {
	/*
	 * I recommend to add additional conditions just to not to load the scipts on each page
	 * like:
	 * if ( !in_array('post-new.php','post.php') ) return;
	 */
	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}

	wp_enqueue_script( 'uploaderscript', get_stylesheet_directory_uri() . '/customscript.js', array('jquery'), '1.7', false );
}

add_action( 'admin_enqueue_scripts', 'woo_include_image_uploader_scripts' );

function woo_image_uploader_field( $name, $value = '') {
	$image = ' button">Upload image';
	$image_size = 'full'; // it would be better to use thumbnail size here (150x150 or so)
	$display = 'none'; // display state ot the "Remove image" button

	if( $image_attributes = wp_get_attachment_image_src( $value, $image_size ) ) {

		// $image_attributes[0] - image URL
		// $image_attributes[1] - image width
		// $image_attributes[2] - image height

		$image = '"><img src="' . $image_attributes[0] . '" style="max-width:95%;display:block;" />';
		$display = 'inline-block';

	}

	return '
    <div>
        <a href="#" class="woo_upload_image_button' . $image . '</a>
        <input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />
        <a href="#" class="woo_remove_image_button" style="display:' . $display . '">Remove image</a>
    </div>';
}

add_action( 'admin_menu', 'woo_meta_box_add' );

function woo_meta_box_add() {
	add_meta_box('woodiv', // meta box ID
		'Custom image', // meta box title
		'woo_image_box', // callback function that prints the meta box HTML
		'product', // post type where to add it
		'side', // priority
		'default' ); // position
}

function woo_image_box( $post ) {
	$meta_key = 'second_featured_img';
	echo woo_image_uploader_field( $meta_key, get_post_meta($post->ID, $meta_key, true) );
}

/**
 * Woocommerce native custom fields
 */

add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );
function woo_add_custom_general_fields() {

    woocommerce_wp_text_input(
		array(
			'id' => '_custom_date',
			'type' => 'date',
			'label' => 'Custom date'
		)
	);

	woocommerce_wp_select(
		array(
			'id'      => '_select_product_type',
			'label'   => 'Select product type',
			'options' => array(
				'rare'   => 'Rare',
				'frequent'   => 'Frequent',
				'unusual' => 'Unusual'
			)
		)
	);

	$product = wc_get_product();
	//echo '<pre>';
	//print_r($product->get_data());
	//echo '</pre>';
    ?>
    <div class="product__btns">
        <input type="submit" class="button button-primary button-large" name="save" id="publish" value="Update" form="post">
        <a class="button button-primary button-large" id="cleanFields">Clear</a>
    </div>
    <style>
        .product__btns {
            padding: 10px 0 10px 0;
        }
        .product__btns #cleanFields {
            margin-left: 8px;
            width: 85px;
            text-align: center;
        }
    </style>
    <?php
}

add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );
function woo_add_custom_general_fields_save( $post_id ) {

	// Img Field
	$woocommerce_second_featured_img = $_POST['second_featured_img'];
	if( !empty( $woocommerce_second_featured_img ) )
		update_post_meta( $post_id, 'second_featured_img', esc_attr( $woocommerce_second_featured_img ) );

	// Date Field
	$woocommerce_custom_date = $_POST['_custom_date'];
	if( !empty( $woocommerce_custom_date ) )
		update_post_meta( $post_id, '_custom_date', esc_attr( $woocommerce_custom_date ) );

	// Img Field
	$woocommerce_custom_img = $_POST['_custom_img'];
	if( !empty( $woocommerce_custom_img ) )
		update_post_meta( $post_id, '_custom_img', esc_attr( $woocommerce_custom_img ) );

	// Select
	$woocommerce_select_product_type = $_POST['_select_product_type'];
	if( !empty( $woocommerce_select_product_type ) )
		update_post_meta( $post_id, '_select_product_type', esc_attr( $woocommerce_select_product_type ) );

}