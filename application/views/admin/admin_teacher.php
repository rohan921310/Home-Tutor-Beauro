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

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">View Teachers</h4>
                <h6 class="card-subtitle">Click to Expand</h6>
                <div class="table-responsive">
                    <table id="demo-foo-row-toggler" class="table table-bordered" data-sorting="true" data-filtering="true" data-toggle-column="first">
                        <thead>
                            <tr>
                                <th data-breakpoints="xs">S No.</th>
                                <th>Full Name</th>
                                <th>WhatsApp No.</th>
                                <th data-breakpoints="xs sm">Email ID</th>
                                <th data-breakpoints="xs">Password</th>
                                <th data-breakpoints="all" data-title="Aadhar">Aadhar Pic</th>
                                <th data-breakpoints="all" data-title="Address">Address</th>
                                <th data-breakpoints="all" data-title="Qualification">Qualification</th>
                                <th data-breakpoints="all" data-title="Default Commision">Default Commision</th>
                                <th data-breakpoints="all" data-title="Classes">Teaching Area</th>
                                <th data-breakpoints="all" data-title="Subjects">Subjects</th>
                                <th data-breakpoints="all" data-title="Status">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($teachers)) {
                                $i = 1;

                                foreach ($teachers as $teacher) { ?>
                                    <tr data-expanded="false">
                                        <td>
                                            <?= $i ?>
                                        </td>
                                        <td>

                                            <?php
                                            $url = base_url() . 'assets/assets/images/users/1.jpg';
                                            if ($teacher->teacher_pic != '') {
                                                $url = base_url() . 'uploads/' . $teacher->teacher_pic;
                                            } ?>
                                              <?php if ($teacher->teacher_status == 0) { ?>
                                                <img src="<?= $url ?>" alt="" width="40" class="rounded-circle" /> <b style="color: #fd2323;"> <?= $teacher->teacher_name ?></b>
                                                <?php }else{ ?>
                                                    <a href="javascript:void(0)"><img src="<?= $url ?>" alt="" width="40" class="rounded-circle" /><b> <?= $teacher->teacher_name ?></b></a>

                                               <?php  } ?>
                                        </td>
                                        <td> <b><?= $teacher->teacher_number ?></b> </td>
                                        <td> <b><?= $teacher->teacher_email ?></b></td>
                                        <td><span class="label label-danger"> <b><?= $teacher->teacher_password ?></b></span> </td>
                                        <td><?php
                                            $url = base_url() . 'assets/assets/images/users/1.jpg';
                                            if ($teacher->teacher_pic != '') {
                                                $url = base_url() . 'uploads/' . $teacher->teacher_aadhar;
                                            } ?>
                                            <a class="btn btn-primary" href="<?= base_url() ?>uploads/<?= $teacher->teacher_aadhar ?>" target="_blank">View</a>
                                        </td>
                                        <td> <b><?= $teacher->teacher_address ?></b> </td>
                                        <td> <b><?= $teacher->teacher_qualification ?></b> </td>
                                        <td> <b><?= $teacher->teacher_commision ?> %</b> </td>
                                        <td>
                                            <b>
                                                <?php $teacher_classes = $this->Admin_model->fetch_teacher_class($teacher->teacher_id);
                                                foreach ($teacher_classes as $class_fetch) {
                                                    print_r($class_fetch->class_name . ", ");
                                                }
                                                ?>
                                            </b>
                                        </td>

                                        <td>

                                            <?php $teacher_subjects = $this->Admin_model->fetch_teacher_subject($teacher->teacher_id);
                                            foreach ($teacher_subjects as $subject_fetch) {
                                                print_r($subject_fetch->class_name . " <b>(" . $subject_fetch->subject_name . ")</b>, ");
                                            }
                                            ?>

                                        </td>

                                        <td>
                                            <div>
                                                <?php if ($teacher->teacher_status == 0) { ?>

                                                    <a href="<?= base_url() ?>admin/change_teacher_status/1/<?= $teacher->teacher_id ?>" class="btn btn-info">Accept</a>
                                                <?php } else { ?>
                                                    <a href="<?= base_url() ?>admin/change_teacher_status/0/<?= $teacher->teacher_id ?>" class="btn btn-danger">Reject</a>

                                                <?php }  ?>
                                            </div>
                                        </td>

                                    </tr>
                                    <?php $i++; ?>
                            <?php }
                            } ?>




                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <script src="<?= base_url() ?>assets/assets/libs/moment/moment.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/assets/libs/footable/js/footable.min.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/pages/tables/footable-init.js"></script>