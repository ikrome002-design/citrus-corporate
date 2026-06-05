<script>
jQuery(document).ready(function() {

	// Uploading files

	jQuery('#upload_img_button').click(function(event) {
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#img').val(attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});




jQuery('#upload_thumbnail_button').on('click', function( event ){
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#thumbnail').val(attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});


});
</script>







<div class="wrap">
	<div id="lbg_logo">
			<h2>Playlist for slider: <span style="color:#FF0000; font-weight:bold;"><?php echo strip_tags($_SESSION['xname'])?> - ID #<?php echo strip_tags($_SESSION['xid'])?></span> - Add New</h2>
 	</div>

    <form method="POST" enctype="multipart/form-data" id="form-add-playlist-record">
	    <input name="countdownid" type="hidden" value="<?php echo strip_tags($_SESSION['xid'])?>" />
		<table class="wp-list-table widefat fixed pages" cellspacing="0">
		  <tr>
		    <td align="left" valign="middle" width="25%">&nbsp;</td>
		    <td align="left" valign="middle" width="77%"><a href="?page=countdown_with_background_bg_Playlist" style="padding-left:25%;">Back to Playlist</a></td>
		  </tr>
		  <tr>
		    <td colspan="2" align="left" valign="middle">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="right" valign="middle" class="row-title">Set It First</td>
		    <td align="left" valign="top"><input name="setitfirst" type="checkbox" id="setitfirst" value="1" checked="checked" />
		      <label for="setitfirst"></label></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Image </td>
		    <td width="77%" align="left" valign="top"><input name="img" type="text" id="img" size="60" value="<?php echo (array_key_exists('img', $_POST))?strip_tags($_POST['img']):''?>" /> <input name="upload_img_button" type="button" id="upload_img_button" value="Upload Image" />
	        <br />
	        Enter an URL or upload an image<br />
	        <br />
	        Recommended size: width &amp; height of the Slider</td>
		  </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Link For The Image</td>
		    <td align="left" valign="top"><input name="data-link" type="text" size="60" id="data-link" value="<?php echo (array_key_exists('data-link', $_POST))?strip_tags($_POST['data-link']):''?>"/></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Link Target</td>
		    <td align="left" valign="top"><select name="data-target" id="data-target">
              <option value="" <?php echo ((array_key_exists('data-target', $_POST) && $_POST['data-target']=='')?'selected="selected"':'')?>>select...</option>
		      <option value="_blank" <?php echo ((array_key_exists('data-target', $_POST) && $_POST['data-target']=='_blank')?'selected="selected"':'')?>>_blank</option>
		      <option value="_self" <?php echo ((array_key_exists('data-target', $_POST) && $_POST['data-target']=='_self')?'selected="selected"':'')?>>_self</option>

	        </select></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Thumbnail </td>
		    <td width="77%" align="left" valign="top"><input name="thumbnail" type="text" id="thumbnail" size="60" value="<?php echo (array_key_exists('thumbnail', $_POST))?strip_tags($_POST['thumbnail']):''?>" /> <input name="upload_thumbnail_button" type="button" id="upload_thumbnail_button" value="Upload Image" />
	        <br />
	        Enter an URL or upload an image<br />
	        <br />
	        Recommended size for 'bullets' skin: 80px x 80px<br />
Recommended size for 'thumbs' skin: 110px x 65px</td>
		  </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Image Title/Alternative Text</td>
		    <td align="left" valign="top"><input name="alt_text" type="text" size="60" id="alt_text" value="<?php echo (array_key_exists('alt_text', $_POST))?strip_tags($_POST['alt_text']):''?>"/>    </td>
		  </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Video Beneath Image</td>
		    <td align="left" valign="middle"><select name="data-video" id="data-video">
          <option value="_blank" <?php echo ((array_key_exists('data-video', $_POST) && $_POST['data-video']=='false')?'selected="selected"':'')?>>false</option>
		      <option value="_blank" <?php echo ((array_key_exists('data-video', $_POST) && $_POST['data-video']=='true')?'selected="selected"':'')?>>true</option>
	        </select></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">YouTube/Vimeo Iframe</td>
		    <td align="left" valign="top"><textarea name="content" id="content" cols="45" rows="5"><?php echo (array_key_exists('content', $_POST))?strip_tags($_POST['content']):''?></textarea></td>
	      </tr>
		  <tr>
            <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
	      </tr>
		  <tr>
		    <td colspan="2" align="left" valign="middle">&nbsp;</td>
		  </tr>
		  <tr>
		    <td colspan="2" align="center" valign="middle"><input name="Submit" id="Submit" type="submit" class="button-primary" value="Add Record"></td>
		  </tr>
		</table>
  </form>






</div>
