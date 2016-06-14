var DEBUG = true;
function log(msg) {
    if (DEBUG)
        console.log(msg);
}

$(function () {
    BA.Actions.init($('body'))
    jQuery(".image-box").colorbox({width: "75%", height: "75%"});

});
tinymce.init(BA.Options.wysiwyg);
