<div class="content-wrapper">
   
    <div class='errormsg'>
        <?php echo validation_errors(); ?>
    </div>
    
    <form action="<?= base_url('saa/create'); ?>" method="post" accept-charset="utf-8">
    <div class="form-group">
        <div class="form-group-create">
            <h3>Department of Environment and Natural Resources</h3>
            <p>Programs/Activities/Projects (P/A/P)/Major Final Output (MFO)</p> 

            <!-- IF USER IS ADMIN -->
            <h5><b>SAA Configuration Settings</b></h5>
            <h3>ALLOTMENT</h3>
            <!-- END IF USER IS ADMIN -->
            <div class="row">
                <div class="col-sm-4" >
                    <p><b>For REGION: </b></p> 
                </div> 
                <div class="col-sm-8">
                <!-- IF USER IS ADMIN -->
                <select name="regionYear">
                <?php foreach($allotment as $all) : ?>
                    <option value="<?php echo $all['region']; ?>">Region <?php echo $all['region']; ?> - for year <?php echo $all['year']; ?></option>
                <?php endforeach; ?>
                </select>
                <!-- END IF USER IS ADMIN -->
                </div>

                <div class="col-sm-4" >
                    <p><b>Month: </b></p> 
                </div> 
                <div class="col-sm-8">
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
        </div>
        <div class="form-group-forms">  
            <div class="row">
                <div class="col-sm-2" >
                    <p><b>Select PAP:</b></p> 
                </div> 
                <div class="col-sm-2">
                <select name="PAP_CAT">
                    <option value="PS">PS</option>
                    <option value="MOOE">MOOE</option>
                    <option value="CO">CO</option>
                    <option value="RLIP">RLIP</option>
                </select>
                </div> 
                <div class="col-sm-3">
                <select name="sp_id">
                <?php foreach($sub_pap as $sp) : ?>
                    <option value="<?php echo $sp['sp_id']; ?>"><?php echo $sp['sp_code']; ?> - <?php echo $sp['sp_name']; ?></option>
                <?php endforeach; ?>
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
            </div>
        </div>
        
        <div class="center-button">
        <button type="submit" class="btn btn-success" onclick="return confirm('Press OK to confirm save?')">Save new SAA</button>
        </div>
    </div>
</form>

   
</div>