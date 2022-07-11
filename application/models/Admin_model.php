<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    function fetch_class()
    {
        $this->db->select('*');
        $this->db->from('class');
        $this->db->order_by('class_id', 'asc');

        $query = $this->db->get();
        return $query->result();
    }

    function fetch_subject($class_id = '')
    {
        $this->db->select('*');
        $this->db->from('subject');
        if ($class_id != '') {
            $this->db->where('subject.class_id', $class_id);
        }
        $this->db->join('class', 'class.class_id  = subject.class_id', 'left');
        $this->db->order_by('subject_id', 'asc');

        $query = $this->db->get();
        return $query->result();
    }

    function fetch_teacher_admin()
    {
        $this->db->select('*');
        $this->db->from('teacher');
        // $this->db->join('teacher_subject', 'teacher_subject.teacher_id  = teacher.teacher_id', 'left');
        // $this->db->join('teacher_subject', 'teacher_subject.class_id  = class.class_id', 'left');
        $this->db->order_by('teacher_status', 'asc');

        $query = $this->db->get();
        return $query->result();
    }

    function fetch_teacher($teacher_id = '')
    {
        $this->db->select('*');
        $this->db->from('teacher');
        $this->db->where('teacher_status', 1);
        if ($teacher_id != '') {
            $this->db->where('teacher_id', $teacher_id);
        }
        $this->db->order_by('teacher_id', 'asc');

        $query = $this->db->get();
        return $query->result();
    }

    function fetch_teacher_one($teacher_id = '')
    {
        $this->db->select('*');
        $this->db->from('teacher');
        $this->db->where('teacher_status', 1);
        if ($teacher_id != '') {
            $this->db->where('teacher_id', $teacher_id);
        }

        $query = $this->db->get()->row_array();
        return $query;
    }


    function fetch_teacher_ajax($class_id, $subject_id)
    {
        $this->db->select('*');
        $this->db->from('teacher_subject');
        $this->db->join('teacher', 'teacher.teacher_id  = teacher_subject.teacher_id', 'left');
        $this->db->where('teacher.teacher_status', 1);
        $this->db->where('teacher_subject.class_id', $class_id);
        $this->db->where('teacher_subject.subject_id', $subject_id);
        $this->db->order_by('teacher.teacher_id', 'asc');

        $query = $this->db->get();
        return $query->result();
    }

    function fetch_teacher_class($teacher_id)
    {
        $this->db->distinct();
        $this->db->select('class.class_name');
        $this->db->from('teacher_subject');
        $this->db->where('teacher_subject.teacher_id', $teacher_id);
        $this->db->join('class', 'class.class_id  = teacher_subject.class_id', 'left');

        $query = $this->db->get();
        return $query->result();
    }

    function fetch_teacher_subject($teacher_id)
    {
        $this->db->select('class.class_name, subject.subject_name');
        $this->db->from('teacher_subject');
        $this->db->where('teacher_subject.teacher_id', $teacher_id);
        $this->db->join('subject', 'subject.subject_id  = teacher_subject.subject_id', 'left');
        $this->db->join('class', 'class.class_id  = teacher_subject.class_id', 'left');
        $this->db->order_by('subject.subject_name', 'asc');

        $query = $this->db->get();
        return $query->result();
    }

    function add_subject()
    {
        extract($this->input->post());
        $formArray = array(
            'class_id' => $class_id,
            'subject_name' => $subject_name,
        );
        $this->db->insert('subject', $formArray);
    }

    function delete_subject()
    {
        $subject_id = $this->input->get('subject_id');
        $this->db->where('subject_id', $subject_id);
        $this->db->delete('subject');
    }

    function change_teacher_status($teacher_status, $teacher_id)
    {
        $formArray = array(
            'teacher_status' => $teacher_status,
        );
        $this->db->where('teacher_id', $teacher_id);
        $this->db->update('teacher', $formArray);
    }

    function register_teacher($profile_pic, $aadhar)
    {
        extract($this->input->post());
        $this->db->select('*');
        $this->db->from('teacher');
        $this->db->where('teacher_email', $teacher_email);
        $query = $this->db->get();
        $login = $query->row();
        if ($login) {
            return 0;
        } else {

            $formArray = array(
                'teacher_status' => 1,
                'teacher_email' => $teacher_email,
                'teacher_password' => $teacher_password,
                'teacher_name' => $teacher_name,
                'teacher_pic' => $profile_pic,
                'teacher_number' => $teacher_number,
                'teacher_address' => $teacher_address,
                'teacher_qualification' => $teacher_qualification,
                'teacher_aadhar' => $aadhar,
                'teacher_commision' => $teacher_commision
            );
            $this->db->insert('teacher', $formArray);
            $last_id = $this->db->insert_id();


            foreach ($subjects as $subject) {
                $insert = explode(',', $subject);
                $formArray = array(
                    'class_id' => $insert[0],
                    'subject_id' => $insert[1],
                    'teacher_id' => $last_id,
                );
                $this->db->insert('teacher_subject', $formArray);
            }
            return 1;
        }
    }

    function fetch_student_one($student_id)
    {
        $this->db->select('*');
        $this->db->from('student');
        $this->db->where('student.student_id', $student_id);

        $query = $this->db->get()->row_array();
        return $query;
    }

    function fetch_student_admin($student_table_id = '')
    {
        $this->db->select('*');
        $this->db->from('student_table');
        $this->db->join('student', 'student.student_id  = student_table.student_id', 'left');
        $this->db->join('teacher', 'teacher.teacher_id  = student_table.student_teacher_id', 'left');
        $this->db->join('class', 'class.class_id  = student_table.student_class_id', 'left');
        $this->db->join('subject', 'subject.subject_id  = student_table.student_subject_id', 'left');
        $this->db->where('teacher.teacher_status', 1);

        if ($student_table_id != '') {
            $this->db->where('student_table.student_table_id', $student_table_id);
        }
        $this->db->order_by('student_table.student_id', 'desc');

        $query = $this->db->get();
        return $query->result();
    }

    function fetch_student_status_one($class_id, $student_table_id = '')
    {
        $subject_id = $this->input->post('subject_id');
        $teacher_id = $this->input->post('teacher_id');
        $student_class = $this->input->post('class_id');

        $this->db->select('*');
        $this->db->from('student_table');
        $this->db->join('student', 'student.student_id  = student_table.student_id', 'left');
        $this->db->join('teacher', 'teacher.teacher_id  = student_table.student_teacher_id', 'left');
        $this->db->join('class', 'class.class_id  = student_table.student_class_id', 'left');
        $this->db->join('subject', 'subject.subject_id  = student_table.student_subject_id', 'left');
        $this->db->where('student_table.student_subject_status', 1);
        $this->db->where('student_table.student_subject_id', $subject_id);
        $this->db->where('student_table.student_teacher_id', $teacher_id);
        $this->db->where('teacher.teacher_status', 1);
        $this->db->where('student_table.student_class', $student_class);


        if ($student_table_id != '') {
            $this->db->where('student_table.student_table_id', $student_table_id);
        }
        $this->db->order_by('student_table.student_id', 'desc');

        $query = $this->db->get();
        return $query->result();
    }

    function fetch_student_fees_admin()
    {
        $this->db->select('student.student_name, student_fee.student_fee_amount, teacher.teacher_name , student_fee.created_at,student_fee.subscribe_till, student_fee.student_fee_id, student_fee.seen_status, student_fee.paid_to_teacher');
        $this->db->from('student_fee');

        $this->db->join('teacher', 'teacher.teacher_id  = student_fee.student_fee_teacher_id', 'left');
        $this->db->join('subject', 'subject.subject_id  = student_fee.student_fee_subject_id', 'left');
        $this->db->join('student_table', 'student_table.student_table_id  = student_fee.student_fee_student_id', 'left');
        $this->db->join('student', 'student.student_id  = student_fee.student_details_id', 'left');


        // $this->db->where('student_table.student_subject_status', 1);
        // $this->db->where('teacher.teacher_status', 1);
        $this->db->order_by('created_at', 'desc');


        $query = $this->db->get();
        return $query->result();
    }

    function filter_student_fee()
    {
        $subject_id = $this->input->post('subject_id');
        $teacher_id = $this->input->post('teacher_id');
        $student_class = $this->input->post('class_id');
        
        $this->db->select('student.student_name, student_fee.student_fee_amount, teacher.teacher_name , student_fee.subscribe_till, student_fee.student_fee_id, student_fee.seen_status, student_fee.paid_to_teacher');
        $this->db->from('student_fee');
        $this->db->join('teacher', 'teacher.teacher_id  = student_fee.student_fee_teacher_id', 'left');
        $this->db->join('subject', 'subject.subject_id  = student_fee.student_fee_subject_id', 'left');
        $this->db->join('student_table', 'student_table.student_table_id  = student_fee.student_fee_student_id', 'left');
        $this->db->join('student', 'student.student_id  = student_fee.student_details_id', 'left');

        if ($student_class != '0') {
            $this->db->where('student_table.student_class', $student_class);
        }
        if ($teacher_id != '0') {
            $this->db->where('student_fee.student_fee_teacher_id', $teacher_id);
        }

        if ($subject_id != '0') {
            $this->db->where('student_fee.student_fee_subject_id', $subject_id);
        }

        $this->db->order_by('student_fee.student_fee_id', 'desc');

        $query = $this->db->get();
        return $query->result();
    }

    function get_fee_details_one()
    {
        $student_fee_id = $this->input->post('student_fee_id');
        $this->db->select('*');
        $this->db->from('student_fee');
        $this->db->join('teacher', 'teacher.teacher_id  = student_fee.student_fee_teacher_id', 'left');
        $this->db->join('subject', 'subject.subject_id  = student_fee.student_fee_subject_id', 'left');
        $this->db->join('student_table', 'student_table.student_table_id  = student_fee.student_fee_student_id', 'left');
        $this->db->join('student', 'student.student_id  = student_fee.student_details_id', 'left');
        $this->db->where('student_fee.student_fee_id', $student_fee_id);

        $this->db->order_by('student_fee.student_fee_id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function fetch_student_last_description()
    {
        $student_id = $this->input->post('student_id');

        $this->db->select('description');
        $this->db->from('student_fee');
        $this->db->where('student_fee_student_id', $student_id);
        $this->db->order_by('student_fee_id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

    function change_student_fee_status()
    {
        $student_fee_id = $this->input->post('student_fee_id');

        $this->db->select('*');
        $this->db->from('student_fee');
        $this->db->where('student_fee_id', $student_fee_id);
        $query = $this->db->get();
        $login = $query->row();
        if ($login) {
            $formArray1 = array(
                'seen_status' => !$login->seen_status,
            );
            $this->db->where('student_fee_id', $student_fee_id);
            $this->db->update('student_fee', $formArray1);
            return 1;
        }
    }

    function fetch_unseen_teacher_fee($teacher_id)
    {
        $this->db->select('student_fee_id');
        $this->db->from('student_fee');
        $this->db->where('student_fee_teacher_id', $teacher_id);
        $this->db->where('seen_status', 0);
        $query = $this->db->get()->row_array();
        if($query){
            return count($query);
        }else{
           return 0;
        }

    }

    function delete_student_fee()
    {
        $student_fee_id = $this->input->get('student_fee_id');
        $this->db->where('student_fee_id', $student_fee_id);
        $this->db->delete('student_fee');
    }

    function apply_student_filters_admin($class_id = '')
    {
        $subject_id = $this->input->post('subject_id');
        $teacher_id = $this->input->post('teacher_id');

        $this->db->select('*');
        $this->db->from('student_table');
        $this->db->join('student', 'student.student_id  = student_table.student_id', 'left');
        $this->db->join('teacher', 'teacher.teacher_id  = student_table.student_teacher_id', 'left');
        $this->db->join('class', 'class.class_id  = student_table.student_class_id', 'left');
        $this->db->join('subject', 'subject.subject_id  = student_table.student_subject_id', 'left');
        $this->db->where('teacher.teacher_status', 1);

        if ($class_id != 0) {
            $student_class = $this->input->post('class_id');
            $this->db->where('student_table.student_class_id', $class_id);
            $this->db->where('student_table.student_class', $student_class);
        }
        if ($subject_id != 0) {
            $this->db->where('student_table.student_subject_id', $subject_id);
        }

        if ($teacher_id != 0) {
            $this->db->where('student_table.student_teacher_id', $teacher_id);
        }

        $this->db->order_by('student_table.student_id', 'desc');

        $query = $this->db->get();
        return $query->result();
    }

    function add_student($class_id_api)
    {
        $notifications = 0;
        extract($this->input->post());
        $teacher_details = explode(',', $teacher_id);

        $this->db->select('*');
        $this->db->from('student');
        $this->db->where('student_name', $student_name);
        $this->db->where('student_number', $student_number);
        $query = $this->db->get();
        $login = $query->row();
        if ($login) {
            $last_id = $login->student_id;
        } else {

            $formArray = array(
                'student_name' => $student_name,
                'student_number' => $student_number,
                'notifications' => $notifications,
                'student_status' => 1,
            );
            $this->db->insert('student', $formArray);
            $last_id = $this->db->insert_id();
        }


        $this->db->select('*');
        $this->db->from('student_table');
        $this->db->where('student_id', $last_id);
        $this->db->where('student_class_id', $class_id_api);
        $this->db->where('student_class', $class_id);
        $this->db->where('student_subject_id', $subject_id);
        $this->db->where('student_teacher_id', $teacher_details[0]);
        $this->db->where('student_fee', $student_fee);
        $query = $this->db->get();
        $login = $query->row();
        if ($login) {
            return 0;
        } else {
            $today_date = date("Y-m-d");
            $formArray1 = array(
                'student_id' => $last_id,
                'student_class_id' => $class_id_api,
                'student_class' => $class_id,
                'student_subject_id' => $subject_id,
                'student_teacher_id' => $teacher_details[0],
                'student_fee' => $student_fee,
                'student_subject_status' => 1,
                'student_commision' => $student_commision,
                'subscription_date' => $today_date,
                'next_subscription_date' => $today_date
            );
            $this->db->insert('student_table', $formArray1);
            $text = 'Welcome to *Genius Study Circle*....%0a'.$student_name;
            $this->Whatsapp_model->send_message($text, $student_number);
            return 1;
        }
    }

    function delete_student_subject()
    {
        $student_table_id = $this->input->get('student_table_id');
        $this->db->where('student_table_id', $student_table_id);
        $this->db->delete('student_table');
    }

    function change_student_subject_status()
    {
        $student_table_id = $this->input->post('student_table_id');
        $this->db->select('*');
        $this->db->from('student_table');
        $this->db->where('student_table_id', $student_table_id);
        $query = $this->db->get();
        $login = $query->row();
        if ($login) {
            $formArray1 = array(
                'student_subject_status' => !$login->student_subject_status,
            );
            $this->db->where('student_table_id', $student_table_id);
            $this->db->update('student_table', $formArray1);
            return 1;
        }
    }

    function add_student_payment($class_id)
    {
        extract($this->input->post());
        $teacher_details = explode(',', $teacher_id);
        $student_id = explode(',', $student_id);

       
        $formArray = array(
            'student_fee_class_id' => $class_id,
            'student_fee_subject_id' => $subject_id,
            'student_fee_teacher_id' => $teacher_details[0],
            'student_fee_student_id' => $student_id[0],
            'student_details_id' => $student_id[4],
            'student_fee_amount' => $student_fee,
            'subscribe_till' => $paid_on,
            'description' => $description,
            'seen_status' => 1,
        );
        $this->db->insert('student_fee', $formArray);
        
        //....whatsapp message....//
        $month_num =  date("m", strtotime($paid_on . '+0 month'));
        $month_name = date("F", mktime(0, 0, 0, $month_num, 10));

        $text = 'We have received your tuition fees for the month '.$month_name;
        $this->Whatsapp_model->send_message($text, $student_id[2]);

        $next_subscription_date = date("Y-m-d", strtotime($paid_on. '+1 month'));
        $formArray1 = array(
            'subscription_date' => $paid_on,
            'next_subscription_date' => $next_subscription_date
        );
        $this->db->where('student_table_id', $student_id[0]);
        $this->db->update('student_table', $formArray1);
        return 1;
    }

    function fetch_teacher_student_fee($teacher_id)
    {
        $this->db->select('*');
        $this->db->from('student_fee');

        $this->db->join('teacher', 'teacher.teacher_id  = student_fee.student_fee_teacher_id', 'left');
        $this->db->join('subject', 'subject.subject_id  = student_fee.student_fee_subject_id', 'left');
        $this->db->join('student_table', 'student_table.student_table_id  = student_fee.student_fee_student_id', 'left');
        $this->db->join('student', 'student.student_id  = student_fee.student_details_id', 'left');
        $this->db->where('teacher.teacher_status', 1);
        $this->db->where('student_fee.student_fee_teacher_id', $teacher_id);


        $this->db->order_by('created_at', 'desc');


        $query = $this->db->get();
        return $query->result();
    }
}
