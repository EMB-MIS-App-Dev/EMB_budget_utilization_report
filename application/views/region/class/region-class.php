<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class='successmsg'>
        <?php if($this->session->flashdata('successmsg')): ?> 
            <p><?php echo $this->session->flashdata('successmsg'); ?></p>
        <?php endif; ?>
    </div>

    <div>
        <a class="btn btn-info create-btn" href="<?php echo base_url(); ?>region">Back</a>
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
            
            <h2>Region: <?php echo $region; ?></h2>
            </div>

            <div class="col-sm-6">
                Year: <b><?php echo $year; ?> </b>
            </div>
            <div class="col-sm-6">
                Fund Source: <b><?php echo $fs; ?> </b>
            </div>
        </div>

        <div class="col-sm-12" style="margin-top:1em;">
            <h3>Select Form:</h3>
        
            <h3><select name='region' class="browser-default custom-select">
                        <option value='1'>Financial Program</option>
                        <option value='2'>Obligation</option>
                        <option value='3'>Disbursement</option>

            </select></h3>
        </div>
    </div>
    
    <!-- <form action="<?= base_url('region/class/update'); ?>" method="post" accept-charset="utf-8"> -->
    <form>  
        <table id="myTableAll" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
        
        <div class="col-sm-4" >
            <thead>
                <tr>
                    <th scope="col">MFO</th>
                    <th scope="col">PAP</th>
                    <th scope="col">Class</th>
                    <th scope="col">Allotment</th>
                    <th scope="col">Amount</th>
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
                                $cl_amt = $ac['cl_amount'];
                            ?>
                            <input type="hidden" name="cl_id" value="<?php echo $cl_id; ?>">
                            <?php if ($ac['cl_remarks'] == 'regular'){
                                // with saa
                                echo" <input type='number' step='0.01' class='form-control' id='cl-allotment-$cl_id' value='$cl_amt' readonly>";
                            }else{
                                // without saa
                                echo" <input type='number' step='0.01' class='form-control' id='cl-allotment-$cl_id' value='$cl_amt' readonly>";
                            }
                            ?>
                            
                        </td>
                        <td><input type='number' step='0.01' class='form-control' id='cl-amount-<?php echo $ac['cl_id']; ?>' name='cl-amount-<?php echo $ac['cl_id']; ?>'></td>
                </tr>   
                <?php endforeach; ?>
            
            </tbody>
        </table>

        
        <div class="center-button">
            <button type="submit" id="compareSubmit" class="btn btn-success" onclick="return confirm('Press OK to confirm changes?')">Save all changes</button>
        </div>
    </form>
   
</div>
<!-- /.content-wrapper -->

