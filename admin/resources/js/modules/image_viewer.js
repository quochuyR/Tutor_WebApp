export function image_viewer(images_class) {

	


	jQuery(images_class).on('click', (e) => {
			jQuery("#full-image").attr("src", e.target.src);
			jQuery('#image-viewer').show();
			console.log(e.target)
		
	})

	jQuery("#image-viewer .close").on('click', (e) => {
		jQuery('#image-viewer').hide();
	});

}

export function remove_eventListener({ event, selector }) {

	
	jQuery(selector).off();

}
// module.exports = { image_viewer }