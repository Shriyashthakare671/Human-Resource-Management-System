<?php include 'include/header.php'; ?>
<?php 
    if(isset($_SESSION['userdata']))
    {
        $interviews = $jsondata->read_data('json/feedback.json');
        $users = $jsondata->read_data('json/user.json');
?>
        <link rel="stylesheet" href="assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
        <div class="content">
            <header class="page-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h1 class="separator">Feedbacks</h1>
                    </div>
                </div>
            </header>

            <section class="page-content container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">   
                                <b>Feedback List</b>
                            </div>
                            <div class="card-body">
                                <?php
                                    if(isset($_SESSION['success']))
                                        echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>'; 

                                    if(isset($_SESSION['error']))
                                        echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>'; 
                                ?>
                                <div class="table-responsive">
                                    <table id="table" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="20%">Comment</th>
                                                <th width="20%">Employee</th>
                                                <th width="20%">Given By</th>
                                                <th width="20%">Date</th>
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
                                                                <td><?php echo ucwords($jsondata->data_decryption($val->comment)); ?></td>
                                                                <td>
                                                                    <?php 
                                                                        $name = "";
                                                                        if($users) {
                                                                            foreach($users as $user) {
                                                                                if($val->user_id == $user->id)
                                                                                    $name = $jsondata->data_decryption($user->name);
                                                                            }
                                                                        }
                                                                        echo $name;
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php 
                                                                        $name = "";
                                                                        if($users) {
                                                                            foreach($users as $user) {
                                                                                if($val->created_by == $user->id)
                                                                                    $name = $jsondata->data_decryption($user->name);
                                                                            }
                                                                        }
                                                                        echo $name;
                                                                    ?>
                                                                </td>
                                                                <td><?php echo date('d-M-Y',strtotime($val->created_at)); ?></td>
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