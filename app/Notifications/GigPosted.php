<?php

namespace App\Notifications;

use App\Project;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class GigPosted extends Notification
{
    use Queueable;

    private $project;
    private $user;

    /**
     * Create a new notification instance.
     *
     * @param  Project $project
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
        $this->user = User::find($project->user_id);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Thanks for posting your project')
            ->line('Congratulations! You successfully posted your project.')
            ->line('Now sit back, relax and wait for the participants to join.')
            ->action('View your project', secure_url('/projects').'/'.$this->project->id)
            ->line('Thank you for using Gigatize!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'project_id' => $this->project->id,
            'user_id' => $this->user->id,
            'notification_type' => 'Gig posted',
            'message' => 'You posted the project ' . $this->project->title,
            'link' => route('projects.show',['project' => $this->project->id])
        ];
    }
}
