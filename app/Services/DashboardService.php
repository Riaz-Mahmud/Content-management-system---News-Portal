<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\News;
use App\Models\Session;
use App\Models\Category;
use App\Models\ActivityLog;
use App\Models\NewsComment;
use Carbon\CarbonInterface;
use App\Helpers\StringHelper;
use Illuminate\Support\Facades\Crypt;

class DashboardService{

    public function getTopTags(){
        $tags = Tag::all();
        $topTags = [];
        foreach($tags as $tag){
            $topTags[] = [
                'hasId' => Crypt::encrypt($tag->id),
                'label' => $tag->label,
                'count' => $tag->news()->where('status', 'Active')->where('is_deleted', 0)->count(),
            ];
        }
        usort($topTags, function($a, $b){
            return $b['count'] <=> $a['count'];
        });

        return array_slice($topTags, 0, 5);
    }

    public function getTopCategories(){
        $categories = Category::all();
        $topCategories = [];
        foreach($categories as $category){
            $topCategories[] = [
                'hasId' => Crypt::encrypt($category->id),
                'title' => $category->title,
                'count' => $category->news()->where('status', 'Active')->where('is_deleted', 0)->count(),
            ];
        }
        usort($topCategories, function($a, $b){
            return $b['count'] <=> $a['count'];
        });

        return array_slice($topCategories, 0, 5);
    }

    public function getLatestNews(){
        $news = News::latest()->limit(5)->get();
        $newNews = [];
        foreach($news as $new){

            $options = [
                'join' => ', ',
                'parts' => 2,
                'syntax' => CarbonInterface::DIFF_ABSOLUTE,
            ];

            $newNews[] = [
                'hasId' => Crypt::encrypt($new->id),
                'title' => StringHelper::title($new->title),
                'author' => $new->user->name,
                'status' => $new->status,
                'created_at' => Carbon::parse($new->created_at)->diffForHumans(null, $options, true). ' ago',
            ];
        }

        return array_slice($newNews, 0, 5);
    }

    public function getLatestComments(){
        $comments = NewsComment::latest()->limit(5)->get();
        $newComments = [];
        foreach($comments as $comment){

            $options = [
                'join' => ', ',
                'parts' => 2,
                'syntax' => CarbonInterface::DIFF_ABSOLUTE,
            ];

            $newComments[] = [
                'hasId' => Crypt::encrypt($comment->id),
                'comment' => $comment->content,
                'author' => $comment->user->name,
                'news' => StringHelper::title($comment->news->title),
                'created_at' => Carbon::parse($comment->created_at)->diffForHumans(null, $options, true). ' ago',
            ];
        }

        return array_slice($newComments, 0, 5);
    }

    public function getNewVisitors(){

        // get unique IP count from activity log
        $visitors = ActivityLog::where('created_at', '>=', Carbon::now()->subDays(7))->get();

        $data = [];

        // keep last 7 days ip count in array with day name
        for($i = 6; $i >= 0; $i--){
            $data['days'][]= [
                'day' => Carbon::now()->subDays($i)->format('l'),
                'day_short' => substr(Carbon::now()->subDays($i)->format('l'), 0, 1),
                'count' => $visitors->where('created_at', '>=', Carbon::now()->subDays($i)->startOfDay())
                    ->where('created_at', '<=', Carbon::now()->subDays($i)->endOfDay())
                    ->unique('ip')
                    ->count(),
                'activity_count' => $visitors->where('created_at', '>=', Carbon::now()->subDays($i)->startOfDay())
                    ->where('created_at', '<=', Carbon::now()->subDays($i)->endOfDay())
                    ->count(),
            ];
        }

        // dd($data);

        // count how many percentage change from average percentage
        for($i = 0; $i < count($data['days']); $i++){
            if($i == 0){
                $data['days'][$i]['percentage'] = 0;
            }else{
                if($data['days'][$i - 1]['count'] == 0){
                    $data['days'][$i]['percentage'] = 0;
                }else{
                    $data['days'][$i]['percentage'] = round((($data['days'][$i]['count'] - $data['days'][$i - 1]['count']) / $data['days'][$i - 1]['count']) * 100, 2);
                }

                if($data['days'][$i- 1]['activity_count'] == 0){
                    $data['days'][$i]['activity_percentage'] = 0;
                }else{
                    $data['days'][$i]['activity_percentage'] = round((($data['days'][$i]['activity_count'] - $data['days'][$i - 1]['activity_count']) / $data['days'][$i - 1]['activity_count']) * 100, 2);
                }
            }
        }

        // count average percentage change
        $average = 0;
        for($i = 0; $i < count($data['days']); $i++){
            if($i == 0){
                $average += 0;
            }else{
                if($data['days'][$i - 1]['count'] == 0){
                    $average += 0;
                }else{
                    $average += (($data['days'][$i]['count'] - $data['days'][$i - 1]['count']) / $data['days'][$i - 1]['count']) * 100;
                }
            }
        }
        $data['average'] = round($average / count($data['days']), 0);

        // count average percentage for activity_count
        $data['average_activity'] = 0;
        for($i = 0; $i < count($data['days']); $i++){
            if($i == 0){
                $data['average_activity'] += 0;
            }else{
                if($data['days'][$i - 1]['activity_count'] == 0){
                    $data['average_activity'] += 0;
                }else{
                    $data['average_activity'] += (($data['days'][$i]['activity_count'] - $data['days'][$i - 1]['activity_count']) / $data['days'][$i - 1]['activity_count']) * 100;
                }
            }
        }
        $data['average_activity'] = round($data['average_activity'] / count($data['days']), 0);

        // dd($data);

        return $data;
    }

    public function getActiveNow(){

        $data = [];

        $data['activeNow'] = Session::activity(10)->count();
        $data['guests'] = Session::guests()->activity(10)->count();
        $data['users'] = Session::registered()->activity(10)->count();

        return $data;

    }

    public function getVisitedCountryList(){

        $countries = [
            [
                'index' => 'map_1',
                'country_name' => 'AFGHANISTAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_2',
                'country_name' => 'ALBANIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_3',
                'country_name' => 'ALGERIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_4',
                'country_name' => 'ANDORRA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_5',
                'country_name' => 'ANGOLA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_6',
                'country_name' => 'ARGENTINA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_7',
                'country_name' => 'ARMENIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_8',
                'country_name' => 'AUSTRALIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_9',
                'country_name' => 'AUSTRIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_10',
                'country_name' => 'AZERBAIJAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_11',
                'country_name' => 'BAHAMAS',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_12',
                'country_name' => 'BAHRAIN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_13',
                'country_name' => 'BANGLADESH',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_14',
                'country_name' => 'BELARUS',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_15',
                'country_name' => 'BELGIUM',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_16',
                'country_name' => 'BELIZE',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_17',
                'country_name' => 'BENIN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_18',
                'country_name' => 'BHUTAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_19',
                'country_name' => 'BOLIVIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_20',
                'country_name' => 'BOSNIA AND HERZEGOVINA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_21',
                'country_name' => 'BOTSWANA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_22',
                'country_name' => 'BRAZIL',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_23',
                'country_name' => 'BRUNEI',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_24',
                'country_name' => 'BULGARIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_25',
                'country_name' => 'BURKINA FASO',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_26',
                'country_name' => 'BURUNDI',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_27',
                'country_name' => 'CAMBODIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_28',
                'country_name' => 'CAMEROON',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_29',
                'country_name' => 'CANADA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_30',
                'country_name' => 'CENTRAL AFRICAN REPUBLIC',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_31',
                'country_name' => 'CHAD',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_32',
                'country_name' => 'CHILE',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_33',
                'country_name' => 'CHINA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_34',
                'country_name' => 'COLOMBIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_35',
                'country_name' => 'COMOROS',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_36',
                'country_name' => 'CONGO',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_37',
                'country_name' => 'COSTA RICA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_38',
                'country_name' => 'CROATIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_39',
                'country_name' => 'CUBA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_40',
                'country_name' => 'CYPRUS',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_41',
                'country_name' => 'CZECH REPUBLIC',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_42',
                'country_name' => 'CÔTE D&#39;IVOIRE',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_43',
                'country_name' => 'DEMOCRATIC REPUBLIC OF THE CONGO',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_44',
                'country_name' => 'DENMARK',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_45',
                'country_name' => 'DJIBOUTI',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_46',
                'country_name' => 'DOMINICAN REPUBLIC',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_47',
                'country_name' => 'ECUADOR',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_48',
                'country_name' => 'EGYPT',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_49',
                'country_name' => 'EL SALVADOR',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_50',
                'country_name' => 'EQUATORIAL GUINEA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_51',
                'country_name' => 'ERITREA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_52',
                'country_name' => 'ESTONIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_53',
                'country_name' => 'ETHIOPIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_54',
                'country_name' => 'FIJI',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_55',
                'country_name' => 'FINLAND',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_56',
                'country_name' => 'FRANCE',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_57',
                'country_name' => 'FRENCH GUIANA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_58',
                'country_name' => 'GABON',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_59',
                'country_name' => 'GEORGIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_60',
                'country_name' => 'GERMANY',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_61',
                'country_name' => 'GHANA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_62',
                'country_name' => 'GREECE',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_63',
                'country_name' => 'GREENLAND',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_64',
                'country_name' => 'GUATEMALA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_65',
                'country_name' => 'GUINEA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_66',
                'country_name' => 'GUINEA-BISSAU',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_67',
                'country_name' => 'GUYANA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_68',
                'country_name' => 'HAITI',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_69',
                'country_name' => 'HONDURAS',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_70',
                'country_name' => 'HUNGARY',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_71',
                'country_name' => 'ICELAND',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_72',
                'country_name' => 'INDIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_73',
                'country_name' => 'INDONESIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_74',
                'country_name' => 'IRAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_75',
                'country_name' => 'IRAQ',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_76',
                'country_name' => 'IRELAND',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_77',
                'country_name' => 'ISREAL',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_78',
                'country_name' => 'ITALY',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_79',
                'country_name' => 'JAMAICA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_80',
                'country_name' => 'JAPAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_81',
                'country_name' => 'JORDAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_82',
                'country_name' => 'KAZAKHSTAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_83',
                'country_name' => 'KENYA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_84',
                'country_name' => 'KOSOVO',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_85',
                'country_name' => 'KUWAIT',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_86',
                'country_name' => 'KYRGYZSTAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_87',
                'country_name' => 'LAOS',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_88',
                'country_name' => 'LATVIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_89',
                'country_name' => 'LEBANON',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_90',
                'country_name' => 'LESOTHO',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_91',
                'country_name' => 'LIBERIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_92',
                'country_name' => 'LIBYA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_93',
                'country_name' => 'LIECHTENSTEIN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_94',
                'country_name' => 'LITHUANIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_95',
                'country_name' => 'LUXEMBOURG',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_96',
                'country_name' => 'MACEDONIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_97',
                'country_name' => 'MADAGASCAR',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_98',
                'country_name' => 'MALAWI',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_99',
                'country_name' => 'MALAYSIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_100',
                'country_name' => 'MALDIVES',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_101',
                'country_name' => 'MALI',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_102',
                'country_name' => 'MALTA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_103',
                'country_name' => 'MAURITANIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_104',
                'country_name' => 'MAURITIUS',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_105',
                'country_name' => 'MEXICO',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_106',
                'country_name' => 'MOLDOVA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_107',
                'country_name' => 'MONGOLIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_108',
                'country_name' => 'MONTENEGRO',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_109',
                'country_name' => 'MOROCCO',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_110',
                'country_name' => 'MOZAMBIQUE',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_111',
                'country_name' => 'MYANMAR',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_112',
                'country_name' => 'NAMIBIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_113',
                'country_name' => 'NEPAL',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_114',
                'country_name' => 'NETHERLANDS',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_115',
                'country_name' => 'NEW ZEALAND',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_116',
                'country_name' => 'NICARAGUA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_117',
                'country_name' => 'NIGER',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_118',
                'country_name' => 'NIGERIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_119',
                'country_name' => 'NORTH KOREA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_120',
                'country_name' => 'NORWAY',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_121',
                'country_name' => 'OMAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_122',
                'country_name' => 'PAKISTAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_123',
                'country_name' => 'PALESTINE',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_124',
                'country_name' => 'PANAMA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_125',
                'country_name' => 'PAPUA NEW GUINEA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_126',
                'country_name' => 'PARAGUAY',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_127',
                'country_name' => 'PERU',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_128',
                'country_name' => 'PHILIPPINES',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_129',
                'country_name' => 'POLAND',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_130',
                'country_name' => 'PORTUGAL',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_131',
                'country_name' => 'PUETRO RICO',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_132',
                'country_name' => 'QATAR',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_133',
                'country_name' => 'ROMANIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_134',
                'country_name' => 'RUSSIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_135',
                'country_name' => 'RWANDA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_136',
                'country_name' => 'SAUDI ARABIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_137',
                'country_name' => 'SENEGAL',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_138',
                'country_name' => 'SERBIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_138',
                'country_name' => 'SERBIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_139',
                'country_name' => 'SEYCHELLES',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_140',
                'country_name' => 'SIERRA LEONE',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_141',
                'country_name' => 'SINGAPORE',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_142',
                'country_name' => 'SLOVAKIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_143',
                'country_name' => 'SLOVENIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_144',
                'country_name' => 'SOLOMON ISLANDS',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_145',
                'country_name' => 'SOMALIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_146',
                'country_name' => 'SOUTH AFRICA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_147',
                'country_name' => 'SOUTH KOREA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_148',
                'country_name' => 'SOUTH SUDAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_149',
                'country_name' => 'SPAIN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_150',
                'country_name' => 'SRI LANKA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_151',
                'country_name' => 'SUDAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_152',
                'country_name' => 'SURINAME',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_153',
                'country_name' => 'SWAZILAND',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_154',
                'country_name' => 'SWEDEN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_155',
                'country_name' => 'SWITZERLAND',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_156',
                'country_name' => 'SYRIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_157',
                'country_name' => 'SÃO TOMÉ AND PRÍNCIPE',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_158',
                'country_name' => 'TAIWAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_159',
                'country_name' => 'TAJIKISTAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_160',
                'country_name' => 'TANZANIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_161',
                'country_name' => 'THAILAND',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_162',
                'country_name' => 'THE GAMBIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_163',
                'country_name' => 'TIMOR-LESTE',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_164',
                'country_name' => 'TOGO',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_165',
                'country_name' => 'TUNISIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_166',
                'country_name' => 'TURKEY',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_167',
                'country_name' => 'TURKMENISTAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_168',
                'country_name' => 'UGANDA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_169',
                'country_name' => 'UKRAINE',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_170',
                'country_name' => 'UNITED ARAB EMIRATES',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_171',
                'country_name' => 'UNITED KINGDOM',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_172',
                'country_name' => 'UNITED STATES',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_173',
                'country_name' => 'URUGUAY',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_174',
                'country_name' => 'UZBEKISTAN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_175',
                'country_name' => 'VENEZUELA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_176',
                'country_name' => 'VIETNAM',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_177',
                'country_name' => 'WESTERN SAHARA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_178',
                'country_name' => 'YEMEN',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_179',
                'country_name' => 'ZAMBIA',
                'visited' => false,
                'count' => 0
            ],
            [
                'index' => 'map_180',
                'country_name' => 'ZIMBABWE',
                'visited' => false,
                'count' => 0
            ]
        ];

        // Retrieve and process activity logs
        $activityLogs = ActivityLog::whereNotNull('country')->get();

        // Process unique countries and counts in one go
        $countryCounts = [];
        foreach ($activityLogs as $log) {
            $country = ucwords(strtolower($log->country));
            if (!isset($countryCounts[$country])) {
                $countryCounts[$country] = ['visited' => true, 'count' => 0];
            }
            $countryCounts[$country]['count']++;
        }

        // Update countries with visit status and count
        foreach ($countries as &$country) {
            $countryName = ucwords(strtolower($country['country_name']));
            if (isset($countryCounts[$countryName])) {
                $country['visited'] = true;
                $country['count'] = $countryCounts[$countryName]['count'];
            }
        }

        return $countries;
    }

}
