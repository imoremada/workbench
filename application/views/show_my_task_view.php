<div id="item-div">
    <h4>Assigned Pending Tasks</h4>
    <table class="table table-hover table-condensed table-bordered">
        <thead>
        <th>Task</th>
        <th>Description</th>
        <th>Estimation (in Days)</th>
        <th>Attachments</th>
        <th>Status</th>
        <th>Actions</th>
        </thead>
        <tbody>
            <?php
            $all_tasks = $this->task_model->getAllCurrentUserInprogressTasks();
            if ($all_tasks):
                foreach ($all_tasks as $task):
                    if ($task['progress'] != 3) {
                        ?>
                        <tr>
                            <td><?php echo $task['title']; ?></td>
                            <td><?php echo $task['description']; ?></td>
                            <td><?php echo $task['estimated_time']; ?></td>
                             <td>
                                <?php if ($task['attachment_path'] != 'null'){ ?>
                                <a class="btn btn-success btn-xs" role="button"
                                   href="<?php echo base_url(); ?>task/download/<?php echo urlencode(base64_encode($task['attachment_path']));?>">Download</a>
                                <?php }  ?>
                            </td>
                            
                            <td><?php if ($task['status'] == 0) { ?>
                                    Pending
                                   <?php }  else if ($task['status'] == 1) {?>
                                    In Progress
                                   <?php } ?></td>
                            <td>
                                <?php if ($task['status'] == 0) { ?>
                                    <a class="btn btn-success btn-xs" role="button"
                                       href="<?php echo base_url(); ?>task/pick/<?php echo urlencode(base64_encode($task['task_id'])); ?>">Pick Task</a>
                                   <?php }  else if ($task['status'] == 1) {?>
                                    <a class="btn btn-warning btn-xs" role="button"
                                       href="<?php echo base_url(); ?>task/rejectUserTask/<?php echo urlencode(base64_encode($task['task_id']));?>/<?php echo urlencode(base64_encode('2'));?>">Reject Task</a>
                                <a class="btn btn-success btn-xs" role="button"
                                       href="<?php echo base_url(); ?>task/finishUserTask/<?php echo urlencode(base64_encode($task['task_id']));?>">Finish Task</a>
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