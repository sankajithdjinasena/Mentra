from flask import Flask, request, jsonify
import random
import nltk
from nltk.tokenize import word_tokenize
from nltk.corpus import wordnet

nltk.download('punkt')
nltk.download('wordnet')

app = Flask(__name__)

time_based_templates = {
    (0, 10): [
        "Great start! Stay {} and push forward.",
        "You've taken the first step – be {} and keep going!"
    ],
    (11, 30): [
        "You're doing {} – keep the momentum alive.",
        "Solid effort so far! Stay {} and don't give up."
    ],
    (31, 60): [
        "Halfway through! Stay {}, you're doing great.",
        "You're in the zone – remain {} and focused."
    ],
    (61, 90): [
        "You're showing serious {} – keep pushing.",
        "Stay {}, success is within reach."
    ],
    (91, 180): [
        "That's some real {}! Amazing focus.",
        "You're built for this. Stay {} and keep going strong."
    ],
    (181, 9999): [
        "What an achievement! Your {} is inspiring.",
        "True {} shines over time. Keep up the great work."
    ]
}
base_words = ['strong', 'dedication', 'grit', 'power', 'focus', 'effort', 'drive', 'perseverance']

def get_synonyms(word):
    synonyms = set()
    for syn in wordnet.synsets(word):
        for lemma in syn.lemmas():
            w = lemma.name().replace('_', ' ')
            if w.lower() != word.lower():
                synonyms.add(w)
    return list(synonyms)

def generate_time_based_motivation(minutes):
    for time_range, templates in time_based_templates.items():
        if time_range[0] <= minutes <= time_range[1]:
            template = random.choice(templates)
            break
    else:
        return "Keep going! You're doing great."


    base_word = random.choice(base_words)
    synonyms = get_synonyms(base_word)
    replacement = random.choice(synonyms) if synonyms else base_word


    message = template.replace("{}", replacement)
    return message


@app.route('/motivate', methods=['GET'])
def motivate():
    minutes = int(request.args.get('minutes', 0))
    message = generate_time_based_motivation(minutes)
    return jsonify({'message': message})


if __name__ == '__main__':
    app.run(port=5000, debug=True)




# from flask import Flask, request, jsonify
# import openai
# import os

# app = Flask(__name__)


# openai.api_key = ""

# def generate_gpt_motivation(minutes):
#     prompt = (
#         f"Generate a short, inspiring motivational message for a student who has studied for {minutes} minutes. "
#         "Make it positive, creative, and encouraging."
#     )

#     try:
#       response = openai.ChatCompletion.create(
#             model="gpt-3.5-turbo",
#             messages=[
#                 {"role": "system", "content": "You are a motivational coach."},
#                 {"role": "user", "content": prompt}
#             ],
#             max_tokens=60,
#             temperature=0.9
#         )
#       return response.choices[0].message["content"].strip()
#     except Exception as e:
#         print("OpenAI API error:", e)
#         return "Keep going! You're doing great."

# @app.route('/motivate', methods=['GET'])
# def motivate():
#     try:
#         minutes = int(request.args.get('minutes', 0))
#     except ValueError:
#         minutes = 0

#     message = generate_gpt_motivation(minutes)
#     return jsonify({'message': message})

# if __name__ == '__main__':
#     app.run(port=5000, debug=False, use_reloader=False)


