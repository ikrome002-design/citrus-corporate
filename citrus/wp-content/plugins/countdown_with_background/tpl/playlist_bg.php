<div class="wrap">
	<div id="lbg_logo">
			<h2>Playlist Background for countdown: <span style="color:#FF0000; font-weight:bold;"><?php echo strip_tags($_SESSION['xname'])?> - ID #<?php echo strip_tags($_SESSION['xid'])?></span></h2>
 	</div>
  <div id="countdown_with_background_updating_witness"><img src="<?php echo plugins_url('images/ajax-loader.gif', dirname(__FILE__))?>" /> Updating...</div>
  <div id="previewDialog"><iframe id="previewDialogIframe" src="" width="100%" height="600" style="border:0;"></iframe></div>
  
<div style="text-align:center; padding:0px 0px 20px 0px;"><img src="<?php echo plugins_url('images/icons/add_icon.gif', dirname(__FILE__))?>" alt="add" align="absmiddle" /> <a href="?page=countdown_with_background_bg_Playlist&xmlf=add_playlist_record">Add new</a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; <img src="<?php echo plugins_url('images/icons/magnifier.png', dirname(__FILE__))?>" alt="add" align="absmiddle" /> <a href="javascript: void(0);" onclick="showDialogPreview(<?php echo strip_tags($_SESSION['xid'])?>)">Preview CountDown</a></div>
<div style="text-align:left; padding:10px 0px 10px 14px;">#Initial Order</div>


<ul id="countdown_with_background_slider_sortable">
	<?php foreach ( $result as $row ) 
	{
		$row=countdown_with_background_unstrip_array($row); ?>
	<li class="ui-state-default cursor_move" id="<?php echo $row['id']?>">#<?php echo $row['ord']?> ---  <img src="<?php echo $row['img']?>" height="30" align="absmiddle" id="top_image_<?php echo $row['id']?>" /><div class="toogle-btn-closed" id="toogle-btn<?php echo $row['ord']?>" onclick="mytoggle('toggleable<?php echo $row['ord']?>','toogle-btn<?php echo $row['ord']?>');"></div><div class="options"><a href="javascript: void(0);" onclick="countdown_with_background_delete_entire_record_bg(<?php echo $row['id']?>,<?php echo $row['ord']?>);" style="color:#F00;">Delete</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="?page=countdown_with_background_bg_Playlist&amp;id=<?php echo strip_tags($_SESSION['xid'])?>&amp;name=<?php echo strip_tags($_SESSION['xname'])?>&amp;duplicate_id=<?php echo $row['id']?>">Duplicate</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	<div class="toggleable" id="toggleable<?php echo $row['ord']?>">
    <form method="POST" enctype="multipart/form-data" id="form-playlist-countdown_with_background_bg-<?php echo $row['ord']?>">
	    <input name="id" type="hidden" value="<?php echo $row['id']?>" />
        <input name="ord" type="hidden" value="<?php echo $row['ord']?>" />
		<table width="100%" cellspacing="0" class="wp-list-table widefat fixed pages" style="background-color:#FFFFFF;">
		  <tr>
		    <td align="left" valign="middle" width="25%"></td>
		    <td align="left" valign="middle" width="77%"></td>
		  </tr>
		  <tr>
		    <td colspan="2" align="center" valign="middle">&nbsp;</td>
		  </tr>
          <tr>
            <td align="right" valign="top" class="row-title">Image</td>
            <td align="left" valign="middle"><input name="img" type="text" id="img" size="100" value="<?php echo stripslashes($row['img']);?>" />
              <input name="upload_img_button_<?php echo $row['ord']?>" type="button" id="upload_img_button_<?php echo $row['ord']?>" value="Change Image" />
              <br />
              Enter an URL or upload an image<br />
              <br />
              Recommended size: width &amp; height of the slider</td>
            </tr>
          <tr>
        <td align="right" valign="top" class="row-title">&nbsp;</td>
        <td align="left" valign="middle"><img src="<?php echo $row['img']?>" width="300" id="img_<?php echo $row['ord']?>" /></td>
      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Link For The Image</td>
		    <td align="left" valign="top"><input name="data-link" type="text" size="60" id="data-link" value="<?php echo $row['data-link'];?>"/></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Link Target</td>
		    <td align="left" valign="top"><select name="data-target" id="data-target">
              <option value="" <?php echo (($row['data-target']=='')?'selected="selected"':'')?>>select...</option>
		      <option value="_blank" <?php echo (($row['data-target']=='_blank')?'selected="selected"':'')?>>_blank</option>
		      <option value="_self" <?php echo (($row['data-target']=='_self')?'selected="selected"':'')?>>_self</option>
		      
	        </select></td>
	      </tr>
          <tr>
            <td align="right" valign="top" class="row-title">Thumbnail</td>
            <td align="left" valign="middle"><input name="thumbnail" type="text" id="thumbnail" size="100" value="<?php echo stripslashes($row['thumbnail'])?>" />
              <input name="upload_thumbnail_button_countdown_with_background_slider_<?php echo $row['ord']?>" type="button" id="upload_thumbnail_button_countdown_with_background_slider_<?php echo $row['ord']?>" value="Change Thumbnail" />
              <br />
              Enter an URL or upload an image<br />
              <br />
              Recommended size for 'bullets' skin: 80px x 80px<br />
              Recommended size for 'thumbs' skin: 110px x 65px</td>
            </tr>
          <tr>
        <td align="right" valign="top" class="row-title">&nbsp;</td>
        <td align="left" valign="middle"><img src="<?php echo $row['thumbnail']?>" name="thumbnail_<?php echo $row['ord']?>" id="thumbnail_<?php echo $row['ord']?>" /></td>
      </tr>
          <tr>
            <td align="right" valign="top" class="row-title">Image Title/Alternative Text</td>
            <td align="left" valign="top"><input name="alt_text" type="text" size="60" id="alt_text" value="<?php echo stripslashes($row['alt_text']);?>"/></td>
          </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Video Beneath Image</td>
		    <td align="left" valign="middle"><select name="data-video" id="data-video">
		      <option value="false" <?php echo (($row['data-video']=='false')?'selected="selected"':'')?>>false</option>
		      <option value="true" <?php echo (($row['data-video']=='true')?'selected="selected"':'')?>>true</option>
		      </select></td>
		    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">YouTube/Vimeo Iframe</td>
		    <td align="left" valign="top"><textarea name="content" id="content" cols="45" rows="5"><?php echo stripslashes($row['content']);?></textarea></td>
		  </tr>
     
		  <tr>
		    <td colspan="2" align="left" valign="middle">&nbsp;</td>
		  </tr>
		  <tr>
		    <td colspan="2" align="center" valign="middle"><input name="Submit<?php echo $row['ord']?>" id="Submit<?php echo $row['ord']?>" type="submit" class="button-primary" value="Update Playlist Record"></td>
		  </tr>
		</table>
       
            
        </form>
            <div id="ajax-message-<?php echo $row['ord']?>" class="ajax-message"></div>
    </div>
    </li>
	<?php } ?>
</ul>





</div>				