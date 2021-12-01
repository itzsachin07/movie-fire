<?php include('session.php'); ?>
<?php include("public/menubar.php"); ?>
<link href="assets/css/bootstrap-select.css" rel="stylesheet">
<script src="assets/js/ckeditor/ckeditor.js"></script>

<?php

    include('public/fcm.php');

    $qry = "SELECT * FROM tbl_settings where id = '1'";
    $result = mysqli_query($connect, $qry);
    $settings_row = mysqli_fetch_assoc($result);

    if(isset($_POST['submit'])) {

        $sql_query = "SELECT * FROM tbl_settings WHERE id = '1'";
        $img_res = mysqli_query($connect, $sql_query);
        $img_row=  mysqli_fetch_assoc($img_res);

        $data = array(
            'app_fcm_key' => $_POST['app_fcm_key'],
            'api_key' => $_POST['api_key'],
            'package_name' => $_POST['package_name'],
            'onesignal_app_id' => $_POST['onesignal_app_id'],
            'onesignal_rest_api_key' => $_POST['onesignal_rest_api_key'],
            'providers' => $_POST['providers'],
            'protocol_type' => $_POST['protocol_type'],
            'privacy_policy' => $_POST['privacy_policy'],
            'youtube_api_key' => $_POST['youtube_api_key']
        );

        $update_setting = Update('tbl_settings', $data, "WHERE id = '1'");

        if ($update_setting > 0) {
                $succes =<<<EOF
                    <script>
                    alert('Settings Updated Successfully...');
                    window.location = 'settings.php';
                    </script>
EOF;
                echo $succes;
        }
    }

?>


    <section class="content">

        <ol class="breadcrumb">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li class="active">Settings</a></li>
        </ol>

       <div class="container-fluid">

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <form method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="header">
                            <h2>SETTINGS</h2>
                            <div class="header-dropdown m-r--5">
                                <button type="submit" name="submit" class="btn bg-blue waves-effect">SAVE SETTINGS</button>
                            </div>
                        </div>
                        <div class="body">

                            <div class="row clearfix">
                            <div class="col-sm-12">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <div class="font-12"><b>applicationId (Package Name)</b></div>
                                            <input type="text" class="form-control" name="package_name" id="package_name" value="<?php echo $settings_row['package_name'];?>" required>
                                        </div>
                                        <div class="help-info pull-left"><a href="" data-toggle="modal" data-target="#modal-package-name">What is my package name?</a></div>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                            <div class="font-12"><b>Push Notification Provider</b></div>
                                                <select class="form-control show-tick" name="providers" id="providers">
                                                        <?php if ($settings_row['providers'] == 'onesignal') { ?>
                                                            <option value="onesignal" selected="selected">OneSignal</option>
                                                            <option value="firebase">Firebase Cloud Messaging (FCM)</option>
                                                        <?php } else { ?>
                                                            <option value="onesignal">OneSignal</option>
                                                            <option value="firebase" selected="selected">Firebase Cloud Messaging (FCM)</option>
                                                        <?php } ?>
                                                </select>
                                        <div class="help-info pull-left"><font color="#337ab7">Choose your provider for sending push notification</font></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                            <div class="font-12"><b>Protocol Type</b></div>
                                                <select class="form-control show-tick" name="protocol_type" id="protocol_type">
                                                        <?php if ($settings_row['protocol_type'] == 'http') { ?>
                                                            <option value="http" selected="selected">HTTP</option>
                                                            <option value="https">HTTPS</option>
                                                        <?php } else { ?>
                                                            <option value="http">HTTP</option>
                                                            <option value="https" selected="selected">HTTPS</option>
                                                        <?php } ?>
                                                </select>
                                        <div class="help-info pull-left"><font color="#337ab7">Choose your website protocol type</font></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <div class="font-12"><b>YouTube API Key</b></div>
                                            <input type="text" class="form-control" name="youtube_api_key" id="youtube_api_key" value="<?php echo $settings_row['youtube_api_key'];?>" required>
                                        </div>
                                        <div class="help-info pull-left"><a href="" data-toggle="modal" data-target="#modal-youtube-api-key">How to obtain your YouTube API Key?</a></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <div class="font-12"><b>FCM Server Key</b></div>
                                            <input type="text" class="form-control" name="app_fcm_key" id="app_fcm_key" value="<?php echo $settings_row['app_fcm_key'];?>" required>
                                        </div>
                                        <div class="help-info pull-left"><a href="" data-toggle="modal" data-target="#modal-server-key">How to obtain your FCM Server Key?</a></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <div class="font-12"><b>OneSignal APP ID</b></div>
                                            <input type="text" class="form-control" name="onesignal_app_id" id="onesignal_app_id" value="<?php echo $settings_row['onesignal_app_id'];?>" required>
                                        </div>
                                        <div class="help-info pull-left"><a href="" data-toggle="modal" data-target="#modal-onesignal">Where do I get my OneSignal app id?</a></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <div class="font-12"><b>OneSignal Rest API Key</b></div>
                                            <input type="text" class="form-control" name="onesignal_rest_api_key" id="onesignal_rest_api_key" value="<?php echo $settings_row['onesignal_rest_api_key'];?>" required>
                                        </div>
                                        <div class="help-info pull-left"><a href="" data-toggle="modal" data-target="#modal-onesignal">Where do I get my OneSignal Rest API Key?</a></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <div class="font-12"><b>API Key</b></div>
                                            <input type="text" class="form-control" name="api_key" id="api_key" value="<?php echo $settings_row['api_key'];?>" required>
                                        </div>
                                        <div class="help-info pull-left"><a href="" data-toggle="modal" data-target="#modal-api-key">Where I have to put my API Key?</a> | <a href="change-api-key.php"><span class="label bg-blue">CHANGE API KEY</span></a></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    
                                    <div class="form-group">
                                        <div class="form-line">
                                            <div class="font-12 ex1"><b>Privacy Policy</b></div>
                                            <textarea class="form-control" name="privacy_policy" id="privacy_policy" class="form-control" cols="60" rows="10" required><?php echo $settings_row['privacy_policy'];?></textarea>

                                            <?php if ($ENABLE_RTL_MODE == 'true') { ?>
                                            <script>                             
                                                CKEDITOR.replace( 'privacy_policy' );
                                                CKEDITOR.config.contentsLangDirection = 'rtl';
                                            </script>
                                            <?php } else { ?>
                                            <script>                             
                                                CKEDITOR.replace( 'privacy_policy' );
                                                CKEDITOR.config.height = 400; 
                                            </script>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            </div>
                        </div>
                    </div>
                    </form>

                </div>
            </div>
            
        </div>

    </section>


<?php include('public/footer.php'); ?>