<div class="row">
    <div class="col border rounded text-center">
        <?php if ($status == "accept") {
            include_once "inc_view_app_signed_accepted.php";
        }
        if ($status == "deny") {
            include_once "inc_view_app_signed_rejected.php";
        }
        ?>
        <a type="button" class="btn btn-secondary" data-dismiss="modal" href="applications.php">Go Back</a>
    </div>

</div>