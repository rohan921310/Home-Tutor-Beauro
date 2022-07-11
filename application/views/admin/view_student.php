<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/assets/libs/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">

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

                        <div class="col-12">
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

                        <button type="submit" data-toggle="modal" data-target="#myModal" class="btn btn-info"> <i class="fas fa-plus"></i> Student</button>
                        <button style="float: right;" type="button" class="btn btn-primary"> <i class="fas fa-eye"></i> All Students</button>


                        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Add Student</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <form class="mt-1" id="form2" novalidate>
                                        <div class="modal-body new">

                                            <div class="form-group">
                                                <label>Class <span style="color: red;">*</span></label>
                                                <div class="controls">

                                                    <select class="custom-select col-12" id="class_id" name="class_id" onchange="changeSubject(event)">
                                                        <option value="">Choose...</option>
                                                        <?php for ($i = 12; $i > 0; $i--) { ?>
                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                        <?php  } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Subject <span style="color: red;">*</span></label>
                                                <div class="controls">

                                                    <select class="custom-select col-12" id="subject_id" onchange="changeTeacher(event)" name="subject_id">
                                                        <option value="">Choose...</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Teacher <span style="color: red;">*</span></label>
                                                <div class="controls">
                                                    <select class="custom-select col-12" id="teacher_id" onchange="showTeacherDetails(event)" name="teacher_id" required data-validation-required-message="Select Class And Subject First">
                                                        <option value="">Choose...</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div id="teacher_details" style="margin:14px">
                                            </div>

                                            <hr>
                                            <div class="form-group">
                                                <label for="student_name">Student Full Name <span style="color: red;">*</span> </label>
                                                <div class="controls">
                                                    <input type="text" name="student_name" required data-validation-required-message="Name is required" class="form-control" id="student_name" placeholder="Student Name">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="student_number">WhatsApp Number <span style="color: red;">*</span> </label>
                                                <div class="controls">
                                                    <input type="text" name="student_number" required data-validation-required-message="Number is required" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" minlength="10" maxlength="10" class="form-control" id="student_number" placeholder="WhatsApp Number">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="student_fee">Fees <span style="color: red;">*</span> </label>
                                                <div class="controls">

                                                    <input type="text" name="student_fee" required data-validation-required-message="Fee is required" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="student_fee" placeholder="Fee" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="student_fee">Commision <span style="color: red;">*</span> </label>
                                                <div class="controls">

                                                    <input type="text" id="student_commision" value="" name="student_commision" required data-validation-required-message="Commision is required" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="student_fee" placeholder="Commision" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="controls">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" checked value="1" name="notifications" class="custom-control-input" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">WhatsApp Notifications</label>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-info waves-effect">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>




                    </div>
                </div>
            </div>
        </div>

        <div class="row">


            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Enrolled Student: </h4>
                        <br>
                        Filters:
                        <form id="apply_filters">
                            <div class="row">

                                <div class="form-group col-sm-4">

                                    <select class="custom-select col-12" id="filter_class_id" name="class_id">
                                        <option value="0">Classs..</option>
                                        <?php for ($i = 12; $i > 0; $i--) { ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php  } ?>
                                    </select>
                                </div>

                                <div class="form-group col-sm-4">

                                    <select class="custom-select col-12" id="filter_subject_id" name="subject_id">
                                        <option value="0">Subjects..</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-4">
                                    <select class="custom-select col-12" id="filter_teacher_id" name="teacher_id">
                                        <option value="0">Teachers..</option>
                                    </select>
                                </div>
                            </div>

                            <div style="text-align: center;">

                                <button type="submit" class="btn btn-danger">Apply Filters</button>
                            </div>
                        </form>




                        <!-- <h6 class="card-subtitle">DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function:<code> $().DataTable();</code>. You can refer full documentation from here <a href="https://datatables.net/">Datatables</a></h6> -->
                        <div class="table-responsive mt-3 status_update">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Class</th>
                                        <th>Subject</th>
                                        <th>Student</th>
                                        <th>Number</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody id="filter_table">
                                    <?php $i = 1;
                                    foreach ($students as $student) { ?>

                                        <tr>
                                            <td>
                                                <div class="material-switch pull-right">
                                                    <input class="student_status" id="status_<?= $student->student_table_id ?>" value="<?= $student->student_subject_status ?>" <?php if ($student->student_subject_status == 1) {
                                                                                                                                                                                    echo ('checked="1"');
                                                                                                                                                                                } ?> name="status_<?= $student->student_table_id ?>" type="checkbox" />
                                                    <label for="status_<?= $student->student_table_id ?>" class="label-primary"></label>
                                                </div>
                                            </td>
                                            <td> <b> <?= $student->student_class ?></b> </td>
                                            <td> <b> <?= $student->subject_name ?></b> </td>
                                            <td><b><?= $student->student_name ?></b></td>
                                            <td>+91-<b><a href="tel:+91-<?= $student->student_number ?>"><?= $student->student_number ?> </a> </b></td>

                                            <td>
                                                <div class="row">
                                                    <div class="col-6 show_data" id="data_<?= $student->student_table_id ?>" data-toggle="modal" data-target="#show_data">
                                                        <i class="fas fa-eye" style="color: blue;"></i>
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="<?= base_url() ?>admin/delete_student_subject?student_table_id=<?= $student->student_table_id ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    <?php     } ?>


                                </tbody>
                                <tfoot>
                                    <tr>

                                        <th>Status</th>
                                        <th>Class</th>
                                        <th>Subject</th>
                                        <th>Student</th>
                                        <th>Number</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>



                        <div id="show_data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">More Details</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>

                                    <div class="modal-body new">


                                        <div id="show_details">


                                            <div class="card">
                                                <div class="card-body" id="show_student_one">



                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>

                                    </div>

                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>



    <link href="<?= base_url() ?>assets/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">

    <script src="<?= base_url() ?>assets/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/pages/datatable/datatable-basic.init.js"></script>

    <script>
        function showTeacherDetails(e) {
            var teacher = $("#teacher_id").val();
            $('.alert').remove();
            if (teacher == '') {
                var html = '';
                $('#teacher_details').html(html);

            } else {
                let teacher_details = teacher.split(",");
                var html = '';
                html += '<a href="javascript:void(0)" style="color:#f52d51" ><img src="<?= base_url() ?>uploads/' + teacher_details[2] + '" alt="" width="40" class="rounded-circle"><b style="margin: 2px 10px;color: #2862ff;">' + teacher_details[3] + '</b>: +91-' + teacher_details[1] + '</a>'

                $('#teacher_details').html(html);

                var teacher = $("#student_commision").val(teacher_details[4]);

            }
        }


        function changeSubject(e) {
            var teacher = $("#teacher_id").val('');
            showTeacherDetails();
            var html2 = '';
            html2 += '<option value=""  > Choose..';
            html2 += '</option>';
            $('#teacher_id').html(html2);

            $.ajax({
                    url: '<?php echo base_url(); ?>admin/fetch_subjects',
                    type: 'POST',
                    data: {
                        class_id: e.target.value
                    },
                })
                .done(function(res) {
                    $('.alert').remove();
                    res = JSON.parse(res);
                    var html = '';
                    html += '<option value="0"  > Choose Subject';
                    html += '</option>';

                    $.each(res, function(index, val) {
                        html += '<option value="' + val["subject_id"] + '">' + val["subject_name"] + '</option>';
                    });
                    $('#subject_id').html(html);
                    var teacher = $("#student_commision").val('');

                });

        }

        function changeTeacher(e) {
            var class_id = $("#class_id").val();
            var subject_id = e.target.value;

            var teacher = $("#teacher_id").val('');
            showTeacherDetails();
            var html2 = '';
            html2 += '<option value=""  > Choose..';
            html2 += '</option>';

            $('#teacher_id').html(html2);

            $.ajax({
                    url: '<?php echo base_url(); ?>admin/fetch_teacher',
                    type: 'POST',
                    data: {
                        class_id: class_id,
                        subject_id: subject_id
                    },
                })
                .done(function(res) {
                    res = JSON.parse(res);
                    if (res == '') {
                        $('.alert').remove();
                        var tmpl = '<div class="alert alert-danger alert-dismissable">' +
                            '<button class="close" data-dismiss="alert">&times;</button>' +
                            'No Teachers Available' +
                            '</div>';
                        $('.new').prepend(tmpl);
                        setTimeout(function() {
                            $('.alert').addClass('on');
                        }, 200);
                        var teacher = $("#student_commision").val('');


                    } else {
                        $('.alert').remove();
                        var html = '';
                        html += '<option value=""  > Choose Teacher';
                        html += '</option>';

                        $.each(res, function(index, val) {
                            html += '<option value="' + val["teacher_id"] + ',' + val["teacher_number"] + ',' + val["teacher_pic"] + ',' + val["teacher_name"] + ',' + val["teacher_commision"] + '">' + val["teacher_name"] + '</option>';
                        });
                        $('#teacher_id').html(html);

                    }
                });
        }


        $('#filter_class_id').on('change', function(event) {
            var teacher = $("#filter_teacher_id").val('');
            var html2 = '';
            html2 += '<option value="0"  > Choose..';
            html2 += '</option>';

            $('#filter_teacher_id').html(html2);

            var id = event.target.value;
            $.ajax({
                    url: '<?php echo base_url(); ?>admin/fetch_subjects',
                    type: 'POST',
                    data: {
                        class_id: id
                    },
                })
                .done(function(res) {
                    $('.alert').remove();
                    res = JSON.parse(res);
                    var html = '';
                    html += '<option value="0"  > Choose Subject..';
                    html += '</option>';

                    $.each(res, function(index, val) {
                        html += '<option value="' + val["subject_id"] + '">' + val["subject_name"] + '</option>';
                    });
                    $('#filter_subject_id').html(html);
                });
        })

        $('#filter_subject_id').on('change', function(event) {
            var subject_id = event.target.value;
            var class_id = $("#filter_class_id").val();
            console.log(subject_id + class_id);
            $.ajax({
                    url: '<?php echo base_url(); ?>admin/fetch_teacher',
                    type: 'POST',
                    data: {
                        class_id: class_id,
                        subject_id: subject_id
                    },
                })
                .done(function(res) {
                    $('.alert').remove();
                    res = JSON.parse(res);
                    var html = '';
                    html += '<option value="0"  > Choose Teacher..';
                    html += '</option>';

                    $.each(res, function(index, val) {
                        html += '<option value="' + val["teacher_id"] + '">' + val["teacher_name"] + '</option>';
                    });
                    $('#filter_teacher_id').html(html);
                });
        })







        $(document).ready(function($) {

            $(document).on("click", '.show_data', function() {
                var id = this.id;
                var id_arr = id.split("_");
                $.ajax({
                        url: '<?php echo base_url(); ?>admin/get_student_table_one',
                        type: 'POST',
                        data: {
                            student_table_id: id_arr[1]
                        },
                    })
                    .done(function(res) {
                        res = JSON.parse(res);
                        let status = 'Enrolled';
                        let color = 'green';

                        if (res[0].student_subject_status == 0) {
                            status = 'Rejected';
                            color = 'red';
                        }
                        var html = '';
                        html += '';
                        html += '<h5 class="card-title">';
                        html += '<div class="row">';
                        html += '<div class="col-3">';
                        html += '<b>' + res[0].student_name + '</b> ';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<b> +91-' + res[0].student_number + '</b>';
                        html += '</div>';
                        html += '</div>';
                        html += '</h5>';
                        html += '<p class="card-text">';
                        html += '<div class="row">';
                        html += '<div class="col-3">';
                        html += '<b> Class :</b>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += res[0].student_class + 'th';
                        html += '</div>';
                        html += '</div>';
                        html += '</p>';
                        html += '<p class="card-text">';
                        html += '<div class="row">';
                        html += '<div class="col-3">';
                        html += '<b> Subject :</b>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += res[0].subject_name;
                        html += '</div>';
                        html += '</div>';
                        html += '</p>';
                        html += '<p class="card-text">';
                        html += '<div class="row">';
                        html += '<div class="col-3">';
                        html += '<b> Fee :</b>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '₹ ' + res[0].student_fee;
                        html += '</div>';
                        html += '</div>';
                        html += '</p>';

                        html += '<p class="card-text">';
                        html += '<div class="row">';
                        html += '<div class="col-3">';
                        html += '<b> Commision :</b>';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += res[0].student_commision +' %';
                        html += '</div>';
                        html += '</div>';
                        html += '</p>';

                        html += '<p class="card-text">';
                        html += '<div class="row">';
                        html += '<div class="col-3">';
                        html += '<b> Status :</b>';
                        html += '</div>';
                        html += '<div class="col-6" style="color:' + color + '">';
                        html += status;
                        html += '</div>';
                        html += '</div>';
                        html += '</p>';
                        if (res[0].student_subject_status == 1) {
                            html += '<p class="card-text">';
                            html += '<div class="row">';
                            html += '<div class="col-3">';
                            html += '<b>Joining Date:</b>';
                            html += '</div>';
                            html += '<div class="col-6"">';
                            html += res[0].joining_date;
                            html += '</div>';
                            html += '</div>';
                            html += '</p>';
                        }


                        html += '<hr>';
                        html += '<p><b> Teacher</b> : </p>';
                        html += '<p class="card-title">';
                        html += ' <div class="row">';
                        html += '<div class="col-3">';
                        html += '<img style="margin: 2px 5px;" src="<?= base_url() ?>uploads/' + res[0].teacher_pic + '" alt="" width="40" class="rounded-circle">';
                        html += '</div>';
                        html += '<div class="col-6">';
                        html += '<div class="row">';
                        html += '<b> ' + res[0].teacher_name + ' : ' + res[0].subject_name + '</b>';
                        html += '</div>';
                        html += ' <div class="row">';
                        html += '<b>+91-' + res[0].teacher_number + '</b>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        html += '</p>';


                        $('#show_student_one').html(html);

                    });
            })



            $('#apply_filters').submit(function(event) {
                event.preventDefault();
                var formdata = new FormData(this);
                $.ajax({
                        url: '<?php echo base_url(); ?>admin/apply_student_filters',
                        type: 'POST',
                        data: formdata,
                        processData: false,
                        contentType: false
                    })
                    .done(function(res) {
                        res = JSON.parse(res);

                        if (res != 0) {
                            var html = '';
                            html += '';
                            $.each(res, function(index, val) {

                                if (val['student_subject_status'] == 1) {
                                    var check = 'checked="1"';
                                }
                                html += '<tr>';
                                html += '<td>';
                                html += '<div class="material-switch pull-right">';
                                html += '<input class="student_status" id="status_' + val['student_table_id'] + '" value="' + val['student_subject_status'] + '"' + check + 'name="status_' + val['student_table_id'] + '" type="checkbox" />';
                                html += '<label for="status_' + val['student_table_id'] + '" class="label-primary"></label>';
                                html += '</div>';
                                html += '</td>';
                                html += '<td> <b> ' + val['student_class'] + '</b> </td>';
                                html += ' <td> <b> ' + val['subject_name'] + '</b> </td>';
                                html += ' <td><b>' + val['student_name'] + '</b></td>';
                                html += '<td>+91-<b><a href="tel:+91-' + val['student_number'] + '">' + val['student_number'] + ' </a> </b></td>';
                                html += '<td>';
                                html += ' <div class="row">';
                                html += '<div class="col-6 show_data" id="data_' + val['student_table_id'] + '" data-toggle="modal" data-target="#show_data">';
                                html += ' <i class="fas fa-eye" style="color: blue;"></i>';
                                html += '</div>';
                                html += ' <div class="col-6">';
                                html += ' <a href="<?= base_url() ?>admin/delete_student_subject?student_table_id=' + val['student_table_id'] + '">';
                                html += ' <i class="fas fa-trash"></i>';
                                html += ' </a>';
                                html += '</div>';
                                html += '</div>';

                                html += '</td>';
                                html += '</tr>';
                            });
                            $('#filter_table').html(html);


                        } else {

                            $('.alert').remove();
                            var tmpl = '<div class="alert alert-danger alert-dismissable">' +
                                '<button class="close" data-dismiss="alert">&times;</button>' +
                                'No Records Found..' +
                                '</div>';
                            $('.status_update').prepend(tmpl);
                            setTimeout(function() {
                                $('.alert').addClass('on');
                            }, 200);

                            var html = '';
                            html += '';
                            html += '<tr>';
                            html += '<td colspan="6">No Students Found..</td>';
                            html += '</tr>';
                            $('#filter_table').html(html);

                        }

                    });

            });



            $('#form2').submit(function(event) {

                event.preventDefault();
                var formdata = new FormData(this);

                $.ajax({
                        url: '<?php echo base_url(); ?>admin/add_student',
                        type: 'POST',
                        data: formdata,
                        processData: false,
                        contentType: false
                    })
                    .done(function(res) {

                        if (res == 1) {
                            $('.alert').remove();
                            var tmpl = '<div class="alert alert-success alert-dismissable">' +
                                '<button class="close" data-dismiss="alert">&times;</button>' +
                                'Student Added Successfully' +
                                '</div>';
                            $('.new').prepend(tmpl);
                            setTimeout(function() {
                                $('.alert').addClass('on');
                            }, 200);
                            $("#student_name").val('');
                            $("#student_fee").val('');
                            $("#student_number").val('');
                            $("#student_name").val('');


                        } else {
                            $('.alert').remove();
                            var tmpl = '<div class="alert alert-danger alert-dismissable">' +
                                '<button class="close" data-dismiss="alert">&times;</button>' +
                                'Student Already Exists' +
                                '</div>';
                            $('.new').prepend(tmpl);
                            setTimeout(function() {
                                $('.alert').addClass('on');
                            }, 200);
                        }

                    });
            });


            $(document).on("click", '.student_status', function() {
                var id = this.id;
                var id_arr = id.split("_");

                $.ajax({
                        url: '<?php echo base_url(); ?>admin/change_student_subject_status',
                        type: 'POST',
                        data: {
                            student_table_id: id_arr[1]
                        },
                    })
                    .done(function(res) {
                        res = JSON.parse(res);
                        $('.alert').remove();
                        var tmpl = '<div class="alert alert-success alert-dismissable">' +
                            '<button class="close" data-dismiss="alert">&times;</button>' +
                            'Student Status Changed' +
                            '</div>';
                        $('.status_update').prepend(tmpl);
                        setTimeout(function() {
                            $('.alert').addClass('on');
                        }, 200);

                    });
            });

        });
    </script>


    <script src="<?= base_url() ?>assets/assets/extra-libs/jqbootstrapvalidation/validation.js"></script>
    <script>
        ! function(window, document, $) {
            "use strict";
            $("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
        }(window, document, jQuery);
    </script>