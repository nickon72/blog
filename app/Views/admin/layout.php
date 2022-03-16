<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Starter</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="/css_admin/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css_admin/font-awesome.min.css">

    <link rel="stylesheet" href="/css_admin/ionicons.min.css">
    <!-- DataTables -->

    <link rel="stylesheet" href="/css_admin/dataTables.bootstrap.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="/css_admin/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css_admin/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="/css_admin/skin-purple.min.css">
    <link rel="stylesheet" href="/css_admin/grid.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

    <?= $this->insert('admin/partials/menu');?>

    <?= $this->section('content');?>

    <?= $this->insert('admin/partials/footer');?>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="/js_admin/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/js_admin/bootstrap.min.js"></script>
<script src="/js_admin/jquery.dataTables.min.js"></script>
<script src="/js_admin/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/js_admin/adminlte.min.js"></script>
<script src="/js_admin/tree_toggle.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
<script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
</script>
<script src="/plugins/ckeditor/ckeditor.js"></script>
<script src="/plugins/ckfinder/ckfinder.js"></script>
<script>
    $(document).ready(function(){
        var editor = CKEDITOR.replaceAll();
        CKFinder.setupCKEditor( editor );
    })

</script>
</body>
</html>