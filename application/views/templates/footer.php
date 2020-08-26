
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
        Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
    </div>
    <!-- ./wrapper -->
   
   <!-- DataTable -->
   <script>
     
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#myTable thead tr').clone(true).appendTo( '#myTable thead' );
            $('#myTable thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        
                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        
            var table = $('#myTable').DataTable( {
                orderCellsTop: true,
                fixedHeader: true
            } );
        } );
   </script>

<!---------------------CURRENT--------------------->
   <!-- Show Ref Num and Particulars in Funding Select -->
    <script>
    $(document).ready(function(){
        $("#sub_pap_as").hide();
        $("#sub_pap_other").hide();
        $("#sub_pap_saa").hide();
        
        $("#source").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue === "SAA"){
                    $("#saa_no_label").show();
                    $("#saa_no_value").show();
                    $("#saa_desc_pad").show();
                    $("#saa_desc_label").show();
                    $("#saa_desc_value").show();
                    $("#saa_no_pad").hide();
                } else{
                    $("#saa_no_label").hide();
                    $("#saa_no_value").hide();
                    $("#saa_desc_pad").hide();
                    $("#saa_desc_label").hide();
                    $("#saa_desc_value").hide();
                    $("#saa_no_pad").show();
                }

                if(optionValue === "AS"){
                    $("#sub_pap_as").show();
                    $("#sub_pap_other").hide();
                    $("#sub_pap_saa").hide();
                }else if(optionValue === "OR"){
                    $("#sub_pap_as").hide();
                    $("#sub_pap_other").show();
                    $("#sub_pap_saa").hide();
                }else if(optionValue === "SAA"){
                    $("#sub_pap_as").hide();
                    $("#sub_pap_other").hide();
                    $("#sub_pap_saa").show();
                }else{
                    $("#sub_pap_as").hide();
                    $("#sub_pap_other").hide();
                    $("#sub_pap_saa").hide()
                }
            });
        }).change();
    });
    </script>
    
    <!-- Dynamically input after add activity in PAP -->
    <script type="text/javascript">
    // other releases
        <?php foreach($main_pap as $mp) : ?>
            function addAct_<?php echo $mp['mp_id']; ?>() {
                $select_id = $( "#fund_source_<?php echo $mp['mp_id']; ?> option:selected" ).val();
                $select_name = $( "#fund_source_<?php echo $mp['mp_id']; ?> option:selected" ).text();

                if ($('input[name="newAct_'+ $select_id +'_input_jan"]').length){
                    alert('PAP already exist!');
                }else if($select_id === ''){
                    alert('Please select PAP!');
                }else{
                    var $input = $(
                        "<div class='row' id='newAct_del_"+ $select_id+"'>"+
                            "<div class='col-sm-12'>"+ $select_name +" <a href='#' class='errormsg' onclick='removeAct("+ $select_id +")'>x</a></div>"+
                            "<div class='col-sm-12' style='overflow-x:auto;'>"+
                                "<table>"+
                                    "<tr>"+
                                        "<td><input name='newAct_"+ $select_id +"_input_jan' placeholder='Jan' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_"+ $select_id +"_input_feb' placeholder='Feb' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_"+ $select_id +"_input_mar' placeholder='Mar' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_"+ $select_id +"_input_apr' placeholder='Apr' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_"+ $select_id +"_input_may' placeholder='May' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_"+ $select_id +"_input_jun' placeholder='Jun' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_"+ $select_id +"_input_jul' placeholder='Jul' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_"+ $select_id +"_input_aug' placeholder='Aug' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_"+ $select_id +"_input_sep' placeholder='Sep' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_"+ $select_id +"_input_oct' placeholder='Oct' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_"+ $select_id +"_input_nov' placeholder='Nov' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_"+ $select_id +"_input_dec' placeholder='Dec' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_"+ $select_id +"_input_total' placeholder='Total' type='number' step='0.01' class='form-control' readonly></td>"+
                                    "</tr>"+
                                "</table>"+
                            "</div>"+
                        "</div>"
                    );
                    $('#newAct_<?php echo $mp['mp_id']; ?>').append($input);
                } 
            };

        <?php endforeach; ?>

        // saa
        <?php foreach($main_pap as $mp) : ?>
                function addActsaa_<?php echo $mp['mp_id']; ?>() {
                    $select_id = $( "#fund_sourcesaa_<?php echo $mp['mp_id']; ?> option:selected" ).val();
                    $select_name = $( "#fund_sourcesaa_<?php echo $mp['mp_id']; ?> option:selected" ).text();

                    if ($('input[name="newActsaa_'+ $select_id +'_input_jan"]').length){
                        alert('PAP already exist!');
                    }else if($select_id === ''){
                        alert('Please select PAP!');
                    }else{
                        var $input = $(
                            "<div class='row' id='newActsaa_del_"+ $select_id+"'>"+
                                "<div class='col-sm-12'>"+ $select_name +" <a href='#' class='errormsg' onclick='removeActsaa("+ $select_id +")'>x</a></div>"+
                                "<div class='col-sm-12' style='overflow-x:auto;'>"+
                                    "<table>"+
                                        "<tr>"+
                                            "<td><input name='newActsaa_"+ $select_id +"_input_jan' placeholder='Jan' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_"+ $select_id +"_input_feb' placeholder='Feb' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_"+ $select_id +"_input_mar' placeholder='Mar' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_"+ $select_id +"_input_apr' placeholder='Apr' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_"+ $select_id +"_input_may' placeholder='May' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_"+ $select_id +"_input_jun' placeholder='Jun' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_"+ $select_id +"_input_jul' placeholder='Jul' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_"+ $select_id +"_input_aug' placeholder='Aug' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_"+ $select_id +"_input_sep' placeholder='Sep' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_"+ $select_id +"_input_oct' placeholder='Oct' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_"+ $select_id +"_input_nov' placeholder='Nov' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_"+ $select_id +"_input_dec' placeholder='Dec' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_"+ $select_id +"_input_total' placeholder='Total' type='number' step='0.01' class='form-control' readonly></td>"+
                                        "</tr>"+
                                    "</table>"+
                                "</div>"+
                            "</div>"
                        );
                        $('#newActsaa_<?php echo $mp['mp_id']; ?>').append($input);
                    }
                    
                    
                };
            <?php endforeach; ?>
    </script>

    <!--------------------- REMOVE ACTIVIY --------------------->
    <script>
        function removeAct($id) {
            $('#newAct_del_'+$id).remove();
        };
        function removeActsaa($id) {
            $('#newActsaa_del_'+$id).remove();
        };
    </script>
    <!--------------------- END REMOVE ACTIVIY --------------------->
<!--------------------- END CURRENT--------------------->

<!---------------------CONTINUING APPRPRIATION--------------------->
    <!-- Show Ref Num and Particulars in select -->
    <script>
    $(document).ready(function(){
        $("#sub_pap_as_ca").hide();
        $("#sub_pap_other_ca").hide();
        $("#sub_pap_saa_ca").hide();
        
        $("#source_ca").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue === "SAA"){
                    $("#saa_no_label_ca").show();
                    $("#saa_no_value_ca").show();
                    $("#saa_desc_pad_ca").show();
                    $("#saa_desc_label_ca").show();
                    $("#saa_desc_value_ca").show();
                    $("#saa_no_pad_ca").hide();
                } else{
                    $("#saa_no_label_ca").hide();
                    $("#saa_no_value_ca").hide();
                    $("#saa_desc_pad_ca").hide();
                    $("#saa_desc_label_ca").hide();
                    $("#saa_desc_value_ca").hide();
                    $("#saa_no_pad_ca").show();
                }

                if(optionValue === "AS"){
                    $("#sub_pap_as_ca").show();
                    $("#sub_pap_other_ca").hide();
                    $("#sub_pap_saa_ca").hide();
                }else if(optionValue === "OR"){
                    $("#sub_pap_as_ca").hide();
                    $("#sub_pap_other_ca").show();
                    $("#sub_pap_saa_ca").hide();
                }else if(optionValue === "SAA"){
                    $("#sub_pap_as_ca").hide();
                    $("#sub_pap_other_ca").hide();
                    $("#sub_pap_saa_ca").show();
                }else{
                    $("#sub_pap_as_ca").hide();
                    $("#sub_pap_other_ca").hide();
                    $("#sub_pap_saa_ca").hide()
                }
            });
        }).change();
    });
    </script>

    <!-- Dynamically input after add activity in PAP for Continuing Appropriation-->
    <script type="text/javascript">
    // other releases
        <?php foreach($main_pap as $mp) : ?>
            function addAct_ca_<?php echo $mp['mp_id']; ?>() {
                $select_id = $( "#fund_source_ca_<?php echo $mp['mp_id']; ?> option:selected" ).val();
                $select_name = $( "#fund_source_ca_<?php echo $mp['mp_id']; ?> option:selected" ).text();

                if ($('input[name="newAct_ca_'+ $select_id +'_input_jan"]').length){
                    alert('PAP already exist!');
                }else if($select_id === ''){
                        alert('Please select PAP!');
                }else{
                    var $input = $(
                        "<div class='row' id='newAct_ca_del_"+ $select_id+"'>"+
                            "<div class='col-sm-12'>"+ $select_name +" <a href='#' class='errormsg' onclick='removeAct_ca("+ $select_id +")'>x</a></div>"+
                            "<div class='col-sm-12' style='overflow-x:auto;'>"+
                                "<table>"+
                                    "<tr>"+
                                        "<td><input name='newAct_ca_"+ $select_id +"_input_jan' placeholder='Jan' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_ca_"+ $select_id +"_input_feb' placeholder='Feb' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_ca_"+ $select_id +"_input_mar' placeholder='Mar' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_ca_"+ $select_id +"_input_apr' placeholder='Apr' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_ca_"+ $select_id +"_input_may' placeholder='May' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_ca_"+ $select_id +"_input_jun' placeholder='Jun' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_ca_"+ $select_id +"_input_jul' placeholder='Jul' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_ca_"+ $select_id +"_input_aug' placeholder='Aug' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_ca_"+ $select_id +"_input_sep' placeholder='Sep' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_ca_"+ $select_id +"_input_oct' placeholder='Oct' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_ca_"+ $select_id +"_input_nov' placeholder='Nov' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_ca_"+ $select_id +"_input_dec' placeholder='Dec' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_ca_"+ $select_id +"_input_total' placeholder='Total' type='number' step='0.01' class='form-control' readonly></td>"+
                                    "</tr>"+
                                "</table>"+
                            "</div>"+
                        "</div>"
                    );
                    $('#newAct_ca_<?php echo $mp['mp_id']; ?>').append($input);
                }
                
                  
            };
        <?php endforeach; ?>

        // saa
        <?php foreach($main_pap as $mp) : ?>
                function addActsaa_ca_<?php echo $mp['mp_id']; ?>() {
                    $select_id = $( "#fund_sourcesaa_ca_<?php echo $mp['mp_id']; ?> option:selected" ).val();
                    $select_name = $( "#fund_sourcesaa_ca_<?php echo $mp['mp_id']; ?> option:selected" ).text();

                    if ($('input[name="newActsaa_ca_'+ $select_id +'_input_jan"]').length){
                        alert('PAP already exist!');
                    }else if($select_id === ''){
                        alert('Please select PAP!');
                    }else{
                        var $input = $(
                            "<div class='row' id='newActsaa_ca_del_"+ $select_id+"'>"+
                                "<div class='col-sm-12'>"+ $select_name +" <a href='#' class='errormsg' onclick='removeActsaa_ca("+ $select_id +")'>x</a></div>"+
                                "<div class='col-sm-12' style='overflow-x:auto;'>"+
                                    "<table>"+
                                        "<tr>"+
                                            "<td><input name='newActsaa_ca_"+ $select_id +"_input_jan' placeholder='Jan' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_ca_"+ $select_id +"_input_feb' placeholder='Feb' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_ca_"+ $select_id +"_input_mar' placeholder='Mar' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_ca_"+ $select_id +"_input_apr' placeholder='Apr' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_ca_"+ $select_id +"_input_may' placeholder='May' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_ca_"+ $select_id +"_input_jun' placeholder='Jun' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_ca_"+ $select_id +"_input_jul' placeholder='Jul' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_ca_"+ $select_id +"_input_aug' placeholder='Aug' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_ca_"+ $select_id +"_input_sep' placeholder='Sep' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_ca_"+ $select_id +"_input_oct' placeholder='Oct' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_ca_"+ $select_id +"_input_nov' placeholder='Nov' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_ca_"+ $select_id +"_input_dec' placeholder='Dec' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_ca_"+ $select_id +"_input_total' placeholder='Total' type='number' step='0.01' class='form-control' readonly></td>"+
                                        "</tr>"+
                                    "</table>"+
                                "</div>"+
                            "</div>"
                        );
                        $('#newActsaa_ca_<?php echo $mp['mp_id']; ?>').append($input);
                    }
                    
                    
                };
            <?php endforeach; ?>
    </script>
    <!--------------------- REMOVE ACTIVIY --------------------->
    <script>
        function removeAct_ca($id) {
            $('#newAct_ca_del_'+$id).remove();
        };
        function removeActsaa_ca($id) {
            $('#newActsaa_ca_del_'+$id).remove();
        };
    </script>
    <!--------------------- END REMOVE ACTIVIY --------------------->
<!---------------------END CONTINUING APPRIATION--------------------->

<!---------------------AUTOMATIC APPRPRIATION--------------------->
    <!-- Show Ref Num and Particulars in select -->
    <script>
    $(document).ready(function(){
        $("#sub_pap_as_aa").hide();
        $("#sub_pap_other_aa").hide();
        $("#sub_pap_saa_aa").hide();
        
        $("#source_aa").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue === "SAA"){
                    $("#saa_no_label_aa").show();
                    $("#saa_no_value_aa").show();
                    $("#saa_desc_pad_aa").show();
                    $("#saa_desc_label_aa").show();
                    $("#saa_desc_value_aa").show();
                    $("#saa_no_pad_aa").hide();
                } else{
                    $("#saa_no_label_aa").hide();
                    $("#saa_no_value_aa").hide();
                    $("#saa_desc_pad_aa").hide();
                    $("#saa_desc_label_aa").hide();
                    $("#saa_desc_value_aa").hide();
                    $("#saa_no_pad_aa").show();
                }

                if(optionValue === "AS"){
                    $("#sub_pap_as_aa").show();
                    $("#sub_pap_other_aa").hide();
                    $("#sub_pap_saa_aa").hide();
                }else if(optionValue === "OR"){
                    $("#sub_pap_as_aa").hide();
                    $("#sub_pap_other_aa").show();
                    $("#sub_pap_saa_aa").hide();
                }else if(optionValue === "SAA"){
                    $("#sub_pap_as_aa").hide();
                    $("#sub_pap_other_aa").hide();
                    $("#sub_pap_saa_aa").show();
                }else{
                    $("#sub_pap_as_aa").hide();
                    $("#sub_pap_other_aa").hide();
                    $("#sub_pap_saa_aa").hide()
                }
            });
        }).change();
    });
    </script>

    <!-- Dynamically input after add activity in PAP for Continuing Apprpriation-->
    <script type="text/javascript">
    // other releases
        <?php foreach($main_pap as $mp) : ?>
            function addAct_aa_<?php echo $mp['mp_id']; ?>() {
                $select_id = $( "#fund_source_aa_<?php echo $mp['mp_id']; ?> option:selected" ).val();
                $select_name = $( "#fund_source_aa_<?php echo $mp['mp_id']; ?> option:selected" ).text();

                if ($('input[name="newAct_aa_'+ $select_id +'_input_jan"]').length){
                    alert('PAP already exist!');
                }else if($select_id === ''){
                        alert('Please select PAP!');
                }else{
                    var $input = $(
                        "<div class='row' id='newAct_aa_del_"+ $select_id+"'>"+
                            "<div class='col-sm-12'>"+ $select_name +" <a href='#' class='errormsg' onclick='removeAct_aa("+ $select_id +")'>x</a></div>"+
                            "<div class='col-sm-12' style='overflow-x:auto;'>"+
                                "<table>"+
                                    "<tr>"+
                                        "<td><input name='newAct_aa_"+ $select_id +"_input_jan' placeholder='Jan' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_aa_"+ $select_id +"_input_feb' placeholder='Feb' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_aa_"+ $select_id +"_input_mar' placeholder='Mar' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_aa_"+ $select_id +"_input_apr' placeholder='Apr' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_aa_"+ $select_id +"_input_may' placeholder='May' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_aa_"+ $select_id +"_input_jun' placeholder='Jun' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_aa_"+ $select_id +"_input_jul' placeholder='Jul' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_aa_"+ $select_id +"_input_aug' placeholder='Aug' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_aa_"+ $select_id +"_input_sep' placeholder='Sep' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_aa_"+ $select_id +"_input_oct' placeholder='Oct' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_aa_"+ $select_id +"_input_nov' placeholder='Nov' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_aa_"+ $select_id +"_input_dec' placeholder='Dec' type='number' step='0.01' class='form-control'></td>"+
                                        "<td><input name='newAct_aa_"+ $select_id +"_input_total' placeholder='Total' type='number' step='0.01' class='form-control' readonly></td>"+
                                    "</tr>"+
                                "</table>"+
                            "</div>"+
                        "</div>"
                    );
                    $('#newAct_aa_<?php echo $mp['mp_id']; ?>').append($input);
                }
                
                  
            };
        <?php endforeach; ?>

        // saa
        <?php foreach($main_pap as $mp) : ?>
                function addActsaa_aa_<?php echo $mp['mp_id']; ?>() {
                    $select_id = $( "#fund_sourcesaa_aa_<?php echo $mp['mp_id']; ?> option:selected" ).val();
                    $select_name = $( "#fund_sourcesaa_aa_<?php echo $mp['mp_id']; ?> option:selected" ).text();

                    if ($('input[name="newActsaa_aa_'+ $select_id +'_input_jan"]').length){
                        alert('PAP already exist!');
                    }else if($select_id === ''){
                        alert('Please select PAP!');
                    }else{
                        var $input = $(
                            "<div class='row' id='newActsaa_aa_del_"+ $select_id+"'>"+
                                "<div class='col-sm-12'>"+ $select_name +" <a href='#' class='errormsg' onclick='removeActsaa_aa("+ $select_id +")'>x</a></div>"+
                                "<div class='col-sm-12' style='overflow-x:auto;'>"+
                                    "<table>"+
                                        "<tr>"+
                                            "<td><input name='newActsaa_aa_"+ $select_id +"_input_jan' placeholder='Jan' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_aa_"+ $select_id +"_input_feb' placeholder='Feb' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_aa_"+ $select_id +"_input_mar' placeholder='Mar' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_aa_"+ $select_id +"_input_apr' placeholder='Apr' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_aa_"+ $select_id +"_input_may' placeholder='May' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_aa_"+ $select_id +"_input_jun' placeholder='Jun' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_aa_"+ $select_id +"_input_jul' placeholder='Jul' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_aa_"+ $select_id +"_input_aug' placeholder='Aug' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_aa_"+ $select_id +"_input_sep' placeholder='Sep' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_aa_"+ $select_id +"_input_oct' placeholder='Oct' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_aa_"+ $select_id +"_input_nov' placeholder='Nov' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_aa_"+ $select_id +"_input_dec' placeholder='Dec' type='number' step='0.01' class='form-control'></td>"+
                                            "<td><input name='newActsaa_aa_"+ $select_id +"_input_total' placeholder='Total' type='number' step='0.01' class='form-control' readonly></td>"+
                                        "</tr>"+
                                    "</table>"+
                                "</div>"+
                            "</div>"
                        );
                        $('#newActsaa_aa_<?php echo $mp['mp_id']; ?>').append($input);
                    }
                    
                    
                };
            <?php endforeach; ?>
    </script>

    <!--------------------- REMOVE ACTIVIY --------------------->
    <script>
        function removeAct_aa($id) {
            $('#newAct_aa_del_'+$id).remove();
        };
        function removeActsaa_aa($id) {
            $('#newActsaa_aa_del_'+$id).remove();
        };
    </script>
    <!--------------------- END REMOVE ACTIVIY --------------------->
<!---------------------END AUTOMATIC APPRIATION--------------------->

    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url()."assets/"; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url()."assets/"; ?>dist/js/adminlte.min.js"></script>
        
</body>
</html>
