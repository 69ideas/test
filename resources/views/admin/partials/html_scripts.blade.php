<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/js/AdminLTE.js"></script>

<script src="/plugins/jQuery-treegrid/js/jquery.treegrid.min.js" type="text/javascript"></script>
<script src="/plugins/jQuery-treegrid/js/jquery.treegrid.bootstrap3.js" type="text/javascript"></script>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="//cdn.tinymce.com/4/jquery.tinymce.min.js"></script>
<script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<script src="/tinymce/plugins/responsivefilemanager/plugin.min.js" type="text/javascript"></script>
<script src="/js/admin.js" type="text/javascript"></script>
<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="/js/vue-admin.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $(".bars").click(function(){
            $("nav ul").toggle();
        });

    $('.searchable').each(function(){
        if($(this).find('tbody tr:not(.bg-info)').length > 0)
            $(this).DataTable();
    });
    });
</script>


