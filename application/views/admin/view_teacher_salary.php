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
                            <!-- <li class="breadcrumb-item"><a href="<?= base_url() ?>admin-dashboard">Home</a></li> -->
                            <li class="breadcrumb-item"><a href="<?= base_url() ?>admin/teacher_salary">Back</a></li>
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

        <!-- basic table -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Pay Salary</h4>
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="student_fee">Fee <span style="color: red;">*</span> </label>
                                <div class="controls">

                                    <input type="text" name="student_fee" required data-validation-required-message="Fee is required" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="student_fee" placeholder="Fee...">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="student_fee">Paid On <span style="color: red;">*</span> </label>
                                <div class="controls">

                                    <input type="date" value="" name="paid_on" required data-validation-required-message="Fee is required" class="form-control" id="paid_on">
                                </div>
                            </div>

                            <button type="button" class="mt-3 btn waves-effect waves-light btn-info">Pay</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Fee Collected (Student)</h4>
                        <div class="table-responsive mt-3 status_update">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Seen</th>
                                        <th>Student</th>
                                        <th>Amount</th>
                                        <th>Class</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="filter_table">
                                    <?php $i = 1;
                                    foreach ($teacher_fees as $fee) { ?>

                                        <tr>

                                            <td>
                                                <?php
                                                if ($fee->paid_to_teacher == 0) { ?>
                                                    <div class="material-switch pull-right">
                                                        <input class="fee_status" id="status_<?= $fee->student_fee_id ?>" value="<?= $fee->seen_status ?>" <?php if ($fee->seen_status == 1) {
                                                                                                                                                                echo ('checked="1"');
                                                                                                                                                            } ?> name="status_<?= $fee->student_fee_id ?>" type="checkbox" />
                                                        <label for="status_<?= $fee->student_fee_id ?>" class="label-primary"></label>
                                                    </div>
                                                <?php  } else { ?>
                                                    <b style="color: green">Paid</b>
                                                <?php }
                                                ?>
                                            </td>
                                            <td><b><?= $fee->student_name ?></b></td>
                                            <td> <b>₹ <?= $fee->student_fee_amount ?></b> </td>
                                            <td> <b><?= $fee->student_fee_class_id ?></b> </td>

                                            <td> <b><?= $fee->subscribe_till ?></b> </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-6 show_data" id="data_<?= $fee->student_fee_id ?>" data-toggle="modal" data-target="#show_data">
                                                        <i class="fas fa-eye" style="color: blue;"></i>
                                                    </div>

                                                    <?php if ($fee->paid_to_teacher == 0) { ?>
                                                        <div class="col-6">
                                                            <a href="<?= base_url() ?>admin/delete_student_fee?student_fee_id=<?= $fee->student_fee_id ?>">
                                                                <i class="fas fa-trash" style="color: red"></i>
                                                            </a>
                                                        </div>
                                                    <?php  } ?>

                                                </div>

                                            </td>

                                        </tr>
                                        <?php $i++; ?>
                                    <?php     } ?>


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Seen</th>
                                        <th>Student</th>
                                        <th>Amount</th>
                                        <th>Class</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Salary Date</h4>
                    </div>
                    <div class="card-body bg-light">
                        <div class="row text-center">
                            <div class="col-6 mt-2 mb-2">
                                <span class="label label-warning">In Progress</span>
                            </div>
                            <div class="col-6 mt-2 mb-2">
                                May 2, 2018 9:49
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card-body">
                                <h5 class="pt-3">Ticket Creator</h5>
                                <span>User Name</span>
                                <h5 class="mt-4">Support Staff</h5>
                                <span>Agent Name</span>
                                <br/>
                                <button type="button" class="mt-3 btn waves-effect waves-light btn-success">Update</button>
                            </div> -->
                </div>
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title"><?= $teacher['teacher_name'] ?></h4>
                        <div class="profile-pic mb-3 mt-3">
                            <img src="<?= base_url() ?>uploads/<?= $teacher['teacher_pic'] ?>" width="150" class="rounded-circle" alt="user">
                            <h4 class="mt-3 mb-0"><?= $teacher['teacher_number'] ?></h4>
                            <a href="mailto:<?= $teacher['teacher_email'] ?>"><?= $teacher['teacher_email'] ?></a>
                        </div>
                        <div class="row text-center mt-5">
                            <div class="col-4">
                                <h3 class="font-bold">₹ 4</h3>
                                <h6>Salary</h6>
                            </div>
                            <div class="col-4">
                                <h3 class="font-bold">₹ <?= $teacher['teacher_balance'] ?></h3>
                                <h6>Balance</h6>
                            </div>
                            <div class="col-4">
                                <h3 class="font-bold"><?php echo ($this->Admin_model->fetch_unseen_teacher_fee($teacher['teacher_id'])); ?></h3>
                                <h6>Fee Not Collected</h6>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="p-25 border-top mt-3">
                                <div class="row text-center">
                                    <div class="col-6 border-right">
                                        <a href="#" class="link d-flex align-items-center justify-content-center font-medium"><i class="mdi mdi-message font-20 mr-1"></i>Message</a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="link d-flex align-items-center justify-content-center font-medium"><i class="mdi mdi-developer-board font-20 mr-1"></i>Portfolio</a>
                                    </div>
                                </div>
                            </div> -->
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ticket Statestics</h4>
                        <div id="visitor" style="height:290px; width:100%;" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <link href="<?= base_url() ?>assets/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    <script src="<?= base_url() ?>assets/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/pages/datatable/datatable-basic.init.js"></script>