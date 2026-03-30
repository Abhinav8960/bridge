<?php

namespace App\Helpers;

use App\Models\Backend\Blog;
use App\Models\Backend\Configuration\Exam;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Stream;
use App\Models\Institute;
use App\Models\Institute\Information\Center;
use App\Models\Institute\Information\Champions;
use App\Models\Institute\Information\Course;
use App\Models\Institute\Information\FacultySubject;
use App\Models\Institute\InstituteExam;
use App\Models\Institute\InstituteStream;
use App\Models\InstituteStreamExam;
use Illuminate\Support\Facades\Session;

class Helper
{
    const ADMIN_ROLE = 1;
    const INSTITUTE_ROLE = 2;
    const USER_ROLE = 3;


    const NOT_NEEDED = 0;


    const TAX_TYPE_INCLUSIVE = 1;
    const TAX_TYPE_EXCLUSIVE = 2;


    public static function getCategory($id)
    {

        $cat =  Category::where('id', $id)->first();
        return $cat;
    }

    public static function fetchCategory()
    {
        return Category::where('status', true)->get();
    }

    public static function fetchStream($category_id = NULL)
    {

        return Stream::where([['category_id', $category_id], ['status', true]])->get();
    }

    public static function fetchInstituteStream($category_id, $institute_id = NULL)
    {

        if (!empty($institute_id)) {
            return InstituteStream::where('category_id', $category_id)->where('institute_id', $institute_id)->where('status', true)->get();
        }
        return InstituteStream::where('category_id', $category_id)->get();
    }

    public static function fetchStreamByStreamId($id, $category = false)
    {

        $stream = Stream::where([['id', $id], ['status', true]])->first();
        if ($category) {
            return $stream->category->name;
        }
        return $stream->name;
    }

    public static function fetchExam($stream_id)
    {

        return Exam::where([["stream_id", $stream_id], ['status', true]])->get();
    }

    public static function fetchInstituteExam($stream_id, $institute_id = NULL)
    {
        if (!empty($institute_id)) {
            return InstituteStreamExam::where('stream_id', $stream_id)->where('institute_id', $institute_id)->get();
        }
        return InstituteStreamExam::where('stream_id', $stream_id)->get();
    }

    public static function featutesInputType()
    {

        return [1 => 'Yes/No', 2 => 'Input Text'];
    }

    public static function facultySubjectId($subject)
    {
        $model = FacultySubject::updateOrCreate([

            'subject'   => strtolower($subject),
        ], [
            'subject'   => strtolower($subject),

        ]);
        return $model->id;
    }

    public static function CenterBranchType($instituteId, $centerId = NULL)
    {

        $count = Center::where('institute_id', $instituteId)->where('branch_type', Center::CORPORATE_HEADQUARTER);

        if (!empty($centerId)) {
            $count = $count->where('id', $centerId);
        }

        $count = $count->count();

        if (!empty($centerId)) {

            if ($count == 1) {
                return  [Center::CORPORATE_HEADQUARTER => 'Corporate Headquarter'];
            } else {
                return  [Center::BRANCH => 'Branch'];
            }
        } else {

            if ($count < 1) {
                return  [Center::CORPORATE_HEADQUARTER => 'Corporate Headquarter'];
            } else {
                return  [Center::BRANCH => 'Branch'];
            }
        }
    }

    public static function VideoCode($url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
        $youtube_id = $my_array_of_vars['v'];

        return $youtube_id;
    }

    public static function examCategoryIdByExamId($exam)
    {
        $exam = Exam::where([["id", $exam], ['status', true]])->first();
        return $exam->category_id;
    }
    public static function examStreamIdByExamId($exam)
    {
        $exam = Exam::where([["id", $exam], ['status', true]])->first();
        return $exam->stream_id;
    }

    public static function examByExamId($exam)
    {
        $exam = Exam::where([["id", $exam], ['status', true]])->first();
        return $exam;
    }

    public static function StreamByStreamId($id)
    {

        return Stream::where([['id', $id]])->first();
    }

    public static function BookingFeesByCategoryId($id)
    {
        $cat =  Category::where('id', $id)->first();

        return $cat->booking_fees;
    }

    public static function TaxIdByCategoryId($id)
    {
        $cat =  Category::where('id', $id)->first();

        return $cat->tax_id;
    }

    public static function TaxTypeIdByCategoryId($id)
    {
        $cat =  Category::where('id', $id)->first();

        return $cat->tax_type_id;
    }

    public static function SacCodeByCategoryId($id)
    {
        $cat =  Category::where('id', $id)->first();

        return $cat->sac_code_id;
    }

    public static function BillingAccountIdByCategoryId($id)
    {
        $cat =  Category::where('id', $id)->first();

        return $cat->billing_account_id;
    }



    public static function CenterBycenterId($id)
    {
        return Center::where('id', $id)->first();
    }

    public static function cityByCityId($city)
    {
        $city = array_column(LocationHelper::getAllCitiesWithoutState()->response, "city", "city_id");

        return $city;
    }


    public static function AsPerValidityOptions($read = false)
    {
        if ($read) {
            $arr = [
                0   =>  "45 days",
                1   =>  "1 Month",
                2   =>  "2 Months",
                3   =>  "3 Months",
                6   =>  "6 Months",
                12  =>  "12 Months"

            ];
        } else {
        }
        $arr = [
            1   =>  "1 Month",
            2   =>  "2 Months",
            3   =>  "3 Months",
            6   =>  "6 Months",
            12  =>  "12 Months"

        ];
        return $arr;
    }

    public static function SeoUrl($seourlArray)
    {
        // $category, $stream, $exam, $country, $state, $city, $area, $nearme

        $str = "coaching";
        $location = "";
        $prefix = NULL;

        $configuration = "";
        if (isset($seourlArray['exam']) && $seourlArray['exam'] > 0) {
            $exm =  Exam::where('id', $seourlArray['exam'])->firstOrFail();
            $s = strtolower($exm->name);
            $configuration =  str_replace(" ", "-", $s);
        } elseif (isset($seourlArray['stream']) && $seourlArray['stream'] > 0) {
            $strm =  Stream::where('id', $seourlArray['stream'])->firstOrFail();
            $s = strtolower($strm->name);
            $configuration =  str_replace(" ", "-", $s);
        } elseif (isset($seourlArray['category']) && $seourlArray['category'] > 0) {
            $cat =  Category::where('id', $seourlArray['category'])->firstOrFail();
            $s = strtolower($cat->name);
            $configuration =  str_replace(" ", "-", $s);
        }
        if (!empty($configuration)) {
            $configuration .= "-";
        }


        if (isset($seourlArray['nearme']) && $seourlArray['nearme'] > 0) {
            $location = "-near-me";
        } elseif (isset($seourlArray['area']) && $seourlArray['area'] > 0) {
            $areaName = LocationHelper::getAreaName($seourlArray['state'], $seourlArray['city'], $seourlArray['area']);
            $prefix = LocationHelper::getCityName($seourlArray['state'], $seourlArray['city']);
            $s = strtolower($areaName);

            $location = "-in-" . str_replace(" ", "-", $s);
            $prefix = strtolower(str_replace(" ", "-", $prefix));
        } elseif (isset($seourlArray['city']) && $seourlArray['city'] > 0) {
            $cityName = LocationHelper::getCityName($seourlArray['state'], $seourlArray['city']);
            $prefix = LocationHelper::getStateName($seourlArray['state']);
            $s = strtolower($cityName);
            $location = "-in-" . str_replace(" ", "-", $s);
            $prefix = strtolower(str_replace(" ", "-", $prefix));
        } elseif (isset($seourlArray['state']) && $seourlArray['state'] > 0) {
            $StateName = LocationHelper::getStateName($seourlArray['state']);
            $s = strtolower($StateName);
            $location = "-in-" . str_replace(" ", "-", $s);
        } elseif (isset($seourlArray['country']) && $seourlArray['country'] > 0) {
            $location = "-in-india";
        } else {
            $location = "-in-india";
        }
        if (!empty($prefix)) {
            return  $prefix . '/' . $configuration . '' . $str . '' . $location;
        }

        return   $configuration . '' . $str . '' . $location;
    }
    public static function SeoUrldb($seourlArray)
    {
        // $category, $stream, $exam, $country, $state, $city, $area, $nearme

        $str = "coaching";
        $location = "";
        $prefix = NULL;

        $configuration = "";
        if (isset($seourlArray['exam']) && $seourlArray['exam'] > 0) {
            $exm =  Exam::where('id', $seourlArray['exam'])->firstOrFail();
            $s = strtolower($exm->name);
            $configuration =  str_replace(" ", "-", $s);
        } elseif (isset($seourlArray['stream']) && $seourlArray['stream'] > 0) {
            $strm =  Stream::where('id', $seourlArray['stream'])->firstOrFail();
            $s = strtolower($strm->name);
            $configuration =  str_replace(" ", "-", $s);
        } elseif (isset($seourlArray['category']) && $seourlArray['category'] > 0) {
            $cat =  Category::where('id', $seourlArray['category'])->firstOrFail();
            $s = strtolower($cat->name);
            $configuration =  str_replace(" ", "-", $s);
        }
        if (!empty($configuration)) {
            $configuration .= "-";
        }


        if (isset($seourlArray['nearme']) && $seourlArray['nearme'] > 0) {
            $location = "-near-me";
        } elseif (isset($seourlArray['area']) && $seourlArray['area'] > 0) {
            $areaName = LocationHelper::getAreaName($seourlArray['state'], $seourlArray['city'], $seourlArray['area']);
            $prefix = LocationHelper::getCityName($seourlArray['state'], $seourlArray['city']);
            $s = strtolower($areaName);

            $location = "-in-" . str_replace(" ", "-", $s);
            $prefix = strtolower(str_replace(" ", "-", $prefix));
        } elseif (isset($seourlArray['city']) && $seourlArray['city'] > 0) {
            $cityName = LocationHelper::getCityName($seourlArray['state'], $seourlArray['city']);
            $prefix = LocationHelper::getStateName($seourlArray['state']);
            $s = strtolower($cityName);
            $location = "-in-" . str_replace(" ", "-", $s);
            $prefix = strtolower(str_replace(" ", "-", $prefix));
        } elseif (isset($seourlArray['state']) && $seourlArray['state'] > 0) {
            $StateName = LocationHelper::getStateName($seourlArray['state']);
            $s = strtolower($StateName);
            $location = "-in-" . str_replace(" ", "-", $s);
        } elseif (isset($seourlArray['country']) && $seourlArray['country'] > 0) {
            $location = "-in-india";
        } else {
            $location = "-in-india";
        }
        // if (!empty($prefix)) {
        //     return  $prefix . '/' . $configuration . '' . $str . '' . $location;
        // }

        return   $configuration . '' . $str . '' . $location;
    }
    public static function array_column_recursive(array $haystack, $needle, $isUnique = true)
    {
        $found = [];
        array_walk_recursive($haystack, function ($value, $key) use (&$found, $needle) {
            if ($key == $needle)
                $found[] = $value;
        });
        if ($isUnique) {
            return array_unique($found);
        }
        return $found;
    }


    public static function InstituteStreamOptions($examCategoryId)
    {

        $streamOptions = InstituteStream::where('institute_id', session()->get('institute.id'))->where('status', true)->where('category_id', $examCategoryId)->groupby(['stream_id'])->get();
        return $streamOptions;
    }

    public static function InstituteExamOptions($examStreamId)
    {
        $courses = Course::where('status', true)->where('institute_id', Session::get('institute.id'))->with('exams')->whereHas('exams', function ($q) use ($examStreamId) {
            $q->where('stream_id', $examStreamId)->groupBy('exam_id');
        })->get()->toArray();
        $exam_ids = SELF::array_column_recursive($courses, 'exam_id');
        $examOptions = Exam::where('status', true)->whereIn('id', $exam_ids)->get();
        return $examOptions;
    }

    public static function ExamOptions($examStreamId)
    {
        $examOptions = Exam::where('institute_id', session()->get('institute.id'))->where('status', true)->where('stream_id', $examStreamId)->get();
        return $examOptions;
    }

    public static function StreamExamOptions($examStreamId)
    {
        $examOptions = InstituteStreamExam::where('institute_id', session()->get('institute.id'))->where('stream_id', $examStreamId)->get();
        return $examOptions;
    }

    public static function removeEmptyValuesAndSubarrays($array)
    {
        foreach ($array as $k => &$v) {
            if (is_array($v)) {
                $v = self::removeEmptyValuesAndSubarrays($v);  // filter subarray and update array
                if (!sizeof($v)) { // check array count
                    unset($array[$k]);
                }
            } elseif (!strlen($v)) {  // this will handle (int) type values correctly
                unset($array[$k]);
            }
        }
        return $array;
    }

    public static function countFeaturedIntituteByStream($streamId)
    {
        return Institute::where('is_plan_expired', false)->where('status', true)
            ->withWhereHas('instituteexam', function ($query) use ($streamId) {
                $query->where('stream_id', $streamId)->distinct();
            })->withWhereHas('featured', function ($query) {
                $query->where('isHome', true);
            })->count();
    }


    public static function IntituteStateList($filter = NULL)
    {
        if (!empty($filter)) {
            return  Center::select(['state_id', 'state_name'])->where('status', true)->where('state_name', 'like', '%' . $filter . '%')->whereHas('institute', function ($q) {
                $q->where('status', true)->where('is_plan_expired', false);
            })->distinct()->get();
        }

        return Center::select(['state_id', 'state_name'])->where('status', true)->whereHas('institute', function ($q) {
            $q->where('status', true)->where('is_plan_expired', false);
        })->distinct()->get();
    }

    public static function IntituteCityList($state, $filter = NULL)
    {

        if ($state > SELF::NOT_NEEDED) {
            if (!empty($filter)) {
                return   Center::select(['city_id', 'city_name'])->where('status', true)->where('state_id', $state)->where('city_name', 'like', '%' . $filter . '%')->whereHas('institute', function ($q) {
                    $q->where('status', true)->where('is_plan_expired', false);
                })->distinct()->get();
            }
            return   Center::select(['city_id', 'city_name'])->where('status', true)->where('state_id', $state)->whereHas('institute', function ($q) {
                $q->where('status', true)->where('is_plan_expired', false);
            })->distinct()->get();
        }
        return [];
    }

    public static function IntituteAreaList($city, $filter = NULL)
    {


        if ($city > SELF::NOT_NEEDED) {
            if (!empty($filter)) {
                return   Center::select(['area_id', 'area'])->where('status', true)->where('city_id', $city)->where('area', 'like', '%' . $filter . '%')->whereHas('institute', function ($q) {
                    $q->where('status', true)->where('is_plan_expired', false);
                })->distinct()->get();
            }

            return  Center::select(['area_id', 'area'])->where('status', true)->where('city_id', $city)->whereHas('institute', function ($q) {
                $q->where('status', true)->where('is_plan_expired', false);
            })->distinct()->get();
        }
        return [];
    }

    public static function getInstitute($id)
    {
        $inst = Institute::find($id);

        return $inst;
    }


    public static function championswithconfiguration($institute_id, $category_id = NULL, $stream_id = NULL, $exam_id = NULL)
    {

        $model =  Champions::where(['status' => true, 'institute_id' => $institute_id]);
        if ($exam_id > 0) {
            $model->where('exam_id', $exam_id);
        } elseif ($stream_id > 0) {
            $model->where('exam_stream_id', $stream_id);
        } elseif ($category_id  > 0) {
            $model->where('exam_category_id', $category_id);
        }



        return $model->orderBy('year', 'DESC')->limit(4)->get();
    }


    public static function wordslice($num_words = 50, $original_string, $route)
    {

        $words = array();
        $words = explode(" ", $original_string, $num_words);
        $shown_string = "";

        if (count($words) == $num_words) {
            $words[$num_words - 1] = " ... <a class='btn btn-link' href='" . route('institute.microsite', ['slug' => $route]) . "'>Read More</a>";
        }

        return $shown_string = implode(" ", $words);
    }


    public static function printStar($average_rating, $canweshow)
    {
        $maxrating = 5;
        $str = "";
        $numpart = explode(".", $average_rating);
        $isDescimal = false;
        $integer = $numpart[0];
        if (isset($numpart[1]) && ($numpart[1] > 0)) {
            $isDescimal = true;
        }

        if ($canweshow) {
            for ($j = 1; $j <= $maxrating; $j++) {
                if ($j <= $integer) {
                    $str .=  '<li><i class="bi bi-star-fill"></i></li>';
                } elseif ($isDescimal == true) {
                    $str .= '<li><i class="bi bi-star-half"></i></li>';
                    $isDescimal = false;
                } else {
                    $str .= '<li><i class="bi bi-star"></i></li>';
                }
            }
        } else {

            for ($j = 1; $j <= $maxrating; $j++) {

                $str .= '<li><i class="bi bi-star"></i></li>';
            }
        }
        return $str;
    }

    public static function mobileprintStar($average_rating, $canweshow)
    {

        $maxrating = 5;
        $str = "";
        $numpart = explode(".", $average_rating);
        $isDescimal = false;
        $integer = $numpart[0];
        if (isset($numpart[1]) && ($numpart[1] > 0)) {
            $isDescimal = true;
        }

        if ($canweshow) {

            for ($j = 1; $j <= $maxrating; $j++) {
                if ($j <= $integer) {
                    $str .=  '<a><i class="bi bi-star-fill"></i></a>';
                } elseif ($isDescimal == true) {
                    $str .= '<a><i class="bi bi-star-half"></i></a>';
                    $isDescimal = false;
                } else {
                    $str .= '<a><i class="bi bi-star"></i></a>';
                }
            }
        } else {
            for ($j = 1; $j <= $maxrating; $j++) {

                $str .= '<a><i class="bi bi-star"></i></a>';
            }
        }
        return $str;
    }

    public static function conatctTypeOptions()
    {
        $arr = [
            1 => "Institute Listing",
            2 => "Student's Enquiry",
            3 => "Franchise Queries",
            4 => "General Queries",
            5 => "Not Listed or Others"
        ];
        return $arr;
    }

    public static function InternalRoles()
    {
        $arr = [
            1 => 'Admin',
            4 => 'Blogger',
            5 => 'Seeder',
            6 => 'Manager',
        ];
        return $arr;
    }


    public static function formationType()
    {
        return [1 => 'Sole Proprietorship', 2 => 'Partnership', 3 => 'Private Limited Company', 4 => 'India Limited Company', 5 => 'Limited Liability Company', 6 => 'Joint Venture Company', 7 => 'One Person Company', 8 => 'Section 8 Company', 9 => 'Non-Governmental Organization', 10 => 'Trust', 11 => 'Society'];
    }


    public static function chargeableamount($taxType, $taxpercentage, $amount)
    {

        if ($taxType == SELF::TAX_TYPE_EXCLUSIVE) {
            // $amt = ceil(($amount * 100) / (100 + $taxpercentage));
            // $amt = ceil($amount);
            $amt = sprintf('%0.2f', round(($amount * (100 + $taxpercentage)) / 100), 2);
        } else {
            $amt = sprintf('%0.2f', round($amount, 2));
        }
        return $amt;
    }

    public static function amountWithoutTax($taxType, $taxpercentage, $amount)
    {

        if ($taxType == SELF::TAX_TYPE_EXCLUSIVE) {
            // $amt = ceil(($amount * 100) / (100 + $taxpercentage));
            $amt = sprintf('%0.2f', round($amount, 2));
        } else {
            // $amt = ceil(($amount * (100 + $taxpercentage)) / 100);
            // $amt = ceil($amount);
            $amt = sprintf('%0.2f', round(($amount * 100) / (100 + $taxpercentage), 2));
        }
        return $amt;
    }

    public static function taxableamount($charegableamount, $percentage)
    {
        return sprintf('%0.2f', round((($charegableamount * $percentage) / 100), 2));
    }

    public static function getNameById($category = null, $stream = null, $exam = null)
    {
        if ($category != null && $stream != null && $exam != null) {
            $category = Category::where('id', $category)->first();
            $stream = Stream::where('id', $stream)->first();
            $exam = Exam::where('id', $exam)->first();
            return $category->name . ' / ' . $stream->name  . ' / ' . $exam->name;
        } elseif ($category != null && $stream != null) {
            $category = Category::where('id', $category)->first();
            $stream = Stream::where('id', $stream)->first();
            return $category->name . ' / ' . $stream->name;
        } elseif ($category != null) {
            $category = Category::where('id', $category)->first();
            return $category->name;
        }
    }

    public static function countweekview($blogId)
    {
        $date = \Carbon\Carbon::today()->subDays(7);

        $trendingweekposts = Blog::where('id', $blogId)->where('status', 1)->whereDate('created_at', '>=', $date)->first();
        if ($trendingweekposts == null) {
            return 0;
        } else {

            return   $trendingweekposts->views;
        }
    }

    public static function countInstituteStreamWise($stream)
    {
       return $ins = Institute::where('is_plan_expired', false)->where('status', true)->withWhereHas('streamexam', function ($query) use ($stream) {
            $query->where('stream_id', $stream)->distinct();
        })->count();

    }
}
