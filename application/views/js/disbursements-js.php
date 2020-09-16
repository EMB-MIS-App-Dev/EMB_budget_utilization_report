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

<!-- thousand separator -->
<script>

$(document).on( "keyup", "input.number", function(){
    if (event.which >= 37 && event.which <= 40) return;
    $(this).val(function(index, value) {
        return value
        // Keep only digits and decimal points:
        .replace(/[^\d.]/g, "")
        // Remove duplicated decimal point, if one exists:
        .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
        // Keep only two digits past the decimal point:
        .replace(/\.(\d{2})\d+/, '.$1')
        // Add thousands separators:
        .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    });
});
</script>

<!-- month change -->
<script>
     $("#month").change(function(){
         $(this).find("option:selected").each(function(){
            var monthVal = $(this).attr("value");
            var oblPre = 0;

            <?php foreach($allotment_amount as $am) : ?>
                // total obligation of of this month
                for ($i = 1; $i <= monthVal; $i++) {
                    <?php foreach($obligations as $obligation) : ?>
                        if(<?php echo $am['amt_id']; ?> == <?php echo $obligation['ob_amt_id']; ?>){
                            if(<?php echo $obligation['ob_month']; ?> == $i){
                                var ob_amt =  <?php echo str_replace(',','',$obligation['ob_amount']); ?>;
                                oblPre = oblPre + ob_amt;
                            }
                        }
                    <?php endforeach; ?>

                }

                oblPre = oblPre.toFixed(2)
                                 .replace(/[^\d.]/g, "")
                                 .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
                                 .replace(/\.(\d{2})\d+/, '.$1')
                                 .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#obligation-this-<?php echo $am['amt_id']; ?>').val(oblPre);
                oblPre = 0;


                // disbursements as of the prev month
                var disPre = 0;
                for ($i = 1; $i < monthVal; $i++) {
                    <?php foreach($disbursements as $disbursement) : ?>
                        if(<?php echo $am['amt_id']; ?> == <?php echo $disbursement['dis_amt_id']; ?>){
                            if(<?php echo $disbursement['dis_month']; ?> == $i){
                                var dis_amt =  <?php echo str_replace(',','',$disbursement['dis_amount']); ?>;
                                disPre = disPre + dis_amt;
                            }
                        }
                    <?php endforeach; ?>

                }

                disPre = disPre.toFixed(2)
                                 .replace(/[^\d.]/g, "")
                                 .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
                                 .replace(/\.(\d{2})\d+/, '.$1')
                                 .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                $('#disPre-<?php echo $am['amt_id']; ?>').val(disPre);
                disPre = 0;

                // disable disbursement this month
                var d = new Date();
                var n = d.getMonth() +1;
                var disAmt = 0;
                
                <?php foreach($disbursements as $disbursement) : ?>
                    if(<?php echo $am['amt_id']; ?> == <?php echo $disbursement['dis_amt_id']; ?>){
                        if(monthVal == <?php echo $disbursement['dis_month']; ?>){
                            disAmt =  <?php echo str_replace(',','', $disbursement['dis_amount']); ?>;
                        }
                    }
                    
                <?php endforeach; ?>

                disAmt = disAmt.toFixed(2)
                                 .replace(/[^\d.]/g, "")
                                 .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
                                 .replace(/\.(\d{2})\d+/, '.$1')
                                 .replace(/\B(?=(\d{3})+(?!\d))/g, ",");


                if(monthVal < n){
                    $('#disbursement-amount-<?php echo $am['amt_id']; ?>').attr('readonly', true)
                                                                        .css('background-color','#ECECEC')
                                                                        .val(disAmt);
                    $("#disbursement-amount-<?php echo $am['amt_id']; ?>").keyup();
                }else{
                    $('#disbursement-amount-<?php echo $am['amt_id']; ?>').attr('readonly', false)
                                                                        .css('background-color','')
                                                                        .val(disAmt);
                    $("#disbursement-amount-<?php echo $am['amt_id']; ?>").keyup();
                }

                disAmt = 0;


            <?php endforeach; ?>
            
         });
     });
</script>

<!-- disbursement for this month change -->
<script>
    <?php foreach($allotment_amount as $am) : ?>
    $("#disbursement-amount-<?php echo $am['amt_id']; ?>").keyup(function(){
       
        var oblThis =  $('#obligation-this-<?php echo $am['amt_id']; ?>').val().replace(/,/g, '');
        var disPre =  $('#disPre-<?php echo $am['amt_id']; ?>').val().replace(/,/g, '');
        var disThis =  $('#disbursement-amount-<?php echo $am['amt_id']; ?>').val().replace(/,/g, '');

        var unpaidObl = Number(oblThis) - Number(disPre) - Number(disThis);
        var uti = Number(disPre) + Number(disThis);
        uti = Number(uti) / Number(oblThis);


        // cannot be higher than allotment
        var totalDis = Number(disPre) + Number(disThis);
        if (Number(oblThis) < Number(totalDis)){
            alert('Obligation cannot be higher than Allotment!');

            $('#disbursement-amount-<?php echo $am['amt_id']; ?>').val("");
            $('#unpaidObl-<?php echo $am['amt_id']; ?>').val("");
            $('#uti-<?php echo $am['amt_id']; ?>').val("");
        }else{
            unpaidObl = unpaidObl.toFixed(2)
                .replace(/[^\d.]/g, "")
                .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
                .replace(/\.(\d{2})\d+/, '.$1')
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            uti = uti.toFixed(2)
                    .replace(/[^\d.]/g, "")
                    .replace(/^(\d*\.)(.*)\.(.*)$/, '$1$2$3')
                    .replace(/\.(\d{2})\d+/, '.$1')
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#unpaidObl-<?php echo $am['amt_id']; ?>').val(unpaidObl);
            $('#uti-<?php echo $am['amt_id']; ?>').val(uti);
        }

        
        // alert(total);

    });
    <?php endforeach; ?>
</script>