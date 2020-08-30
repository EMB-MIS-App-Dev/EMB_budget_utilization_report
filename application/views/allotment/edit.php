<div class="content-wrapper">

<div class='errormsg'>
        <?php echo validation_errors(); ?>
</div>

<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>

<?php foreach($allotments as $allotment){
    $region =  $allotment['all_region']; 
    $year =  $allotment['all_year']; 

    if($allotment['all_category'] == 'cu'){
        $category =  'Current'; 
    }else if($allotment['all_category'] == 'ca'){
        $category =  'Continuing Appropriation';
    }else if($allotment['all_category'] == 'aa'){
        $category =  'Automatic Appropriation';
    }

    if($allotment['all_type'] == 'sb'){
        $type =  'Specific Budget'; 
    }else if($allotment['all_type'] == 'sp'){
        $type =  'Special Purpose Fund'; 
    }else if($allotment['all_type'] == 'rlip'){
        $type =  'RLIP'; 
    }

    if($allotment['all_funding'] == 'as'){
        $funding =  'Agency Specific'; 
    }else if($allotment['all_funding'] == 'or'){
        $funding =  'Other Releases'; 
    }else if($allotment['all_funding'] == 'sa'){
        $funding =  'SAA'; 
        $saa_no =  $allotment['all_saa_no']; 
        $saa_desc =  $allotment['all_saa_desc']; 

    }

    $class =  strtoupper($allotment['all_class']); 
};
?>

<div class="form-group">
<form action="<?= base_url('allotment/edit'); ?>" method="post" accept-charset="utf-8">
    <div class="form-group-create">
        <!-- IF USER IS ADMIN -->
        <p><b>MONTHLY FINANCIAL PROGRAM</b></p>
        <p>ALLOTMENT</p>
        <p style="color:blue;"><i>(Update - <?php echo $category; ?>)</i></p>
        <!-- END IF USER IS ADMIN -->
        <div class="row">
            <div class="col-sm-2" >
                <b>For REGION: </b>
            </div> 
            <div class="col-sm-3">
            <!-- IF USER IS ADMIN -->
                <?php echo $region; ?>
            </div>
            <div class="col-sm-7"></div>

            <div class="col-sm-2" >
                <b>for YEAR: </b>
            </div> 
            <div class="col-sm-3">
                <?php echo $year; ?>
            </div>
            <div class="col-sm-7"></div>

            <div class="col-sm-2" >
                Type:
            </div> 
            <div class="col-sm-3">
                <?php echo $type; ?>
            </div>
            <div class="col-sm-7"></div>

            <div class="col-sm-2" >
                Funding:
            </div> 
            <div class="col-sm-3">
                <?php echo $funding; ?>
            </div>
            <div class="col-sm-7"></div>
            
            <?php 
            if($funding == 'SAA'){
            echo"
                <div class='col-sm-2' >
                SAA No:
                </div> 
                <div class='col-sm-3'>
                <input type='number' placeholder='0000' name='SAA_number_cu' value='$saa_no'>
                </div>
                <div class='col-sm-7'></div>
                <div class='col-sm-2' >
                    Description:
                </div> 
                <div class='col-sm-3'>
                <input type='text' name='SAA_desc_cu' value='$saa_desc'>
                </div>
                <div class='col-sm-7'></div>
            ";
            } 
            ?>

            <div class="col-sm-2" >
                Allotment Class:
            </div> 
            <div class="col-sm-3">
                <?php echo $class; ?>
            </div>
            <div class="col-sm-7"></div>
        </div>
    </div>


    <!-- PAP input update -->
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

        foreach($allotments as $allotment){
            $sp_id = $allotment['sp_id'];
            $sp_code = $allotment['sp_code'];
            $sp_name = $allotment['sp_name'];
            $sp_mp_id = $allotment['sp_mp_id'];

            $jan = $allotment['amt_jan'];
            $feb = $allotment['amt_feb'];
            $mar = $allotment['amt_mar'];
            $apr = $allotment['amt_apr'];
            $may = $allotment['amt_may'];
            $jun = $allotment['amt_jun'];
            $jul = $allotment['amt_jul'];
            $aug = $allotment['amt_aug'];
            $sep = $allotment['amt_sep'];
            $oct = $allotment['amt_oct'];
            $nov = $allotment['amt_nov'];
            $dec = $allotment['amt_dec'];
            
            
            if( $mp_id == $sp_mp_id){
                echo"
                <div class='col-sm-12' style='margin-bottom: 0px;'>
                <input type='hidden' name='sp_id_cu' value='$sp_id'>
                    $sp_code - $sp_name
                </div>
        
                <div class='col-sm-12' style='overflow-x:auto;'>
                    <table>
                        <tr>
                            <td><input step='0.01' placeholder='Jan' class='number' name='$sp_id-amount-jan-cu' value='$jan'></td>
                            <td><input step='0.01' placeholder='Feb' class='number' name='$sp_id-amount-feb-cu' value='$feb'></td>
                            <td><input step='0.01' placeholder='Mar' class='number' name='$sp_id-amount-mar-cu' value='$mar'></td>
                            <td><input step='0.01' placeholder='Apr' class='number' name='$sp_id-amount-apr-cu' value='$apr'></td>
                            <td><input step='0.01' placeholder='May' class='number' name='$sp_id-amount-may-cu' value='$may'></td>
                            <td><input step='0.01' placeholder='Jun' class='number' name='$sp_id-amount-jun-cu' value='$jun'></td>
                            </tr>
                            <tr>
                            <td><input step='0.01' placeholder='Jul' class='number' name='$sp_id-amount-jul-cu' value='$jul'></td>
                            <td><input step='0.01' placeholder='Aug' class='number' name='$sp_id-amount-aug-cu' value='$aug'></td>
                            <td><input step='0.01' placeholder='Sep' class='number' name='$sp_id-amount-sep-cu' value='$sep'></td>
                            <td><input step='0.01' placeholder='Oct' class='number' name='$sp_id-amount-oct-cu' value='$oct'></td>
                            <td><input step='0.01' placeholder='Nov' class='number' name='$sp_id-amount-nov-cu' value='$nov'></td>
                            <td><input step='0.01' placeholder='Dec' class='number' name='$sp_id-amount-dec-cu' value='$dec'></td>
                            <td><input step='0.01' placeholder='Total' class='number' name='$sp_id-amount-total-cu' readonly></td>
                        </tr>
                    </table>
                </div>
                
                ";
            }
            
            
        };
    };
    ?>
    
</form>
</div>


   
</div>