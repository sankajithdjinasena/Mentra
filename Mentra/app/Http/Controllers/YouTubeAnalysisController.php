<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class YouTubeAnalysisController extends Controller
{
    public function analyze(Request $request)
    {
        $url = $request->input('youtube_url');

        preg_match('/(?:youtube\.com\/.*v=|youtu\.be\/)([0-9A-Za-z_-]{11})/', $url, $matches);

        if (empty($matches[1])) {
            return back()->with('error', 'Invalid YouTube URL');
        }

        $videoId = $matches[1];

        $response = Http::post('https://focuszen-yt.onrender.com/analyze', [
            'video_id' => $videoId
        ]);

        if ($response->successful()) {
            $result = $response->json();
            return view('youtube_form', [
                'analysisResult' => $result
            ]);
        } else {
            return back()->with('error', 'Error analyzing video: ' . $response->body());
        }
    }
}
