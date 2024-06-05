<?php include 'include/header.php'; ?>
<?php 
    if(isset($_SESSION['userdata']))
    {
        $companies = $jsondata->read_data('json/past.json');
?>
        <link rel="stylesheet" href="assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">   
                                <b>Company List</b>
                                <a href="past_company.php" style="float: right;">New Past Company</a>
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
                                                <th width="20%">Company Name</th>
                                                <th width="20%">Joining Date</th>
                                                <th width="20%">Last Date</th>
                                                <th width="15%">Package</th>
                                                <th width="20%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if($companies)
                                                {
                                                    $no = 0;
                                                    foreach($companies as $key => $val)
                                                    {
                                                        if($val->created_by == $_SESSION['userdata']->id)
                                                        {
                                                            $no++;
                                            ?>
                                                            <tr>
                                                                <td><?php echo $no; ?></td>
                                                                <td><?php echo ucwords($jsondata->data_decryption($val->cname)); ?></td>
                                                                <td><?php echo $jsondata->data_decryption($val->sdate); ?></td>
                                                                <td><?php echo $jsondata->data_decryption($val->edate); ?></td>
                                                                <td><?php echo $jsondata->data_decryption($val->package); ?></td>
                                                                <td>
                                                                    <a href="past_company.php?iid=<?php echo $val->id; ?>">Edit</a> |
                                                                    <a onclick="return confirm('Are you sure?')" href="submit_past_company.php?iid=<?php echo $val->id; ?>&action=delete">Remove</a>
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