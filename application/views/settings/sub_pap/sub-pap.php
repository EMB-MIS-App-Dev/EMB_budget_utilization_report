<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<div class='successmsg'>
    <?php if($this->session->flashdata('successmsg')): ?> 
        <p><?php echo $this->session->flashdata('successmsg'); ?></p>
    <?php endif; ?>
</div>
<div class="create">
    <a class="btn btn-success create-btn" href="sp/create">New</a>
</div>
<table id="myTable" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th scope="col">Main</th>
        <th scope="col">Code</th>
        <th scope="col">Name</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>           
            <?php foreach($sub_pap as $sp) : ?>
                <tr class="table-active"> 
                    <td><?php echo $sp['mp_code']; ?> - <?php echo $sp['mp_name']; ?></td>
                    <td><?php echo $sp['sp_code']; ?></td>
                    <td><?php echo $sp['sp_name']; ?></td>
                    <td>
                        <a class="btn btn-info" href="sp/edit/<?php echo $sp['sp_id'] ?>">Edit</a>
                        <a class="btn btn-danger" onclick="return confirm('Press OK to confirm delete PAP?')" href="sp/delete/<?php echo $sp['sp_id'] ?>">Delete</a>
                    </td>
            </tr>   
            <?php endforeach; ?>
    </tbody>
</table>
</div>
<!-- /.content-wrapper -->

