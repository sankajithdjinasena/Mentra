<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YouTubeAnalysisController extends Controller
{
    public function analyze(Request $request)
    {
        $url = $request->input('youtube_url');

        // Extract video ID
        preg_match('/(?:youtube\.com\/.*v=|youtu\.be\/)([0-9A-Za-z_-]{11})/', $url, $matches);

        if (empty($matches[1])) {
            return back()->with('error', 'Invalid YouTube URL');
        }

        $videoId = escapeshellarg($matches[1]);

        // Python path (IMPORTANT for Windows)
        $pythonPath = "python"; 
        // Example if not working:
        // $pythonPath = "C:\\Python39\\python.exe";

        $scriptPath = base_path('scripts/youtube_analysis.py');

        // Build command safely
        $command = "\"$pythonPath\" \"$scriptPath\" $videoId";

        \Log::info("Command: " . $command);

        $output = [];
        $returnVar = 0;

        exec($command . " 2>&1", $output, $returnVar);

        if ($returnVar !== 0) {
            \Log::error("Python Error: " . implode("\n", $output));
            return back()->with('error', 'Error analyzing video.');
        }

        $jsonOutput = implode("", $output);

        $analysisResult = json_decode($jsonOutput, true);


        if (!$analysisResult) {
            return back()->with('error', 'Invalid response from analysis script.');
        }

        return view('youtube_form', compact('analysisResult'));
    }
}