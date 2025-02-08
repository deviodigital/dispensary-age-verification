jQuery(document).ready(function ($) {
    $('.dav-upload-image').click(function (e) {
        e.preventDefault();
        let button = $(this);
        let field = button.prev('.dav-image-field');
        
        let frame = wp.media({
            title: 'Select or Upload Image',
            library: { type: 'image' },
            button: { text: 'Use this image' },
            multiple: false
        });

        frame.on('select', function () {
            let attachment = frame.state().get('selection').first().toJSON();
            field.val(attachment.url);
        });

        frame.open();
    });
});
