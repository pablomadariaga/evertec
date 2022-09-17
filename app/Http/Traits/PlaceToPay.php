<?php

namespace App\Http\Traits;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Jenssegers\Agent\Facades\Agent;

/**
 * This trait is used to consume the services of Evertec's
 * PlaceToPay api, the functions and vars within the
 * trait contain the acronym Ptp at the end to
 * refer to PlaceToPay
 */
trait PlaceToPay
{
    /**
     * Login credential for integration
     *
     * @var string
     */
    private string $loginKeyPtp;

    /**
     * Secret key credential for integration,
     * it is used to generate the transactional key
     *
     * @var string
     */
    private string $secretKeyPtp;

    /**
     * Base URL of the service for integration
     *
     * @var string
     */
    private string $baseUrlPtp;

    /**
     * Initial setup to consume the PlaceToPay api.
     *
     * @return void
     */
    private function setUpPtp(): void
    {
        $this->loginKeyPtp = config('placetopay.login');
        $this->secretKeyPtp = config('placetopay.secret');
        $this->baseUrlPtp = config('placetopay.base_url');
    }

    /**
     * new request with auth for PlaceToPay api
     *
     * @param string $action Path url to perform an action with the api
     * @param array $data
     * @return mixed
     */
    private function requestAuthPtp(string $action = "", array $data = [])
    {
        $this->setUpPtp();
        $data = $this->setStandardData($data);
        $response = Http::acceptJson()->asJson()->post($this->baseUrlPtp . $action, $data);
        if ($response->successful()) {
            return toObject($response->json());
        }
        return $response->throw()->json();
    }

    /**
     * Set set the necessary data for each request to the api
     *
     * @param array $data
     * @return array
     */
    private function setStandardData(array $data = []): array
    {
        $seed = date('c');
        $nonce = randomString(10);
        $nonceEncode = base64_encode($nonce);
        $tranKeyEncode = base64_encode(sha1("$nonce$seed{$this->secretKeyPtp}",true));
        $data['locale'] = "es_CO";
        $data['auth'] = [
            "login" => $this->loginKeyPtp,
            "tranKey" => $tranKeyEncode,
            "nonce" => $nonceEncode,
            "seed" => $seed
        ];

        return $data;
    }

    /**
     * Requests the creation of the session, returns the identifier and the processing URL.
     *
     * @param Order $order
     * @return mixed
     */
    private function createSessionPtp(Order $order)
    {
        $person = $this->getOrderPersonInformation($order->customer);

        return $this->requestAuthPtp("api/session" ,[
            "payment"=>[
                "reference" => $order->reference,
                "description" => __('Evertec test purchase'),
                "amount" => [
                    "currency" => "COP",
                    "total" => $order->total
                ]
            ],
            "payer" => $person,
            "buyer" => $person,
            "expiration" => now()->addHours(2)->format('c'),
            "returnUrl" => route('order.payment',['id' => $order->id]),
            "ipAddress" => "127.0.0.1",
            "userAgent" => "PlacetoPay Sandbox"
        ]);
    }

    /**
     * Obtains the session information, if there are transactions in the session,
     * their details are shown.
     *
     * @param Order $order
     * @return mixed
     */
    private function getSessionPtp(Order $order)
    {
        return $this->requestAuthPtp("api/session/".$order->request_id);
    }

    /**
     * get person information for buyer and payer data in session request
     *
     * @param Customer $customer
     * @return array
     */
    private function getOrderPersonInformation(Customer $customer): array{
        return [
            "document"=> "1122334455", //TODO get document from customer
            "documentType"=> "CC", //TODO get document type from customer
            "name" => $customer->first_name,
            "surname" => $customer->last_name,
            "email" => $customer->email,
            "mobile" => $customer->mobile
        ];
    }

}
