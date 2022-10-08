import '../styles/admin.scss';

var _ = jQuery;
_(document).ready( function () {
    _('#slideshow_images').on('change', function(e){
        var files = e.target.files.length;
        for (var i=0;i<files;i++) {
            _('#slides').append("<img class='slides' width='100' height='100' src='"+URL.createObjectURL(e.target.files[i])+"'>");
        }
    })
});
