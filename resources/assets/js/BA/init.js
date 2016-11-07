var DEBUG = true;
function log(msg) {
    if (DEBUG)
        console.log(msg);
}

$(function () {
    BA.Actions.init($('body'))
});
tinymce.init(BA.Options.wysiwyg);
tinymce.init(BA.Options.wysiwyg1);
