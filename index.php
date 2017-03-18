<?php include "header.php" ?>

<p>Writers fullfil our lifes with pleasure an knowledge.It is good to know about them, enjoy this with <h5>Linked Data.</h5></p>
<form action="retrieve.php" method="post">
Resources to Get:<select name="k" class="col-lg-12">
   <?php for($i=10;$i<=50;$i++){
     echo "<option value=".$i.">$i</option>" ;
    }
   ?>
    </select>
    Order By:<select name="order" class="active">
        <option>BirthDate</option>
        <option>DeathDate</option>
    </select>
    Criteria:<select name="criteria" class="col-lg-12">
        <option>Education</option>
        <option>Birth Place</option>
        <option>CitizenShip</option>
        <option>Nation</option>
    </select>
    <input type="submit" name="get" value="Get the List" class="btn-success"><br><br><br><br><br><br>
    <input type="submit" name="next" value="next" class="btn-success">
    <input type="submit" name="previous" value="previous" class="btn-success">

</form>
<?php include "footer.php" ?>


 