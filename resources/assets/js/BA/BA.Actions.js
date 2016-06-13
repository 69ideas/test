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