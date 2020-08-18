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
                </div>

                <div class="col-sm-4" >
                    <p><b>Source Fund: </b></p> 
                </div> 
                <div class="col-sm-8">
                    <select name='fund_source' class="browser-default custom-select">
                        <option value='GAA'>Comprehensive Release</option>
                        <option value='SARO'>Special Allotment Release Order</option>
                        
                    </select>
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

        <!-- STATUS -->
        <input type="hidden" name="status" value="1">

        <div class="form-group-forms"> 
            <div class="row">

                <?php foreach($sub_pap as $sp) : ?>

                    <div class="col-sm-12">
                        <input type="hidden" name="sp_id" value="<?php echo $sp['sp_id']; ?>">
                        
                        <h5><?php echo $sp['sp_code']; ?> - <?php echo $sp['sp_name']; ?></h5>
                    </div>
                    <?php
                        
                        $sp_code =  $sp['sp_code'];
                        $sp_id =  $sp['sp_id'];

                        for ($i = 1; $i <= 4; $i++) {
                            $cl_name = array("N/A","ps", "mooe", "co", "rlip");
                            //echo "<input type='text' name='count_$i'>";

                            
                            echo"
                            <input type='hidden' name='sp_id' value='$sp_id'>
                            <div class='col-sm-4' >
                                <p><b>$cl_name[$i]</b></p> 
                            </div> 
                            <div class='col-sm-8'>
                                <input type='number' step='0.01' placeholder='0000' class='form-control' name='$sp_code-$cl_name[$i]-amount-$i'>
                            </div>
                            ";
                        }
                        
                    ?>
                    
                <?php endforeach; ?>

            </div>
        </div>
        
    </div>

    <div class="center-button">
    <button type="submit" class="btn btn-success" onclick="return confirm('Press OK to confirm save?')">Save new Allotment</button>
    </div>
</form>

   
</div>