<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class='successmsg'>
        <?php if($this->session->flashdata('successmsg')): ?> 
            <p><?php echo $this->session->flashdata('successmsg'); ?></p>
        <?php endif; ?>
    </div>

    <table id="myTable" class="table table-striped table-bordered table-sm align">
    <!-- <table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"> -->
    <div class="col-sm-4" >
        <thead>
            <tr>
                <th scope="col">Region</th>
                <th scope="col">Year</th>
                <th scope="col">Category</th>
                <th scope="col">Type</th>
                <th scope="col">Funding</th>
                <th scope="col">Class</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody> 
            <?php foreach($allotments as $allotment) : ?>
                <tr class="table-active"> 
                    <td><?php echo $allotment['all_region']; ?></td>
                    <td><?php echo $allotment['all_year']; ?></td>
                    <?php
                        if($allotment['all_category'] == 'cu'){
                            echo"<td>Current</td>";
                        }else if($allotment['all_category'] == 'ca'){
                            echo"<td>Continuing Appropriation</td>";
                        }else if($allotment['all_category'] == 'aa'){
                            echo"<td>Automatic Appropriation</td>";
                        }

                        if($allotment['all_type'] == 'sb'){
                            echo"<td>Specific Budget</td>";
                        }else if($allotment['all_type'] == 'sp'){
                            echo"<td>Special Purpose Fund</td>";
                        }else if($allotment['all_type'] == 'rlip'){
                            echo"<td>RLIP</td>";
                        }

                        if($allotment['all_funding'] == 'as'){
                            echo"<td>Agency Specific</td>";
                        }else if($allotment['all_funding'] == 'or'){
                            echo"<td>Other Releases</td>";
                        }else if($allotment['all_funding'] == 'sa'){
                            echo"<td>SAA</td>";
                        }
                    ?>
                    <td><?php echo strtoupper($allotment['all_class']); ?></td>
                    <td>
                        <a href="disbursements/<?php echo $allotment['all_id'] ?>"><i class="fa fa-plus" style="font-size:24px; color:green"></i></a>
                        <a href="disbursements/summary/<?php echo $allotment['all_id'] ?>" target="_blank"><i class="fa fa-list-alt" style="font-size:24px; margin-left: 1em;"></i></a>
                    </td>
            </tr>   
            <?php endforeach; ?>
        
        </tbody>
    </table>
   
    </div>
<!-- /.content-wrapper -->

