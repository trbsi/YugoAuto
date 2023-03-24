<?php

declare(strict_types=1);

namespace App\Source\SystemCommunication\Email\Infra\Mailable;

use App\Source\SystemCommunication\Email\Infra\Value\FromValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MarkdownEmailMailable extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $subject;
    public string $bladeView;
    public $viewData;
    private ?FromValueObject $fromValueObject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        string $subject,
        string $bladeView,
        array $viewData,
        ?FromValueObject $fromValueObject
    ) {
        $this->subject = $subject;
        $this->bladeView = $bladeView;
        $this->viewData = $viewData;
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
            ->with($this->viewData);

        if ($this->fromValueObject) {
            $mail->from($this->fromValueObject->getEmail(), $this->fromValueObject->getName());
        }

        return $mail;
    }
}
