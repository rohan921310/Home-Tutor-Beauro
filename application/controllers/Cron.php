<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cron extends CI_Controller
{
    function late_fee()
    {
        $data['students'] = $this->Cron_model->fetch_student();

        foreach ($data['students'] as $student) {
            //....student created on .....///
            $subscription_date = $student->subscription_date;

            $today_date = date('Y-m-d');

            $subscription_date = date_create($subscription_date, timezone_open('Asia/Kolkata'));
            $date2 = date_create($today_date, timezone_open('Asia/Kolkata'));
            $diff = date_diff($subscription_date, $date2);
            $di =  $diff->format("%R%a");


            $start_date =  date("Y-m-d", strtotime($student->subscription_date . '-6 days'));
            $end_date =  date("Y-m-d", strtotime($student->subscription_date . '+6 days'));

            if ($di >= -5 && $di <= -1) {
                $result = $this->Cron_model->is_fee_paid($student->student_table_id, $start_date, $end_date);
                if (!$result) {
                    if ($di >= -5 && $di <= -2) {
                        $month_num =  date("m", strtotime($student->subscription_date . '+1 month'));
                        $month_name = date("F", mktime(0, 0, 0, $month_num, 10));

                        $text = '*Genius Study Circle...* %0aHi *' . $student->student_name . '*, %0aYour *Fees* is balance for the month of *' . $month_name . '*';
                        $this->Whatsapp_model->send_message($text, $student->student_number);
                    }
                    if ($di == -1) {
                        $month_num =  date("m", strtotime($student->subscription_date . '+1 month'));
                        $month_name = date("F", mktime(0, 0, 0, $month_num, 10));
                        $text = '*Genius Study Circle...* %0aHi *' . $student->student_name . '*, %0aToday you have to mandatory submit the tuition fees otherwise from tomorrow your class will not commence ';
                        $this->Whatsapp_model->send_message($text, $student->student_number);
                    }
                }
            }

        }
    }

    function send_message()
    {
        $result = $this->Whatsapp_model->check_status();
        if ($result == 1) {
            $result = $this->Whatsapp_model->fetch_unsend_messages();
            foreach ($result as $send) {
                $result = $this->Whatsapp_model->check_status();
                if ($result == 1) {
                    $this->Whatsapp_model->send_unsend_messages($send->text, $send->phone, $send->whatsapp_id);
                } else {
                    break;
                }
            }
        }
    }
}
