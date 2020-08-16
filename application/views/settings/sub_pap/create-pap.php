<div class="content-wrapper">
<div class='errormsg'>
    <?php echo validation_errors(); ?>
</div>
<form action="<?= base_url('sp/create'); ?>" method="post" accept-charset="utf-8">
<div class="form-group">
        <div class="form-group-create-sm">
            <h3>Programs/Activities/Projects (P/A/P)</h3>
           
            <div class="row">
                <div class="col-sm-4" >
                    <p><b>Select PAP: </b></p> 
                </div> 
                <div class="col-sm-8">
                    <select name="sp_mp_id">
                    <?php foreach($main_pap as $mp) : ?>
                        <option value="<?php echo $mp['mp_id']; ?>"><?php echo $mp['mp_code']; ?> - <?php echo $mp['mp_name']; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-sm-4" >
                    <p><b>Code: </b></p> 
                </div> 
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="sp_code">
                </div>

                <div class="col-sm-4" >
                    <p><b>Name: </b></p> 
                </div> 
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="sp_name">
                </div>

                <div class="col-sm-4" >
                    <p><b>Description: </b></p> 
                </div> 
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="sp_description">
                </div>
                
            </div>
        </div>
       
        
        <div class="center-button">
        <button type="submit" class="btn btn-success" onclick="return confirm('Press OK to confirm save?')">Create</button>
        </div>
    </div>
</form>    
</div>