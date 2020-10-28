<script>
$("#generatebtn").click(function(){

    if ($("[name='report']").val() == "" ){
        alert('Please select a Report.');
    }else if($("[name='category']").val() == "" ){
        alert('Please select a Category.');
    }else if($("[name='year']").val() == "" ){
        alert('Please select a Year.');
    }else if($("[name='class']").val() == "" ){
        alert('Please select a Class.');
    }else if($("[name='month_from']").val() == "" || $("[name='month_to']").val() == ""){
        alert('Please select Month range.');
    }else{
        // ------------------- FINANCIAL PERFORMANCE REPORT -------------------
        if($( "[name='report'] option:selected" ).val() == "fp"){
            var $inputH = $(
                    "<div style='text-align:center'>"+
                        "<h5>"+
                            "Spending Performance<br>" + $( "[name='category'] option:selected" ).text()+
                        "</h5>"+
                        "<p>as of "+ $( "[name='month_to'] option:selected" ).text()+" "+$( "[name='year']" ).val()+"</p>"+
                    "</div>"
            );

            $('.reportDispHeader').empty().show().append($inputH);
            
            var $inputTH = $(
                "<thead>"+
                "<tr>"+
                    "<th>Region</th>"+
                    "<th>Target Obligation as of this Month</th>"+
                    "<th>Actual Obligation as of this Month</th>"+
                    "<th>Target</th>"+
                    "<th>Accomplishment</th>"+
                    "<th>Under Accomplishment</th>"+
                "</tr>"+
                "</thead>"+
                "<tbody>"
            );

            $('.reportDisp').empty(); 
            $('.reportDisp').append($inputTH);
            
            var regions = ["CO","NCR","R1","CAR","ARMM","R2","R3","R4A","R4B","R5","R6","R7","R8","R9","R10","R11","R12","R13"];
            for (var r = 0; r <= 17; r++) {
                
                var region = regions[r];

                var tarOblThis_total = region+'_tarOblThis_total';
                var actOblThis_total = region+'_actOblThis_total';
                var target = region+'_target';
                var accom = region+'_accom';
                var under_accom = region+'_under_accom';

                tarOblThis_total = 0;
                actOblThis_total = 0;
                target = 0;
                accom = 0;
                under_accom = 0;

                <?php foreach($allotment_amt_all as $aa) : ?>
                    if ($("[name='category']").val() == "<?php echo $aa['all_category']; ?>"){
                        if($("[name='year']").val() == "<?php echo $aa['all_year']; ?>"){
                            if($("[name='class']").val() == "<?php echo $aa['all_class']; ?>"){

                                if("<?php echo $aa['all_region']; ?>" == region){

                                    // Target Obligation as of this Month
                                    var month = [Number(<?php echo $aa['amt_jan']; ?>), 
                                                Number(<?php echo $aa['amt_feb']; ?>),
                                                Number(<?php echo $aa['amt_mar']; ?>),
                                                Number(<?php echo $aa['amt_apr']; ?>),
                                                Number(<?php echo $aa['amt_may']; ?>),
                                                Number(<?php echo $aa['amt_jun']; ?>),
                                                Number(<?php echo $aa['amt_jul']; ?>),
                                                Number(<?php echo $aa['amt_aug']; ?>),
                                                Number(<?php echo $aa['amt_sep']; ?>),
                                                Number(<?php echo $aa['amt_oct']; ?>),
                                                Number(<?php echo $aa['amt_nov']; ?>),
                                                Number(<?php echo $aa['amt_dec']; ?>)
                                                ];

                                    var from = Number($("[name='month_from']").val())-1;
                                    var to = Number($("[name='month_to']").val())-1;
                                    
                                    for (var i = from; i <= to; i++) {
                                        tarOblThis_total += Number(month[i]);   
                                    }

                                    //Target
                                    for (var i = 0; i <= 11; i++) {
                                        target += Number(month[i]);   
                                    }
                                    

                                    // Actual Obligation as of this Month
                                    <?php foreach($obligation as $ob) : ?>
                                        if("<?php echo $aa['amt_id']; ?>" == "<?php echo $ob['ob_amt_id']; ?>"){

                                            var from = Number($("[name='month_from']").val());
                                            var to = Number($("[name='month_to']").val());
                                            
                                            var myMonth = <?php echo $ob['ob_month']; ?>;

                                            if (myMonth >= from && myMonth <= to){
                                                actOblThis_total += Number(<?php echo $ob['ob_amount']; ?>);
                                            }
                                        }
                                    <?php endforeach; ?>
                                }
                            }
                        }   
                    }
                <?php endforeach; ?>

                //Target
                target = (tarOblThis_total/target) * 100;
                target = Math.floor(target); 

                //Accomplishment
                accom = (actOblThis_total/tarOblThis_total) * 100;
                accom = Math.floor(accom); 

                //Under Accomplishment
                under_accom = (100-accom);
                under_accom = Math.floor(under_accom); 

                tarOblThis_total = tarOblThis_total.toFixed(2)
                            .replace(/[^\d.]/g, "")
                            .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
                            .replace(/\.(\d{2})\d+/, '.$1')
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                actOblThis_total = actOblThis_total.toFixed(2)
                            .replace(/[^\d.]/g, "")
                            .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
                            .replace(/\.(\d{2})\d+/, '.$1')
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                var $input = $(
                        "<tr>"+
                            "<td>"+region+"</td>"+
                            "<td>"+tarOblThis_total+"</td>"+
                            "<td>"+actOblThis_total+"</td>"+
                            "<td>"+target+"%</td>"+
                            "<td>"+accom+"%</td>"+
                            "<td>"+under_accom+"%</td>"+
                        "</tr>"
                );
            
                $('.reportDisp').show().append($input);
            }
        // ------------------- UTILIZATION REPORT -------------------
        }else if($( "[name='report'] option:selected" ).val() == "ut"){
            var $inputH = $(
                    "<div style='text-align:center'>"+
                        "<h5>"+
                            "Budget Utilization Rate<br>" + $( "[name='category'] option:selected" ).text()+
                        "</h5>"+
                        "<p>as of "+ $( "[name='month_to'] option:selected" ).text()+" "+$( "[name='year']" ).val()+"</p>"+
                    "</div>"
            );

            $('.reportDispHeader').empty().show().append($inputH);
            
            var $inputTH = $(
                "<thead>"+
                "<tr>"+
                    "<th>Region</th>"+
                    "<th>Total Allotment</th>"+
                    "<th>Actual Obligation as of this Month</th>"+
                    "<th>Balance in Allotment</th>"+
                    "<th>% Utilization</th>"+
                    "<th>% Unutilized</th>"+
                "</tr>"+
                "</thead>"+
                "<tbody>"
            );

            $('.reportDisp').empty(); 
            $('.reportDisp').append($inputTH);

            var regions = ["CO","NCR","R1","CAR","ARMM","R2","R3","R4A","R4B","R5","R6","R7","R8","R9","R10","R11","R12","R13"];
            for (var r = 0; r <= 17; r++) {
                
                var region = regions[r];

                var totalAll = region+'_totalAll';
                var actOblThis_total = region+'_actOblThis_total';
                var balanceAll = region+'_balanceAll';
                var utilization = region+'_utilization';
                var unutilized = region+'_unutilized';

                totalAll = 0;
                actOblThis_total = 0;
                balanceAll = 0;
                utilization = 0;
                unutilized = 0;

                <?php foreach($allotment_amt_all as $aa) : ?>
                    if ($("[name='category']").val() == "<?php echo $aa['all_category']; ?>"){
                        if($("[name='year']").val() == "<?php echo $aa['all_year']; ?>"){
                            if($("[name='class']").val() == "<?php echo $aa['all_class']; ?>"){

                                if("<?php echo $aa['all_region']; ?>" == region){

                                    // Target Obligation as of this Month
                                    var month = [Number(<?php echo $aa['amt_jan']; ?>), 
                                                Number(<?php echo $aa['amt_feb']; ?>),
                                                Number(<?php echo $aa['amt_mar']; ?>),
                                                Number(<?php echo $aa['amt_apr']; ?>),
                                                Number(<?php echo $aa['amt_may']; ?>),
                                                Number(<?php echo $aa['amt_jun']; ?>),
                                                Number(<?php echo $aa['amt_jul']; ?>),
                                                Number(<?php echo $aa['amt_aug']; ?>),
                                                Number(<?php echo $aa['amt_sep']; ?>),
                                                Number(<?php echo $aa['amt_oct']; ?>),
                                                Number(<?php echo $aa['amt_nov']; ?>),
                                                Number(<?php echo $aa['amt_dec']; ?>)
                                                ];

                                    //Target
                                    for (var i = 0; i <= 11; i++) {
                                        totalAll += Number(month[i]);   
                                    }
                                    

                                    // Actual Obligation as of this Month
                                    <?php foreach($obligation as $ob) : ?>
                                        if("<?php echo $aa['amt_id']; ?>" == "<?php echo $ob['ob_amt_id']; ?>"){

                                            var from = Number($("[name='month_from']").val());
                                            var to = Number($("[name='month_to']").val());
                                            
                                            var myMonth = <?php echo $ob['ob_month']; ?>;

                                            if (myMonth >= from && myMonth <= to){
                                                actOblThis_total += Number(<?php echo $ob['ob_amount']; ?>);
                                            }
                                        }
                                    <?php endforeach; ?>
                                }
                            }
                        }   
                    }
                <?php endforeach; ?>

                // balanceAll
                balanceAll = totalAll-actOblThis_total;

                // utilization
                utilization = (actOblThis_total/totalAll) * 100;
                utilization = Math.floor(utilization); 

                // unutilized
                unutilized = (100-utilization);
                unutilized = Math.floor(unutilized); 

                totalAll = totalAll.toFixed(2)
                            .replace(/[^\d.]/g, "")
                            .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
                            .replace(/\.(\d{2})\d+/, '.$1')
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                actOblThis_total = actOblThis_total.toFixed(2)
                            .replace(/[^\d.]/g, "")
                            .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
                            .replace(/\.(\d{2})\d+/, '.$1')
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                balanceAll = balanceAll.toFixed(2)
                            .replace(/[^\d.]/g, "")
                            .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
                            .replace(/\.(\d{2})\d+/, '.$1')
                            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                
                var $input = $(
                        "<tr>"+
                            "<td>"+region+"</td>"+
                            "<td>"+totalAll+"</td>"+
                            "<td>"+actOblThis_total+"</td>"+
                            "<td>"+balanceAll+"</td>"+
                            "<td>"+utilization+"%</td>"+
                            "<td>"+unutilized+"%</td>"+
                        "</tr>"
                );
            
                $('.reportDisp').append($input);
            }
        }


        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("myTable");
        switching = true;
        /*Make a loop that will continue until
        no switching has been done:*/
        while (switching) {
            //start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
                //start by saying there should be no switching:
                shouldSwitch = false;
                /*Get the two elements you want to compare,
                one from current row and one from the next:*/
                x = rows[i].getElementsByTagName("TD")[4];
                y = rows[i + 1].getElementsByTagName("TD")[4];
                //check if the two rows should switch place:
                //alert('x: '+x.innerHTML.slice(0,-1)+ ' > y: '+y.innerHTML.slice(0,-1));
                if (parseInt(x.innerHTML.slice(0,-1)) > parseInt(y.innerHTML.slice(0,-1))) {
                //if so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
                }
            }
            if (shouldSwitch) {
                /*If a switch has been marked, make the switch
                and mark that a switch has been done:*/
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    } 
});
</script>