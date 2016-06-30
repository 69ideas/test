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

        $(".add-participant", context).click(BA.Events.TabContentManage);
        $(".edit-participant", context).click(BA.Events.TabContentManage);
        $(".send-email", context).click(BA.Events.TabContentManage);

        console.log($('.datepicker',context));
        $('.datepicker',context).datepicker({
            autoclose: true,
            format: 'mm/dd/yyyy',
            zIndex:100000
        });

        $("form").submit(function(){
            $(this).find('[type="submit"]').prop('disabled', true);
        });
        tinymce.init(BA.Options.wysiwyg);

        log('GCA inited on');
        log(context);
    },
    
    OpenModal: function (title, content) {

        console.log('try to open modal');

        var template = '<div class="modal" tabindex="-1" role="dialog">' +
            '<div class="modal-dialog">' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
            '<h4 class="modal-title"></h4>' +
            '</div>' +
            '<div class="modal-body">' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';


        if (BA.Bindings.CurrentWindow != null)
            BA.Bindings.CurrentWindow.find('.close').click();

        var wnd = $(template);

        wnd.find('.modal-title').html(title);
        wnd.find('.modal-body').append(content);

        $("body").append(wnd);



        wnd.modal('show');
        wnd.on('hidden.bs.modal', BA.Events.ModalClosed);
        wnd.on('hide.bs.modal', BA.Events.ModalClosing);
        BA.Bindings.CurrentWindow = wnd;
    }
};
BA.Bindings = {
    CurrentWindow : null
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
        //$(this).val() - �������� �� �������
        $.get('/admin/type?related=' + $(this).val(), null, function(data){

            var content = $(data.content);
            BA.Actions.init(content);
            $('#data_holder_type').slideDown().html('').append(content);
            console.log(data.data);
            console.log(data);
        }, 'json');
    },
    TabContentManage: function(e)
    {
        e.preventDefault();
        var href = $(this).prop('href');
        $.get(href, null, BA.Events.TabContentManageLoaded, 'json');
    },

    TabContentManageLoaded:function(data)
    {
        if(data.error_code != 0)
        {
            alert('Error happened');
            return ;
        }

        var content = $(data.content);
        BA.Actions.init(content);

        var title = data.title || "";

        BA.Actions.OpenModal(title, content);
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

    }, ModalClosed: function(e) {
        $(this).remove();
        e.preventDefault();
    },

    ModalClosing: function(e) {
        BA.Bindings.CurrentWindow = null;
    },

    SubmitAjaxForm: function(e)
    {
        e.preventDefault();

        var _form = $(this);
        _form.find('.error_desc').remove();
        _form.find('.form-group').removeClass('has-error');

        $.ajax({
            type: "POST",
            url: $(this).prop('action'),
            data: $(this).serialize(),
            success: function(data, status){BA.Events.AjaxFormHandler(data, status, _form)},
            error: function(response, status){BA.Events.AjaxFormHandlerFailed(response, status, _form)},
            dataType: 'json'
        });
    },

    AjaxFormHandler: function(data, status, _form)
    {
        if(data.error_code == 0)
        {
            data = data.data;
            $.get(data.url, null, ERP.Events.TabContentLoaded, 'json');
        }
    },

    TabContentLoaded: function(data, type)
    {
        if(data.error_code == 0)
        {
            data = data.data;
            var tab = $('#tab_' + data.type);
            tab.html('');
            var content = $(data.content);
            BA.Actions.init(content);
            tab.append(content);

            if(BA.Bindings.CurrentWindow != null)
                BA.Bindings.CurrentWindow.find('.close').click();
        }

    },

    AjaxFormHandlerFailed: function(response, status, _form)
    {
        if(response.status == 422)
        {
            for(var i in response.responseJSON)
            {
                var block = _form.find("[name='" + i + "']").parents('.form-group');

                block.addClass('has-error');
                block.append('<p class="help-block error_desc">' + response.responseJSON[i].join('<br/>') + '</p>')
            }
        }
        console.log(response);
    },

    SubmitMainForm: function(e)
    {
        e.preventDefault();

        $('.main_form_'+$(this).data('form')).submit();
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
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager code textcolor colorpicker",
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: "responsivefilemanager | link unlink anchor | image media | forecolor backcolor ",
        menubar: false,
        image_advtab: true ,
        relative_urls: false,

        external_filemanager_path:"/filemanager/",
        filemanager_title: "Filemanager" ,
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
});
tinymce.init(BA.Options.wysiwyg);

//# sourceMappingURL=admin.js.map
