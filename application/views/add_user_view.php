<form method="post" action="<?php echo base_url(); ?>user/addUser">
    <div class="form-group">
        <label>Name</label>
        <input class="form-control" type="text" name="name" />
    </div>
    <div class="form-group">
        <label>Email</label>
        <input class="form-control" type="text" name="email" />
    </div>
    <div class="form-group">
        <label>NIC</label>
        <input class="form-control" type="text" name="nic" />
    </div>
    <div class="form-group">
        <label>Current City</label>
        <input class="form-control" type="text" name="currentCity" />
    </div>
    <div class="form-group">
        <label>Phone 1</label>
        <input class="form-control" type="text" name="phone1" />
    </div>
    <div class="form-group">
        <label>Phone 2</label>
        <input class="form-control" type="text" name="phone2" />
    </div>
    <div class="form-group">
        <label for="description">Address</label>
        <textarea class="form-control" rows="3" name="address"></textarea>
    </div>
    <div class="form-group">
        <label>Role</label>
        <select name="role">
         <?php
            $roles =  $this->role_model->getAllRoles();
            foreach ($roles as $role)
            {
                echo '<option  value="'.$role['id'] .'" >'. $role['name'].'</option>';
            }
            ?>
            </select>
    </div>
    <div class="form-group">
        <label>Skills</label>

        <br/>
        <?php
        $skills = $this->skill_model->getAllSkills();
        foreach ($skills as $skill) {
            echo '<input type="checkbox" name="skills[]" value="' . $skill['id'] . '" />' . $skill['type'] . '<br />';
        }
        ?>

    </div>
     <div class="form-group">
        <label for="description">Password</label>
        <input type="password" name="password"/>
    </div>
    <div class="form-group">
        <input type="submit" value="Submit Skill" class="btn btn-primary"/>
    </div>
</form>
