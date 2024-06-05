<?php include 'include/header.php'; ?>
<?php
    if(isset($_SESSION['userdata']))
    {
        $get = $_GET;
        if(isset($get['pid']) && $get['pid'] != "")
        {
            $patientdata = $jsondata->read_row_data('json/user.json',$_GET['pid']);
            
            $title = $jsondata->data_decryption($userdata['usertype']) == 1 ? "New User" : "New Shopkeeper";
            $action = "submit_user.php";
            $btn = "Save";

            $pid = $patientdata->id;
            $name = $jsondata->data_decryption($patientdata->name);
            $phone = $jsondata->data_decryption($patientdata->phone);
            $email = $jsondata->data_decryption($patientdata->email);
            $state = $jsondata->data_decryption($patientdata->state);
            $form_action = "edit";
        } else {
            $title = $jsondata->data_decryption($userdata['usertype']) == 1 ? "New User" : "New Shopkeeper";
            $action = "submit_user.php";
            $btn = "Add";

            $pid = "";
            $name = "";
            $phone = "";
            $email = "";
            $state = "";
            $form_action = "add";
        }
        $states = $jsondata->read_data('json/state.json');
?>
        <div class="content">
            <header class="page-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h1 class="separator">
                        <?php
                            if($jsondata->data_decryption($userdata['usertype']) == 1)
                                echo 'Users';
                            else 
                                echo 'Shopkeepers';
                            ?>
                        </h1>
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
                                            <label for="colFormLabel" class="col-form-label">Phone</label>
                                            <input type="number" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>" placeholder="Enter phone" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" placeholder="Enter email" required />
                                        </div>
                                    </div>
                                    <?php 
                                        if($name == "")
                                        {
                                    ?>
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label for="colFormLabel" class="col-form-label">Password</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required />
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">State</label>
                                            <select id="state" name="state" class="form-control" required="">
                                                <option value="">State</option>
                                                <?php 
                                                    foreach($states as $state)
                                                    {
                                                        echo '<option value="'.$state->name.'">'.$state->name.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-light">
                                    <button class="btn <?php echo $name == "" ? 'btn-success' : 'btn-success'; ?> m-r-10" type="submit"><?php echo $btn; ?></button>
                                    <a class="btn btn-danger m-r-10 text-white" href="users.php" id="back">Back</a>
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
