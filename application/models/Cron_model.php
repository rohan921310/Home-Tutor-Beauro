<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron_model extends CI_Model
{

    function fetch_student()
    {
        $this->db->select('student.student_number, student_table.subscription_date,student_table.student_table_id,student_table.joining_date, student.student_name');
        $this->db->from('student_table');
        $this->db->join('student', 'student.student_id  = student_table.student_id', 'left');
        $this->db->join('teacher', 'teacher.teacher_id  = student_table.student_teacher_id', 'left');
        $this->db->where('teacher.teacher_status', 1);
        $this->db->where('student_table.student_subject_status', 1);
        $this->db->order_by('student_table.student_table_id', 'asc');


        $query = $this->db->get();
        return $query->result();
    }

    function is_fee_paid($student_table_id, $start_date, $end_date)
    {
        $this->db->select('*');
        $this->db->from('student_fee');
        $this->db->where('student_fee.created_at >=', $start_date);
        $this->db->where('student_fee.created_at <=', $end_date);
        $this->db->where('student_fee.student_fee_student_id', $student_table_id);
        $this->db->order_by('student_fee.student_fee_student_id', 'desc');

        $query=$this->db->get();
        $login=$query->row();
		if($login){ 
			return 1;
		} else {
			return 0;
		}
    }
}
