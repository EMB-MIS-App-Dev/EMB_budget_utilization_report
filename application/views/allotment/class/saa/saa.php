<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class='successmsg'>
        <?php if($this->session->flashdata('successmsg')): ?> 
            <p><?php echo $this->session->flashdata('successmsg'); ?></p>
        <?php endif; ?>
    </div>

    <?php 
        foreach($allotment_class as $ac) : 
            $all_class_id = $ac['cl_allotment_id'];
            $class_id = $ac['cl_id'];
            $class_name = $ac['cl_name'];
            $region = $ac['region'].' - '.$ac['year'];
            $sp_name = $ac['sp_code'].' - '.$ac['sp_name'];
        endforeach;
     ?>

    <div>
        <a class="btn btn-info create-btn" href="<?php echo base_url(); ?>allotment/class/<?php echo $all_class_id; ?>">Back</a>
    </div>
    <div class="form-group-create">
       
        <div class="row">
            <div class="col-sm-12">
            <h3>Department of Environment and Natural Resources</h3>
            <p>Programs/Activities/Projects (P/A/P)/Major Final Output (MFO)</p> 

            <!-- IF USER IS ADMIN -->
            <h5><b>SAA Funding</b></h5>
            <h3>ALLOTMENT</h3>
            <h5><?php echo $region; ?></h5>
            <p><?php echo $sp_name; ?></p>
            <p><b>Class - <?php echo strtoupper($class_name); ?></b></p>
            </div>

        </div>
    </div>
    
    <div class="create">
        <a class="btn btn-info create-btn" href="create/<?php echo $class_id; ?>">Create</a>
    </div>
    <table id="myTableAll" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    
    <div class="col-sm-4" >
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Month</th>
                <th scope="col">Amount</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody> 
            <?php foreach($saa as $sa) : ?>
                <tr class="table-active"> 
                    <td><?php echo $sa['sa_name']; ?></td>
                    <td><?php 
                        $month_num = $sa['sa_month'];
                        echo date("F", mktime(0, 0, 0, $month_num, 10)); 
                    ?></td>
                    <td><?php echo $sa['sa_amount']; ?></td>
                    <td>
                        <a class="btn btn-danger" onclick="return confirm('Press OK to confirm delete SAA?')" href="delete/<?php echo $sa['sa_id'] ?>">Delete</a>
                    </td>
            </tr>   
            <?php endforeach; ?>
        
        </tbody>
    </table>
   
</div>
<!-- /.content-wrapper -->

