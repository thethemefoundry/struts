jQuery(document).ready(function($) {
  // Image Upload Option
  jQuery('.struts-image-upload').click(function() {
    formfield = jQuery(this).attr('data-field-id');
    tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
    return false;
  });

  // Handles sending the image from the media uploader screen to the input field (for images)
  window.original_send_to_editor = window.send_to_editor;
  window.send_to_editor = function(html) {
    if(formfield) {
      source = jQuery(html).find('img').attr('src');
      jQuery('#'+formfield).val(source);
      tb_remove();
    }else{
      window.original_send_to_editor(html);
    }
  }

  // Color Chooser Option
  jQuery('.struts-color-chooser').each(function() {
    jQuery(this).farbtastic('#' + jQuery(this).attr('data-field-id'));
  });

  // hides as soon as the DOM is ready
  jQuery( 'div.struts-section-body' ).hide();
  // shows on clicking the noted link
  jQuery( 'div.struts-section h3' ).click(function() {
    jQuery(this).toggleClass("open");
    jQuery(this).next("div").toggle();
    return false;
  });

  jQuery('.struts-color-chooser').hide();
  jQuery( '.struts-color-chooser-toggle' ).click(function() {
    var colorchooser = jQuery(this).parent().next();

    colorchooser.toggle();

    if (colorchooser.is(':visible')) {
      jQuery(this).text('hide color picker');
    } else {
      jQuery(this).text('show color picker');
    }
    return false;
  });


  /**
   * Option Section Display
   *
   * Display an options section if the section param
   * is passed via a query string in the url.
   *
   * Example: <php get_admin_url() . 'themes.php?page=yourtheme_options&section=logo_section'
   */
	var section_id = getParameterByName('section');

	if( section_id ) {
		var section_id = '#' + section_id;
		jQuery('h3', section_id).addClass('open');
		jQuery('.struts-section-body', section_id).css('display','block');
	}

	function getParameterByName(name) {
	  name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	  var regexS = "[\\?&]" + name + "=([^&#]*)";
	  var regex = new RegExp(regexS);
	  var results = regex.exec(window.location.search);
	  if(results == null)
	    return "";
	  else
	    return decodeURIComponent(results[1].replace(/\+/g, " "));
	}

});