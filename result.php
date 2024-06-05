<?php include 'include/header.php'; ?>
<?php 
    // if(isset($_SESSION['userdata']))
    // {
        $is_exam_given = 0;
        $obj = [];
        $tests = $jsondata->read_data('json/mcq.json');
        
        if($tests) {
            foreach($tests as $test) {
                if($test->created_by == $_GET['eid']) {
                    $is_exam_given = 1;
                    $obj = $test;
                }
            }
        }
        $udata = $jsondata->read_row_data('json/user.json',$_GET['eid']);
        if($jsondata->data_decryption($_SESSION['userdata']->usertype) == 1 && !empty($obj)) {
            $total = 15;
            $true = 0;
            $cat1 = 0;
            $cat2 = 0;
            $cat3 = 0;
            if($obj->q1 == 1)
                $cat1++;

            if($obj->q2 == 1)
                $cat1++;

            if($obj->q3 == 1)
                $cat1++;

            if($obj->q4 == 1)
                $cat1++;

            if($obj->q5 == 1)
                $cat1++;

            if($obj->q6 == 1)
                $cat2++;

            if($obj->q7 == 1)
                $cat2++;

            if($obj->q8 == 1)
                $cat2++;

            if($obj->q9 == 1)
                $cat2++;

            if($obj->q10 == 1)
                $cat2++;

            if($obj->q11 == 1)
                $cat3++;

            if($obj->q12 == 1)
                $cat3++;

            if($obj->q13 == 1)
                $cat3++;

            if($obj->q14 == 1)
                $cat3++;

            if($obj->q15 == 1)
                $cat3++;

                
?>
            <div class="content">
            <header class="page-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h1 class="separator">Result of <?php echo ucwords($jsondata->data_decryption($udata->name)); ?></h1>
                    </div>
                </div>
            </header>
            <section class="page-content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <canvas id="chartjs_pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </section>
            </div>
            <script>
                var cat1 = "<?php echo $cat1; ?>";
                var cat2 = "<?php echo $cat2; ?>";
                var cat3 = "<?php echo $cat3; ?>";
            </script>
<?php
        }
        include 'include/footer.php'; 
    // } else {
    //     header("Location: index.php");
    // }
?>