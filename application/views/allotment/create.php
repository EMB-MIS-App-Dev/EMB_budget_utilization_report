<div class="content-wrapper">

<div class='errormsg'>
        <?php echo validation_errors(); ?>
</div>

<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>

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

    <div class="form-group-create-menu">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" class="nav-link" href="#current">Current</a></li>
            <li><a data-toggle="tab" class="nav-link" href="#continuing">Continuing Appropriation</a></li>
            <li><a data-toggle="tab" class="nav-link" href="#automatic">Automatic Appropriation</a></li>
        </ul> 

        <div class="tab-content">
        <!-- TAB CURRENT -->
            <div role="tabpanel" class="tab-pane fade in active" id="current">
                <div class="form-group">  
                    <div class="row">

                        <div class='col-sm-12'>
                            <h2 style="text-align: center; margin-bottom: 1em;">Current</h2>
                        </div>

                        <div class="col-sm-4" >
                            <p><b>Type: </b></p> 
                        </div> 
                        <div class="col-sm-3">
                            <select name='source' class="browser-default custom-select">
                                <option value=''>SELECT</option>
                                <option value='specificBudget'>Specific Budget</option>
                                <option value='specialPurposeFund'>Special Purpose Fund</option>
                            </select>
                        </div>
                        <div class="col-sm-5"></div>

                        <div class="col-sm-4" >
                            <p><b>Funding: </b></p> 
                        </div> 
                        <div class="col-sm-3">
                            <select name='source' id="source" class="browser-default custom-select">
                                <option value=''>SELECT</option>
                                <option value='AS'>Agency Specific</option>
                                <option value='OR'>Other Releases</option>
                                <option value='SAA'>SAA</option>
                            </select>
                        </div>
                        <div class="col-sm-5" id="saa_no_pad"></div>

                        <div class="col-sm-2" id="saa_no_label">
                            <p><b>SAA No: </b></p> 
                        </div> 
                        <div class="col-sm-3" id="saa_no_value">
                            <input type='text' placeholder='0000' class='form-control' name='SAA_number'>
                        </div>

                        <div class="col-sm-7" id="saa_desc_pad"></div>
                        <div class="col-sm-2" id="saa_desc_label">
                            <p><b>Description: </b></p> 
                        </div> 
                        <div class="col-sm-3" id="saa_desc_value">
                            <input type='text' class='form-control' name='SAA_desc'>
                        </div>

                        <div class="col-sm-4" >
                            <p><b>Allotment Class: </b></p> 
                        </div> 
                        <div class="col-sm-3" style="margin-bottom: 2em;">
                            <select name='source' class="browser-default custom-select">
                                <option value=''>SELECT</option>
                                <option value='PS'>PS</option>
                                <option value='MOOE'>MOOE</option>
                                <option value='CO'>CO</option>
                            </select>
                        </div>
                        <div class="col-sm-5"></div>

                        <!-- PAP -->
                        <!-- Agency Specific -->
                        <div id="sub_pap_as">
                            <?php 
                                foreach($main_pap as $mp){
                                    $mp_id = $mp['mp_id'];
                                    $mp_code = $mp['mp_code'];
                                    $mp_name = $mp['mp_name'];

                                    echo"
                                    <div class='col-sm-12' style='margin-top: 4em;'>
                                        <input type='hidden' name='mp_id' value='$mp_id'>
                                        <h5>$mp_code - $mp_name</h5>
                                    </div>
                                    ";

                                    foreach($sub_pap as $sp){
                                        $sp_id = $sp['sp_id'];
                                        $sp_code = $sp['sp_code'];
                                        $sp_name = $sp['sp_name'];
                                        $sp_mp_id = $sp['sp_mp_id'];
                                        
                                        if( $mp_id == $sp_mp_id){
                                            echo"
                                            <div class='col-sm-12' style='margin-top: 2em; margin-bottom: 0px;'>
                                                <input type='hidden' name='sp_id' value='$sp_id'>
                                                <p>$sp_code - $sp_name</p>
                                            </div>
                                    
                                            <div class='col-sm-12' style='overflow-x:auto;'>
                                                <table>
                                                    <tr>
                                                        <td><input type='number' step='0.01' placeholder='Jan' class='form-control' name='$sp_id-amount-jan'></td>
                                                        <td><input type='number' step='0.01' placeholder='Feb' class='form-control' name='$sp_id-amount-feb'></td>
                                                        <td><input type='number' step='0.01' placeholder='Mar' class='form-control' name='$sp_id-amount-mar'></td>
                                                        <td><input type='number' step='0.01' placeholder='Apr' class='form-control' name='$sp_id-amount-apr'></td>
                                                        <td><input type='number' step='0.01' placeholder='May' class='form-control' name='$sp_id-amount-may'></td>
                                                        <td><input type='number' step='0.01' placeholder='Jun' class='form-control' name='$sp_id-amount-jun'></td>
                                                        <td><input type='number' step='0.01' placeholder='Jul' class='form-control' name='$sp_id-amount-jul'></td>
                                                        <td><input type='number' step='0.01' placeholder='Aug' class='form-control' name='$sp_id-amount-aug'></td>
                                                        <td><input type='number' step='0.01' placeholder='Sep' class='form-control' name='$sp_id-amount-sep'></td>
                                                        <td><input type='number' step='0.01' placeholder='Oct' class='form-control' name='$sp_id-amount-oct'></td>
                                                        <td><input type='number' step='0.01' placeholder='Nov' class='form-control' name='$sp_id-amount-nov'></td>
                                                        <td><input type='number' step='0.01' placeholder='Dec' class='form-control' name='$sp_id-amount-dec'></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            
                                            ";
                                        }
                                        
                                    };
                                };
                            ?>
                        </div>

                        <!-- OTHER RELEASES -->
                        <div id="sub_pap_other">
                            <?php 
                                foreach($main_pap as $mp){
                                    $mp_id = $mp['mp_id'];
                                    $mp_code = $mp['mp_code'];
                                    $mp_name = $mp['mp_name'];

                                    echo"
                                    <div class='col-sm-12' style='margin-top: 2em;'>
                                        <input type='hidden' name='mp_id' value='$mp_id'>
                                        <h5>$mp_code - $mp_name</h5>
                                    </div>
                                    ";


                                    // MODAL FOR ADD ACTIVITY
                                    echo"
                                    <div class='col-sm-12' style='margin-bottom: 2em;'>
                                        <a href='' id='add-$mp_id' data-toggle='modal' data-target='#myModal-$mp_id'>Add Activity</a>
                                        <div id='newAct_$mp_id'></div>
                                    </div>

                                    
                                    <div class='modal fade' id='myModal-$mp_id' role='dialog'>
                                        <div class='modal-dialog'>
                                        
                                        <!-- Modal content-->
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                            <h4 class='modal-title'>Add Activity</h4>
                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                            </div>
                                            <div class='modal-body'>
                                            <select name='source' id='fund_source_$mp_id' class='browser-default custom-select'>
                                                <option value=''>SELECT</option>
                                                    ";
                                                    foreach($sub_pap as $sp){
                                                        $sp_id = $sp['sp_id'];
                                                        $sp_code = $sp['sp_code'];
                                                        $sp_name = $sp['sp_name'];
                                                        $sp_mp_id = $sp['sp_mp_id'];

                                                        if( $mp_id == $sp_mp_id){
                                                        echo"
                                                        
                                                        <option value='$sp_id'>$sp_code - $sp_name</option>
                                                        
                                                        ";
                                                        };
                                                    };
                                                    echo"
                                                </select>
                                            </div>
                                            <div class='modal-footer'>
                                            <button type='button' class='btn btn-success' onclick='addAct_$mp_id()'>Add</button>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                        
                                        </div>
                                    </div>

                                    ";
                                    // END MODAL FOR ADD ACTIVITY
                                };
                            ?>
                        </div>

                        <!-- SAA -->
                        <div id="sub_pap_saa">
                            <?php 
                                foreach($main_pap as $mp){
                                    $mp_id = $mp['mp_id'];
                                    $mp_code = $mp['mp_code'];
                                    $mp_name = $mp['mp_name'];

                                    echo"
                                    <div class='col-sm-12' style='margin-top: 2em;'>
                                        <input type='hidden' name='mp_id' value='$mp_id'>
                                        <h5>$mp_code - $mp_name</h5>
                                    </div>
                                    ";


                                    // MODAL FOR ADD ACTIVITY
                                    echo"
                                    <div class='col-sm-12' style='margin-bottom: 2em;'>
                                        <a href='' id='add-$mp_id' data-toggle='modal' data-target='#myModalsaa-$mp_id'>Add Activity</a>
                                        <div id='newActsaa_$mp_id'></div>
                                    </div>

                                    
                                    <div class='modal fade' id='myModalsaa-$mp_id' role='dialog'>
                                        <div class='modal-dialog'>
                                        
                                        <!-- Modal content-->
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                            <h4 class='modal-title'>Add Activity</h4>
                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                            </div>
                                            <div class='modal-body'>
                                            <select name='source' id='fund_sourcesaa_$mp_id' class='browser-default custom-select'>
                                                <option value=''>SELECT</option>
                                                    ";
                                                    foreach($sub_pap as $sp){
                                                        $sp_id = $sp['sp_id'];
                                                        $sp_code = $sp['sp_code'];
                                                        $sp_name = $sp['sp_name'];
                                                        $sp_mp_id = $sp['sp_mp_id'];

                                                        if( $mp_id == $sp_mp_id){
                                                        echo"
                                                        
                                                        <option value='$sp_id'>$sp_code - $sp_name</option>
                                                        
                                                        ";
                                                        };
                                                    };
                                                    echo"
                                                </select>
                                            </div>
                                            <div class='modal-footer'>
                                            <button type='button' class='btn btn-success' onclick='addActsaa_$mp_id()'>Add</button>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            </div>
                                        </div>
                                        
                                        </div>
                                    </div>

                                    ";
                                    // END MODAL FOR ADD ACTIVITY
                                };
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB CONTINUING -->
            <div role="tabpanel" class="tab-pane fade" id="continuing">
                <div class="form-group">  
                    <div class="row">
                        <div class='col-sm-12'>
                            <h2 style="text-align: center; margin-bottom: 1em;">Continuing Appropriation</h2>
                        </div>

                        <div class="col-sm-4" >
                            <p><b>Type: </b></p> 
                        </div> 
                        <div class="col-sm-8">
                            <select name='source' class="browser-default custom-select">
                                <option value=''>SELECT</option>
                                <option value='specificBudget'>Specific Budget</option>
                                <option value='specialPurposeFund'>Special Purpose Fund</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

             <!-- TAB AUTOMATIC -->
             <div role="tabpanel" class="tab-pane fade" id="automatic">
                <div class="form-group">  
                    <div class="row">
                        <div class='col-sm-12'>
                            <h2 style="text-align: center; margin-bottom: 1em;">Automatic Appropriation</h2>
                        </div>

                        <div class="col-sm-12" >
                            <h5>Retirement and Life Insurance Premium</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!-- STATUS -->
    <input type="hidden" name="status" value="1">

    
    
</div>


   
</div>