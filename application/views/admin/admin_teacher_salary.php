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
                        <h4 class="card-title">View Teacher Salary: </h4>
                        <br>


                        <div class="row el-element-overlay">

                            <?php foreach ($teachers as $teacher) {   ?>

                                <div class="col-sm-3">
                                    <div class="card">

                                        <div class="el-card-item">
                                            <div class="el-card-avatar el-overlay-1 " style="height: 23vh;"> <img src="<?= base_url() ?>uploads/<?= $teacher->teacher_pic ?>" alt="user">
                                                <div class="el-overlay">
                                                    <ul class="list-style-none el-info">
                                                        <li class="el-item"><a class="btn default btn-outline el-link" href="<?= base_url() ?>admin/view_teacher_salary?teacher_id=<?= $teacher->teacher_id ?>"><i class="mdi mdi-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="el-card-content">
                                                <h4 class="mb-0"><?= $teacher->teacher_name ?></h4> <span class="text-muted">+91-<?= $teacher->teacher_number ?></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php } ?>

                        </div>




                    </div>
                </div>
            </div>

        </div>



    </div>