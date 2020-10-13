<?php


namespace App\Services;

use App\Models\Swagger\v1\Client;
use App\Models\Swagger\v1\Push;
use Pushok\AuthProvider;
use Pushok\Client as PushClient;
use Pushok\Notification;
use Pushok\Payload;
use Pushok\Payload\Alert;

class PushService
{
    private array $apple;

    public static function heartbeat()
    {
        $now = new \DateTime();
        //$now->setTimezone();
        $from = $now->modify('-5 day')->format('Y-m-d H:i:s');
        $to = $now->modify('+5 day')->format('Y-m-d H:i:s');

        //$pushes = Push::whereBetween('date', [$from, $to])->get();
        $pushes = Push::all();
        logger(
            [
                $pushes->count(),
                $from,
                $to,
                Push::whereBetween('date', [$from, $to])->get()
            ]
        );
    }

    public function makePushApple(Client $client, Push $push)
    {
        $options = [
            'key_id' => 'AAAABBBBCC', // The Key ID obtained from Apple developer account
            'team_id' => 'DDDDEEEEFF', // The Team ID obtained from Apple developer account
            'app_bundle_id' => 'com.app.Test', // The bundle ID for app obtained from Apple developer account
            'private_key_path' => __DIR__ . '/private_key.p8', // Path to private key
            'private_key_secret' => null // Private key secret
        ];

        $authProvider = AuthProvider\Token::create($options);

        $alert = Alert::create()->setTitle('Hello!');
        $alert = $alert->setBody('First push notification');

        $payload = Payload::create()->setAlert($alert);

        //set notification sound to default
        $payload->setSound('default');

        //add custom value to your notification, needs to be customized
        //$payload->setCustomValue('key', 'value');

        $deviceTokens = [$push->getDeviceToken()];

        $notifications = [];
        foreach ($deviceTokens as $deviceToken) {
            $notifications[] = new Notification($payload, $deviceToken);
        }

        $client = new PushClient($authProvider, $production = false);
        $client->addNotifications($notifications);


        $responses = $client->push(); // returns an array of ApnsResponseInterface (one Response per Notification)

        foreach ($responses as $response) {
            $response->getApnsId();
            $response->getStatusCode();
            $response->getReasonPhrase();
            $response->getErrorReason();
            $response->getErrorDescription();
        }
    }


}
