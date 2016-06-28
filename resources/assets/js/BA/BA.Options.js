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