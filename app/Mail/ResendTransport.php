<?php

namespace App\Mail;

use GuzzleHttp\Client;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\MessageConverter;

class ResendTransport extends AbstractTransport
{
    public function __construct(private string $apiKey)
    {
        parent::__construct();
    }

    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());

        $from = $email->getFrom();
        $fromAddress = count($from) > 0
            ? ($from[0]->getName()
                ? '"' . $from[0]->getName() . '" <' . $from[0]->getAddress() . '>'
                : $from[0]->getAddress())
            : env('MAIL_FROM_ADDRESS', 'onboarding@resend.dev');

        $to = array_map(fn($addr) => $addr->getAddress(), $email->getTo());

        $client = new Client();
        $client->post('https://api.resend.com/emails', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'from'    => $fromAddress,
                'to'      => $to,
                'subject' => $email->getSubject(),
                'html'    => $email->getHtmlBody() ?? $email->getTextBody(),
                'text'    => $email->getTextBody(),
            ],
        ]);
    }

    public function __toString(): string
    {
        return 'resend';
    }
}
