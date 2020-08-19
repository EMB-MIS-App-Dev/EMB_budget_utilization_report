<div class="content-wrapper">
   
    <div class='errormsg'>
        <?php echo validation_errors(); ?>
    </div>
    <?php 
        foreach($allotment_class as $ac) : 
            $class_id = $ac['cl_id'];
            $class_name = $ac['cl_name'];
            $allotment_id = $ac['cl_allotment_id'];
            $region = $ac['region'].' - '.$ac['year'];
            $sp_name = $ac['sp_code'].' - '.$ac['sp_name'];
        endforeach;
     ?>
    <div>
        <a class="btn btn-info create-btn" href="<?php echo base_url(); ?>allotment/class/saa/<?php echo $class_id; ?>">Back</a>
    </div>
    <form action="<?php echo base_url(); ?>allotment/class/saa/create/<?php echo $class_id; ?>" method="post" accept-charset="utf-8">
    <div class="form-group">
        <div class="form-group-create">
            <h3>Department of Environment and Natural Resources</h3>
            <p>Programs/Activities/Projects (P/A/P)/Major Final Output (MFO)</p> 

            <!-- IF USER IS ADMIN -->
            <h3>ALLOTMENT</h3>
            <h5><b>Create New SAA for  <h5><?php echo $region; ?></h5>
            <p><?php echo $sp_name; ?></p></b></h5>
            <p><b>Class - <?php echo strtoupper($class_name); ?></b></p>
            <!-- END IF USER IS ADMIN --> 
        </div>
        <div class="form-group-forms">  
            <div class="row">
            <div class="col-sm-12">
                <input type="hidden" name="cl_id" value="<?php echo $class_id; ?>">
            </div>

            <div class="col-sm-12">
                <input type="hidden" name="all_id" value="<?php echo $allotment_id; ?>">
            </div>

            <div class="col-sm-2" >
                    <p><b>Month: </b></p> 
                </div> 
                <div class="col-sm-10">
                <select name="month">
                    <option value=''>Select Month</option>
                    <option value="1">January</option>
                    <option value="2">Febuary</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>

                </div>
               
            </div>
            <div class="row">
                <div class="col-sm-2" >
                    <p><b>SAA Name:</b></p> 
                </div> 
                <div class="col-sm-4">
                    <input type="name" placeholder="Enter SAA name" class="form-control" name="SAA_name">
                </div>

                <div class="col-sm-2" >
                    <p><b>Amount:</b></p> 
                </div> 
                <div class="col-sm-4">
                    <input type="number" step="0.01" class="form-control" name="SAA_amount">          
                </div>

                <div class="col-sm-2" >
                    <p><b>Description:</b></p> 
                </div> 
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="SAA_description">          
                </div>
            </div>
        </div>
        
        <div class="center-button">
        <button type="submit" class="btn btn-success" onclick="return confirm('Press OK to confirm save?')">Save new SAA</button>
        </div>
    </div>
</form>

   
</div>