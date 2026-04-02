<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PredictController extends Controller
{
    public function index()
    {
        return view('sleep_predict');
    }


    public function predict(Request $request)
    {
        $data = $request->except('_token');

        $processedData = [
            'Age' => (int) $data['Age'],
            'Quality_of_Sleep' => (int) $data['Quality_of_Sleep'],
            'Physical_Activity_Level' => (int) $data['Physical_Activity_Level'],
            'Stress_Level' => (int) $data['Stress_Level'],
            'Heart_Rate' => (int) $data['Heart_Rate'],
            'Daily_Steps' => (int) $data['Daily_Steps'],
        ];

        $processedData['Gender_Female'] = $data['gender'] === 'female' ? 1 : 0;
        $processedData['Gender_Male'] = $data['gender'] === 'male' ? 1 : 0;

        $processedData['BMI_Normal'] = $data['bmi'] === 'normal' ? 1 : 0;
        $processedData['BMI_Normal_Weight'] = $data['bmi'] === 'normal_weight' ? 1 : 0;
        $processedData['BMI_Obese'] = $data['bmi'] === 'obese' ? 1 : 0;
        $processedData['BMI_Overweight'] = $data['bmi'] === 'overweight' ? 1 : 0;

        $processedData['Systolic_BP'] = (int) $data['Systolic_BP'];
        $processedData['Diastolic_BP'] = (int) $data['Diastolic_BP'];



        $response = Http::post('https://focuszen-predictor.onrender.com/predictsleepDuration', $processedData);

        if ($response->successful()) {
            $predictedSleepDuration = $response->json()['predicted_sleep_duration'] ?? null;

            if ($predictedSleepDuration !== null) {
                return view('sleep_predict')->with('predictedSleepDuration', $predictedSleepDuration);
            } else {
                return response()->json(['error' => 'Failed to process prediction'], 500);
            }
        } else {
            return response()->json(['error' => 'Failed to predict'], $response->status());
        }

    }


}
