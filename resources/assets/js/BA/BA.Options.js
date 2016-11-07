BA.Options = {
    wysiwyg: {
        selector: 'textarea.wysiwyg',
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager code textcolor colorpicker",
        ],
        toolbar1: 'insertfile undo redo | bold italic underline | forecolor backcolor',
        toolbar2:'',
        menubar: false,
        image_advtab: true ,
        relative_urls: false,

        external_filemanager_path:"/filemanager/",
        filemanager_title: "Filemanager" ,
        external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
    },

    wysiwyg1: {
        selector: 'textarea.wysiwyg-admin',
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
        ],
        toolbar1: "| undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist ",
        toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | code ",
        menubar: false,
        image_advtab: true ,
        relative_urls: false,

        external_filemanager_path:"/filemanager/",
        extended_valid_elements:'script[language|type|src]',
        filemanager_title:"Filemanager" ,
        external_plugins: { "filemanager" : "/filemanager/plugin.min.js"}
    }
};