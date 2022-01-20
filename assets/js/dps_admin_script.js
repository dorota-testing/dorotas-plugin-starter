jQuery(document).ready(function($){
// media uploader
  var mediaUploader;

  $('.dps_upload-button').click(function(e) {
	//Get data attribute
    e.preventDefault();

    // If the uploader object has already been created, reopen the dialog
      if (mediaUploader) {
      mediaUploader.open();
      return;
    }	
    // Extend the wp.media object
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
      text: 'Choose Image'
    }, multiple: false });
	

    // When a file is selected, grab the URL and set it as the text field's value
    mediaUploader.on('select', function() {
      attachment = mediaUploader.state().get('selection').first().toJSON();
//	  console.log(attachment);
	  $('.dps_upload-button:focus').prev().val(attachment.id);
	  $('.dps_upload-button:focus').next().val(attachment.url);
	  $('.dps_upload-button:focus').parents('.dps_row_wrap').find('img').attr("src", attachment.url);	  

    });
    // Open the uploader dialog
    mediaUploader.open();
  });
  $('.dps_deleteIcon').click(function() {
//	alert('lorem');
	var placeholder = $(this).attr("data-placeholder");
	
	  $(this).parents('.dps_row_wrap').find('.image-id').val('');
	  $(this).parents('.dps_row_wrap').find('img').attr("src", placeholder);
//	  $('#image-url').val('');
//      $('#image-preview').attr("src", placeholder);

  });

});