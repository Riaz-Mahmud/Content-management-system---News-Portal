<?php
namespace App\Services;

use App\Models\LoginLog;

use Illuminate\Support\Facades\Auth;

class GeocodeLocation{

    public function addressToCoordinates($address){

        $data = [];
        $data['lat'] = null;
        $data['lng'] = null;

        $address = str_replace(" ", "+", $address);
        if($address == null || $address == ''){
            $data['status'] = 'error';
            return $data;
        }

        $apiKey = config('services.geloky.api_key');

        if($apiKey == null || $apiKey == ''){
            $data['status'] = 'error';
            return $data;
        }

        $url = "https://geloky.com/api/geo/geocode?address=$address&key=$apiKey&format=google";
        $response = file_get_contents($url);

        if($response == null || $response == ''){
            $data['status'] = 'error';
            return $data;
        }

        $json = json_decode($response,TRUE); //generate array object from the response from the web

        $data['status'] = 'success';
        $data['lat'] = $json['results'][0]['geometry']['location']['lat'];
        $data['lng'] = $json['results'][0]['geometry']['location']['lng'];

        return $data;
    }

}
