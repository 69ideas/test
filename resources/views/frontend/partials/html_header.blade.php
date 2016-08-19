<head>
    <title>Vault_Xchange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/AdminLTE.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">
    <link rel="stylesheet" href="/css/bootstrap.css"/>
    <link rel="stylesheet" href="/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/css/custom.css"/>
    <link rel="stylesheet" href="/css/responsive.css"/>

    <link rel="stylesheet" href="/plugins/jQuery-treegrid/css/jquery.treegrid.css">
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="/plugins/datepicker/datepicker3.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">

    <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>


    <script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="/js/jquery.maskedinput.js" type="text/javascript"></script>
    <script src="/plugins/select2/select2.full.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="/plugins/iCheck/icheck.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".bars").click(function(){
                $("nav ul").toggle();
            });
        });
    </script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
            $('.select2').select2();
            $('.searchable').each(function(){
                if($(this).find('tbody tr:not(.bg-info)').length > 0)
                    $(this).DataTable();
            });
        });

    </script>
    <script>
        $(function () {
            $('[data-toggle="popover"]').popover()
            $('[data-toggle="tooltip"]').tooltip()
        })
        jQuery(function($){
            $("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
            $(".phone").mask("999-999-9999");
            $("#tin").mask("99-9999999");
            $("#ssn").mask("999-99-9999");
        });
    </script>
    <script>
        $(document).ready(function(){
            var waypoint = new Waypoint({
                element: document.getElementById('waypoint'),
                handler: function(direction) {
                    if (Waypoint.viewportWidth()>=1008) {
                        if (direction == "down") {
//                        $('#main-header').css("height", "64px");
                            $('#main-header').addClass('et-fixed-header');
                            $('#et-top-navigation').css("padding-top", "20px")
                        } else {
//                        $('#main-header').css("height", "90px");
                            $('#main-header').removeClass('et-fixed-header');
                            $('#et-top-navigation').css("padding-top", "33px")
                        }
                    }
                },
                offset: 80
            })
        })
    </script>
    <script src="/js/AdminLTE.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="//cdn.tinymce.com/4/jquery.tinymce.min.js"></script>
    <script src="/tinymce/plugins/responsivefilemanager/plugin.min.js" type="text/javascript"></script>

    <script src="/js/admin.js" type="text/javascript"></script>
    <script src="/js/vue-admin.js" type="text/javascript"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/js/jquery.waypoints.min.js"></script>
    <script src="/js/custom.js"></script>
    <script src="/plugins/datepicker/bootstrap-datepicker.js"></script>

</head>