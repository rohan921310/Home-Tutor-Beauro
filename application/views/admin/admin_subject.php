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
                        <h4 class="card-title">Add New Subject</h4>
                        <h6 class="card-subtitle"> Fill All Mandatory Fields <span style="color: red;">*</span> </h6>
                        <form class="mt-4" method="post" action="<?= base_url() ?>admin/add_subject">

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
                                <label>Select Class</label>
                                <select class="custom-select col-12" name="class_id" required id="inlineFormCustomSelect">
                                    <option selected>Choose...</option>
                                    <?php foreach ($classes as $class) { ?>
                                        <option value="<?= $class->class_id ?>"><?= $class->class_name ?></option>

                                    <?php  } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Subject Name <span style="color: red;">*</span> </label>
                                <input type="text" class="form-control" name="subject_name" id="name" placeholder="Subject Name" required>
                            </div>


                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Manage Subjects</h4>
                        <!-- <h6 class="card-subtitle">DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code> $().DataTable();</code>. You can refer full documentation from here <a href="https://datatables.net/">Datatables</a></h6> -->
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Class</th>
                                        <th>Subject Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($subjects as $subject) { ?>

                                        <tr>

                                            <td> <b> <?= $subject->class_name ?></b></td>
                                            <td><?= $subject->subject_name ?></td>
                                            <td>
                                                <a href="<?= base_url() ?>admin/delete_subject?subject_id=<?= $subject->subject_id ?>">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>


                                        </tr>
                                    <?php     } ?>


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Class</th>
                                        <th>Subject Name</th>

                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <link href="<?= base_url() ?>assets/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    <script src="<?= base_url() ?>assets/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/pages/datatable/datatable-basic.init.js"></script>