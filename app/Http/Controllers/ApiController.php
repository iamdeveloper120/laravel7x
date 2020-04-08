<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\GuzzleTrait;

class ApiController extends Controller
{
    use GuzzleTrait;

    public function createToken() {
        $url = 'https://services-qa.walgreens.com/api/util/mweb5url';
        $body = [
            'apiKey' => 'rA8JQjV7yHWvYfgu1OS0tbsgGijJbQuL',
            'affId' => 'rxapi',
            'transaction' => 'refillByScan',
            'act' => 'mweb5Url',
            'view' => 'mweb5UrlJSON',
            'devinf' => 'iPhone,9.1',
            'appver' => '1.1'
        ];
        $response = $this->apiRequest($url, $body, 1);
        dd($response);
    }
    public function refill() {
        $url = 'https://m5-qa.walgreens.com/refillapi/refill';
        $body = [
            'appId' => 'refillByScan',
            'affId' => 'rxapi',
            'token' => 'RXT-cJxcTkh3UwpZumcyAd858UoanFv0pMW0',
            'rxNo' => '0459772-59382',
            'appCallBackScheme' => 'YOUR APP CALLBACK URI SCHEME',
            'appCallBackAction' => 'YOUR APP CALLBACK ACTION',
            'act' => 'chkExpRx',
            'devinf' => 'Chrome,80.0.3987.132',
            'appver' => '1.0'
        ];
        $response = $this->apiRequest($url, $body);
        dd($response);
    }
}
