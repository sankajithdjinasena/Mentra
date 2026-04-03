<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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

            $smsApi = new SmsApi(config: $configuration);

            $destination = new SmsDestination(to: $this->phone);

            $message = new SmsTextualMessage(
                destinations: [$destination],
                text: $this->message
            );

            $request = new SmsAdvancedTextualRequest(messages: [$message]);

            $response = $smsApi->sendSmsMessage($request);

            \Log::info('SMS SENT SUCCESS', ['response' => $response]);

        } catch (\Infobip\ApiException $e) {

            \Log::error('INFOBIP API ERROR', [
                'message' => $e->getMessage(),
                'response' => $e->getResponseBody()
            ]);

            throw $e; 

        } catch (\Exception $e) {

            \Log::error('GENERAL SMS ERROR', [
                'message' => $e->getMessage()
            ]);

            throw $e;
        }

    }
}
