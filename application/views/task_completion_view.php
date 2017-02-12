<form method="post" action="<?php echo  base_url(); ?>task/markAsFinished"  enctype="multipart/form-data" >
    
    <div class="form-group">
        <label>Task Title </label><br/>
        <label for="note" align="right"><?php
                    $task = $this->task_model->getTaskById(base64_decode(urldecode( $taskId)));
                    if ($task):
                            echo $task[0]['title'];
                    endif;
                    ?></label>
        <input type='hidden' name="task_id" value="<?php echo $taskId; ?>"/>
    </div>
<!--    <div class="form-group">
        <label for="note">Note</label>
        <textarea class="form-control" rows="3" name="note"></textarea>
        <input type='hidden' name="task_id" value="<?php //echo base64_decode(urldecode($taskId))?>"/>
                   
    </div>-->
    <div>
       
        <input type="file"  name="userfile" size="20" id="userfile">
        <br/>
    </div>
    <div class="form-group">
        <input type="submit" value="Mark As Finished" class="btn btn-primary"/>
    </div>
</form>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

