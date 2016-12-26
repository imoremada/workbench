<form method="post" action="<?php echo  base_url(); ?>task/addTask"  enctype="multipart/form-data" >
    
    <div class="form-group">
        <label>Title</label>
        <input class="form-control" type="text" name="title" />
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" rows="3" name="description"></textarea>
    </div>
    <div class="form-group">
        <label>Estimation in Days</label>
        <input class="form-control" type="text" name="estimation" />
    </div>
    <div class="form-group">
        <label>Type</label>
        
        <br/>
            <?php
            $skills =  $this->skill_model->getAllSkills();
            foreach ($skills as $skill)
            {
                echo '<input type="checkbox" name="skills[]" value="'.$skill['id'] .'" />'. $skill['type'].'<br />';
            }
            ?>
       
    </div>
    <div>
       
        <input type="file"  name="userfile" size="20" id="userfile">
        <br/>
    </div>
    <div class="form-group">
        <input type="submit" value="upload" class="btn btn-primary"/>
    </div>
</form>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

