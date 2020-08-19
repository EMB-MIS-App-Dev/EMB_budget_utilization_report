
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
        Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
    </div>
    <!-- ./wrapper -->
   
   <!-- DataTable -->
   <script>
     
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#myTable thead tr').clone(true).appendTo( '#myTable thead' );
            $('#myTable thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        
                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        
            var table = $('#myTable').DataTable( {
                orderCellsTop: true,
                fixedHeader: true
            } );
        } );
   </script>

    <!-- DataTable SHOW ALL -->
    <script>
        
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#myTableAll thead tr').clone(true).appendTo( '#myTableAll thead' );
            $('#myTableAll thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        
                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        
            var table = $('#myTableAll').DataTable( {
                orderCellsTop: true,
                fixedHeader: true,
                lengthMenu: [[-1], ["All"]]
            } );
        } );
    </script>

    <!-- expenditure higher than allotment -->
    <script>
    <?php foreach($allotment_class as $ac) : ?>
    $("#cl-amount-<?php echo $ac['cl_id']; ?>").focusout(function (e) {
        
            var from = parseInt($("#cl-allotment-<?php echo $ac['cl_id']; ?>").val());
            var to = parseInt($("#cl-amount-<?php echo $ac['cl_id']; ?>").val());
            if(to > from){
                //alert('Amount must not be higher than allotment! \nPlease check your input!');
                $("#cl-amount-<?php echo $ac['cl_id']; ?>").focus();
            }
            else {
                //submit form
            }
    });
    <?php endforeach; ?>
    </script>

    
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url()."assets/"; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url()."assets/"; ?>dist/js/adminlte.min.js"></script>
        
</body>
</html>
