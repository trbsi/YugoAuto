<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\Email\Infra\Mailable;

use App\Source\SystemCommunication\Email\Infra\Value\FromValue;
use App\Source\SystemCommunication\Email\Infra\Value\ViewDataValue;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MarkdownEmailMailable extends Mailable
{
    use Queueable;
    use SerializesModels;

    public string $bladeView;
    private ?FromValue $fromValueObject;
    private ViewDataValue $viewDataObject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        string $subject,
        string $bladeView,
        ViewDataValue $viewDataObject,
        ?FromValue $fromValueObject
    ) {
        $this->subject = $subject;
        $this->bladeView = $bladeView;
        $this->viewDataObject = $viewDataObject;
        $this->fromValueObject = $fromValueObject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this
            ->subject($this->subject)
            ->markdown($this->bladeView)
            ->with($this->viewDataObject->toArray());

        if ($this->fromValueObject) {
            $mail->replyTo($this->fromValueObject->getEmail(), $this->fromValueObject->getName());
        }

        return $mail;
    }
}
