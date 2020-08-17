<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class='successmsg'>
        <?php if($this->session->flashdata('successmsg')): ?> 
            <p><?php echo $this->session->flashdata('successmsg'); ?></p>
        <?php endif; ?>
    </div>
    <div>
        <a class="btn btn-primary create-btn" href="saa/create">Create</a>
    </div>

    <table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <div class="col-sm-4" >
        <thead>
            <tr>
                <th scope="col">Region</th>
                <th scope="col">Class</th>
                <th scope="col">Name</th>
                <th scope="col">Month</th>
                <th scope="col">Action</th>
            </tr>
		</thead>
        <tbody> 
            <?php foreach($saa as $sa) : ?>
                <tr class="table-active"> 
                    <td><?php echo $sa['region']; ?> - <?php echo $sa['year']; ?></td>
                    <td><?php echo $sa['cl_name']; ?></td>
                    <td><?php echo $sa['sa_name']; ?></td>
                    <td>
                        <?php 
                            $monthNum  = $sa['sa_month'];
                            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                            $monthName = $dateObj->format('F'); // M
                            echo $monthName; 
                        ?>
                    </td>
                    <td>
                        <a class="btn btn-info" href="saa/edit/<?php echo $sa['id'] ?>">Edit</a>
                        <a class="btn btn-danger" onclick="return confirm('Press OK to confirm delete PAP?')" href="saa/delete/<?php echo $sa['id'] ?>">Delete</a>
                    </td>
            </tr>   
            <?php endforeach; ?>
           
        </tbody>
    </table>
   
    </div>
<!-- /.content-wrapper -->

