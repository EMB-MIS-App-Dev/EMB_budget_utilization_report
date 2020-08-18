<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class='successmsg'>
        <?php if($this->session->flashdata('successmsg')): ?> 
            <p><?php echo $this->session->flashdata('successmsg'); ?></p>
        <?php endif; ?>
    </div>

    <div>
        <a class="btn btn-info create-btn" href="<?php echo base_url(); ?>allotment">Back</a>
    </div>
    <div class="form-group-create">
        <?php foreach($allotment_class as $acs) : 
           $region =  $acs['region']; 
           $year =  $acs['year']; 
           $fs =  $acs['fund_source']; 
        endforeach; ?> 
        <div class="row">
            <div class="col-sm-12">
            <h3>Department of Environment and Natural Resources</h3>
            <p>Programs/Activities/Projects (P/A/P)/Major Final Output (MFO)</p> 

            <!-- IF USER IS ADMIN -->
            <h5><b>MONTHLY FINANCIAL PROGRAM</b></h5>
            <h3>ALLOTMENT</h3>
            
            <h2>Region: <?php echo $region; ?></h2>
            </div>

            <div class="col-sm-6">
                Year: <b><?php echo $year; ?> </b>
            </div>
            <div class="col-sm-6">
                Fund Source: <b><?php echo $fs; ?> </b>
            </div>
        </div>
    </div>
    
    <form action="<?= base_url('allotment/class/update'); ?>" method="post" accept-charset="utf-8">
        
        <table id="myTableAll" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        
        <div class="col-sm-4" >
            <thead>
                <tr>
                    <th scope="col">MFO</th>
                    <th scope="col">PAP</th>
                    <th scope="col">Class</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody> 
                <?php foreach($allotment_class as $ac) : ?>
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
                            <a class="btn btn-primary" href="saa/<?php echo $ac['cl_id'] ?>">Add SAA</a>
                        </td>
                </tr>   
                <?php endforeach; ?>
            
            </tbody>
        </table>

        
        <div class="center-button">
            <button type="submit" class="btn btn-success" onclick="return confirm('Press OK to confirm changes?')">Save all changes</button>
        </div>
    </form>
   
</div>
<!-- /.content-wrapper -->

