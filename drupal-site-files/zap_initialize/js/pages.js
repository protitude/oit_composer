(function ($) {
  var $cont = $('select#edit-field-oit-page-category');
    $('select#edit-field-oit-page-category option').each(function () {
        if ($(this).text().indexOf('-') !== 0) {
            $('<optGroup/>').attr('label', $(this).text()).appendTo($cont);
            $(this).remove();
        } else {
            $cont.find('optGroup').last().append($(this));
        }
    });
  $("select#edit-field-oit-page-category").select2();
})(jQuery);
