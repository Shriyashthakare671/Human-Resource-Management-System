<?php include 'include/header.php'; ?>
<?php 
    if(isset($_SESSION['userdata']))
    {
        $interviews = $jsondata->read_data('json/interview.json');
?>
        <link rel="stylesheet" href="assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">   
                                <b>Interview List</b>
                                <a href="interview.php" style="float: right;">New Interview</a>
                            </div>
                            <div class="card-body">
                                <?php
                                    // if(isset($_SESSION['success']))
                                    //     echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>'; 

                                    // if(isset($_SESSION['error']))
                                    //     echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>'; 
                                ?>
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="20%">Company Name</th>
                                                <th width="20%">Position</th>
                                                <th width="15%">Package</th>
                                                <th width="20%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if($interviews)
                                                {
                                                    $no = 0;
                                                    foreach($interviews as $key => $val)
                                                    {
                                                        if($jsondata->data_decryption($val->usertype) != 1)
                                                        {
                                                            $no++;
                                            ?>
                                                            <tr>
                                                                <td><?php echo $no; ?></td>
                                                                <td><?php echo ucwords($jsondata->data_decryption($val->cname)); ?></td>
                                                                <td><?php echo $jsondata->data_decryption($val->position); ?></td>
                                                                <td><?php echo $jsondata->data_decryption($val->package); ?></td>
                                                                <td>
                                                                    <a href="send_email.php?iid=<?php echo $val->id; ?>">Send Email</a> |
                                                                    <a href="interview.php?iid=<?php echo $val->id; ?>">Edit</a> |
                                                                    <a onclick="return confirm('Are you sure?')" href="submit_interview.php?iid=<?php echo $val->id; ?>&action=delete">Remove</a>
                                                                </td>
                                                            </tr>
                                            <?php
                                                        }
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
<?php
        include 'include/footer.php';
    } else {
        header("Location: index.php");
    }
?>