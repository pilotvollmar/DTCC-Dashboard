<?php

function CollectQuestionnaireData()
{
    $sql = "SELECT * FROM `practical_test_data_v0` WHERE 1";
    return fetchAll($sql);
}

function CreateQuestionnaireElement($id, $data)
{

    $vis_id = $id + 1;

    echo "<div class='container'>";
    echo "<div class='row border mt-3 mb-3 rounded-lg'>";
    echo "<div class='col'>";
    echo "<h5 class='mt-3'>" . $vis_id . ". " . $data[$id][1] . "</h5>";
    echo "<i><h6>" . $data[$id][2] . "</h6></i><br>";
    echo "<div class='input-group mb-3'>
  <input type='range' min='0' max='5' value='0' step='1' name='A[]' oninput='UpdateElem(this)' class='slider w-25' id='RangeSlider'>
  <div class='input-group-append'>
    <input class='output w-25' type='text' value='0' disabled>
  </div>
  
</div>
</div>
</div>
</div>";
}

function CollectCallsigns($rank, $region)
{
    $sql = "SELECT * FROM `callsigns` WHERE `min_rank` = $rank AND region = '$region' AND assigned_steam_id is null limit 10";

    return fetchAll($sql);
}

?>

<div class="container border">
    <h3> Practical Test: <?php echo $char_name ?></h3>
    <p class="">
        Let's get dis beautiful person on the road!!!
    </p>
</div>

<div class="container border">
    <form action="view_test.php" method="post">
        <?php $data = CollectQuestionnaireData();
        for ($i = 0; $i < count($data); $i++) {
            CreateQuestionnaireElement($i, $data);
        } ?>
        <div class="form-group col-3">
            <label for="callsign">
                <h3>Select Callsign</h3>
            </label>
            <select name="callsign" class="form-control" id="callsign" required>
                <?php $callsigns = CollectCallsigns(0, $region);
                foreach ($callsigns as $c) {
                    echo "<option>" . $c[0] . "</option>";
                }

                ?>
            </select>
        </div>
        <input name="steamid" value="<?php echo $student_steamid ?>" hidden>
        <input name="char_name" value="<?php echo $char_name ?>" hidden>
        <input name="test_type" value="practical" hidden>

        <button class="btn btn-success" type="submit">Submit</button>
        <a class="btn btn-secondary" href="table_tests.php">Go Back</a>
    </form>
</div>

<script>
    function IndexInClass(elem) {
        var sliders = document.getElementsByClassName("slider");
        var num = 0;
        for (var i = 0; i < sliders.length; i++) {
            if (sliders[i] === elem) {
                return i;
            }
        }
        return -1;
    }


    function UpdateElem(elem) {
        var sliders = document.getElementsByClassName("slider");
        var index = IndexInClass(elem);
        var output = document.getElementsByClassName("output")[index];
        output.value = elem.value;
    }



    // Update the current slider value (each time you drag the slider handle)
</script>