from flask import Flask, request, jsonify
import pickle
import numpy as np
from flask_cors import CORS  # <-- Allow Laravel to call API

app = Flask(__name__)
CORS(app)  # Enable CORS for all routes

# Load model
with open('Model/predictor.pickle', 'rb') as file:
    model = pickle.load(file)

@app.route('/')
def index():
    return jsonify({"message": "Flask API is running!"})

@app.route('/predictsleepDuration', methods=['POST'])
def predict_sleep():
    try:
        data = request.get_json()

        processed_data = [
            int(data['Age']),
            data['Quality_of_Sleep'],
            data['Physical_Activity_Level'],
            data['Stress_Level'],
            int(data['Heart_Rate']),
            int(data['Daily_Steps']),
            data['Gender_Female'],
            data['Gender_Male'],
            data['BMI_Normal'],
            data['BMI_Normal_Weight'],
            data['BMI_Obese'],
            data['BMI_Overweight'],
            int(data['Systolic_BP']),
            int(data['Diastolic_BP']),
        ]

        prediction = model.predict([processed_data])
        return jsonify({'predicted_sleep_duration': float(prediction[0])})

    except Exception as e:
        print("Error during prediction:", e)
        return jsonify({'error': f'Failed to predict: {str(e)}'}), 500


if __name__ == '__main__':
    # On Render, remove debug=True and set host=0.0.0.0
    app.run(host='0.0.0.0', port=10000)
