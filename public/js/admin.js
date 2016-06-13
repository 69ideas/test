var BA = {

};
BA.Actions = {

    init: function (context) {
        $('.carusel-remove-row', context).click(BA.Events.CaruselDeleteRow).change();
        $('.carusel-add-row', context).click(BA.Events.CaruselAddRow).change();

        $('input[name="resource_type"]').change(BA.Events.ResourceTypeChanged);

        $('input[name="resource_type"]:checked').change();
        $('.related-type', context).change(BA.Events.RelatedType);
        $('.related-type', context).change();

        console.log($('.related-category', context));
        $('.related-category', context).change(BA.Events.RelatedCategory);
        $('.related-product', context).change(BA.Events.RelatedProduct);
        $('.related-location', context).change(BA.Events.RelatedLocation);


        tinymce.init(BA.Options.wysiwyg);

        log('GCA inited on');
        log(context);
    },
};
BA.Bindings = {

};
BA.Events = {

    AddBlockContentClick: function (e) {
        $.get($(this).prop('href') + '/' + $('.media').length, null, BA.Events.NewBlockContentResponse, 'json');

        e.preventDefault();
    },

    CityChanged: function () {
        if ($(this).val() == '')
            $('.new_city').slideDown();
        else
            $('.new_city').slideUp();

    },
    RelatedType: function(e)
    {
        $('#data_holder_type').slideUp();
        //$(this).val() - значение из селекта
        $.get('/admin/type?related=' + $(this).val(), null, function(data){

            var content = $(data.content);
            BA.Actions.init(content);
            $('#data_holder_type').slideDown().html('').append(content);
            console.log(data.data);
            console.log(data);
        }, 'json');
    },
    RelatedCategory: function(e)
    {
        //$(this).val() - значение из селекта
        if($(this).val() != '')
            location.href=$(this).data('url')+'/' + $(this).val();
    },
    RelatedProduct: function(e)
    {
        //$(this).val() - значение из селекта
        if($(this).val() != '')
            location.href='/gallery/manufacturer/' + $(this).val();
    },
    RelatedLocation: function(e)
    {
        //$(this).val() - значение из селекта
        if($(this).val() != '')
            location.href='/gallery/location/' + $(this).val();
    },

    MoveUpBlockClick: function (e) {
        var block = $(this).parents('.media');
        var line_block = block.prev();
        var next_block = line_block.prev();

        if (next_block.hasClass('media')) {
            next_block.prev().after(block);
            block.after(line_block);
        }

        BA.Actions.RebuildUIBlocks();
        e.preventDefault();

    },

    MoveDownBlockClick: function (e) {
        var block = $(this).parents('.media');
        var line_block = block.next();
        var next_block = line_block.next();

        if (next_block.hasClass('media')) {
            next_block.next().after(block);
            block.after(line_block);
        }

        BA.Actions.RebuildUIBlocks();
        e.preventDefault();
    },

    DeleteBlockClick: function (e) {
        $(this).parents('.media').slideUp('slow', function () {
            $(this).prev().remove();
            $(this).remove();

            BA.Actions.RebuildUIBlocks();

        });

        e.preventDefault();
    },

    DeletePhotoClick: function (e) {
        $.get($(this).prop('href'), null);
        $(this).parent().find('img').remove();
        $(this).remove();

        e.preventDefault();
    },

    UploadPhotoClick: function (e) {
        $(this).parent().find('input').click();
        e.preventDefault();
    },

    NewBlockContentResponse: function (data) {
        if (data.status == 'ok') {
            var content = $(data.content);
            BA.Actions.init(content);

            var last_item = $('.media').last();

            if (last_item.length > 0) {
                last_item.after(content);
                last_item.after('<hr />');
            }
            else {
                last_item = $('hr.limiter')
                last_item.before('<hr />');
                last_item.after(content);
            }

            BA.Actions.RebuildUIBlocks();
        }
    },

    ResourceTypeChanged: function () {
        var type = $(this).val();
        var image_field_holder = $('.media_upload_image');
        var youtube_link_holder = $('.media_youtube_link');

        if (type == 'image') {
            image_field_holder.show();
            youtube_link_holder.hide()
        }
        else {
            image_field_holder.hide();
            youtube_link_holder.show();
        }
    },

    CaruselDeleteRow: function (e)
    {
        e.preventDefault();

        $(this).parents('tr').remove();
    },

    CaruselAddRow: function (e)
    {
        console.log($(this).prop('href'));
        $.get($(this).prop('href') + '/' + ($('table.carusel-rows tr').length - 1), null, BA.Events.NewCaruselRowResponse, 'json');
        e.preventDefault();

    },

    NewCaruselRowResponse: function(data)
    {
        if(data.status == 'ok')
        {
            var content = $(data.content);
            BA.Actions.init(content);

            $('table.carusel-rows').append(content);


        }
    }
};
BA.Options = {
    wysiwyg: {
        selector: 'textarea.wysiwyg',
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
        ],
        toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
        menubar: false,
        image_advtab: true ,
        relative_urls: false,

        external_filemanager_path:"/filemanager/",
        filemanager_title:"Filemanager" ,
        external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
    }
};
var DEBUG = true;
function log(msg) {
    if (DEBUG)
        console.log(msg);
}

$(function () {
    BA.Actions.init($('body'))
    jQuery(".image-box").colorbox({width: "75%", height: "75%"});

});
//# sourceMappingURL=admin.js.map
