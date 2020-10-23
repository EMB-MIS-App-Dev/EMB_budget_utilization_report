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

        var co_tarOblThis_total = 0;
        var co_actOblThis_total = 0;
        var co_totalAll = 0;

        <?php foreach($allotment_amt_all as $aa) : ?>
        // //   $aa['mp_id'];

            if ($("[name='category']").val() == "<?php echo $aa['all_category']; ?>"){
                if($("[name='year']").val() == "<?php echo $aa['all_year']; ?>"){
                    if($("[name='class']").val() == "<?php echo $aa['all_class']; ?>"){
                        if("<?php echo $aa['all_region']; ?>" == "CO"){

                            // Target Obligation as of this Month
                            var monthAll = [Number(<?php echo $aa['amt_jan']; ?>), 
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
                                co_tarOblThis_total += Number(monthAll[i]);   
                            }

                            //Total
                            for (var i = 0; i <= 11; i++) {
                                co_totalAll += Number(monthAll[i]);   
                            }
                             

                            // Actual Obligation as of this Month
                            <?php foreach($obligation as $ob) : ?>
                                if("<?php echo $aa['amt_id']; ?>" == "<?php echo $ob['ob_amt_id']; ?>"){

                                    var from = Number($("[name='month_from']").val());
                                    var to = Number($("[name='month_to']").val());
                                    
                                    var myMonth = <?php echo $ob['ob_month']; ?>;

                                    if (myMonth >= from && myMonth <= to){
                                        co_actOblThis_total += Number(<?php echo $ob['ob_amount']; ?>);
                                    }
                                }
                            <?php endforeach; ?>
                        }
                    }
                }   
            }
        <?php endforeach; ?>

        co_totalAll = (co_tarOblThis_total/co_totalAll) * 100;
        co_totalAll = Math.floor(co_totalAll); 



        co_tarOblThis_total = co_tarOblThis_total.toFixed(2)
                    .replace(/[^\d.]/g, "")
                    .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
                    .replace(/\.(\d{2})\d+/, '.$1')
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        co_actOblThis_total = co_actOblThis_total.toFixed(2)
                    .replace(/[^\d.]/g, "")
                    .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
                    .replace(/\.(\d{2})\d+/, '.$1')
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        
        
        var $input = $(
        "<div style='text-align:center'>"+
            "<h5>"+
                "Spending Performance<br>" + $( "[name='category'] option:selected" ).text()+
            "</h5>"+
            "<p>as of "+ $( "[name='month_to'] option:selected" ).text()+" "+$( "[name='year']" ).val()+"</p>"+
        "</div>"+

        "<div class='row'>"+
            "<div class='col-sm-2'>"+
                "Overall Target:"+
            "</div>"+
            "<div class='col-sm-3'>"+
                "000000000000"+
            "</div>"+
            "<div class='col-sm-7'></div>"+

            "<div class='col-sm-2'>"+
                "Accomplishment:"+
            "</div>"+
            "<div class='col-sm-3'>"+
                "00.00%"+
            "</div>"+
            "<div class='col-sm-7'></div>"+

            "<div class='col-sm-2'>"+
                "Overall Rating:"+
            "</div>"+
            "<div class='col-sm-3'>"+
                "POOR"+
            "</div>"+
            "<div class='col-sm-7'></div>"+
        "</div>"+

        "<table border=1>"+
            "<tr>"+
                "<th>Region</th>"+
                "<th>Target Obligation as of this Month</th>"+
                "<th>Actual Obligation as of this Month</th>"+
                "<th>Target</th>"+
                "<th>Accomplishment</th>"+
                "<th>Rating</th>"+
                "<th>Under Accomplishment</th>"+
            "</tr>"+
            "<tr>"+
                "<td>CO</td>"+
                "<td>"+co_tarOblThis_total+"</td>"+
                "<td>"+co_actOblThis_total+"</td>"+
                "<td>"+co_totalAll+"%</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>NCR</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>Region 1</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>CAR</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>ARMM</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>Region 2</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>Region 3</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>Region 4A</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>Region 4B</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>Region 5</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>Region 6</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>Region 7</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>Region 8</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>Region 9</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>Region 10</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>Region 11</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>Region 12</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
            "<tr>"+
                "<td>Region 13</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
                "<td>0</td>"+
            "</tr>"+
        "</table>"
        );
    
        $('#reportDisp').empty().append($input);

    }

    
});
</script>