<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\AD;
use Illuminate\Support\Facades\Crypt;
use App\Helpers\ImageHelper;
use Illuminate\Support\Carbon;

class AdShow extends Component
{

    public $data = [];

    public function refreshAd($code){
        $this->data['row'] = [];
        $this->getAds($code);
    }

    protected function getAds($code){
        $ads = AD::where('code', $code)
        ->where('start_date', '<=', Carbon::now())
        ->where('end_date', '>=', Carbon::now())
        ->where('status', 'Active')->where('is_deleted', 0)->inRandomOrder()->first();

        if($ads != null){
            $this->data['row'] = [
                'id' => $ads->id,
                'hashId' => Crypt::encrypt($ads->id),
                'title' => $ads->title,
                'description' => $ads->description,
                'image' => ImageHelper::generateImage($ads->src, 'main'),
                'width' => $ads->width,
                'height' => $ads->height,
                'url' => $ads->url,
            ];
        }else{
            $this->data['row'] = null;
        }
    }

    function mount($code, $place){
        if($code != null && $place != null){
            $code = $code;
            $this->data = [
                'place' => $place,
                'code' => $code,
            ];
        }

        $this->getAds($this->data['code']);

    }

    public function render()
    {
        return view('livewire.ad-show');
    }
}
