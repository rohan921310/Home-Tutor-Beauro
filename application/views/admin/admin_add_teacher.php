<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title"><?= $page_name ?></h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>admin-dashboard">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= $page_name ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex no-block justify-content-end align-items-center">
                    <div class="mr-2">
                        <!-- <div class="lastmonth"></div> -->
                    </div>
                    <div class="">
                        <!-- <small>Total Teacher</small> -->
                        <!-- <h4 class="text-info mb-0 font-medium"><? ?></h4> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add New Teacher</h4>
                        <h6 class="card-subtitle"> Fill All Mandatory Fields <span style="color: red;">*</span> </h6>
                        <form class="mt-4" method="post" action="<?= base_url() ?>register_teacher"  enctype="multipart/form-data">

                            <div class="col-12 new">
                                <?php if ($msg = $this->session->flashdata('msg')) {
                                    if ($msg_class = $this->session->flashdata('msg_class')) {
                                ?>

                                        <div class="alert alert-<?= $msg_class ?>">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <b><?= $msg ?></b>
                                        </div>
                                <?php         }
                                }

                                ?>
                            </div>
                            <div class="form-group">
                                <label for="name">Full Name <span style="color: red;">*</span> </label>
                                <input type="text" class="form-control" name="teacher_name" id="name" placeholder="Enter Name" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email / Username <span style="color: red;">*</span></label>
                                <input type="email" class="form-control" id="email" name="teacher_email" required placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="teacher_password" value="123456" required id="password" placeholder="Password">
                            </div>

                            <div class="form-group">
                                <label for="number">WhatsApp Number <span style="color: red;">*</span> </label>
                                <input type="text" name="teacher_number" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" minlength="10" maxlength="10" class="form-control" id="number" placeholder="Enter WhatsApp Number" required>
                            </div>

                            <div class="form-group">
                                <label for="number">Default Commision </label>
                                <input type="text" name="teacher_commision" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" minlength="2" maxlength="2" class="form-control" id="number" placeholder="eg: 30,40,50">
                                <small id="emailHelp" class="form-text text-muted">Do not Include (%) symbol </small>
                            </div>
                            <hr>
                            <br>

                            <h5 class="card-subtitle">Basic Info</h5>

                            <div class="form-group">
                                <label for="address">Address </label>
                                <textarea class="form-control" value="" name="teacher_address" rows="2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="qualification">Qualification </label>
                                <textarea class="form-control" value="" name="teacher_qualification" rows="2"></textarea>
                            </div>
                            <hr>
                            <br>

                            <h5 class="card-subtitle">Images</h5>
                            <div class="form-group">
                                <label>Profile Pic <span style="color: red;">*</span> </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="profile_pic" required accept="image/jpeg, image/jpg, image/png" id="profile_pic">
                                        <label class="custom-file-label" for="profile_pic">Choose file</label>
                                    </div>
                                </div>
                                <small id="emailHelp" class="form-text text-muted">(.jpeg, .jpg, .png) </small>

                            </div>

                            <div class="form-group">
                                <label>Aadhar Card <span style="color: red;">*</span> </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept="application/pdf" required  name="aadhar" id="aadhar">
                                        <label class="custom-file-label" for="aadhar">Choose file</label>
                                    </div>
                                </div>
                                <small id="emailHelp" class="form-text text-muted">(.pdf) </small>
                            </div>

         

                            <hr>
                            <br>
                            <h5 class="card-subtitle">Subjects</h5>

                            <br>
                            <?php foreach ($classes as $class) { ?>

                                <h5 class=""><b><?= $class->class_name ?></b></h5>

                                <?php foreach ($subjects as $subject) { ?>
                                    <?php if ($class->class_id == $subject->class_id) { ?>
                                        <fieldset class="checkbox">
                                            <label>
                                                <input type="checkbox" name="subjects[]" value="<?= $subject->class_id ?>,<?= $subject->subject_id ?>"> <?= $subject->subject_name ?>
                                            </label>
                                        </fieldset>

                                    <?php } ?>

                                <?php } ?>
                                <br>
                            <?php } ?>





                            <!-- <div class="custom-control custom-checkbox mr-sm-2 mb-3">
                                        <input type="checkbox" class="custom-control-input" id="checkbox0" value="check">
                                        <label class="custom-control-label" for="checkbox0">Check Me Out !</label>
                                    </div> -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>