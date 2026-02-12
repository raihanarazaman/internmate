<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Internship;

class InternshipStatusChanged extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Internship $internship) {}
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
            'internship_id' => $this->internship->id,
            'status' => $this->internship->status,
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
        return match ($this->internship->status) {
            'approved' =>
                'Your internship "' . $this->internship->job_name . '" has been approved by admin.',
            'rejected' =>
                'Your internship "' . $this->internship->job_name . '" has been rejected by admin.',
            default =>
                'Internship status updated.',
        };
    }
}
