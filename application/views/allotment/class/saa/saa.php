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
            </div>

        </div>
    </div>
    
    <div class="create">
        <a class="btn btn-success create-btn" href="create/<?php echo $class_id; ?>">New</a>
    </div>
    <table id="myTableAll" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    
    <div class="col-sm-4" >
        <thead>
            <tr>
                <th scope="col">PAP</th>
                <th scope="col">Name</th>
                <th scope="col">Month</th>
                <th scope="col">Amount</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody> 
            <?php foreach($saa as $sa) : ?>
                <div class="col-sm-12">
                    <input type="hidden" name="allotment_id" value="<?php echo $ac['cl_allotment_id']; ?>">
                </div>
                <tr class="table-active"> 
                    <td><?php echo $ac['mp_code']; ?> - <?php echo $ac['mp_name']; ?></td>
                    <td><?php echo $ac['sp_code']; ?> - <?php echo $ac['sp_name']; ?></td>
                    <td><?php echo strtoupper($ac['cl_name']); ?></td>
                    <td>
                    <!-- dynamic add field -->
                        <?php 
                            $cl_id = $ac['cl_id']; 
                        ?>
                        <input type="hidden" name="cl_id" value="<?php echo $cl_id; ?>">
                        <input type="number" step="0.01" class="form-control" name="cl-amount-<?php echo $cl_id ?>" value="<?php echo $ac['cl_amount']; ?>">
                    </td>
                    <td>
                        <a class="btn btn-success" href="saa/<?php echo $ac['cl_id'] ?>">Add SAA</a>
                        <a class="btn btn-danger" onclick="return confirm('Press OK to confirm delete PAP?')" href="allotment/delete/<?php echo $ac['id'] ?>">Delete</a>
                    </td>
            </tr>   
            <?php endforeach; ?>
        
        </tbody>
    </table>
   
</div>
<!-- /.content-wrapper -->

