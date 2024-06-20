<?php

namespace App\View\Components\Frontend\SocialIcon;

use App\Models\Setting;
use Illuminate\View\Component;

class SocialIcon extends Component
{
    protected $data = array();
    protected $position;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($position){
        $this->data['position'] = $position;
        $this->data['items'] = $this->getSocialIcons();
    }

    protected function getSocialIcons(){
        $socialIcons = [
            [
                'facebook_icon',
                'facebook_href',
            ],
            [
                'twitter_icon',
                'twitter_href',
            ],
            [
                'instagram_icon',
                'instagram_href',
            ],
            [
                'linkedin_icon',
                'linkedin_href',
            ],
            [
                'youtube_icon',
                'youtube_href',
            ],
        ];

        $valueList = array();

        $settings = Setting::where('status', 'Active')->where('is_deleted', 0)->get();
        if($settings->count() == 0){
            return $valueList = [];
        }

        foreach ($socialIcons as $key => $socialIcon) {
            if(count($socialIcon) == 2){
                $row  = $settings->where('settings_key', $socialIcon[0])->first();
                if(!empty($row)){
                    $singleValue = array();
                    $row = $row->toArray();
                    if ($row['settings_key'] == $socialIcon[0] && $row['settings_value'] != '') {
                        $singleValue['icon'] = $row['settings_value'];
                    }

                    $row = $settings->where('settings_key', $socialIcon[1])->first();
                    if(!empty($row)){
                        $row = $row->toArray();
                        if ($row['settings_key'] == $socialIcon[1] && $row['settings_value'] != '') {
                            $singleValue['href'] = $row['settings_value'];
                        }
                    }

                    // check singleValue have 2 values
                    if(count($singleValue) == 2){
                        $valueList[$key] = $singleValue;
                    }
                }
            }
        }
        return $valueList;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.frontend.social-icon.social-icon')->with('data', $this->data);
    }
}
