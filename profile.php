<?php include 'include/header.php'; ?>
<?php
    if(isset($_SESSION['userdata']))
    {
        $empdata = $jsondata->read_row_data('json/user.json',$_SESSION['userdata']->id);
            
        $title = "Edit Profile";
        $action = "submit_profile.php";
        $btn = "Save";

        $pid = $empdata->id;
        $name = $jsondata->data_decryption($empdata->name);
        $phone = $jsondata->data_decryption($empdata->phone);
        $email = $jsondata->data_decryption($empdata->email);
        $experience = isset($empdata->experience) ? $jsondata->data_decryption($empdata->experience) : "";
        $package = isset($empdata->package) ? $jsondata->data_decryption($empdata->package) : "";
        $ssc = isset($empdata->ssc) ? $jsondata->data_decryption($empdata->ssc) : "";
        $linkedin = isset($empdata->linkedin) ? $jsondata->data_decryption($empdata->linkedin) : "";
        $graduation = isset($empdata->graduation) ? $jsondata->data_decryption($empdata->graduation) : "";
        $post_graduation = isset($empdata->post_graduation) ? $jsondata->data_decryption($empdata->post_graduation) : "";
        $no_project = isset($empdata->no_project) ? $jsondata->data_decryption($empdata->no_project) : "";
        $form_action = "edit";
?>
        <div class="content">
            <header class="page-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h1 class="separator">Profile</h1>
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
                                            <label for="colFormLabel" class="col-form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" placeholder="Enter name" autofocus="" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">Phone</label>
                                            <input type="number" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">Experience (in year)</label>
                                            <input type="text" class="form-control" name="experience" id="experience" value="<?php echo $experience; ?>" placeholder="Enter experience" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">Package (LPA)</label>
                                            <input type="text" class="form-control" name="package" id="package" value="<?php echo $package; ?>" placeholder="Enter package" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">SSC (%)</label>
                                            <input type="text" class="form-control" name="ssc" id="ssc" value="<?php echo $ssc; ?>" placeholder="Enter ssc (%)" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">Linkedin URL</label>
                                            <input type="text" class="form-control" name="linkedin" id="linkedin" value="<?php echo $linkedin; ?>" placeholder="Enter linkedin url" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">Graduation</label>
                                            <input type="text" class="form-control" name="graduation" id="graduation" value="<?php echo $graduation; ?>" placeholder="Enter graduation" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">Post Graduation</label>
                                            <input type="text" class="form-control" name="post_graduation" id="post_graduation" value="<?php echo $post_graduation; ?>" placeholder="Enter post graduation" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">No. of project</label>
                                            <input type="text" class="form-control" name="no_project" id="no_project" value="<?php echo $no_project; ?>" placeholder="Enter no. of project" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-light">
                                    <button class="btn <?php echo $name == "" ? 'btn-success' : 'btn-success'; ?> m-r-10" type="submit"><?php echo $btn; ?></button>
                                    <a class="btn btn-danger m-r-10 text-white" href="dashboard.php" id="back">Back</a>
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
