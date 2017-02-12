<form method="post" action="<?php echo base_url(); ?>task/finalize">
    <div id="item-div">
        <table class="table table-hover table-condensed table-bordered">
            <thead>
            <th>Task Title</th>
            <th>Completed User</th>
            <th>Email</th>
            <th>Quality</th>
            </thead>
            <tr>
                <td>
                    <input type='hidden' name="task_id" value="<?php echo base64_decode(urldecode($taskId))?>"/>
                    <input type='hidden' name="user_id" value="<?php echo base64_decode(urldecode($userId))?>"/>
                    <?php
                    $uId = base64_decode(urldecode($userId));
                    $task = $this->task_model->getTaskById(base64_decode(urldecode($taskId)));
                    if ($task):
                       // foreach ($all_tasks as $task):
                            echo $task[0]['title'];
                        //endforeach;
                    endif;
                    ?>
                </td>
                <td><?php
                    $user = $this->user_model->get_user_by_id($uId);
                    if ($user):
                            echo $user->name;
                            echo "<td>";
                            echo $user->email;
                            echo "</td>";
                    endif;
                    ?></td>
                <td>
                    <fieldset class="rating">
                        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                                <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                    </fieldset>
                </td>   
            </tr>
        </table>
    </div>
    <div class="form-group">
        <input type="submit" value="Finalize" class="btn btn-primary"/>
    </div>
</form>

