<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <div class='successmsg'>
        <?php if($this->session->flashdata('successmsg')): ?> 
            <p><?php echo $this->session->flashdata('successmsg'); ?></p>
        <?php endif; ?>
    </div>
    <div>
        <a class="btn btn-info create-btn" href="allotment/create">Create</a>
    </div>

    <table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <div class="col-sm-4" >
        <thead>
            <tr>
                <th scope="col">Region</th>
                <th scope="col">Year</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
		</thead>
        <tbody> 
            <?php foreach($allotments as $allotment) : ?>
                <tr class="table-active"> 
                    <td><?php echo $allotment['region']; ?></td>
                    <td><?php echo $allotment['year']; ?></td>
                    <td><?php echo $allotment['fund_source']; ?></td>
                    <td><?php 
                    if($allotment['status'] == 1){
                        echo 'Current'; 
                    }elseif ($allotment['status'] == 2){
                        echo 'Continuing'; 
                    }

                    
                    ?></td>
                    <td>
                        <a class="btn btn-primary" href="allotment/class/<?php echo $allotment['id'] ?>">Edit</a>
                        <a class="btn btn-danger" onclick="return confirm('Press OK to confirm delete PAP?')" href="allotment/delete/<?php echo $allotment['id'] ?>">Delete</a>
                    </td>
            </tr>   
            <?php endforeach; ?>
           
        </tbody>
    </table>
   
    </div>
<!-- /.content-wrapper -->

