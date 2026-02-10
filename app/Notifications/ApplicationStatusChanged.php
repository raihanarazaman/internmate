<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Application;

class ApplicationStatusChanged extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
 
  public function __construct(public Application $application) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
        public function toDatabase($notifiable)
            {
                return [
                    'application_id' => $this->application->id,
                    'student_id' => $this->application->student_id,
                    'internship_id' => $this->application->internship_id,
                    'status' => $this->application->status,
                    'message' => $this->message(),
                ];
            }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    private function message(): string
    {
        return match ($this->application->status) {
            'company_approved' =>
                'Company approved the student application.',
            'company_rejected' =>
                'Company rejected the student application.',
            'student_submitted' =>
                'Student submitted application for admin approval.',
            'admin_approved' =>
                'Admin approved the internship.',
            'admin_rejected' =>
                'Admin rejected the internship.',
            default =>
                'Application status updated.',
        };
    }
}
