
<div class="content-wrapper">
<div class='errormsg'>
    <?php echo validation_errors(); ?>
</div>
    <div class="form-group-create">
        <form action="<?= base_url('reports'); ?>" method="post" accept-charset="utf-8">
            <div class="row">
            <div class="col-sm-1">Report: </div>
                <div class="col-sm-3">
                    <select name='report' class="browser-default custom-select">
                        <option value=''>SELECT</option>
                        <option value='fp'>Financial Performance</option>
                        <option value='ut'>Utilization</option>
                    </select>
                </div>

                <div class="col-sm-8"></div>

                <div class="col-sm-1">Category: </div>
                <div class="col-sm-3">
                    <select name='category' class="browser-default custom-select">
                        <option value=''>SELECT</option>
                        <option value='cu'>Current</option>
                        <option value='ca'>Continuing Appropriation</option>
                        <option value='aa'>Automatic Appropriation</option>
                        <option value='cunca'>Current + Continuing</option>
                    </select>
                </div>
                
                <div class="col-sm-1">Class: </div>
                <div class="col-sm-3">
                    <select name='class' class="browser-default custom-select">
                        <option value=''>SELECT</option>
                        <option value='ps'>PS</option>
                        <option value='mo'>MOOE</option>
                        <option value='co'>CO</option>
                        <option value='psnmonco'>PS + MO + CO</option>
                        <option value='monco'>MO + CO</option>
                    </select>
                </div>

                <div class="col-sm-4"></div>

                <div class="col-sm-1">Year: </div>
                <div class="col-sm-3"><input type="number" name="year" onKeyPress="if(this.value.length==4) return false;" /></div>

                <div class="col-sm-1">Month: </div>
                <div class="col-sm-3">
                    <select name="month_from" id="month_from" size='1'>
                        <option value=''>SELECT</option>
                        <option value='1'>January</option>
                        <option value='2'>February</option>
                        <option value='3'>March</option>
                        <option value='4'>April</option>
                        <option value='5'>May</option>
                        <option value='6'>June</option>
                        <option value='7'>July</option>
                        <option value='8'>August</option>
                        <option value='9'>September</option>
                        <option value='10'>October</option>
                        <option value='11'>November</option>
                        <option value='12'>December</option>
                    </select>

                    -

                    <select name="month_to" id="month_to" size='1'>
                        <option value=''>SELECT</option>
                        <option value='1'>January</option>
                        <option value='2'>February</option>
                        <option value='3'>March</option>
                        <option value='4'>April</option>
                        <option value='5'>May</option>
                        <option value='6'>June</option>
                        <option value='7'>July</option>
                        <option value='8'>August</option>
                        <option value='9'>September</option>
                        <option value='10'>October</option>
                        <option value='11'>November</option>
                        <option value='12'>December</option>
                    </select>
                </div>
                
                <div class="col-sm-4"></div>

                <!-- <div class="col-sm-4">
                    <button name="generate" id="generatebtn" class='btn btn-primary' >Generate Report</button>
                </div>
                <div class="col-sm-4">
                    <button id="btnExport" onclick="fnExcelReport();" class='btn btn-success'>Export Report</button>
                </div> -->
                
                <!-- <div class="col-sm-4"></div> -->

                <div class="center-button">
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>

            </div>
        </form> 

        <table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Report:</th>
                    <th>Spending Performance</th>
                    <th></th>
                    <th>Class:</th>
                    <?php
                    if(isset($details['class'])){
                        if($details['class'] == 'ps' || $details['class'] == 'mo' || $details['class'] == 'co'){
                            $class = strtoupper($details['class']);
                        }elseif($details['class'] == 'psnmonco'){
                            $class = 'PS + MO + CO';
                        }
                        elseif($details['class'] == 'monco'){
                            $class = 'MO + CO';
                        }
                        
                    }
                   
                    ?>
                    <th><?php echo isset($class) ? $class : '' ?></th>
                    <th></th>
                </tr>
                <tr>
                    <th>Category:</th>
                    <?php
                    if(isset($details['category'])){
                        if($details['category'] == 'cu'){
                            $cat = 'Current';
                        }elseif($details['category'] == 'ca'){
                            $cat = 'Continuing Appropriation';
                        }elseif($details['category'] == 'aa'){
                            $cat = 'Automatic Appropriation';
                        }elseif($details['category'] == 'cunca'){
                            $cat = 'Current + Continuing';
                        }
                        
                    }
                
                    ?>
                    <th><?php echo isset($cat) ? $cat : '' ?></th>
                    <th></th>
                    <th>Date:</th>
                    <?php
                    if(isset($details['month_from'])){
                        $monthNum = $details['month_from'];
                        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                        $monthFrom = $dateObj->format('F');
                    }
                    if(isset($details['month_to'])){
                        $monthNumto = $details['month_to'];
                        $dateObjto   = DateTime::createFromFormat('!m', $monthNumto);
                        $monthTo = $dateObjto->format('F');
                    }
                   
                    ?>
                    <th colspan=2><?php echo isset($monthFrom) ? $monthFrom : '' ?> - <?php echo isset($monthTo) ? $monthTo : '' ?>, <?php echo isset($details['year']) ? $details['year'] : '' ?></th>
                    <th></th>
                </tr>
                <tr>
                    <?php
                    if(isset($details['report']) && isset($details['category']) && isset($details['year']) && isset($details['class']) && isset($details['month_from']) && isset($details['month_to']) ){
                        if($details['report'] ==  "fp"){
                            echo"
                            <th scope='col'>Region Office</th>
                            <th scope='col'>Target Obligation as of this Month</th>
                            <th scope='col'>Actual Obligation as of this Month</th>
                            <th scope='col'>Target</th>
                            <th scope='col'>Accomplishment</th>
                            <th scope='col'>Actual Disbursements as of this Month</th>
                            ";      
                        }elseif($details['report'] ==  "ut"){
                            echo"
                            <th scope='col'>Region Office</th>
                            <th scope='col'>Total Allotment</th>
                            <th scope='col'>Actual Obligation as of this Month</th>
                            <th scope='col'>Balance in Allotment</th>
                            <th scope='col'>Utilization</th>
                            <th scope='col'>Actual Disbursements as of this Month</th>
                            "; 
                        }
                    }
                    ?>
                </tr>
            </thead>
            <tbody>  
            <?php
             if(isset($details['report']) && isset($details['category']) && isset($details['year']) && isset($details['class']) && isset($details['month_from']) && isset($details['month_to']) ){
                $monthFrom = intval($details['month_from']) -1;
                $monthTo = intval($details['month_to']) -1;
    
                $regions = array("CO","NCR","R1","CAR","ARMM","R2","R3","R4A","R4B","R5","R6","R7","R8","R9","R10","R11","R12","R13");
                for ($r = 0; $r <= 17; $r++) {
                    $region = $regions[$r];

                    //fp
                    $tarOblThis_total = 0;
                    $actOblThis_total = 0;
                    $actDisThis_total = 0;
                    $target = 0;
                    $accom = 0;

                    //uti
                    $totalAll = 0;
                    $actOblThis_total_ut = 0;
                    $balanceAll = 0;
                    $actDisThis_total_ut = 0;
                    $utilization = 0;
                
                    foreach($allotment_amt_all as $aa){
                        //Financial Performance
                        if($details['report'] ==  "fp"){
                            if ($details['category'] == $aa['all_category']){
                                if($details['year'] == $aa['all_year']){
                                    if($details['class'] == $aa['all_class']){
                                        if($aa['all_region'] == $region){
                                            $month = array(floatval(str_replace(",","",$aa['amt_jan'])), 
                                            floatval(str_replace(",","",$aa['amt_feb'])),
                                            floatval(str_replace(",","",$aa['amt_mar'])),
                                            floatval(str_replace(",","",$aa['amt_apr'])),
                                            floatval(str_replace(",","",$aa['amt_may'])),
                                            floatval(str_replace(",","",$aa['amt_jun'])),
                                            floatval(str_replace(",","",$aa['amt_jul'])),
                                            floatval(str_replace(",","",$aa['amt_aug'])),
                                            floatval(str_replace(",","",$aa['amt_sep'])),
                                            floatval(str_replace(",","",$aa['amt_oct'])),
                                            floatval(str_replace(",","",$aa['amt_nov'])),
                                            floatval(str_replace(",","",$aa['amt_dec']))
                                            );

                                            // Target Obligation as of this Month
                                            for ($i = $monthFrom; $i <= $monthTo; $i++) {
                                                $tarOblThis_total += $month[$i];   
                                            }

                                
                                            // Actual Obligation as of this Month
                                            foreach($obligation as $ob){
                                                if($aa['amt_id'] == $ob['ob_amt_id']){
                                                    
                                                    $myMonth = intval($ob['ob_month']) -1;

                                                    if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                        $actOblThis_total += floatval(str_replace(",","",$ob['ob_amount']));
                                                    }
                                                }
                                            }

                                            // Actual Disbursements as of this Month
                                            foreach($disbursements as $ds){
                                                if($aa['amt_id'] == $ds['dis_amt_id']){
                                                    
                                                    $myMonth = intval($ds['dis_month']) -1;

                                                    if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                        $actDisThis_total += floatval(str_replace(",","",$ds['dis_amount']));
                                                    }
                                                }
                                            }

                                            //Target
                                            for ($i = 0; $i <= 11; $i++) {
                                                $target += $month[$i];   
                                            }
                                        }
                                    }elseif($details['class'] == 'psnmonco'){
                                        // PS + MO + CO
                                        if($aa['all_class'] == 'ps' || $aa['all_class'] == 'mo' || $aa['all_class'] == 'co'){
                                            if($aa['all_region'] == $region){
                                                $month = array(floatval(str_replace(",","",$aa['amt_jan'])), 
                                                floatval(str_replace(",","",$aa['amt_feb'])),
                                                floatval(str_replace(",","",$aa['amt_mar'])),
                                                floatval(str_replace(",","",$aa['amt_apr'])),
                                                floatval(str_replace(",","",$aa['amt_may'])),
                                                floatval(str_replace(",","",$aa['amt_jun'])),
                                                floatval(str_replace(",","",$aa['amt_jul'])),
                                                floatval(str_replace(",","",$aa['amt_aug'])),
                                                floatval(str_replace(",","",$aa['amt_sep'])),
                                                floatval(str_replace(",","",$aa['amt_oct'])),
                                                floatval(str_replace(",","",$aa['amt_nov'])),
                                                floatval(str_replace(",","",$aa['amt_dec']))
                                                );
        
                                                // Target Obligation as of this Month
                                                for ($i = $monthFrom; $i <= $monthTo; $i++) {
                                                    $tarOblThis_total += $month[$i];   
                                                }
        
                                    
                                                // Actual Obligation as of this Month
                                                foreach($obligation as $ob){
                                                    if($aa['amt_id'] == $ob['ob_amt_id']){
                                                        
                                                        $myMonth = intval($ob['ob_month']) -1;
        
                                                        if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                            $actOblThis_total += floatval(str_replace(",","",$ob['ob_amount']));
                                                        }
                                                    }
                                                }
        
                                                // Actual Disbursements as of this Month
                                                foreach($disbursements as $ds){
                                                    if($aa['amt_id'] == $ds['dis_amt_id']){
                                                        
                                                        $myMonth = intval($ds['dis_month']) -1;
        
                                                        if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                            $actDisThis_total += floatval(str_replace(",","",$ds['dis_amount']));
                                                        }
                                                    }
                                                }
        
                                                //Target
                                                for ($i = 0; $i <= 11; $i++) {
                                                    $target += $month[$i];   
                                                }
                                            }
                                        }
                                    }elseif($details['class'] == 'monco'){
                                        // PS + MO + CO
                                        if($aa['all_class'] == 'mo' || $aa['all_class'] == 'co'){
                                            if($aa['all_region'] == $region){
                                                $month = array(floatval(str_replace(",","",$aa['amt_jan'])), 
                                                floatval(str_replace(",","",$aa['amt_feb'])),
                                                floatval(str_replace(",","",$aa['amt_mar'])),
                                                floatval(str_replace(",","",$aa['amt_apr'])),
                                                floatval(str_replace(",","",$aa['amt_may'])),
                                                floatval(str_replace(",","",$aa['amt_jun'])),
                                                floatval(str_replace(",","",$aa['amt_jul'])),
                                                floatval(str_replace(",","",$aa['amt_aug'])),
                                                floatval(str_replace(",","",$aa['amt_sep'])),
                                                floatval(str_replace(",","",$aa['amt_oct'])),
                                                floatval(str_replace(",","",$aa['amt_nov'])),
                                                floatval(str_replace(",","",$aa['amt_dec']))
                                                );
        
                                                // Target Obligation as of this Month
                                                for ($i = $monthFrom; $i <= $monthTo; $i++) {
                                                    $tarOblThis_total += $month[$i];   
                                                }
        
                                    
                                                // Actual Obligation as of this Month
                                                foreach($obligation as $ob){
                                                    if($aa['amt_id'] == $ob['ob_amt_id']){
                                                        
                                                        $myMonth = intval($ob['ob_month']) -1;
        
                                                        if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                            $actOblThis_total += floatval(str_replace(",","",$ob['ob_amount']));
                                                        }
                                                    }
                                                }
        
                                                // Actual Disbursements as of this Month
                                                foreach($disbursements as $ds){
                                                    if($aa['amt_id'] == $ds['dis_amt_id']){
                                                        
                                                        $myMonth = intval($ds['dis_month']) -1;
        
                                                        if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                            $actDisThis_total += floatval(str_replace(",","",$ds['dis_amount']));
                                                        }
                                                    }
                                                }
        
                                                //Target
                                                for ($i = 0; $i <= 11; $i++) {
                                                    $target += $month[$i];   
                                                }
                                            }
                                        }
                                    }
                                }
                            }elseif($details['category'] == 'cunca'){
                                // Current + Continuing 
                                if ($aa['all_category'] == 'cu' || $aa['all_category'] == 'ca'){
                                    if($details['year'] == $aa['all_year']){
                                        if($details['class'] == $aa['all_class']){
                                            if($aa['all_region'] == $region){
                                                $month = array(floatval(str_replace(",","",$aa['amt_jan'])), 
                                                floatval(str_replace(",","",$aa['amt_feb'])),
                                                floatval(str_replace(",","",$aa['amt_mar'])),
                                                floatval(str_replace(",","",$aa['amt_apr'])),
                                                floatval(str_replace(",","",$aa['amt_may'])),
                                                floatval(str_replace(",","",$aa['amt_jun'])),
                                                floatval(str_replace(",","",$aa['amt_jul'])),
                                                floatval(str_replace(",","",$aa['amt_aug'])),
                                                floatval(str_replace(",","",$aa['amt_sep'])),
                                                floatval(str_replace(",","",$aa['amt_oct'])),
                                                floatval(str_replace(",","",$aa['amt_nov'])),
                                                floatval(str_replace(",","",$aa['amt_dec']))
                                                );

                                                // Target Obligation as of this Month
                                                for ($i = $monthFrom; $i <= $monthTo; $i++) {
                                                    $tarOblThis_total += $month[$i];   
                                                }

                                    
                                                // Actual Obligation as of this Month
                                                foreach($obligation as $ob){
                                                    if($aa['amt_id'] == $ob['ob_amt_id']){
                                                        
                                                        $myMonth = intval($ob['ob_month']) -1;

                                                        if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                            $actOblThis_total += floatval(str_replace(",","",$ob['ob_amount']));
                                                        }
                                                    }
                                                }

                                                // Actual Disbursements as of this Month
                                                foreach($disbursements as $ds){
                                                    if($aa['amt_id'] == $ds['dis_amt_id']){
                                                        
                                                        $myMonth = intval($ds['dis_month']) -1;

                                                        if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                            $actDisThis_total += floatval(str_replace(",","",$ds['dis_amount']));
                                                        }
                                                    }
                                                }

                                                //Target
                                                for ($i = 0; $i <= 11; $i++) {
                                                    $target += $month[$i];   
                                                }
                                            }
                                        }elseif($details['class'] == 'psnmonco'){
                                            // PS + MO + CO
                                            if($aa['all_class'] == 'ps' || $aa['all_class'] == 'mo' || $aa['all_class'] == 'co'){
                                                if($aa['all_region'] == $region){
                                                    $month = array(floatval(str_replace(",","",$aa['amt_jan'])), 
                                                    floatval(str_replace(",","",$aa['amt_feb'])),
                                                    floatval(str_replace(",","",$aa['amt_mar'])),
                                                    floatval(str_replace(",","",$aa['amt_apr'])),
                                                    floatval(str_replace(",","",$aa['amt_may'])),
                                                    floatval(str_replace(",","",$aa['amt_jun'])),
                                                    floatval(str_replace(",","",$aa['amt_jul'])),
                                                    floatval(str_replace(",","",$aa['amt_aug'])),
                                                    floatval(str_replace(",","",$aa['amt_sep'])),
                                                    floatval(str_replace(",","",$aa['amt_oct'])),
                                                    floatval(str_replace(",","",$aa['amt_nov'])),
                                                    floatval(str_replace(",","",$aa['amt_dec']))
                                                    );
            
                                                    // Target Obligation as of this Month
                                                    for ($i = $monthFrom; $i <= $monthTo; $i++) {
                                                        $tarOblThis_total += $month[$i];   
                                                    }
            
                                        
                                                    // Actual Obligation as of this Month
                                                    foreach($obligation as $ob){
                                                        if($aa['amt_id'] == $ob['ob_amt_id']){
                                                            
                                                            $myMonth = intval($ob['ob_month']) -1;
            
                                                            if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                                $actOblThis_total += floatval(str_replace(",","",$ob['ob_amount']));
                                                            }
                                                        }
                                                    }
            
                                                    // Actual Disbursements as of this Month
                                                    foreach($disbursements as $ds){
                                                        if($aa['amt_id'] == $ds['dis_amt_id']){
                                                            
                                                            $myMonth = intval($ds['dis_month']) -1;
            
                                                            if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                                $actDisThis_total += floatval(str_replace(",","",$ds['dis_amount']));
                                                            }
                                                        }
                                                    }
            
                                                    //Target
                                                    for ($i = 0; $i <= 11; $i++) {
                                                        $target += $month[$i];   
                                                    }
                                                }
                                            }
                                        }elseif($details['class'] == 'monco'){
                                            // PS + MO + CO
                                            if($aa['all_class'] == 'mo' || $aa['all_class'] == 'co'){
                                                if($aa['all_region'] == $region){
                                                    $month = array(floatval(str_replace(",","",$aa['amt_jan'])), 
                                                    floatval(str_replace(",","",$aa['amt_feb'])),
                                                    floatval(str_replace(",","",$aa['amt_mar'])),
                                                    floatval(str_replace(",","",$aa['amt_apr'])),
                                                    floatval(str_replace(",","",$aa['amt_may'])),
                                                    floatval(str_replace(",","",$aa['amt_jun'])),
                                                    floatval(str_replace(",","",$aa['amt_jul'])),
                                                    floatval(str_replace(",","",$aa['amt_aug'])),
                                                    floatval(str_replace(",","",$aa['amt_sep'])),
                                                    floatval(str_replace(",","",$aa['amt_oct'])),
                                                    floatval(str_replace(",","",$aa['amt_nov'])),
                                                    floatval(str_replace(",","",$aa['amt_dec']))
                                                    );
            
                                                    // Target Obligation as of this Month
                                                    for ($i = $monthFrom; $i <= $monthTo; $i++) {
                                                        $tarOblThis_total += $month[$i];   
                                                    }
            
                                        
                                                    // Actual Obligation as of this Month
                                                    foreach($obligation as $ob){
                                                        if($aa['amt_id'] == $ob['ob_amt_id']){
                                                            
                                                            $myMonth = intval($ob['ob_month']) -1;
            
                                                            if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                                $actOblThis_total += floatval(str_replace(",","",$ob['ob_amount']));
                                                            }
                                                        }
                                                    }
            
                                                    // Actual Disbursements as of this Month
                                                    foreach($disbursements as $ds){
                                                        if($aa['amt_id'] == $ds['dis_amt_id']){
                                                            
                                                            $myMonth = intval($ds['dis_month']) -1;
            
                                                            if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                                $actDisThis_total += floatval(str_replace(",","",$ds['dis_amount']));
                                                            }
                                                        }
                                                    }
            
                                                    //Target
                                                    for ($i = 0; $i <= 11; $i++) {
                                                        $target += $month[$i];   
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }   
                            }
                        //Utilization
                        }elseif($details['report'] ==  "ut"){
                            if ($details['category'] == $aa['all_category']){
                                if($details['year'] == $aa['all_year']){
                                    if($details['class'] == $aa['all_class']){
                                        if($aa['all_region'] == $region){
                                            $month = array(floatval(str_replace(",","",$aa['amt_jan'])), 
                                            floatval(str_replace(",","",$aa['amt_feb'])),
                                            floatval(str_replace(",","",$aa['amt_mar'])),
                                            floatval(str_replace(",","",$aa['amt_apr'])),
                                            floatval(str_replace(",","",$aa['amt_may'])),
                                            floatval(str_replace(",","",$aa['amt_jun'])),
                                            floatval(str_replace(",","",$aa['amt_jul'])),
                                            floatval(str_replace(",","",$aa['amt_aug'])),
                                            floatval(str_replace(",","",$aa['amt_sep'])),
                                            floatval(str_replace(",","",$aa['amt_oct'])),
                                            floatval(str_replace(",","",$aa['amt_nov'])),
                                            floatval(str_replace(",","",$aa['amt_dec']))
                                            );

                                            //Target
                                            for ($i = 0; $i <= 11; $i++) {
                                                $totalAll += $month[$i];   
                                            }

                                            // Actual Obligation as of this Month
                                            foreach($obligation as $ob){
                                                if($aa['amt_id'] == $ob['ob_amt_id']){
                                                    
                                                    $myMonth = intval($ob['ob_month']) -1;
    
                                                    if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                        $actOblThis_total_ut += floatval(str_replace(",","",$ob['ob_amount']));
                                                    }
                                                }
                                            }

                                             // Actual Disbursements as of this Month
                                             foreach($disbursements as $ds){
                                                if($aa['amt_id'] == $ds['dis_amt_id']){
                                                    
                                                    $myMonth = intval($ds['dis_month']) -1;
    
                                                    if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                        $actDisThis_total_ut += floatval(str_replace(",","",$ds['dis_amount']));
                                                    }
                                                }
                                            }
                                        }
                                    }elseif($details['class'] == 'psnmonco'){
                                        // PS + MO + CO
                                        if($aa['all_class'] == 'ps' || $aa['all_class'] == 'mo' || $aa['all_class'] == 'co'){
                                            if($aa['all_region'] == $region){
                                                $month = array(floatval(str_replace(",","",$aa['amt_jan'])), 
                                                floatval(str_replace(",","",$aa['amt_feb'])),
                                                floatval(str_replace(",","",$aa['amt_mar'])),
                                                floatval(str_replace(",","",$aa['amt_apr'])),
                                                floatval(str_replace(",","",$aa['amt_may'])),
                                                floatval(str_replace(",","",$aa['amt_jun'])),
                                                floatval(str_replace(",","",$aa['amt_jul'])),
                                                floatval(str_replace(",","",$aa['amt_aug'])),
                                                floatval(str_replace(",","",$aa['amt_sep'])),
                                                floatval(str_replace(",","",$aa['amt_oct'])),
                                                floatval(str_replace(",","",$aa['amt_nov'])),
                                                floatval(str_replace(",","",$aa['amt_dec']))
                                                );
    
                                                //Target
                                                for ($i = 0; $i <= 11; $i++) {
                                                    $totalAll += $month[$i];   
                                                }
    
                                                // Actual Obligation as of this Month
                                                foreach($obligation as $ob){
                                                    if($aa['amt_id'] == $ob['ob_amt_id']){
                                                        
                                                        $myMonth = intval($ob['ob_month']) -1;
        
                                                        if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                            $actOblThis_total_ut += floatval(str_replace(",","",$ob['ob_amount']));
                                                        }
                                                    }
                                                }
    
                                                 // Actual Disbursements as of this Month
                                                 foreach($disbursements as $ds){
                                                    if($aa['amt_id'] == $ds['dis_amt_id']){
                                                        
                                                        $myMonth = intval($ds['dis_month']) -1;
        
                                                        if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                            $actDisThis_total_ut += floatval(str_replace(",","",$ds['dis_amount']));
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }elseif($details['class'] == 'monco'){
                                        // PS + MO + CO
                                        if($aa['all_class'] == 'mo' || $aa['all_class'] == 'co'){
                                            if($aa['all_region'] == $region){
                                                $month = array(floatval(str_replace(",","",$aa['amt_jan'])), 
                                                floatval(str_replace(",","",$aa['amt_feb'])),
                                                floatval(str_replace(",","",$aa['amt_mar'])),
                                                floatval(str_replace(",","",$aa['amt_apr'])),
                                                floatval(str_replace(",","",$aa['amt_may'])),
                                                floatval(str_replace(",","",$aa['amt_jun'])),
                                                floatval(str_replace(",","",$aa['amt_jul'])),
                                                floatval(str_replace(",","",$aa['amt_aug'])),
                                                floatval(str_replace(",","",$aa['amt_sep'])),
                                                floatval(str_replace(",","",$aa['amt_oct'])),
                                                floatval(str_replace(",","",$aa['amt_nov'])),
                                                floatval(str_replace(",","",$aa['amt_dec']))
                                                );
    
                                                //Target
                                                for ($i = 0; $i <= 11; $i++) {
                                                    $totalAll += $month[$i];   
                                                }
    
                                                // Actual Obligation as of this Month
                                                foreach($obligation as $ob){
                                                    if($aa['amt_id'] == $ob['ob_amt_id']){
                                                        
                                                        $myMonth = intval($ob['ob_month']) -1;
        
                                                        if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                            $actOblThis_total_ut += floatval(str_replace(",","",$ob['ob_amount']));
                                                        }
                                                    }
                                                }
    
                                                 // Actual Disbursements as of this Month
                                                 foreach($disbursements as $ds){
                                                    if($aa['amt_id'] == $ds['dis_amt_id']){
                                                        
                                                        $myMonth = intval($ds['dis_month']) -1;
        
                                                        if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                            $actDisThis_total_ut += floatval(str_replace(",","",$ds['dis_amount']));
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }elseif($details['category'] == 'cunca'){
                                // Current + Continuing 
                                if ($aa['all_category'] == 'cu' || $aa['all_category'] == 'ca'){
                                    if($details['year'] == $aa['all_year']){
                                        if($details['class'] == $aa['all_class']){
                                            if($aa['all_region'] == $region){
                                                $month = array(floatval(str_replace(",","",$aa['amt_jan'])), 
                                                floatval(str_replace(",","",$aa['amt_feb'])),
                                                floatval(str_replace(",","",$aa['amt_mar'])),
                                                floatval(str_replace(",","",$aa['amt_apr'])),
                                                floatval(str_replace(",","",$aa['amt_may'])),
                                                floatval(str_replace(",","",$aa['amt_jun'])),
                                                floatval(str_replace(",","",$aa['amt_jul'])),
                                                floatval(str_replace(",","",$aa['amt_aug'])),
                                                floatval(str_replace(",","",$aa['amt_sep'])),
                                                floatval(str_replace(",","",$aa['amt_oct'])),
                                                floatval(str_replace(",","",$aa['amt_nov'])),
                                                floatval(str_replace(",","",$aa['amt_dec']))
                                                );
    
                                                //Target
                                                for ($i = 0; $i <= 11; $i++) {
                                                    $totalAll += $month[$i];   
                                                }
    
                                                // Actual Obligation as of this Month
                                                foreach($obligation as $ob){
                                                    if($aa['amt_id'] == $ob['ob_amt_id']){
                                                        
                                                        $myMonth = intval($ob['ob_month']) -1;
        
                                                        if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                            $actOblThis_total_ut += floatval(str_replace(",","",$ob['ob_amount']));
                                                        }
                                                    }
                                                }
    
                                                 // Actual Disbursements as of this Month
                                                 foreach($disbursements as $ds){
                                                    if($aa['amt_id'] == $ds['dis_amt_id']){
                                                        
                                                        $myMonth = intval($ds['dis_month']) -1;
        
                                                        if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                            $actDisThis_total_ut += floatval(str_replace(",","",$ds['dis_amount']));
                                                        }
                                                    }
                                                }
                                            }
                                        }elseif($details['class'] == 'psnmonco'){
                                            // PS + MO + CO
                                            if($aa['all_class'] == 'ps' || $aa['all_class'] == 'mo' || $aa['all_class'] == 'co'){
                                                if($aa['all_region'] == $region){
                                                    $month = array(floatval(str_replace(",","",$aa['amt_jan'])), 
                                                    floatval(str_replace(",","",$aa['amt_feb'])),
                                                    floatval(str_replace(",","",$aa['amt_mar'])),
                                                    floatval(str_replace(",","",$aa['amt_apr'])),
                                                    floatval(str_replace(",","",$aa['amt_may'])),
                                                    floatval(str_replace(",","",$aa['amt_jun'])),
                                                    floatval(str_replace(",","",$aa['amt_jul'])),
                                                    floatval(str_replace(",","",$aa['amt_aug'])),
                                                    floatval(str_replace(",","",$aa['amt_sep'])),
                                                    floatval(str_replace(",","",$aa['amt_oct'])),
                                                    floatval(str_replace(",","",$aa['amt_nov'])),
                                                    floatval(str_replace(",","",$aa['amt_dec']))
                                                    );
        
                                                    //Target
                                                    for ($i = 0; $i <= 11; $i++) {
                                                        $totalAll += $month[$i];   
                                                    }
        
                                                    // Actual Obligation as of this Month
                                                    foreach($obligation as $ob){
                                                        if($aa['amt_id'] == $ob['ob_amt_id']){
                                                            
                                                            $myMonth = intval($ob['ob_month']) -1;
            
                                                            if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                                $actOblThis_total_ut += floatval(str_replace(",","",$ob['ob_amount']));
                                                            }
                                                        }
                                                    }
        
                                                     // Actual Disbursements as of this Month
                                                     foreach($disbursements as $ds){
                                                        if($aa['amt_id'] == $ds['dis_amt_id']){
                                                            
                                                            $myMonth = intval($ds['dis_month']) -1;
            
                                                            if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                                $actDisThis_total_ut += floatval(str_replace(",","",$ds['dis_amount']));
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }elseif($details['class'] == 'monco'){
                                            // PS + MO + CO
                                            if($aa['all_class'] == 'mo' || $aa['all_class'] == 'co'){
                                                if($aa['all_region'] == $region){
                                                    $month = array(floatval(str_replace(",","",$aa['amt_jan'])), 
                                                    floatval(str_replace(",","",$aa['amt_feb'])),
                                                    floatval(str_replace(",","",$aa['amt_mar'])),
                                                    floatval(str_replace(",","",$aa['amt_apr'])),
                                                    floatval(str_replace(",","",$aa['amt_may'])),
                                                    floatval(str_replace(",","",$aa['amt_jun'])),
                                                    floatval(str_replace(",","",$aa['amt_jul'])),
                                                    floatval(str_replace(",","",$aa['amt_aug'])),
                                                    floatval(str_replace(",","",$aa['amt_sep'])),
                                                    floatval(str_replace(",","",$aa['amt_oct'])),
                                                    floatval(str_replace(",","",$aa['amt_nov'])),
                                                    floatval(str_replace(",","",$aa['amt_dec']))
                                                    );
        
                                                    //Target
                                                    for ($i = 0; $i <= 11; $i++) {
                                                        $totalAll += $month[$i];   
                                                    }
        
                                                    // Actual Obligation as of this Month
                                                    foreach($obligation as $ob){
                                                        if($aa['amt_id'] == $ob['ob_amt_id']){
                                                            
                                                            $myMonth = intval($ob['ob_month']) -1;
            
                                                            if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                                $actOblThis_total_ut += floatval(str_replace(",","",$ob['ob_amount']));
                                                            }
                                                        }
                                                    }
        
                                                     // Actual Disbursements as of this Month
                                                     foreach($disbursements as $ds){
                                                        if($aa['amt_id'] == $ds['dis_amt_id']){
                                                            
                                                            $myMonth = intval($ds['dis_month']) -1;
            
                                                            if ($myMonth >= $monthFrom && $myMonth <= $monthTo){
                                                                $actDisThis_total_ut += floatval(str_replace(",","",$ds['dis_amount']));
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                   //SP
                   if($details['report'] ==  "sp"){
                        //Target
                        if($tarOblThis_total > 0 && $target >0){
                            $target = ($tarOblThis_total/$target) * 100;
                        }
                        $target = intval($target);

                        //Accomplishment
                        if($actOblThis_total > 0 && $tarOblThis_total >0){
                            $accom = ($actOblThis_total/$tarOblThis_total) * 100;
                        }
                        $accom = intval($accom); 
                        
                        // thousand separator
                        $tarOblThis_total = number_format($tarOblThis_total,2);
                        $actOblThis_total = number_format($actOblThis_total,2);
                        $actDisThis_total = number_format($actDisThis_total,2);

                        echo"
                                
                            <tr>
                                <td>$region</td>
                                <td>$tarOblThis_total</td>
                                <td>$actOblThis_total</td>
                                <td>$target%</td>
                                <td>$accom%</td>
                                <td>$actDisThis_total</td>
                            </tr>
                            
                        ";
                    //UT
                    }elseif($details['report'] ==  "ut"){

                         //utilization
                         if($actOblThis_total_ut > 0 && $totalAll >0){
                            $utilization = ($actOblThis_total_ut/$totalAll) * 100;
                        }
                        $utilization = intval($utilization);

                        // balanceAll
                        $balanceAll = $totalAll-$actOblThis_total_ut;

                        // thousand separator
                        $totalAll = number_format($totalAll,2);
                        $actOblThis_total_ut = number_format($actOblThis_total_ut,2);
                        $balanceAll = number_format($balanceAll,2);
                        $actDisThis_total_ut = number_format($actDisThis_total_ut,2);

                        echo"
                                
                        <tr>
                            <td>$region</td>
                            <td>$totalAll</td>
                            <td>$actOblThis_total_ut</td>
                            <td>$balanceAll</td>
                            <td>$utilization%</td>
                            <td>$actDisThis_total_ut</td>
                        </tr>
                        
                    ";
                    }
                }
               
                
    
             }
           
            ?>
            </tbody>
           
        </table>
    </div>

</div>