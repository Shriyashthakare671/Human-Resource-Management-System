<?php include 'include/header.php'; ?>
<?php
    if(isset($_SESSION['userdata']))
    {
        $get = $_GET;
        if(isset($get['iid']) && $get['iid'] != "")
        {
            $patientdata = $jsondata->read_row_data('json/past.json',$_GET['iid']);
            
            $title = "Edit Past Company";
            $action = "submit_past_company.php";
            $btn = "Save";

            $pid = $patientdata->id;
            $cname = $jsondata->data_decryption($patientdata->cname);
            $sdate = $jsondata->data_decryption($patientdata->sdate);
            $edate = $jsondata->data_decryption($patientdata->edate);
            $experience = $jsondata->data_decryption($patientdata->experience);
            $package = $jsondata->data_decryption($patientdata->package);
            $form_action = "edit";
        } else {
            $title = "New Past Company";
            $action = "submit_past_company.php";
            $btn = "Add";

            $pid = "";
            $cname = "";
            $sdate = "";
            $edate = "";
            $experience = "";
            $package = "";
            $form_action = "add";
        }
        $states = $jsondata->read_data('json/state.json');
?>
        <div class="content">
            <header class="page-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h1 class="separator">Past Companies</h1>
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
                                            <label for="colFormLabel" class="col-form-label">Joining Date</label>
                                            <input type="date" class="form-control" name="sdate" id="sdate" value="<?php echo $sdate; ?>" max="<?php echo date('Y-m-d'); ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">Last Date</label>
                                            <input type="date" class="form-control" name="edate" id="edate" value="<?php echo $edate; ?>" max="<?php echo date('Y-m-d'); ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">Experience </label>
                                            <input type="text" class="form-control" name="experience" id="experience" value="<?php echo $experience; ?>" placeholder="Enter experience" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">Package (LPA)</label>
                                            <input type="text" class="form-control" name="package" id="package" value="<?php echo $package; ?>" placeholder="Enter package" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-light">
                                    <button class="btn <?php echo $cname == "" ? 'btn-success' : 'btn-success'; ?> m-r-10" type="submit"><?php echo $btn; ?></button>
                                    <a class="btn btn-danger m-r-10 text-white" href="past_companies.php" id="back">Back</a>
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
