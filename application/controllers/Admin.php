<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{



    function __construct()
    {
        parent::__construct();
        error_reporting(0);

        if ($this->session->userdata('admin_id')) {
        } else {
            $this->session->set_flashdata('msg', 'Please Login First');
            $this->session->set_flashdata('msg_class', 'danger');
            redirect(base_url() . 'admin_login');
        }
    }

    public function dashboard()
    {
        $data['page_name'] = 'Dashboard';

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/admin_dashboad');
        $this->load->view('admin/include/footer');
    }

    function view_subjects()
    {
        $data['classes'] = $this->Admin_model->fetch_class();
        $data['subjects'] = $this->Admin_model->fetch_subject();

        $data['page_name'] = 'Subjects';

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/admin_subject', $data);
        $this->load->view('admin/include/footer');
    }


    function add_subject()
    {
        $this->Admin_model->add_subject();

        $this->session->set_flashdata('msg', 'Subject Added');
        $this->session->set_flashdata('msg_class', 'success');
        redirect(base_url() . 'admin/view_subjects');
    }

    function delete_subject()
    {
        $this->Admin_model->delete_subject();

        $this->session->set_flashdata('msg', 'Subject Deleted');
        $this->session->set_flashdata('msg_class', 'danger');
        redirect(base_url() . 'admin/view_subjects');
    }


    function admin_view_teacher()
    {
        $data['teachers'] = $this->Admin_model->fetch_teacher_admin();

        $data['page_name'] = 'Teachers';
        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/admin_teacher', $data);
        $this->load->view('admin/include/footer');
    }

    function change_teacher_status($teacher_status, $teacher_id)
    {
        $this->Admin_model->change_teacher_status($teacher_status, $teacher_id);
        $this->session->set_flashdata('msg', 'Status Changed');
        $this->session->set_flashdata('msg_class', 'success');
        redirect(base_url() . 'admin_view_teacher');
    }

    function admin_add_teacher()
    {
        $data['page_name'] = 'Add Teacher';
        $data['classes'] = $this->Admin_model->fetch_class();
        $data['subjects'] = $this->Admin_model->fetch_subject();

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/admin_add_teacher', $data);
        $this->load->view('admin/include/footer');
    }

    function register_teacher()
    {
        $subjects = $this->input->post('subjects');
        if (!$subjects) {
            $this->session->set_flashdata('msg', 'Teaching Area Missing');
            $this->session->set_flashdata('msg_class', 'danger');
            redirect(base_url() . 'admin_add_teacher');
        }

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg|pdf';
        $config['max_size'] = 20000;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('profile_pic')) {
            $data =  $this->upload->data();
            $profile_pic = $data['raw_name'] . $data['file_ext'];
            $post['profile_pic'] = $profile_pic;
        }

        if ($this->upload->do_upload('aadhar')) {
            $data =  $this->upload->data();
            $aadhar = $data['raw_name'] . $data['file_ext'];
            $post['aadhar'] = $aadhar;
        }

        $result =  $this->Admin_model->register_teacher($profile_pic, $aadhar);
        if ($result) {
            $this->session->set_flashdata('msg', 'Teacher Registered');
            $this->session->set_flashdata('msg_class', 'success');
            redirect(base_url() . 'admin_add_teacher');
        } else {
            $this->session->set_flashdata('msg', 'Email ID Already Registered');
            $this->session->set_flashdata('msg_class', 'danger');
            redirect(base_url() . 'admin_add_teacher');
        }
    }



    function view_students()
    {
        $data['page_name'] = 'Students';
        $data['classes'] = $this->Admin_model->fetch_class();
        $data['subjects'] = $this->Admin_model->fetch_subject();
        $data['teachers'] = $this->Admin_model->fetch_teacher();

        $data['students'] = $this->Admin_model->fetch_student_admin();

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/view_student', $data);
        $this->load->view('admin/include/footer');
    }

    function fetch_subjects()
    {
        $class_id = $this->input->post('class_id');
        if ($class_id == 1 || $class_id == 2 || $class_id == 3 || $class_id == 4 || $class_id == 5) {
            $class_id = 1;
        } elseif ($class_id == 6 || $class_id == 7 || $class_id == 8) {
            $class_id = 2;
        } elseif ($class_id == 9 || $class_id == 10) {
            $class_id = 3;
        } else {
            $class_id = 5;
        }
        $subjects = $this->Admin_model->fetch_subject($class_id);
        echo (json_encode($subjects));
    }

    function fetch_teacher()
    {
        $class_id = $this->input->post('class_id');
        $subject_id = $this->input->post('subject_id');
        if ($class_id == 1 || $class_id == 2 || $class_id == 3 || $class_id == 4 || $class_id == 5) {
            $class_id = 1;
        } elseif ($class_id == 6 || $class_id == 7 || $class_id == 8) {
            $class_id = 2;
        } elseif ($class_id == 9 || $class_id == 10) {
            $class_id = 3;
        } else {
            $class_id = 5;
        }
        $teachers = $this->Admin_model->fetch_teacher_ajax($class_id, $subject_id);
        echo (json_encode($teachers));
    }

    function add_student()
    {
        $class_id = $this->input->post('class_id');

        if ($class_id == 1 || $class_id == 2 || $class_id == 3 || $class_id == 4 || $class_id == 5) {
            $class_id = 1;
        } elseif ($class_id == 6 || $class_id == 7 || $class_id == 8) {
            $class_id = 2;
        } elseif ($class_id == 9 || $class_id == 10) {
            $class_id = 3;
        } else {
            $class_id = 5;
        }
        $result = $this->Admin_model->add_student($class_id);
        echo (json_encode($result));
    }
    function delete_student_subject()
    {
        $this->Admin_model->delete_student_subject();

        $this->session->set_flashdata('msg', 'Student Subject Deleted');
        $this->session->set_flashdata('msg_class', 'danger');
        redirect(base_url() . 'admin/view_students');
    }

    function change_student_subject_status()
    {
        $result = $this->Admin_model->change_student_subject_status();
        echo (json_encode($result));
    }

    function get_student_table_one()
    {
        $student_table_id = $this->input->post('student_table_id');
        $result = $this->Admin_model->fetch_student_admin($student_table_id);
        echo (json_encode($result));
    }

    function apply_student_filters()
    {
        $class_id = $this->input->post('class_id');


        if ($class_id == 1 || $class_id == 2 || $class_id == 3 || $class_id == 4 || $class_id == 5) {
            $class_id = 1;
        } elseif ($class_id == 6 || $class_id == 7 || $class_id == 8) {
            $class_id = 2;
        } elseif ($class_id == 9 || $class_id == 10) {
            $class_id = 3;
        } elseif ($class_id == 11 || $class_id == 12) {
            $class_id = 5;
        } else {
            $class_id = 0;
        }
        $result = $this->Admin_model->apply_student_filters_admin($class_id);
        if (empty($result)) {
            echo (json_encode(0));
        } else {
            echo (json_encode($result));
        }
    }


    function student_fees()
    {
        $data['fees'] = $this->Admin_model->fetch_student_fees_admin();

        $data['page_name'] = 'Student Fee';
        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/admin_student_fee', $data);
        $this->load->view('admin/include/footer');
    }

    function fetch_student_status_one()
    {
        $class_id = $this->input->post('class_id');

        if ($class_id == 1 || $class_id == 2 || $class_id == 3 || $class_id == 4 || $class_id == 5) {
            $class_id = 1;
        } elseif ($class_id == 6 || $class_id == 7 || $class_id == 8) {
            $class_id = 2;
        } elseif ($class_id == 9 || $class_id == 10) {
            $class_id = 3;
        } elseif ($class_id == 11 || $class_id == 12) {
            $class_id = 5;
        } else {
            $class_id = 0;
        }
        $result = $this->Admin_model->fetch_student_status_one($class_id);
        echo(json_encode($result));
    }

    function add_student_payment()
    {
        $class_id = $this->input->post('class_id');
        
        if ($class_id == 1 || $class_id == 2 || $class_id == 3 || $class_id == 4 || $class_id == 5) {
            $class_id = 1;
        } elseif ($class_id == 6 || $class_id == 7 || $class_id == 8) {
            $class_id = 2;
        } elseif ($class_id == 9 || $class_id == 10) {
            $class_id = 3;
        } elseif ($class_id == 11 || $class_id == 12) {
            $class_id = 5;
        } else {
            $class_id = 0;
        }
        $result = $this->Admin_model->add_student_payment($class_id);
        echo(json_encode($result));
    }

    function fetch_student_last_description()
    {
        $result = $this->Admin_model->fetch_student_last_description();
        echo(json_encode($result));
    }


    function get_fee_details()
    {
        $result = $this->Admin_model->get_fee_details_one();
        echo(json_encode($result));
    }

    function filter_student_fee()
    {
        $result = $this->Admin_model->filter_student_fee();
        echo(json_encode($result));
    }
    function change_student_fee_status()
    {
        $result = $this->Admin_model->change_student_fee_status();
        echo(json_encode($result));
    }

    function delete_student_fee()
    {
        $this->Admin_model->delete_student_fee();

        $this->session->set_flashdata('msg', 'Payment Rejected');
        $this->session->set_flashdata('msg_class', 'danger');
        redirect(base_url() . 'admin/student_fees');
    }

    function teacher_salary()
    {
        $data['teachers'] = $this->Admin_model->fetch_teacher();

        $data['page_name'] = 'Teacher Salary';
        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/admin_teacher_salary', $data);
        $this->load->view('admin/include/footer');
    }

    function view_teacher_salary()
    {
        $teacher_id= $this->input->get('teacher_id');
        $data['teacher'] = $this->Admin_model->fetch_teacher_one($teacher_id);
        $data['teacher_fees'] = $this->Admin_model->fetch_teacher_student_fee($teacher_id);

        $data['page_name'] = 'Salary Details';
        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/view_teacher_salary', $data);
        $this->load->view('admin/include/footer');
    }


}
