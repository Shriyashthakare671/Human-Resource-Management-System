<?php include 'include/header.php'; ?>
<?php 
    if(isset($_SESSION['userdata']))
    {
        $users = $jsondata->read_data('json/user.json');
?>
        <link rel="stylesheet" href="assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
        <div class="content">
            <header class="page-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h1 class="separator">Students</h1>
                    </div>
                </div>
            </header>

            <section class="page-content container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">   
                                <b>Student List</b>
                            </div>
                            <div class="card-body">
                                <?php
                                    if(isset($_SESSION['success']))
                                        echo '<div class="alert alert-success" hidden>'.$_SESSION['success'].'</div>'; 

                                    if(isset($_SESSION['error']))
                                        echo '<div class="alert alert-danger" hidden>'.$_SESSION['error'].'</div>'; 
                                ?>
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="20%">Name</th>
                                                <th width="20%">Email</th>
                                                <th width="15%">Phone</th>
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if($users)
                                                {
                                                    $no = 0;
                                                    foreach($users as $key => $val)
                                                    {
                                                        if($jsondata->data_decryption($val->usertype) != 1 && $val->id != $_SESSION['userdata']->id)
                                                        {
                                                            $no++;
                                            ?>
                                                            <tr>
                                                                <td><?php echo $no; ?></td>
                                                                <td><?php echo ucwords($jsondata->data_decryption($val->name)); ?></td>
                                                                <td><?php echo $jsondata->data_decryption($val->email); ?></td>
                                                                <td><?php echo $jsondata->data_decryption($val->phone); ?></td>
                                                                <td><a href="user_feedback.php?uid=<?php echo $val->id; ?>">Feedback</a></td>
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