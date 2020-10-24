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

        if($( "[name='report'] option:selected" ).val() == "fp"){
            var $inputH = $(
                    "<div style='text-align:center'>"+
                        "<h5>"+
                            "Spending Performance<br>" + $( "[name='category'] option:selected" ).text()+
                        "</h5>"+
                        "<p>as of "+ $( "[name='month_to'] option:selected" ).text()+" "+$( "[name='year']" ).val()+"</p>"+
                    "</div>"
            );

            $('#reportDispHeader').empty().show().append($inputH);
            
            var $inputTH = $(
                "<tr>"+
                    "<th>Region</th>"+
                    "<th>Target Obligation as of this Month</th>"+
                    "<th>Actual Obligation as of this Month</th>"+
                    "<th>Target</th>"+
                    "<th>Accomplishment</th>"+
                    "<th>Under Accomplishment</th>"+
                "</tr>"
            );

            $('#reportDisp').empty(); 
            $('#reportDisp').append($inputTH);
            
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
                
                    $('#reportDisp').show().append($input);
                    

            }
        }else{
            alert('no reports found!');
            $('#reportDispHeader').empty();
            $('#reportDisp').empty();
        }
    }

    
});
</script>