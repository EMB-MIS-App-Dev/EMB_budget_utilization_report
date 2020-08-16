<div class="content-wrapper">

<div class='errormsg'>
        <?php echo validation_errors(); ?>
</div>

<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>

<form action="<?= base_url('allotment/create'); ?>" method="post" accept-charset="utf-8">
    <div class="form-group">
        <div class="form-group-create">
            <h3>Department of Environment and Natural Resources</h3>
            <p>Programs/Activities/Projects (P/A/P)/Major Final Output (MFO)</p> 

            <!-- IF USER IS ADMIN -->
            <h5><b>MONTHLY FINANCIAL PROGRAM</b></h5>
            <h3>ALLOTMENT</h3>
            <!-- END IF USER IS ADMIN -->
            <div class="row">
                <div class="col-sm-4" >
                    <p><b>For REGION: </b></p> 
                </div> 
                <div class="col-sm-8">
                <!-- IF USER IS ADMIN -->
                    <select name='region' class="browser-default custom-select">
                        <option value=''>SELECT REGION</option>
                        <option value='NCR'>NCR</option>
                        <option value='1'>Region 1</option>
                        <option value='CAR'>CAR</option>
                        <option value='2'>Region 2</option>
                        <option value='3'>Region 3</option>
                        <option value='4A'>Region 4A</option>
                        <option value='4B'>Region 4B</option>
                        <option value='5'>Region 5</option>
                        <option value='6'>Region 6</option>
                        <option value='7'>Region 7</option>
                        <option value='8'>Region 8</option>
                        <option value='9'>Region 9</option>
                        <option value='10'>Region 10</option>
                        <option value='11'>Region 11</option>
                        <option value='12'>Region 12</option>
                        <option value='13'>Region 13</option>
                    </select>
                <!-- END IF USER IS ADMIN -->
                </div>

                <div class="col-sm-4" >
                    <p><b>for YEAR: </b></p> 
                </div> 
                <div class="col-sm-8">
                    <select name="year">
                        <option value=''>Select Year</option>
                        <?php
                            $year_today = date("Y");
                            $year_plus =$year_today + 5;
                            for ($x = $year_today; $x <= $year_plus; $x++) {
                                echo "<option value=". $x .">". $x ."</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group-forms"> 
            <div class="row">
                <div class="col-sm-4" >
                    <p><b>Select PAP: </b></p> 
                </div> 
                <div class="col-sm-8">
                    <select name="sp_id">
                    <?php foreach($sub_pap as $sp) : ?>
                        <option value="<?php echo $sp['sp_id']; ?>"><?php echo $sp['sp_code']; ?> - <?php echo $sp['sp_name']; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
               
                <div class="col-sm-4" >
                    <p><b>PS</b></p> 
                </div> 
                <div class="col-sm-8">
                    <input type="number" step="0.01" placeholder="0000" class="form-control" name="ps_amount">
                </div>
               
                <div class="col-sm-4" >
                    <p><b>MOOE</b></p> 
                </div> 
                <div class="col-sm-8">
                    <input type="number" step="0.01" placeholder="0000" class="form-control" name="mooe_amount">
                </div>

                <div class="col-sm-4" >
                    <p><b>CO</b></p> 
                </div> 
                <div class="col-sm-8">
                    <input type="number" step="0.01" placeholder="0000" class="form-control" name="co_amount">
                </div>

                <div class="col-sm-4" >
                    <p><b>RLIP</b></p> 
                </div> 
                <div class="col-sm-8">
                    <input type="number" step="0.01" placeholder="0000" class="form-control" name="rlip_amount">
                </div>
               
            </div>
        </div>
        
    </div>

    <div class="center-button">
    <button type="submit" class="btn btn-success" onclick="return confirm('Press OK to confirm save?')">Save new Allotment</button>
    </div>
</form>

   
</div>