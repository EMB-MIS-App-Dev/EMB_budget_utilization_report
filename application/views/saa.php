<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class='successmsg'>
        <?php if($this->session->flashdata('successmsg')): ?> 
            <p><?php echo $this->session->flashdata('successmsg'); ?></p>
        <?php endif; ?>
    </div>
    
   <div">
       <a class="btn btn-primary create-btn" href="saa/create">Create</a>
   </div>
  
   </div>
<!-- /.content-wrapper -->

