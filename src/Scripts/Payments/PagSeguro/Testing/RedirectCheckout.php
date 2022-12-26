<?php

namespace Helvetiapps\LiveControls\Scripts\Payments\PagSeguro;

use Carbon\Carbon;
use Exception;
use Helvetiapps\LiveControls\Objects\Payments\PagSeguro\PaymentReceiver;
use Helvetiapps\LiveControls\Objects\Payments\PagSeguro\PaymentSender;
use Helvetiapps\LiveControls\Objects\Payments\PagSeguro\ShippingInformation;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;

class RedirectCheckout{
    public string $success_landing = '';

    /**
     * Returns an array with 'email' and 'token' depending if the application is in debug mode or not
     *
     * @return array
     */
    private static function getCredentials():array{
        return [
            'email' => urlencode(env('PAGSEGURO_EMAIL_DEBUG')),
            'token' => urlencode(env('PAGSEGURO_TOKEN_DEBUG'))
        ];
    }

    private static function getClient(): \GuzzleHttp\Client
    {
        $client = new \GuzzleHttp\Client();
        return $client;
    }

    public static function generateCode(array $items, PaymentReceiver $receiver, PaymentSender $sender, ShippingInformation $shippingInformation, string $reference, string $redirectUrl, int $timeout = 60, int $maxAge = 30, int $maxUses = 1, bool $enableRecover = false, int $discount = 0):string|false{
        $credentials = static::getCredentials();
        $client = static::getClient();

        $host = "CHANGE_ME";

        $itemsStr = '<items>';
        foreach($items as $item){
            $itemsStr .= '<item>
            <id>'.$item->id.'</id>
            <description>'.$item->description.'</description>
            <amount>'.number_format($item->amount,2,'.','').'</amount>
            <quantity>'.$item->quantity.'</quantity>
            <weight>'.$item->weight.'</weight>
            <shippingCost>'.$item->shippingCost.'</shippingCost>';
        }
        $itemsStr .= '</items>';

        try {
            $response = $client->request('POST', $host.'checkout?email='.$credentials["email"].'&token='.$credentials["token"], [
                'body' => '<checkout>
                <sender>
                  <name>'.$sender->name.'</name>
                  <email>'.$sender->email.'</email>
                  <phone>
                    <areaCode>'.$sender->phone_ddd.'</areaCode>
                    <number>'.$sender->phone.'</number>
                  </phone>
                  <documents>
                    <document>
                      <type>CPF</type>
                      <value>'.$sender->cpf.'</value>
                    </document>
                  </documents>
                </sender>
                <currency>BRL</currency>
                '.$itemsStr.'
                <redirectURL>'.$redirectUrl.'</redirectURL>
                <extraAmount>'.number_format($discount,2,'.','').'</extraAmount>
                <reference>'.$reference.'</reference>
                <shipping>
                  <address>
                    <street>'.$shippingInformation->road.'</street>
                    <number>'.$shippingInformation->number.'</number>
                    <complement>'.$shippingInformation->complement.'</complement>
                    <district>'.$shippingInformation->area.'</district>
                    <city>'.$shippingInformation->city.'</city>
                    <state>'.$shippingInformation->state.'</state>
                    <country>BRA</country>
                    <postalCode>'.$shippingInformation->cep.'</postalCode>
                  </address>
                  <type>'.$shippingInformation->shippingType.'</type>
                  <cost>'.number_format($shippingInformation->shippingCost,2,'.','').'</cost>
                  <addressRequired>'.$shippingInformation->addressRequired.'</addressRequired>
                </shipping>
                <timeout>'.$timeout.'</timeout>
                <maxAge>'.$maxAge.'</maxAge>
                <maxUses>'.$maxUses.'</maxUses>
                <receiver>
                  <email>'.$receiver->email.'</email>
                </receiver>
                <enableRecover>'.$enableRecover.'</enableRecover>
              </checkout>
              ',
                'headers' => [
                  'Content-Type' => 'application/xml; charset=ISO-8859-1',
                  'Accept' => 'application/xml; charset=ISO-8859-1',
                ],
              ]);
            if($response->getStatusCode() == 200){
                //CODE GENERATED
                $sxml = simplexml_load_string($response->getBody());
                return $sxml;
            }else{
                throw new Exception('Invalid PagSeguro Statuscode! => '.$response->getStatusCode());
            }
        }catch (Exception $ex){
            throw $ex;
        }
        return false;
    }

    public static function getTransactionInformation(string $transactionCode): SimpleXMLElement|false{
        $credentials = static::getCredentials();
        $client = static::getClient();

        try {
            $response = $client->request('GET', 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/'.$transactionCode.'?email='.$credentials["email"].'&token='.$credentials["token"], [
                'headers' => [
                  'Accept' => 'application/xml; charset=ISO-8859-1',
                  'content-type' => 'application/json',
                ],
              ]);

            if($response->getStatusCode() == 200){
                $sxml = simplexml_load_string($response->getBody());
                return $sxml;
            }elseif($response->getStatusCode() == 404){
                return false;
            }else{
                throw new Exception("Responds with status ".$response->getStatusCode());
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return false;
        }
        return false;
    }

    public static function getTransactions(Carbon $from, Carbon $to):array{
        $credentials = static::getCredentials();
        $client = static::getClient();

        if($to->timestamp > Carbon::now()->timestamp){
            $to = Carbon::now()->subHours(3);
        }
        $response = $client->request('GET', 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?email='.$credentials["email"].'&token='.$credentials["token"].'&initialDate='.$from->format(DATE_W3C).'&finalDate='.$to->format(DATE_W3C), [
            'headers' => [
              'Accept' => 'application/xml; charset=ISO-8859-1',
              'content-type' => 'application/json',
            ],
          ]);

        if($response->getStatusCode() == 200){
            $sxml = simplexml_load_string($response->getBody());
            $transactions = [];
            foreach($sxml->transactions as $transaction){
                array_push($transactions, $transaction->transaction);
            }
            return $transactions;
        }else{
            throw new Exception("Status code is ".$response->getStatusCode());
        }
        return [];
    }
}