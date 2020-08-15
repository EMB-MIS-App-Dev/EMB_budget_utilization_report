<div class="content-wrapper">
<div class='errormsg'>
    <?php echo validation_errors(); ?>
</div>
<form action="<?= base_url('mp/update'); ?>" method="post" accept-charset="utf-8">
<div class="form-group">
        <div class="form-group-create-sm">
            <h3>Programs/Activities/Projects (P/A/P) - UPDATE</h3>
            <input type="hidden" name="mp_id" value="<?php echo $main_pap['mp_id']; ?>">
            <div class="row">
                <div class="col-sm-4" >
                    <p><b>Code: </b></p> 
                </div> 
                <div class="col-sm-8">
                    <input type="number" value="<?php echo $main_pap['mp_code']; ?>" class="form-control" name="mp_code" required>
                </div>

                <div class="col-sm-4" >
                    <p><b>Name: </b></p> 
                </div> 
                <div class="col-sm-8">
                    <input type="text" value="<?php echo $main_pap['mp_name']; ?>" class="form-control" name="mp_name" required>
                </div>

                <div class="col-sm-4" >
                    <p><b>Description: </b></p> 
                </div> 
                <div class="col-sm-8">
                    <input type="text" value="<?php echo $main_pap['mp_description']; ?>" class="form-control" name="mp_description">
                </div>
                
            </div>
        </div>
       
        
        <div class="center-button">
        <button type="submit" class="btn btn-success" onclick="return confirm('Press OK to confirm update?')">Update</button>
        </div>
    </div>
</form>    
</div>