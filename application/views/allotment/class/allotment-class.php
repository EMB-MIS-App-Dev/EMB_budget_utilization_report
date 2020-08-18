<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class='successmsg'>
        <?php if($this->session->flashdata('successmsg')): ?> 
            <p><?php echo $this->session->flashdata('successmsg'); ?></p>
        <?php endif; ?>
    </div>

    <div>
        <a class="btn btn-primary create-btn" href="<?php echo base_url(); ?>allotment">Back</a>
    </div>
    <table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <div class="col-sm-4" >
        <thead>
            <tr>
                <th scope="col">PAP</th>
                <th scope="col">Sub-PAP</th>
                <th scope="col">Class</th>
                <th scope="col">Amount</th>
                <th scope="col">Action</th>
            </tr>
		</thead>
        <tbody> 
            <?php foreach($allotment_class as $ac) : ?>
                <tr class="table-active"> 
                    <td><?php echo $ac['mp_code']; ?> - <?php echo $ac['mp_name']; ?></td>
                    <td><?php echo $ac['sp_code']; ?> - <?php echo $ac['sp_name']; ?></td>
                    <td><?php echo strtoupper($ac['cl_name']); ?></td>
                    <td>
                    <!-- dynamic add field -->
                        <input type="number" step="0.01" class="form-control" name="cl_amount" value="<?php echo $ac['cl_amount']; ?>">
                    </td>
                    <td>
                        <a class="btn btn-success" href="saa/<?php echo $ac['id'] ?>">Add SAA</a>
                        <a class="btn btn-danger" onclick="return confirm('Press OK to confirm delete PAP?')" href="allotment/delete/<?php echo $ac['id'] ?>">Delete</a>
                    </td>
            </tr>   
            <?php endforeach; ?>
           
        </tbody>
    </table>
   
    </div>
<!-- /.content-wrapper -->

