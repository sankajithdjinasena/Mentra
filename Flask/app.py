from flask import Flask, request, jsonify
import pickle
import numpy as np

app = Flask(__name__)

with open('Model/predictor.pickle', 'rb') as file:
    model = pickle.load(file)

@app.route('/')
def index():
    return "Hello, World!"


@app.route('/predictsleepDuration', methods=['POST'])
def predict_sleep():
    try:
        data = request.get_json()
        
        # Log data to terminal so you can see if it arrives
        print("Incoming Data:", data)

        processed_data = [
            int(data.get('Age', 0)),
            int(data.get('Quality_of_Sleep', 0)),
            int(data.get('Physical_Activity_Level', 0)),
            int(data.get('Stress_Level', 0)),
            int(data.get('Heart_Rate', 0)),
            int(data.get('Daily_Steps', 0)),
            int(data.get('Gender_Female', 0)),
            int(data.get('Gender_Male', 0)),
            int(data.get('BMI_Normal', 0)),
            int(data.get('BMI_Normal_Weight', 0)),
            int(data.get('BMI_Obese', 0)),
            int(data.get('BMI_Overweight', 0)),
            int(data.get('Systolic_BP', 0)),
            int(data.get('Diastolic_BP', 0)),
        ]

        prediction = model.predict([processed_data])
        return jsonify({'predicted_sleep_duration': float(prediction[0])})

    except Exception as e:
        print("Error during prediction:", str(e))
        return jsonify({'error': str(e)}), 500
    

if __name__ == '__main__':
    app.run(debug=True, host='0.0.0.0', port=5001)
