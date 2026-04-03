<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

class SendReminderSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $phone;
    protected $message;

    public function __construct($phone, $message)
    {
        $this->phone = $phone;
        $this->message = $message;
    }

    public function handle()
    {
        try {
            $configuration = new Configuration(
                host: env('INFOBIP_BASE_URL'),
                apiKey: env('INFOBIP_API_KEY')
            );

            $smsApi = new SmsApi(
                config: $configuration,
                client: new Client([
                    'verify' => false,
                ])
            );

            $destination = new SmsDestination(
                to: $this->phone
            );

            $message = new SmsTextualMessage(
                destinations: [$destination],
                text: $this->message,
                from: "InfoSMS"
            );

            $request = new SmsAdvancedTextualRequest(
                messages: [$message]
            );

            $response = $smsApi->sendSmsMessage($request);

            // Extract message details (same as your route)
            $details = $response->getMessages()[0];
            $messageId = $details->getMessageId();
            $status = $details->getStatus()->getName();

            Log::info('SMS SENT SUCCESS', [
                'phone' => $this->phone,
                'messageId' => $messageId,
                'status' => $status
            ]);

        } catch (\Exception $e) {
            Log::error('SMS ERROR', [
                'message' => $e->getMessage(),
                'phone' => $this->phone
            ]);

            throw $e;
        }
    }
}