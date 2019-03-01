<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="">
    <title>Admin - Khoa Phạm</title>

<base href="{{asset('')}}">
    <!-- Bootstrap Core CSS -->
    <link href="admin_asset/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="admin_asset/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="admin_asset/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="admin_asset/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="admin_asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="admin_asset/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        @include('admin.layout.header')

        <!-- Page Content -->
        @yield('content')
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="admin_asset/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin_asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="admin_asset/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="admin_asset/dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="admin_asset/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="admin_asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="admin_asset/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="admin_asset/ckfinder/ckfinder.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
    <script >
        ClassicEditor
        .create( document.querySelector( '#editor1' ), {
            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            // ckfinder: {
            //  uploadUrl: 'admin_asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            // }
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote','insertTable','mediaEmbed','undo', 'redo'],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                ]
            }
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
        } );

        ClassicEditor
        .create( document.querySelector( '#editor2' ), {
            // toolbar: [ 'heading', '|', 'bold', 'italic', 'link','imageUpload' ]
            // ckfinder: {
            //  uploadUrl: 'admin_asset/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            // }
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote','insertTable','mediaEmbed','undo', 'redo'],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                ]
            }
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
        } );


        
    </script>
    
    <script >
        function openPopup() {
             CKFinder.popup( {
                 chooseFiles: true,
                 onInit: function( finder ) {
                     finder.on( 'files:choose', function( evt ) {
                         var file = evt.data.files.first();
                         document.getElementById( 'url' ).value = file.getUrl();
                         document.getElementById( 'img' ).src = file.getUrl();                         
                     } );
                     finder.on( 'file:choose:resizedImage', function( evt ) {
                         document.getElementById( 'url' ).value = evt.data.resizedUrl;
                     } );
                 }
             } );
         }
 
    </script>
    @yield('script')
    
</body>

</html>
