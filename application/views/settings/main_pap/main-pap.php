<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>
<div class="create">
    <a class="btn btn-success create-btn" href="mp/create">New</a>
</div>
<table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th scope="col">Code</th>
        <th scope="col">Name</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>           
            <?php foreach($main_pap as $mp) : ?>
                <tr class="table-active"> 
                    <td><?php echo $mp['mp_code']; ?></td>
                    <td><?php echo $mp['mp_name']; ?></td>
                    <td>
                        <a class="btn btn-info" href="mp/edit/<?php echo $mp['mp_id'] ?>">Edit</a>
                        <a class="btn btn-danger" onclick="return confirm('Press OK to confirm delete PAP?')" href="mp/delete/<?php echo $mp['mp_id'] ?>">Delete</a>
                    </td>
            </tr>   
            <?php endforeach; ?>
    </tbody>
</table>
</div>
<!-- /.content-wrapper -->

