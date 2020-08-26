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
<form action="<?= base_url('allotment/create'); ?>" method="post" accept-charset="utf-8">
    <div class="form-group-create">
        <!-- IF USER IS ADMIN -->
        <p><b>MONTHLY FINANCIAL PROGRAM</b></p>
        <p>ALLOTMENT</p>
        <!-- END IF USER IS ADMIN -->
        <div class="row">
            <div class="col-sm-2" >
                <b>For REGION: </b>
            </div> 
            <div class="col-sm-3">
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
            <div class="col-sm-7"></div>

            <div class="col-sm-2" >
                <b>for YEAR: </b>
            </div> 
            <div class="col-sm-3">
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
            <div class="col-sm-7"></div>
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
            <input type='hidden' name='all_category_cu' value='cu'>
                <div class="form-group">  
                    <div class="row">

                        <div class='col-sm-12'>
                            <p>Current</p>
                        </div>

                        <div class="col-sm-4" >
                            Type:
                        </div> 
                        <div class="col-sm-3">
                            <select name='type_cu' class="browser-default custom-select">
                                <option value=''>SELECT</option>
                                <option value='sb'>Specific Budget</option>
                                <option value='sp'>Special Purpose Fund</option>
                            </select>
                        </div>
                        <div class="col-sm-5"></div>

                        <div class="col-sm-4" >
                            Funding:
                        </div> 
                        <div class="col-sm-3">
                            <select name='funding_cu' id="source" class="browser-default custom-select">
                                <option value=''>SELECT</option>
                                <option value='as'>Agency Specific</option>
                                <option value='or'>Other Releases</option>
                                <option value='sa'>SAA</option>
                            </select>
                        </div>
                        <div class="col-sm-5" id="saa_no_pad"></div>

                        <div class="col-sm-2" id="saa_no_label">
                            SAA No:
                        </div> 
                        <div class="col-sm-3" id="saa_no_value">
                            <input type='text' placeholder='0000' class='number' name='SAA_number_cu'>
                        </div>

                        <div class="col-sm-7" id="saa_desc_pad"></div>
                        <div class="col-sm-2" id="saa_desc_label">
                            Description: 
                        </div> 
                        <div class="col-sm-3" id="saa_desc_value">
                            <input type='text' class='number' name='SAA_desc_cu'>
                        </div>

                        <div class="col-sm-4" >
                            Allotment Class:
                        </div> 
                        <div class="col-sm-3" style="margin-bottom: 2em;">
                            <select name='class_cu' class="browser-default custom-select">
                                <option value=''>SELECT</option>
                                <option value='ps'>PS</option>
                                <option value='mo'>MOOE</option>
                                <option value='co'>CO</option>
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
                                    <div class='col-sm-12'>
                                        <h5 style='margin-top: 20px;'>$mp_code - $mp_name</h5>
                                    </div>
                                    ";

                                    foreach($sub_pap as $sp){
                                        $sp_id = $sp['sp_id'];
                                        $sp_code = $sp['sp_code'];
                                        $sp_name = $sp['sp_name'];
                                        $sp_mp_id = $sp['sp_mp_id'];
                                        
                                        if( $mp_id == $sp_mp_id){
                                            echo"
                                            <div class='col-sm-12' style='margin-bottom: 0px;'>
                                            <input type='hidden' name='sp_id_cu' value='$sp_id'>
                                                $sp_code - $sp_name
                                            </div>
                                    
                                            <div class='col-sm-12' style='overflow-x:auto;'>
                                                <table>
                                                    <tr>
                                                        <td><input step='0.01' placeholder='Jan' class='number' name='$sp_id-amount-jan-cu'></td>
                                                        <td><input step='0.01' placeholder='Feb' class='number' name='$sp_id-amount-feb-cu'></td>
                                                        <td><input step='0.01' placeholder='Mar' class='number' name='$sp_id-amount-mar-cu'></td>
                                                        <td><input step='0.01' placeholder='Apr' class='number' name='$sp_id-amount-apr-cu'></td>
                                                        <td><input step='0.01' placeholder='May' class='number' name='$sp_id-amount-may-cu'></td>
                                                        <td><input step='0.01' placeholder='Jun' class='number' name='$sp_id-amount-jun-cu'></td>
                                                        </tr>
                                                        <td><input step='0.01' placeholder='Jul' class='number' name='$sp_id-amount-jul-cu'></td>
                                                        <td><input step='0.01' placeholder='Aug' class='number' name='$sp_id-amount-aug-cu'></td>
                                                        <td><input step='0.01' placeholder='Sep' class='number' name='$sp_id-amount-sep-cu'></td>
                                                        <td><input step='0.01' placeholder='Oct' class='number' name='$sp_id-amount-oct-cu'></td>
                                                        <td><input step='0.01' placeholder='Nov' class='number' name='$sp_id-amount-nov-cu'></td>
                                                        <td><input step='0.01' placeholder='Dec' class='number' name='$sp_id-amount-dec-cu'></td>
                                                        <td><input step='0.01' placeholder='Total' class='number' name='$sp_id-amount-total-cu' readonly></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            
                                            ";
                                        }
                                        
                                    };
                                };
                            ?>
                            
                            <div class='center-button'>
                                <button type='submit' name="createbtn" value='create_cu_as' class='btn btn-success' >Create New Allotment</button>
                            </div>
                        </div>

                        <!-- OTHER RELEASES -->
                        <div id="sub_pap_other">
                            <?php 
                                foreach($main_pap as $mp){
                                    $mp_id = $mp['mp_id'];
                                    $mp_code = $mp['mp_code'];
                                    $mp_name = $mp['mp_name'];

                                    echo"
                                    <div class='col-sm-12'>
                                        <h5 style='margin-top: 20px;'>$mp_code - $mp_name</h5>
                                    </div>
                                    ";


                                    // MODAL FOR ADD ACTIVITY
                                    echo"
                                    <div class='col-sm-12'>
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

                            <div class='center-button'>
                                <button type='submit' name="createbtn" value='create_cu_or' class='btn btn-success' >Create New Allotment</button>
                            </div>
                        </div>

                        <!-- SAA -->
                        <div id="sub_pap_saa">
                            <?php 
                                foreach($main_pap as $mp){
                                    $mp_id = $mp['mp_id'];
                                    $mp_code = $mp['mp_code'];
                                    $mp_name = $mp['mp_name'];

                                    echo"
                                    <div class='col-sm-12'>
                                        <h5 style='margin-top: 20px;'>$mp_code - $mp_name</h5>
                                    </div>
                                    ";


                                    // MODAL FOR ADD ACTIVITY
                                    echo"
                                    <div class='col-sm-12'>
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
                            <p>Continuing Appropriation</p>
                        </div>  

                        <div class="col-sm-4" >
                            Type:
                        </div> 
                        <div class="col-sm-3">
                            <select name='source_ca' class="browser-default custom-select">
                                <option value=''>SELECT</option>
                                <option value='specificBudget'>Specific Budget</option>
                                <option value='specialPurposeFund'>Special Purpose Fund</option>
                            </select>
                        </div>
                        <div class="col-sm-5"></div>

                        <div class="col-sm-4" >
                            Funding:
                        </div> 
                        <div class="col-sm-3">
                            <select name='source_ca' id="source_ca" class="browser-default custom-select">
                                <option value=''>SELECT</option>
                                <option value='AS'>Agency Specific</option>
                                <option value='OR'>Other Releases</option>
                                <option value='SAA'>SAA</option>
                            </select>
                        </div>
                        <div class="col-sm-5" id="saa_no_pad_ca"></div>

                        <div class="col-sm-2" id="saa_no_label_ca">
                            SAA No:
                        </div> 
                        <div class="col-sm-3" id="saa_no_value_ca">
                            <input type='text' placeholder='0000' class='number' name='SAA_number_ca'>
                        </div>

                        <div class="col-sm-7" id="saa_desc_pad_ca"></div>
                        <div class="col-sm-2" id="saa_desc_label_ca">
                            Description: 
                        </div> 
                        <div class="col-sm-3" id="saa_desc_value_ca">
                            <input type='text' class='number' name='SAA_desc_ca'>
                        </div>

                        <div class="col-sm-4" >
                            Allotment Class:
                        </div> 
                        <div class="col-sm-3" style="margin-bottom: 2em;">
                            <select name='source_ca' class="browser-default custom-select">
                                <option value=''>SELECT</option>
                                <option value='PS'>PS</option>
                                <option value='MOOE'>MOOE</option>
                                <option value='CO'>CO</option>
                            </select>
                        </div>
                        <div class="col-sm-5"></div>

                        <!-- PAP -->
                        <!-- Agency Specific -->
                        <div id="sub_pap_as_ca">
                            <?php 
                                foreach($main_pap as $mp){
                                    $mp_id = $mp['mp_id'];
                                    $mp_code = $mp['mp_code'];
                                    $mp_name = $mp['mp_name'];

                                    echo"
                                    <div class='col-sm-12'>
                                        <input type='hidden' name='mp_id_ca' value='$mp_id'>
                                        <h5 style='margin-top: 20px;'>$mp_code - $mp_name</h5>
                                    </div>
                                    ";

                                    foreach($sub_pap as $sp){
                                        $sp_id = $sp['sp_id'];
                                        $sp_code = $sp['sp_code'];
                                        $sp_name = $sp['sp_name'];
                                        $sp_mp_id = $sp['sp_mp_id'];
                                        
                                        if( $mp_id == $sp_mp_id){
                                            echo"
                                            <div class='col-sm-12' style='margin-bottom: 0px;'>
                                                <input type='hidden' name='sp_id_ca' value='$sp_id'>
                                                $sp_code - $sp_name
                                            </div>
                                    
                                            <div class='col-sm-12' style='overflow-x:auto;'>
                                                <table>
                                                    <tr>
                                                        <td><input step='0.01' placeholder='Jan' class='number' name='$sp_id-amount-jan-ca'></td>
                                                        <td><input step='0.01' placeholder='Feb' class='number' name='$sp_id-amount-feb-ca'></td>
                                                        <td><input step='0.01' placeholder='Mar' class='number' name='$sp_id-amount-mar-ca'></td>
                                                        <td><input step='0.01' placeholder='Apr' class='number' name='$sp_id-amount-apr-ca'></td>
                                                        <td><input step='0.01' placeholder='May' class='number' name='$sp_id-amount-may-ca'></td>
                                                        <td><input step='0.01' placeholder='Jun' class='number' name='$sp_id-amount-jun-ca'></td>
                                                        <td><input step='0.01' placeholder='Jul' class='number' name='$sp_id-amount-jul-ca'></td>
                                                        <td><input step='0.01' placeholder='Aug' class='number' name='$sp_id-amount-aug-ca'></td>
                                                        <td><input step='0.01' placeholder='Sep' class='number' name='$sp_id-amount-sep-ca'></td>
                                                        <td><input step='0.01' placeholder='Oct' class='number' name='$sp_id-amount-oct-ca'></td>
                                                        <td><input step='0.01' placeholder='Nov' class='number' name='$sp_id-amount-nov-ca'></td>
                                                        <td><input step='0.01' placeholder='Dec' class='number' name='$sp_id-amount-dec-ca'></td>
                                                        <td><input step='0.01' placeholder='Total' class='number' name='$sp_id-amount-total-ca' readonly></td>
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
                        <div id="sub_pap_other_ca">
                            <?php 
                                foreach($main_pap as $mp){
                                    $mp_id = $mp['mp_id'];
                                    $mp_code = $mp['mp_code'];
                                    $mp_name = $mp['mp_name'];

                                    echo"
                                    <div class='col-sm-12'>
                                        <input type='hidden' name='mp_id_ca' value='$mp_id'>
                                        <h5 style='margin-top: 20px;'>$mp_code - $mp_name</h5>
                                    </div>
                                    ";


                                    // MODAL FOR ADD ACTIVITY
                                    echo"
                                    <div class='col-sm-12'>
                                        <a href='' id='add-$mp_id-ca' data-toggle='modal' data-target='#myModal-ca-$mp_id'>Add Activity</a>
                                        <div id='newAct_ca_$mp_id'></div>
                                    </div>

                                    
                                    <div class='modal fade' id='myModal-ca-$mp_id' role='dialog'>
                                        <div class='modal-dialog'>
                                        
                                        <!-- Modal content-->
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                            <h4 class='modal-title'>Add Activity</h4>
                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                            </div>
                                            <div class='modal-body'>
                                            <select name='source_ca' id='fund_source_ca_$mp_id' class='browser-default custom-select'>
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
                                            <button type='button' class='btn btn-success' onclick='addAct_ca_$mp_id()'>Add</button>
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
                        <div id="sub_pap_saa_ca">
                            <?php 
                                foreach($main_pap as $mp){
                                    $mp_id = $mp['mp_id'];
                                    $mp_code = $mp['mp_code'];
                                    $mp_name = $mp['mp_name'];

                                    echo"
                                    <div class='col-sm-12'>
                                        <input type='hidden' name='mp_id_ca' value='$mp_id'>
                                        <h5 style='margin-top: 20px;'>$mp_code - $mp_name</h5>
                                    </div>
                                    ";


                                    // MODAL FOR ADD ACTIVITY
                                    echo"
                                    <div class='col-sm-12'>
                                        <a href='' id='add-ca-$mp_id' data-toggle='modal' data-target='#myModalsaa-ca-$mp_id'>Add Activity</a>
                                        <div id='newActsaa_ca_$mp_id'></div>
                                    </div>

                                    
                                    <div class='modal fade' id='myModalsaa-ca-$mp_id' role='dialog'>
                                        <div class='modal-dialog'>
                                        
                                        <!-- Modal content-->
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                            <h4 class='modal-title'>Add Activity</h4>
                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                            </div>
                                            <div class='modal-body'>
                                            <select name='source_ca' id='fund_sourcesaa_ca_$mp_id' class='browser-default custom-select'>
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
                                            <button type='button' class='btn btn-success' onclick='addActsaa_ca_$mp_id()'>Add</button>
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

             <!-- TAB AUTOMATIC -->
            <div role="tabpanel" class="tab-pane fade" id="automatic">
                <div class="form-group">  
                    <div class="row">  
                        <div class='col-sm-12'>
                            <p>Automatic Appropriation</p>
                        </div>  

                        <div class="col-sm-4" >
                            Type:
                        </div> 
                        <div class="col-sm-3">
                            <select name='source_aa' class="browser-default custom-select">
                                <option value='RLIP' selected>Retirement and Life Insurance Premium</option>
                            </select>
                        </div>
                        <div class="col-sm-5"></div>

                        <div class="col-sm-4" >
                            Funding:
                        </div> 
                        <div class="col-sm-3">
                            <select name='source_aa' id="source_aa" class="browser-default custom-select">
                                <option value=''>SELECT</option>
                                <option value='AS'>Agency Specific</option>
                                <option value='OR'>Other Releases</option>
                                <option value='SAA'>SAA</option>
                            </select>
                        </div>
                        <div class="col-sm-5" id="saa_no_pad_aa"></div>

                        <div class="col-sm-2" id="saa_no_label_aa">
                            SAA No:
                        </div> 
                        <div class="col-sm-3" id="saa_no_value_aa">
                            <input type='text' placeholder='0000' class='number' name='SAA_number_aa'>
                        </div>

                        <div class="col-sm-7" id="saa_desc_pad_aa"></div>
                        <div class="col-sm-2" id="saa_desc_label_aa">
                            Description: 
                        </div> 
                        <div class="col-sm-3" id="saa_desc_value_aa">
                            <input type='text' class='number' name='SAA_desc_aa'>
                        </div>

                        <div class="col-sm-4" >
                            Allotment Class:
                        </div> 
                        <div class="col-sm-3" style="margin-bottom: 2em;">
                            <select name='source_aa' class="browser-default custom-select">
                                <option value=''>SELECT</option>
                                <option value='PS'>PS</option>
                                <option value='MOOE'>MOOE</option>
                                <option value='CO'>CO</option>
                            </select>
                        </div>
                        <div class="col-sm-5"></div>

                        <!-- PAP -->
                        <!-- Agency Specific -->
                        <div id="sub_pap_as_aa">
                            <?php 
                                foreach($main_pap as $mp){
                                    $mp_id = $mp['mp_id'];
                                    $mp_code = $mp['mp_code'];
                                    $mp_name = $mp['mp_name'];

                                    echo"
                                    <div class='col-sm-12'>
                                        <input type='hidden' name='mp_id_aa' value='$mp_id'>
                                        <h5 style='margin-top: 20px;'>$mp_code - $mp_name</h5>
                                    </div>
                                    ";

                                    foreach($sub_pap as $sp){
                                        $sp_id = $sp['sp_id'];
                                        $sp_code = $sp['sp_code'];
                                        $sp_name = $sp['sp_name'];
                                        $sp_mp_id = $sp['sp_mp_id'];
                                        
                                        if( $mp_id == $sp_mp_id){
                                            echo"
                                            <div class='col-sm-12' style='margin-bottom: 0px;'>
                                                <input type='hidden' name='sp_id_aa' value='$sp_id'>
                                                $sp_code - $sp_name
                                            </div>
                                    
                                            <div class='col-sm-12' style='overflow-x:auto;'>
                                                <table>
                                                    <tr>
                                                        <td><input step='0.01' placeholder='Jan' class='number' name='$sp_id-amount-jan-aa'></td>
                                                        <td><input step='0.01' placeholder='Feb' class='number' name='$sp_id-amount-feb-aa'></td>
                                                        <td><input step='0.01' placeholder='Mar' class='number' name='$sp_id-amount-mar-aa'></td>
                                                        <td><input step='0.01' placeholder='Apr' class='number' name='$sp_id-amount-apr-aa'></td>
                                                        <td><input step='0.01' placeholder='May' class='number' name='$sp_id-amount-may-aa'></td>
                                                        <td><input step='0.01' placeholder='Jun' class='number' name='$sp_id-amount-jun-aa'></td>
                                                        <td><input step='0.01' placeholder='Jul' class='number' name='$sp_id-amount-jul-aa'></td>
                                                        <td><input step='0.01' placeholder='Aug' class='number' name='$sp_id-amount-aug-aa'></td>
                                                        <td><input step='0.01' placeholder='Sep' class='number' name='$sp_id-amount-sep-aa'></td>
                                                        <td><input step='0.01' placeholder='Oct' class='number' name='$sp_id-amount-oct-aa'></td>
                                                        <td><input step='0.01' placeholder='Nov' class='number' name='$sp_id-amount-nov-aa'></td>
                                                        <td><input step='0.01' placeholder='Dec' class='number' name='$sp_id-amount-dec-aa'></td>
                                                        <td><input step='0.01' placeholder='Total' class='number' name='$sp_id-amount-total-aa' readonly></td>
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
                        <div id="sub_pap_other_aa">
                            <?php 
                                foreach($main_pap as $mp){
                                    $mp_id = $mp['mp_id'];
                                    $mp_code = $mp['mp_code'];
                                    $mp_name = $mp['mp_name'];

                                    echo"
                                    <div class='col-sm-12'>
                                        <input type='hidden' name='mp_id_aa' value='$mp_id'>
                                        <h5 style='margin-top: 20px;'>$mp_code - $mp_name</h5>
                                    </div>
                                    ";


                                    // MODAL FOR ADD ACTIVITY
                                    echo"
                                    <div class='col-sm-12'>
                                        <a href='' id='add-$mp_id-aa' data-toggle='modal' data-target='#myModal-aa-$mp_id'>Add Activity</a>
                                        <div id='newAct_aa_$mp_id'></div>
                                    </div>

                                    
                                    <div class='modal fade' id='myModal-aa-$mp_id' role='dialog'>
                                        <div class='modal-dialog'>
                                        
                                        <!-- Modal content-->
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                            <h4 class='modal-title'>Add Activity</h4>
                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                            </div>
                                            <div class='modal-body'>
                                            <select name='source_aa' id='fund_source_aa_$mp_id' class='browser-default custom-select'>
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
                                            <button type='button' class='btn btn-success' onclick='addAct_aa_$mp_id()'>Add</button>
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
                        <div id="sub_pap_saa_aa">
                            <?php 
                                foreach($main_pap as $mp){
                                    $mp_id = $mp['mp_id'];
                                    $mp_code = $mp['mp_code'];
                                    $mp_name = $mp['mp_name'];

                                    echo"
                                    <div class='col-sm-12'>
                                        <input type='hidden' name='mp_id_aa' value='$mp_id'>
                                        <h5 style='margin-top: 20px;'>$mp_code - $mp_name</h5>
                                    </div>
                                    ";


                                    // MODAL FOR ADD ACTIVITY
                                    echo"
                                    <div class='col-sm-12'>
                                        <a href='' id='add-aa-$mp_id' data-toggle='modal' data-target='#myModalsaa-aa-$mp_id'>Add Activity</a>
                                        <div id='newActsaa_aa_$mp_id'></div>
                                    </div>

                                    
                                    <div class='modal fade' id='myModalsaa-aa-$mp_id' role='dialog'>
                                        <div class='modal-dialog'>
                                        
                                        <!-- Modal content-->
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                            <h4 class='modal-title'>Add Activity</h4>
                                            <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                            </div>
                                            <div class='modal-body'>
                                            <select name='source_aa' id='fund_sourcesaa_aa_$mp_id' class='browser-default custom-select'>
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
                                            <button type='button' class='btn btn-success' onclick='addActsaa_aa_$mp_id()'>Add</button>
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
        </div>
    </div>
</form>
</div>


   
</div>