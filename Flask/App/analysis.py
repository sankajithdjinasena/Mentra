from flask import Flask, request, jsonify
from flask_cors import CORS
from googleapiclient.discovery import build
from vaderSentiment.vaderSentiment import SentimentIntensityAnalyzer
import os

analysis = Flask(__name__)
CORS(analysis)

# YouTube API key from Render environment
YOUTUBE_API_KEY = os.getenv("YOUTUBE_API_KEY")


def analyze_comments(video_id):
    youtube = build('youtube', 'v3', developerKey=YOUTUBE_API_KEY)
    comments = []
    nextPageToken = None
    while len(comments) < 600:
        request = youtube.commentThreads().list(
            part='snippet',
            videoId=video_id,
            maxResults=100,
            pageToken=nextPageToken
        )
        response = request.execute()
        for item in response['items']:
            comment = item['snippet']['topLevelComment']['snippet']
            comments.append(comment['textDisplay'])
        nextPageToken = response.get('nextPageToken')
        if not nextPageToken:
            break

    analyzer = SentimentIntensityAnalyzer()
    polarity = [analyzer.polarity_scores(c)['compound'] for c in comments]
    positive_count = sum(1 for p in polarity if p > 0.05)
    negative_count = sum(1 for p in polarity if p < -0.05)
    neutral_count = len(polarity) - positive_count - negative_count

    total_comments = len(polarity)
    if total_comments == 0:
        return None, "No comments available for analysis."

    positive_ratio = positive_count / total_comments
    negative_ratio = negative_count / total_comments
    rating = 1 + (positive_ratio - negative_ratio) * 4
    rating = max(1, min(5, round(rating)))

    return {
        "rating": rating,
        "positive": positive_count,
        "negative": negative_count,
        "neutral": neutral_count,
        "total_comments": total_comments
    }, None


@analysis.route('/')
def home():
    return jsonify({"message": "YouTube Sentiment API is running"})


@analysis.route('/analyze', methods=['POST'])
def analyze():
    data = request.get_json()
    video_id = data.get("video_id")
    if not video_id:
        return jsonify({"error": "video_id is required"}), 400

    result, error = analyze_comments(video_id)
    if error:
        return jsonify({"error": error}), 400

    return jsonify(result)


if __name__ == "__main__":
    analysis.run(host="0.0.0.0", port=10000)
