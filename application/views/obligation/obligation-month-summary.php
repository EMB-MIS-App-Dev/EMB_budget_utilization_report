
<style>
table {
    border-collapse: collapse;

    margin-left: auto;
    margin-right: auto;
}

/* table, td, th {
    border: 1px solid black;
    border-collapse: collapse;
} */

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

   
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
    <div style="text-align: center">
        <p><b><?php echo 'Region '.$region ?></b></p>    
        <p><?php echo 'For year '.$year ?></p>
        <?php
            if($category == 'cu'){
                echo"<p style='color:blue;'><i>Current</i></p>";
            }else if($category == 'ca'){
                echo"<p style='color:blue;'><i>Continuing Appropriation</i></p>";
            }else if($category == 'aa'){
                echo"<p style='color:blue;'><i>Automatic Appropriation</i></p>";
            }
        ?>
    </div>

    <table border=1>
    <tr>
        <td><b>Type : </b></td>
        <td>
            <?php
                if($type == 'sb'){
                    echo"Specific Budget";
                }else if($type == 'sp'){
                    echo"Special Purpose Fund";
                }else if($type == 'rlip'){
                    echo"RLIP";
                }
            ?>
        </td>
    </tr>
    <tr>
        <td><b>Funding : </b></td>
        <td>
            <?php
                if($funding == 'as'){
                    echo"Agency Specific";
                }else if($funding == 'or'){
                    echo"Other Releases";
                    echo"<br/>No: $all_saa_no";
                    echo"<br/>Description: $all_saa_desc";
                }else if($funding == 'sa'){
                    echo"SAA";
                    echo"<br/>No: $all_saa_no";
                    echo"<br/>Description: $all_saa_desc";
                }
            ?>
        </td>
    </tr>
    <tr>
        <td><b>Allotment Class : </b></td>
        <td><?php echo strtoupper($class); ?></td>
    </tr>
    </table>
    

    <?php 
        foreach($main_pap as $mp){
            $mp_id = $mp['mp_id'];
            $mp_code = $mp['mp_code'];
            $mp_name = $mp['mp_name'];

            echo"
            <div class='col-sm-12'>
                <h5 style='margin-top: 20px; text-align:center'>$mp_code - $mp_name</h5>
            </div>


            <table border=1>
            ";

            
            foreach($allotment_amount as $am){
                $sp_name = $am['sp_name'];
                $amt_id = $am['amt_id'];
                $sp_mp_id = $am['sp_mp_id'];
                $amt_all_id = $am['amt_all_id'];
                
                $jan = str_replace(',','', $am['amt_jan']);
                $feb = str_replace(',','', $am['amt_feb']);
                $mar = str_replace(',','', $am['amt_mar']);
                $apr = str_replace(',','', $am['amt_apr']);
                $may = str_replace(',','', $am['amt_may']);
                $jun = str_replace(',','', $am['amt_jun']);
                $jul = str_replace(',','', $am['amt_jul']);
                $aug = str_replace(',','', $am['amt_aug']);
                $sep = str_replace(',','', $am['amt_sep']);
                $oct = str_replace(',','', $am['amt_oct']);
                $nov = str_replace(',','', $am['amt_nov']);
                $dec = str_replace(',','', $am['amt_dec']);
                $total_all = (float)$jan + (float)$feb + (float)$mar +
                            (float)$apr + (float)$may + (float)$jun +
                            (float)$jul + (float)$aug + (float)$sep +
                            (float)$oct + (float)$nov + (float)$dec;

                $total_all = number_format($total_all,2);

                if( $mp_id == $sp_mp_id){
                
                    echo"
                    <tr>
                        <td colspan=5><b>$sp_name</b></td>
                        <td><input type='hidden' name='amt_id' value='$amt_id'></td>
                        <td><input type='hidden' name='amt_all_id' value='$amt_all_id'></td>
                    </tr>
                    <tr>
                        <td align=center>Allotment</td>
                        <td align=center>Obligation as of the<br/>Previous Month</td>
                        <td align=center>Obligation for<br/>This Month</td>
                        <td align=center>Balance in<br/>Allotment</td>
                        <td align=center>Utilization</td>
                    </tr>
                    <tr>
                        <td align=center><input style='background-color:#ECECEC' placeholder='0000' name='allotment-$amt_id' id='allotment-$amt_id' value='$total_all' readonly></td>
                        <td align=center><input style='background-color:#ECECEC' placeholder='0000' name='oblPre-$amt_id' id='oblPre-$amt_id' readonly></td>
                        <td align=center><input step='0.01' placeholder='UNDER MAINTENANCE' class='number' name='obligation-amount-$amt_id' id='obligation-amount-$amt_id'></td>
                        <td align=center><input style='background-color:#ECECEC' placeholder='0000' name='balAll-$amt_id' id='balAll-$amt_id' readonly></td>
                        <td align=center><input style='background-color:#ECECEC' placeholder='0000' name='uti-$amt_id' id='uti-$amt_id' readonly></td>
                    </tr>
                    ";

                }

            };

            echo "</table>";

        };
        ?>
</div>