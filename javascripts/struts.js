jQuery(document).ready(function($) {
  jQuery('.struts-image-upload').click(function() {
    formfield = jQuery(this).attr('data-field-id');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
    return false;
  });

  window.original_send_to_editor = window.send_to_editor;
  window.send_to_editor = function(html) {
    if(formfield) {
      source = jQuery(html).find('img').attr('src');
      jQuery('#'+formfield).val(source);
      tb_remove();
      jQuery('#'+formfield+'-preview').html('<img src="' + source + '">');
    }else{
      window.original_send_to_editor(html);
    }
  }
});