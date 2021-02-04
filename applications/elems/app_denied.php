<?php
function FormatReasons($app)
{
    $reasons = $app->status_desc;
    $additionalInfo = $app->additional_info;

    if ($reasons[0] == 1) {
        echo "<li>User was previously Banned from DTCC.</li>";
    }
    if ($reasons[1] == 1) {
        echo "<li>Invalid Character Name</li>";
    }
    if ($reasons[2]) {
        echo "<li>Invalid Phone Number</li>";
    }
    if ($reasons[3]) {
        echo "<li>Invalid Discord Name</li>";
    }
    if ($reasons[4]) {
        echo "<li>Invalid Steam Profile Link</li>";
    }
    if ($reasons[5]) {
        echo "<li>User's backstory is improper.</li>";
    }
    if ($reasons[6]) {
        echo "<li>User's reason is improper.</li>";
    }
    if ($reasons[7]) {
        if ($reasons[8] == 0) {
            echo "They have been asked to reapply immediately.<br>";
        }
        if ($reasons[8] == 1) {
            echo "They have been asked to reapply tomorrow.<br>";
        }
        if ($reasons[8] > 1) {
            echo "They have been asked to reapply in " . $reasons[8] . " days.<br>";
        }
        if ($reasons[8] == 0) {
            echo "They have been asked not to reapply again<br>";
        }
        
    }
    if (!$reasons[7]) {
        echo "They have been asked not to reapply again<br>";
    }
    if ($additionalInfo) {
        echo "Additional Info: <br><br>";
        echo $additionalInfo . "<br>";
    }
}

function FormatCopyPasta($app)
{
    $reasons = $app->status_desc;
    $additionalInfo = $app->additional_info;
    echo "Hello " . $app->name . ".<br>";
    echo "Unfortunately, your application for Downtown Cab Co. has been Rejected.<br>";
    echo "The reason(s) given are as follows:<br><br>";

    if ($reasons[0] == 1) {
        echo "You have been barred from using DTCC Services.<br><br>";
    }
    if ($reasons[1] == 1) {
        echo "Your Character Name is invalid.<br>";
    }
    if ($reasons[2]) {
        echo "Your Phone Number is invalid.<br>";
    }
    if ($reasons[3]) {
        echo "Your Discord Username is incorrect.<br>";
    }
    if ($reasons[4]) {
        echo "We cannot find your SteamID from the provided URL. (Do you have your profile set to private?)<br>";
    }
    if ($reasons[5]) {
        echo "Your Backstory is invalid.<br>";
    }
    if ($reasons[6]) {
        echo "Your reason for wanting to join us is invalid.<br>";
    }
    if ($additionalInfo) {
        echo "<br>Additional Info:<br>";
        echo $additionalInfo . "<br><br>";
    }
    if ($reasons[7]) {
        if ($reasons[8] == 0) {
            echo "We recommend you create another application as soon as you can.<br>";
        }
        if ($reasons[8] == 1) {
            echo "We recommend that you reapply tomorrow.<br>";
        }
        if ($reasons[8] > 1) {
            echo "We recommend that you reapply in " . $reasons[8] . " days.<br>";
        }
        if($reasons[8] < 0)
        {
            echo "We recommend that you do not apply for DTCC again.<br>";
        }
    }
    if (!$reasons[7]) {
        echo "We recommend that you do not apply for DTCC again.<br>";
    }

    echo "Regards<br>" . $app->signed_by . "<br> (This message was autogenerated.)";
}


?>

<div class="row">
    <div class="col">
        <div class="container-result"><span class="d-flex justify-content-center align-items-center span-denied">Denied</span>
            <div class="row justify-content-center">
                <div class="col-auto d-flex justify-content-end align-items-center">
                    <div>
                        <div class="input-group d-flex justify-content-end justify-content-sm-center igroup-read">
                            <div class="input-group-prepend"><span class="d-flex justify-content-end input-group-text span-form">Signed:&nbsp;</span></div><input class="form-control d-flex d-xl-flex justify-content-start igroup-read-input" type="text" value="<?= $app_info->signed_by; ?>" readonly="" style="max-width: 200px;">
                            <div class="input-group-append"></div>
                        </div>
                        <div class="input-group d-flex justify-content-end justify-content-sm-center igroup-read">
                            <div class="input-group-prepend"><span class="d-flex justify-content-end input-group-text span-form">Date:&nbsp;</span></div><input class="form-control d-flex d-xl-flex justify-content-start igroup-read-input" type="text" value="<?= $app_info->signed_date; ?>" readonly="" style="max-width: 200px;">
                            <div class="input-group-append"></div>
                        </div>
                    </div>
                </div>
                <div class="col-auto d-flex justify-content-start align-items-center"><button class="btn btn-dark btn-lg fas fa-edit" data-toggle="modal" data-target="#PastaModal" type="button"></button></div>
                <div class="col-auto"><label>Reasons:</label>
                    <ul class="text-left">
                        <?php FormatReasons($app_info); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="PastaModal" tabindex="-1" role="dialog" aria-labelledby="PastaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="PastaModalLabel">Useful CopyPastas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <h6>Copy/paste for recruit: <?= $app_info->discord ?></h6>
                    <div class="border p-4">
                        <?php FormatCopyPasta($app_info); ?>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>