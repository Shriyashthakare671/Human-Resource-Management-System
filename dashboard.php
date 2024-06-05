<?php include 'include/header.php'; ?>
<?php 
    if(isset($_SESSION['userdata']))
    {
        $is_exam_given = 0;
        $obj = [];
        $tests = $jsondata->read_data('json/mcq.json');
        if($tests) {
            foreach($tests as $test) {
                if($test->created_by == $_SESSION['userdata']->id) {
                    $is_exam_given = 1;
                    $obj = $test;
                }
            }
        }

        if($jsondata->data_decryption($_SESSION['userdata']->usertype) == 2) {
            $total = 15;
            $true = 0;
            if(isset($obj->q1) && $obj->q1 == 1)
                $true ++;

            if(isset($obj->q2) && $obj->q2 == 1)
                $true ++;

            if(isset($obj->q3) && $obj->q3 == 1)
                $true ++;

            if(isset($obj->q4) && $obj->q4 == 1)
                $true ++;

            if(isset($obj->q5) && $obj->q5 == 1)
                $true ++;

            if(isset($obj->q6) && $obj->q6 == 1)
                $true ++;

            if(isset($obj->q7) && $obj->q7 == 1)
                $true ++;

            if(isset($obj->q8) && $obj->q8 == 1)
                $true ++;

            if(isset($obj->q9) && $obj->q9 == 1)
                $true ++;

            if(isset($obj->q10) && $obj->q10 == 1)
                $true ++;

            if(isset($obj->q11) && $obj->q11 == 1)
                $true ++;

            if(isset($obj->q12) && $obj->q12 == 1)
                $true ++;

            if(isset($obj->q13) && $obj->q13 == 1)
                $true ++;

            if(isset($obj->q14) && $obj->q14 == 1)
                $true ++;

            if(isset($obj->q15) && $obj->q15 == 1)
                $true ++;
?>
            <div class="content">
                <header class="page-header">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h1 class="separator">MCQ Test</h1>
                        </div>
                    </div>
                </header>
                <section class="page-content container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <form class="m-t-10" method="post" action="submit_mcq.php" id="mcqForm">
                                    <h5 class="card-header">
                                        Skill Test
                                        <a style="float: right;"><?php echo $true."/".$total; ?></a>
                                    </h5>
                                    <div class="card-body">
                                        <h2>
                                            Frontend
                                            <?php
                                                $cat1 = 0;
                                                if(isset($obj->q1) && $obj->q1 == 1)
                                                    $cat1 ++;

                                                if(isset($obj->q2) && $obj->q2 == 1)
                                                    $cat1 ++;

                                                if(isset($obj->q3) && $obj->q3 == 1)
                                                    $cat1 ++;

                                                if(isset($obj->q4) && $obj->q4 == 1)
                                                    $cat1 ++;

                                                if(isset($obj->q5) && $obj->q5 == 1)
                                                    $cat1 ++;
                                            ?>
                                            <a style="float: right;"><?php echo $cat1."/5"; ?></a>
                                        </h2>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h4>1) Full Form of HTML?<?php
                                                            if(isset($obj->q1) && $obj->q1 == 1)
                                                                echo "<a style='float: right;'>Right</a>";
                                                        ?></h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php if($is_exam_given == 0) { ?>
                                                            <input type="radio" name="q1" value="1" required /> 
                                                        <?php } ?>
                                                        Hyper Text Markup Language
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <?php if($is_exam_given == 0) { ?>
                                                            <input type="radio" name="q1" value="2" required /> 
                                                        <?php } ?>
                                                        Hyper Team Markup Language</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q1" value="3" required /><?php } ?> Hyper Text Marketing Language</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q1" value="4" required /><?php } ?> Heavy Text Markup Language</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><h4>2) Which tag is used to display image in HTML?<?php
                                                            if(isset($obj->q2) && $obj->q2 == 1)
                                                                echo "<a style='float: right;'>Right</a>";
                                                        ?></h4></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q2" value="3" required /><?php } ?> TABLE tag</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q2" value="2" required /><?php } ?> MARQUEE tag</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q2" value="1" required /><?php } ?> IMG tag</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q2" value="4" required /><?php } ?> DIV tag</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><h4>3) Which tag is used to display video in HTML?<?php
                                                            if(isset($obj->q3) && $obj->q3 == 1)
                                                                echo "<a style='float: right;'>Right</a>";
                                                        ?></h4></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q3" value="3" required /><?php } ?> SPAN tag</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q3" value="2" required /><?php } ?> IMG tag</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q3" value="4" required /><?php } ?> P tag</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q3" value="1" required /><?php } ?> VIDEOs tag</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><h4>4) Full form of CSS?<?php
                                                            if(isset($obj->q4) && $obj->q4 == 1)
                                                                echo "<a style='float: right;'>Right</a>";
                                                        ?></h4></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q4" value="4" required /><?php } ?> Colorued Style Sheets</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q4" value="1" required /><?php } ?> Cascading Style Sheets</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q4" value="2" required /><?php } ?> Color & Style Sheets</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q4" value="3" required /><?php } ?> None of above</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><h4>5) Which property is used to change color of text to white using css?<?php
                                                            if(isset($obj->q5) && $obj->q5 == 1)
                                                                echo "<a style='float: right;'>Right</a>";
                                                        ?></h4></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q5" value="4" required  /><?php } ?> background-color: #FFFFFF</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q5" value="1" required /><?php } ?> color: #FFFFFF</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q5" value="2" required /><?php } ?> font-color: #FFFFFF</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q5" value="3" required /><?php } ?> None of above</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td align="center"><center>------------------------------------------------------------------------------------------------------------------------------------------------------    </center></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <h2>Backend
                                            <?php
                                                $cat1 = 0;
                                                if(isset($obj->q6) && $obj->q6 == 1)
                                                    $cat1 ++;

                                                if(isset($obj->q7) && $obj->q7 == 1)
                                                    $cat1 ++;

                                                if(isset($obj->q8) && $obj->q8 == 1)
                                                    $cat1 ++;

                                                if(isset($obj->q9) && $obj->q9 == 1)
                                                    $cat1 ++;

                                                if(isset($obj->q10) && $obj->q10 == 1)
                                                    $cat1 ++;
                                            ?>
                                            <a style="float: right;"><?php echo $cat1."/5"; ?></a>
                                        </h2>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><h4>6) What is PHP?<?php
                                                            if(isset($obj->q6) && $obj->q6 == 1)
                                                                echo "<a style='float: right;'>Right</a>";
                                                        ?></h4></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q6" value="1" required /><?php } ?> PHP is an open-source programming language</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q6" value="2" required /><?php } ?> PHP is used to develop dynamic and interactive websites</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q6" value="3" required /><?php } ?> PHP is a server-side scripting language</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q6" value="4" required /><?php } ?>  All of the mentioned</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><h4>7) Who is the father of PHP?<?php
                                                            if(isset($obj->q7) && $obj->q7 == 1)
                                                                echo "<a style='float: right;'>Right</a>";
                                                        ?></h4></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q7" value="3" required /><?php } ?> Drek Kolkevi</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q7" value="2" required /><?php } ?> Willam Makepiece</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q7" value="1" required /><?php } ?> Rasmus Lerdorf</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q7" value="4" required /><?php } ?> List Barely</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><h4>8) Which of the following is the correct way to add a comment in PHP code?<?php
                                                            if(isset($obj->q8) && $obj->q8 == 1)
                                                                echo "<a style='float: right;'>Right</a>";
                                                        ?></h4></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q8" value="3" required /><?php } ?> #</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q8" value="2" required /><?php } ?> //</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q8" value="4" required /><?php } ?> /* */</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q8" value="1" required /><?php } ?> All of the mentioned</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><h4>9) Which of the following is the default file extension of PHP files?<?php
                                                            if(isset($obj->q9) && $obj->q9 == 1)
                                                                echo "<a style='float: right;'>Right</a>";
                                                        ?></h4></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q9" value="1" required /><?php } ?> .php</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q9" value="4" required /><?php } ?> .ph</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q9" value="2" required /><?php } ?> .xml</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q9" value="3" required /><?php } ?> .html</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><h4>10) Which is the right way of declaring a variable in PHP?<?php
                                                            if(isset($obj->q10) && $obj->q10 == 1)
                                                                echo "<a style='float: right;'>Right</a>";
                                                        ?></h4></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q10" value="4" required /><?php } ?> $5_Hello</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q10" value="1" required /><?php } ?> $_hello</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q10" value="2" required /><?php } ?> $3hello</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q10" value="3" required /><?php } ?> $this</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td align="center"><center>------------------------------------------------------------------------------------------------------------------------------------------------------    </center></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <h2>
                                            Database
                                            <?php
                                                $cat1 = 0;
                                                if(isset($obj->q11) && $obj->q11 == 1)
                                                    $cat1 ++;

                                                if(isset($obj->q12) && $obj->q12 == 1)
                                                    $cat1 ++;

                                                if(isset($obj->q13) && $obj->q13 == 1)
                                                    $cat1 ++;

                                                if(isset($obj->q14) && $obj->q14 == 1)
                                                    $cat1 ++;

                                                if(isset($obj->q15) && $obj->q15 == 1)
                                                    $cat1 ++;
                                            ?>
                                            <a style="float: right;"><?php echo $cat1."/5"; ?></a>
                                        </h2>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><h4>11) To see all the databases which command is used?<?php
                                                            if(isset($obj->q11) && $obj->q11 == 1)
                                                                echo "<a style='float: right;'>Right</a>";
                                                        ?></h4></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q11" value="1" required /><?php } ?> Show databases;</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q11" value="2" required /><?php } ?> Show database;</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q11" value="3" required /><?php } ?> Show database();</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q11" value="4" required /><?php } ?>  Show_all database;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><h4>12) Which of the following command is used to delete a database?<?php
                                                            if(isset($obj->q12) && $obj->q12 == 1)
                                                                echo "<a style='float: right;'>Right</a>";
                                                        ?></h4></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q12" value="3" required /><?php } ?> DELETE DATABASE_NAME;</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q12" value="2" required /><?php } ?> DROP DATABASE_NAME;</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q12" value="1" required /><?php } ?> DROP DATABASE DATABASE_NAME;</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q12" value="4" required /><?php } ?> DELETE DATABASE DATABASE_NAME;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><h4>13) ALTER command is a type of which SQL command?<?php
                                                            if(isset($obj->q13) && $obj->q13 == 1)
                                                                echo "<a style='float: right;'>Right</a>";
                                                        ?></h4></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q13" value="3" required /><?php } ?> DML</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q13" value="2" required /><?php } ?> DQL</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q13" value="4" required /><?php } ?> DCL</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q13" value="1" required /><?php } ?> DDL</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><h4>14) Suppose you have 1000 records and you only want 100 records which of the following clause you will use?<?php
                                                            if(isset($obj->q14) && $obj->q14 == 1)
                                                                echo "<a style='float: right;'>Right</a>";
                                                        ?></h4></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q14" value="1" required /><?php } ?> LIMIT</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q14" value="4" required /><?php } ?> SET LIMIT</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q14" value="2" required /><?php } ?> HAVING</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q14" value="3" required /><?php } ?> GROUP BY</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td><h4>15) Which key helps us to establish the relationship between two tables?<?php
                                                            if(isset($obj->q15) && $obj->q15 == 1)
                                                                echo "<a style='float: right;'>Right</a>";
                                                        ?></h4></td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q15" value="4" required /><?php } ?> Candidate key</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q15" value="1" required /><?php } ?> Foreign key</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q15" value="2" required /><?php } ?> Primary key</td>
                                                </tr>
                                                <tr>
                                                    <td> <?php if($is_exam_given == 0) { ?><input type="radio" name="q15" value="3" required /><?php } ?> Unique key</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <?php if($is_exam_given == 0) { ?>
                                        <button type="submit" class="btn btn-sm btn-success">SUBMIT</button>
                                        <?php } ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
<?php
        } else {
            $users = $jsondata->read_data('json/user.json');
            $feedbacks = $jsondata->read_data('json/feedback.json');
?>
            <header class="page-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h1 class="separator">Dashboard</h1>
                    </div>
                </div>
            </header>
            <section class="page-content container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="row m-0 col-border-xl">
                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="card-body">
                                        <div class="icon-rounded icon-rounded-primary float-left m-r-20">
                                            <i class="icon dripicons-graph-bar"></i>
                                        </div>
                                        <h5 class="card-title m-b-5 counter" data-count="<?php echo count($users); ?>"><?php echo count($users); ?></h5>
                                        <h6 class="text-muted m-t-10">
                                            Total Users
                                        </h6>
                                        <div class="progress progress-active-sessions mt-4" style="height:7px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo count($users); ?>%;" aria-valuenow="<?php echo count($users); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small class="text-muted float-right m-t-5 mb-3 counter append-percent" data-count="<?php echo count($users); ?>"><?php echo count($users); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="card-body">
                                        <div class="icon-rounded icon-rounded-primary float-left m-r-20">
                                            <i class="icon dripicons-graph-bar"></i>
                                        </div>
                                        <h5 class="card-title m-b-5 counter" data-count="<?php echo count($feedbacks); ?>"><?php echo count($feedbacks); ?></h5>
                                        <h6 class="text-muted m-t-10">
                                            Total Feedbacks
                                        </h6>
                                        <div class="progress progress-active-sessions mt-4" style="height:7px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo count($feedbacks); ?>%;" aria-valuenow="<?php echo count($feedbacks); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small class="text-muted float-right m-t-5 mb-3 counter append-percent" data-count="<?php echo count($feedbacks); ?>"><?php echo count($feedbacks); ?></small>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-6 col-xl-4">
                                    <div class="card-body">
                                        <div class="icon-rounded icon-rounded-primary float-left m-r-20">
                                            <i class="icon dripicons-graph-bar"></i>
                                        </div>
                                        <h5 class="card-title m-b-5 counter" data-count="<?php echo count($users); ?>"><?php echo count($users); ?></h5>
                                        <h6 class="text-muted m-t-10">
                                            Total Resumes
                                        </h6>
                                        <div class="progress progress-active-sessions mt-4" style="height:7px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo count($users); ?>%;" aria-valuenow="<?php echo count($users); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small class="text-muted float-right m-t-5 mb-3 counter append-percent" data-count="<?php echo count($users); ?>"><?php echo count($users); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
<?php
        }
        include 'include/footer.php'; 
    } else {
        header("Location: index.php");
    }
?>