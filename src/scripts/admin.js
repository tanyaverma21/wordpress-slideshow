import '../styles/admin.scss';

var _ = jQuery;
/**
 * Main Document Ready method.
 * Encapsulates all other JQuery Objects and Handlers.
 * @since 1.0
 */ 
_(document).ready( function () {
  /**
   * Onchange event handler for input type 'file'.
   * Handles multiple images upload.
   * @since 1.0
   */ 
  _('#slideshow_images').on('change', function(e){
    var files = e.target.files.length;
    for (var i=0;i<files;i++) {
        _('#slides').append("<li class='image-slide'><img class='slides' width='100' height='100' src='"+URL.createObjectURL(e.target.files[i])+"'><a class='delete-image' href='javascript:void(0)'><span class='dashicons dashicons-dismiss'></span></a></li>");
    }
  });

  /**
   * Onclick event handler for delete images button.
   * Handles multiple images deletion.
   * @since 1.0
   */ 
  _('a.delete-image').on('click', function() {
    _('<input type="hidden" class="image_ids" name="image_ids[]" value="'+_(this).prev().attr('src')+'" />').insertAfter(_(this));
    _(this).prev().remove();
    _(this).remove();
  });

  /**
   * Adds sortable ui interface.
   * Handles multiple images sorting.
   * @since 1.0
   */ 
  _('#slides').sortable();
});
