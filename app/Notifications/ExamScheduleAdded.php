<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ExamScheduleAdded extends Notification
{
    use Queueable;

    protected $examSchedule;

    /**
     * Create a new notification instance.
     */
    public function __construct($examSchedule)
    {
        $this->examSchedule = $examSchedule;
    }

    /**
     * Channels to deliver the notification.
     */
    public function via($notifiable)
    {
        return ['database']; // store in DB
    }

    /**
     * Store data in the database.
     */
    public function toDatabase($notifiable)
    {
        return [
            'title'       => 'New Exam Scheduled',
            'program'     => $this->examSchedule->program,
            'course_code' => $this->examSchedule->course_code,
            'course_name' => $this->examSchedule->course_name,
            'exam_date'   => $this->examSchedule->exam_date,
            'time_from'   => $this->examSchedule->time_from,
            'time_to'     => $this->examSchedule->time_to,
        ];
    }
}
