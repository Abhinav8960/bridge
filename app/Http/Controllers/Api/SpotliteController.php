<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Backend\Spotlite;
use Illuminate\Http\Request;

class SpotliteController extends Controller
{

    public function showSpotlite(Request $request)
{
    $authorizedToken = "$10OAAJ5p6M%0beDq4DuTWNUKRtUfOezcIBmhUduqZOpoqMknCC$2y1";
    $authToken = $request->header('Authorization');
    $expectedToken = "Bearer " . $authorizedToken;

    if ($authToken !== $expectedToken) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    if ($expectedToken == $authToken) {
        // Get a random spotlite with specific fields
        $spotlite = Spotlite::where('status', true)
            ->inRandomOrder()
            ->select('institute_name', 'location', 'establish_year', 'batch_training', 'virtual_classroom', 'description', 'institute_url', 'dyntube_project_id', 'dyntube_video_id')
            ->first();

        return response()->json($spotlite);
    }
}

}
