<?php include 'include/header.php'; ?>
<?php
    if(isset($_SESSION['userdata']))
    {
        $get = $_GET;
        if(isset($get['iid']) && $get['iid'] != "")
        {
            $patientdata = $jsondata->read_row_data('json/interview.json',$_GET['iid']);
            
            $title = "Edit Interview";
            $action = "submit_interview.php";
            $btn = "Save";

            $pid = $patientdata->id;
            $cname = $jsondata->data_decryption($patientdata->cname);
            $position = $jsondata->data_decryption($patientdata->position);
            $package = $jsondata->data_decryption($patientdata->package);
            $form_action = "edit";
        } else {
            $title = "New Interview";
            $action = "submit_interview.php";
            $btn = "Add";

            $pid = "";
            $cname = $jsondata->data_decryption($patientdata->cname);
            $position = $jsondata->data_decryption($patientdata->position);
            $package = $jsondata->data_decryption($patientdata->package);
            $form_action = "add";
        }
        $states = $jsondata->read_data('json/state.json');
?>
        <div class="content">
            <header class="page-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h1 class="separator">Interviews</h1>
                    </div>
                </div>
            </header>
            <section class="page-content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form class="m-t-10" method="post" action="<?php echo $action; ?>" id="pForm">
                                <input type="hidden" name="form_action" value="<?php echo $form_action; ?>" />
                                <input type="hidden" name="pid" value="<?php echo $pid; ?>" />

                                <h5 class="card-header"><?php echo $title; ?></h5>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">Company Name</label>
                                            <input type="text" class="form-control" name="cname" id="cname" value="<?php echo $cname; ?>" placeholder="Enter company name" autofocus="" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">Position</label>
                                            <input type="text" class="form-control" name="position" id="position" value="<?php echo $position; ?>" placeholder="Enter position" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">Package</label>
                                            <input type="text" class="form-control" name="package" id="package" value="<?php echo $package; ?>" placeholder="Enter package" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-light">
                                    <button class="btn <?php echo $cname == "" ? 'btn-success' : 'btn-success'; ?> m-r-10" type="submit"><?php echo $btn; ?></button>
                                    <a class="btn btn-danger m-r-10 text-white" href="interviews.php" id="back">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
<?php 
        'include/footer.php';
    } else {
        header("Location: index.php");
    }
?>
