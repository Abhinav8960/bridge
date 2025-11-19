<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Configuration\Category;
use App\Models\Backend\Configuration\Stream as ConfigurationStream;
use App\Models\Institute;
use App\Models\Institute\InstituteExam;
use App\Models\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{

    public function showCategoryStats(Request $request)
    {
        $categories = Category::all();

        $authorizedToken = "$10ObbJ5pkRZUM0beDq4DuTWNUKRtUfOezcIBmhUsjduqZOpoqMknMB$2y";
        $authToken = $request->header('Authorization');
        $expectedToken = "Bearer " . $authorizedToken;

        if ($authToken !== $expectedToken) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $results = [];
        foreach ($categories as $category) {
            $categoryId = $category->id;

            $categoryWithStreams = Category::withCount('streams')->where('id', $categoryId)->where('status', true)->first();
            $categoryWithExams = Category::withCount('categorywiseExam')->where('id', $categoryId)->where('status', true)->first();

            $institutes = Institute::where('is_plan_expired', false)
                ->where('status', true)
                ->whereHas('streamexam', function ($query) use ($categoryId) {
                    $query->where('category_id', $categoryId);
                })
                ->distinct()
                ->count('id');

            if (!$categoryWithStreams) {
                continue;
            }

            $results[] = [
                'category_name' => $categoryWithStreams->name,
                'stream' => $categoryWithStreams->streams_count,
                'institute' => $institutes,
                'total_exams' => $categoryWithExams->categorywise_exam_count ?? 0
            ];
        }

        return response()->json($results, 200);
    }
}
