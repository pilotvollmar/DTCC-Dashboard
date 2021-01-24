<?php include "include/components/head.php";
include "include/sqlconnection.php";
include "include/elements.php";

function CreateTableUnread()
{
    //$btn = "<a class='btn btn-table' href='/applications/view_app.php?doc_id=0'>View Application</a>"; //DEBUG
    $sql = "SELECT * FROM `unread_apps`";
    $tblHeaders = ["Date", "Player Name", "Discord Name", ""];
    $result = Query($sql);
    if ($result) {
        $tblBody = array();
        foreach ($result as $row) {
            $tblRow = array();
            $tblRow[] = toDate($row->app_timestamp);
            $tblRow[] = $row->char_name;
            $tblRow[] = $row->discord_name;
            $tblRow[] = "<a class='btn btn-table' href='/applications/view_app.php?doc_id=" . $row->app_id . "'>View</a>";
            $tblBody[] = $tblRow;
        }
    } else {
        $tblBody = [[]];
    }
    return Tablefy($tblHeaders, $tblBody);
}

?>
<!-- <a class='btn btn-secondary mt-1 mb-3' data-toggle="tooltip" data-placement="top" title="Request access if you haven't got it yet" target="_blank" href='https://drive.google.com/drive/folders/1DkeJJ5uiEdpRJ0KCDMmGQsKFPxOaPzF4?usp=sharing'>Google Drive Folder</a>
<a class='btn btn-secondary mt-1 mb-3' data-toggle="tooltip" data-placement="top" title="Login to GitHub" target="_blank" href='https://github.com/pilotvollmar/DTCC-Dashboard/issues'>Feedback</a>
<br> -->


<section>
    <div class="container-fluid d-flex">
        <div class="row">
            <div class="col-auto d-flex flex-column flex-grow-0 flex-shrink-1 col-index">
                <h4 class="h-title">New Applicants</h4>
                <h5 class="h-subtitle">Need Friends?</h5>
                <div class="table-responsive">
                    <?php CreateTableUnread() ?>
                </div>
            </div>
            <div class="col d-xl-flex flex-column justify-content-xl-center align-items-xl-center">
                <h5 class="h-subtitle">Useful Links</h5><a class="btn btn-secondary m-1" href="https://drive.google.com/drive/folders/1DkeJJ5uiEdpRJ0KCDMmGQsKFPxOaPzF4?usp=sharing">Google&nbsp;Drive&nbsp;Folder<br></a><a class="btn btn-secondary m-1" href="#">Feedback</a>
                <a class="btn btn-secondary m-1" href="#">Link</a><a class="btn btn-secondary m-1" href="#">Link</a>
            </div>
        </div>
    </div>
</section>


<?php

if ($_SESSION['rank'] > 2) {

    include "include/inc_index_senior.php";
}

include "include/components/foot.php";
