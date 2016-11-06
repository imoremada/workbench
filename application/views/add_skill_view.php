
<form method="post" action="<?php echo base_url(); ?>skill/addSkill">
    <div class="form-group">
        <label>Skill</label>
        <input class="form-control" type="text" name="skill" />
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" rows="3" name="description"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" value="Submit Skill" class="btn btn-primary"/>
    </div>
</form>

