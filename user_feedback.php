<?php
    if(isset($_POST['submit'])) {
        session_start();
        
        require "constants.php";
        require "blockchain/blockchain.php";

        $jsondata = new Block_chain;
        $postdata['id'] = time();
        $postdata['user_id'] = $_POST['uid'];
        $postdata['comment'] = $jsondata->data_encryption($_POST['comment']);
        $postdata['created_by'] = $_SESSION['userdata']->id;
        $postdata['updated_by'] = $_SESSION['userdata']->id;
        $postdata['created_at'] = date("Y-m-d H:i:s");
        $postdata['updated_at'] = date("Y-m-d H:i:s");
        $jsondata->add_data('json/feedback.json',$postdata);

        header("Location: user_feedback.php?uid=".$_POST['uid']);
    } else {
        include 'include/header.php';

        $get = $_GET;
        if(isset($get['uid']) && $get['uid'] != "")
        {
            $userdata = $jsondata->read_row_data('json/user.json',$_GET['uid']);
            
            $title = "Feedback of ".ucfirst($jsondata->data_decryption($userdata->name));
            $action = "user_feedback.php";
            $btn = "Save";

            $is_given = 0;
            $comment = "";
            $feedback = $jsondata->read_data("json/feedback.json");
            if($feedback) {
                foreach($feedback as $key => $val) {
                    if($val->user_id == $_GET['uid'] && $val->created_by == $_SESSION['userdata']->id) {
                        $is_given = 1;
                        $comment = $jsondata->data_decryption($val->comment);
                    }
                }
            }
        }  
?>
        <div class="content">
            <header class="page-header">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h1 class="separator">Feedback</h1>
                    </div>
                </div>
            </header>
            <section class="page-content container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <form class="m-t-10" method="post" action="<?php echo $action; ?>" id="pForm">                                
                                <input type="hidden" name="uid" value="<?php echo $_GET['uid']; ?>" />

                                <h5 class="card-header"><?php echo $title; ?></h5>
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="colFormLabel" class="col-form-label">Comment</label>
                                            <textarea class="form-control" name="comment" id="comment" placeholder="Enter comment" <?php echo $is_given == 1 ? 'disabled' : ''; ?> required><?php echo $comment; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-light">
                                    <?php if($is_given == 0) { ?>
                                        <button class="btn <?php echo $btn == "Save" ? 'btn-success' : 'btn-success'; ?> m-r-10" type="submit" name="submit"><?php echo $btn; ?></button>
                                    <?php } ?>
                                    <a class="btn btn-danger m-r-10 text-white" href="other_users.php" id="back">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
<?php
        'include/footer.php';
    }
?>
