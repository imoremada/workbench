<div id="item-div">
    <table class="table table-hover table-condensed table-bordered">
        <thead>
        <th>User</th>
        <th>Rating</th>
        <th>Email</th>
        </thead>
        
        <tr>
            <?php
             $uId = base64_decode(urldecode($userId));
             $userInfo = $this->user_model->get_user_by_id($uId);
            ?>
            <td><?php if ($userInfo):
                            echo $userInfo->name;
                    endif; ?>
             <td>
                    <fieldset class="rating">
                        <?php if($rating == '5'){?>
                        <input type="radio" id="star5" name="rating" value="5" checked="" disabled=""/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4" name="rating" value="4" disabled=""/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3" name="rating" value="3" disabled=""/><label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" id="star2" name="rating" value="2" disabled=""/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1" name="rating" value="1" disabled=""/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                        <?php }
                        else if(($rating == '4')){
                        ?>   
                        <input type="radio" id="star5" name="rating" value="5" disabled=""/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4" name="rating" value="4" checked="" disabled=""/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3" name="rating" value="3" disabled=""/><label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" id="star2" name="rating" value="2" disabled=""/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1" name="rating" value="1" disabled=""/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                        <?php } 
                        else if(($rating == '3')){?>
                        <input type="radio" id="star5" name="rating" value="5" disabled=""/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4" name="rating" value="4" disabled=""/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3" name="rating" value="3" checked="" disabled=""/><label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" id="star2" name="rating" value="2" disabled=""/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1" name="rating" value="1" disabled=""/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                        <?php } 
                        else if(($rating == '2')){?>
                        <input type="radio" id="star5" name="rating" value="5" disabled=""/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4" name="rating" value="4" disabled=""/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3" name="rating" value="3" disabled=""/><label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" id="star2" name="rating" value="2" checked="" disabled=""/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1" name="rating" value="1" disabled=""/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                        <?php } 
                        else if(($rating == '1')){?>
                        <input type="radio" id="star5" name="rating" value="5" disabled=""/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4" name="rating" value="4" disabled=""/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3" name="rating" value="3" disabled=""/><label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" id="star2" name="rating" value="2" disabled=""/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1" name="rating" value="1" checked="" disabled=""/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                        <?php } else {?>
                         <input type="radio" id="star5" name="rating" value="5" disabled=""/><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4" name="rating" value="4" disabled=""/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3" name="rating" value="3" disabled=""/><label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" id="star2" name="rating" value="2" disabled=""/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1" name="rating" value="1" disabled=""/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                        <?php }?>
                    </fieldset>
                </td>   
                <td>
                    <?php if ($userInfo):
                            echo $userInfo->email;
                    endif; ?>
                </td>
        </tr>
    </table>
</div>
