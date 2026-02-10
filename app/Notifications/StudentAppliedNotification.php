<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Application;
class StudentAppliedNotification extends Notification
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


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase($notifiable): array
    {
        return [
            'application_id' => $this->application->id,
            'student_id'     => $this->application->student_id,
            'internship_id'  => $this->application->internship_id,
            'message'        => sprintf(
                '%s applied for your internship: %s',
                $this->application->student->full_name,
                $this->application->internship->job_name
            ),
        ];
    }
}
