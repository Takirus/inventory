<?php

namespace App\Mail;

use App\Models\Request as RequestModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $request;
    public $action;
    public $role;

    /**
     * Create a new message instance.
     */
    public function __construct(RequestModel $request, string $action, string $role)
    {
        $this->request = $request;
        $this->action = $action;
        $this->role = $role;
    }

    public function build(){
        if($this->action === 'create' && $this->role === 'admin')
        {
            return $this->subject('Уведомление о заявке')
                ->view('mail.request_notification_create');
        }

        if($this->action === 'create' && $this->role === 'employee')
        {
            return $this->subject('Созданна заявка')
                ->view('mail.user_request_notification_create');
        }

        if($this->action === 'update' && $this->role === 'admin')
        {
            return $this->subject('Уведомление о обновлении заявки')
                ->view('mail.request_notification_update');
        }

        if($this->action === 'update' && $this->role === 'employee')
        {
            return $this->subject('Заявка обновлена')
                ->view('mail.user_request_notification_update');
        }
    }
}
