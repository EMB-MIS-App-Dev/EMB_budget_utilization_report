<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class='successmsg'>
        <?php if($this->session->flashdata('successmsg')): ?> 
            <p><?php echo $this->session->flashdata('successmsg'); ?></p>
        <?php endif; ?>
    </div>
    <div>
        <a class="btn btn-info create-btn" href="<?php echo base_url()."obligation"; ?>">Back</a>
    </div>
    <?php foreach($allotments as $allotment){
        $region = $allotment['all_region'];
        $year = $allotment['all_year'];
        $category = $allotment['all_category'];
        $type = $allotment['all_type'];
        $funding = $allotment['all_funding'];
            if($funding == 'or' || $funding == 'sa'){
                $all_saa_no = $allotment['all_saa_no'];
                $all_saa_desc = $allotment['all_saa_desc'];
            }
        $class = $allotment['all_class'];

    }
    ?>
    <div class="form-group-create">
        <p><b><?php echo 'Region '.$region ?></b></p>    
        <p><?php echo 'For year '.$year ?></p>
        <?php
            if($category == 'cu'){
                echo"<p>Current</p>";
            }else if($category == 'ca'){
                echo"<p>Continuing Appropriation</p>";
            }else if($category == 'aa'){
                echo"<p>Automatic Appropriation</p>";
            }

            if($type == 'sb'){
                echo"<p>Specific Budget</p>";
            }else if($type == 'sp'){
                echo"<p>Special Purpose Fund</p>";
            }else if($type == 'rlip'){
                echo"<p>RLIP</p>";
            }

            if($funding == 'as'){
                echo"<p>Agency Specific</p>";
            }else if($funding == 'or'){
                echo"<p>Other Releases</p>";
                echo"<p>No: $all_saa_no</p>";
                echo"<p>Description: $all_saa_desc</p>";
            }else if($funding == 'sa'){
                echo"<p>SAA</p>";
                echo"<p>No: $all_saa_no</p>";
                echo"<p>Description: $all_saa_desc</p>";
            }
        ?>

        <p><?php echo strtoupper($class); ?></p>

    </div>


    <table id="myTable" class="table table-striped table-bordered table-sm align">
    <!-- <table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"> -->
    <div class="col-sm-4" >
        <thead>
            <tr>
                <th scope="col">Program</th>
                <th scope="col">Allotment</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody> 
            <?php foreach($allotment_amount as $am){
                $sp_name = $am['sp_name'];
                $amt_id = $am['amt_id'];
                
                $jan = str_replace(",","", $am['amt_jan']);
                $feb = str_replace(",","", $am['amt_feb']);
                $mar = str_replace(",","", $am['amt_mar']);
                $apr = str_replace(",","", $am['amt_apr']);
                $may = str_replace(",","", $am['amt_may']);
                $jun = str_replace(",","", $am['amt_jun']);
                $jul = str_replace(",","", $am['amt_jul']);
                $aug = str_replace(",","", $am['amt_aug']);
                $sep = str_replace(",","", $am['amt_sep']);
                $oct = str_replace(",","", $am['amt_oct']);
                $nov = str_replace(",","", $am['amt_nov']);
                $dec = str_replace(",","", $am['amt_dec']);
                $total_all = (float)$jan + (float)$feb + (float)$mar +
                            (float)$apr + (float)$may + (float)$jun +
                            (float)$jul + (float)$aug + (float)$sep +
                            (float)$oct + (float)$nov + (float)$dec;

                $total_all = number_format($total_all,2);
                echo"
                <tr class='table-active'> 
                    <td>$sp_name</td>
                    <td>$total_all</td>
                    <td>
                        <a href='obligation/edit/$amt_id'><i class='fa fa-plus' style='font-size:24px; color:green'></i></a>
                    </td>
                </tr>  
                "; 
            } 
            ?>
        
        </tbody>
    </table>
   
    </div>
<!-- /.content-wrapper -->

