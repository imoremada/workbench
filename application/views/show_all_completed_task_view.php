
<div id="item-div">
    <h4>Completed Tasks</h4>
    <table class="table table-hover table-condensed table-bordered">
        <thead>
        <th>Task</th>
        <th>User</th>
        <th>User Info</th>
        <th>Estimation (in Days)</th>
        <th>Status</th>
        <th>Original Attachments</th>
        <th>Completed Attachments</th>
        <th>Actions</th>
        </thead>
        <tbody>
            <?php
            $all_tasks = $this->task_model->getAllUserPickedTasksByProgress('2');
            if ($all_tasks):
                foreach ($all_tasks as $task):
                    if ($task['status'] == 2) {
                        ?>
                        <tr>
                            <td><?php echo $task['title']; ?></td>
                             <td><?php  $userInfo = $this->user_model->get_user_by_id($task['user_id']);
                             echo $userInfo->name;
                             ?></td>
                             <td><a class="btn btn-success btn-xs" role="button"
                                   href="<?php echo base_url(); ?>user/view_profile/<?php echo urlencode(base64_encode($task['user_id'])); ?>">User Info</a> 
                                </td>
                            <td><?php echo $task['estimated_time']; ?></td>
                            <td>  <?php  if ($task['progress'] != 2) {
                                
                                 echo "Awaiting to Finalize";
                            }
                                 else { 
                                     echo "Finalized";
                                 }
                            ?></td>
                            <td>
                                <?php if ($task['attachment_path'] != 'null') { ?>
                                    <a class="btn btn-success btn-xs" role="button"
                                       href="<?php echo base_url(); ?>task/download/<?php echo urlencode(base64_encode($task['attachment_path'])); ?>">Download</a>
                                   <?php } ?>
                            </td>
                            <td> <?php if ($task['file_path'] != 'null') { ?>
                                    <a class="btn btn-success btn-xs" role="button"
                                       href="<?php echo base_url(); ?>task/download/<?php echo urlencode(base64_encode($task['file_path'])); ?>">Download</a>
                                   <?php } ?></td>
                            
                            <td><a class="btn btn-warning btn-xs" role="button"
                                   href="<?php echo base_url(); ?>task/remove/<?php echo urlencode(base64_encode($task['task_id'])); ?>">Delete</a> 
                                <?php  if ($task['progress'] != 2) { ?>
                                <a class="btn btn-success btn-xs" role="button"
                                   href="<?php echo base_url(); ?>task/closeTask/<?php echo urlencode(base64_encode($task['task_id'])); ?>/<?php echo urlencode(base64_encode($task['user_id'])); ?>">Proceed to Finalize</a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                    }
                endforeach;
            else:
                ?>
                <tr>
                    <td colspan="9">No Entries</td>
                </tr>
            <?php
            endif;
            ?>
        </tbody>
    </table>
    <br/>
    <br/>
</div>