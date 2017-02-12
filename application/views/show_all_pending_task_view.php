<div id="item-div">
    <h4>All Pending Tasks</h4>
    <table class="table table-hover table-condensed table-bordered">
        <thead>
        <th>Task</th>
        <th>Description</th>
        <th>Estimation (in Days)</th>
        <th>Status</th>
        <th>Attachments</th>
        <th>Actions</th>
        </thead>
        <tbody>
            <?php
            $all_tasks = $this->task_model->getAllTaskByProgress('1');
            if ($all_tasks):
                foreach ($all_tasks as $task):
                    if ($task['progress'] == 1) {
                        ?>
                        <tr>
                            <td><?php echo $task['title']; ?></td>
                            <td><?php echo $task['description']; ?></td>
                            <td><?php echo $task['estimated_time']; ?></td>
                            <td> In Progress</td>
                            <td>
                                <?php if ($task['attachment_path'] != 'null'){ ?>
                                <a class="btn btn-success btn-xs" role="button"
                                   href="<?php echo base_url(); ?>task/download/<?php echo urlencode(base64_encode($task['attachment_path']));?>">Download</a>
                                <?php }  ?>
                            </td>
                            
                            <td><a class="btn btn-warning btn-xs" role="button"
                                       href="<?php echo base_url(); ?>task/pick/<?php echo urlencode(base64_encode($task['id']));?>">Cancel</a>                               
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