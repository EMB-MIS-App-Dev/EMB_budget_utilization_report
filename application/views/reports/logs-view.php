<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <table id="myTable" class="table table-striped table-bordered table-sm align">
    <!-- <table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"> -->
    <div class="col-sm-4">
        <button id="btnExport" onclick="fnExcelReport();" class='btn btn-success'>Export Logs</button>
    </div>
        <thead>
            <tr>
                <th scope="col">Action</th>
                <th scope="col">User</th>
                <th scope="col">User Region</th>
                <th scope="col">ID</th>
                <th scope="col">ID #</th>
                <th scope="col">Month</th>
                <th scope="col">Year</th>
                <th scope="col">Timestamp</th>
            </tr>
        </thead>
        <tbody> 
            <?php foreach($logs as $log) : ?>
                <tr class="table-active"> 
                    <td><?php echo $log['log_action']; ?></td>
                    <td><?php echo $log['log_user']; ?></td>
                    <td><?php echo $log['log_region']; ?></td>
                    <td><?php echo $log['log_remarks']; ?></td>
                    <td><?php echo $log['log_data']; ?></td>
                    <td><?php echo $log['log_month']; ?></td>
                    <td><?php echo $log['log_year']; ?></td>
                    <td><?php echo $log['log_date']; ?></td>
            </tr>   
            <?php endforeach; ?>
        
        </tbody>
    </table>
<!-- /.content-wrapper -->

