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
                    <p><b>for: </b></p> 
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

                
                    <select name="year">
                        <option>Select Year</option>
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
                <select name="table_name" style="width: 150px">
                    <option value="GMS">100000100001000 - General Management & Supervision</option>
                    <option value="HRD">100000100002000 - Human Resourse and Development</option>
                    <option value="APB">C100000100003000 - Admin. Of Personnel BenefitsO</option>
                    <option value="PPF">200000100001000 - Planning & Policy Formulation and Mgt. Info. System</option>
                    <option value="LS">200000100002000 - Legal services and provision of secretariat services to the EMB</option>
                    <option value="PRLS">310100100001000 - Pollution research and laboratory services</option>
                    <option value="EEI">310100100002000 - Environmental Education and Information</option>
                    <option value="EIA">310100100003000 - Environmental Impact Assessments</option>
                    <option value="ICAR">310200100002000 - Implementation of Clean Air Regulation</option>
                    <option value="ICWR">310200100002000 - Implementation of Clean Water Regulation </option>
                    <option value="IESW">310200100003000 - Implementation of Ecological Solid Waste Management Regulations</option>
                    <option value="ITSH">310200100004000 - Implementation of Toxic Subtances and Hazardous Waste Management Regulations </option>
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