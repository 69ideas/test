BA.Actions = {

    init: function (context) {
        $('.carusel-remove-row', context).click(BA.Events.CaruselDeleteRow).change();
        $('.carusel-add-row', context).click(BA.Events.CaruselAddRow).change();

        $('input[name="resource_type"]').change(BA.Events.ResourceTypeChanged);

        $('input[name="resource_type"]:checked').change();
        $('.related-type', context).change(BA.Events.RelatedType);
        $('.related-type', context).change();

        console.log($('.related-name', context));
        $('.related-name', context).change(BA.Events.RelatedName);
        $('.related-name', context).change();
        $(".add-participant", context).click(BA.Events.TabContentManage);
        $(".edit-participant", context).click(BA.Events.TabContentManage);
        $(".make-payment", context).click(BA.Events.TabContentManage);
        $('.related-payment', context).keyup(BA.Events.RelatedPayment);
        $('.related-payment', context).keyup();

        $('.another_entry', context).change(BA.Events.AnotherEntry);


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