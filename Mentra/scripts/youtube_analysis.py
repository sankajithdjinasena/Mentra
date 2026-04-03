import sys
from googleapiclient.discovery import build
import re
import emoji
from vaderSentiment.vaderSentiment import SentimentIntensityAnalyzer
import json

API_KEY = "AIzaSyAqj6nRQ50AacJs86Fmv6Dxfy--riJwyOk"

def analyze_comments(video_id):
    youtube = build('youtube', 'v3', developerKey=API_KEY)

    # Fetch comments
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

    # Sentiment analysis
    analyzer = SentimentIntensityAnalyzer()
    polarity = [analyzer.polarity_scores(c)['compound'] for c in comments]
    positive_count = sum(1 for p in polarity if p > 0.05)
    negative_count = sum(1 for p in polarity if p < -0.05)
    neutral_count = len(polarity) - positive_count - negative_count

    # Calculate rating (example: scale 1 to 5)
    total_comments = len(polarity)
    if total_comments == 0:
        return "No comments available for analysis."

    positive_ratio = positive_count / total_comments
    negative_ratio = negative_count / total_comments

    # Assign a rating based on the sentiment distribution
    rating = 1 + (positive_ratio - negative_ratio) * 4  # Scale: 1 (worst) to 5 (best)
    rating = max(1, min(5, round(rating)))  # Ensure rating stays between 1 and 5

    # Return the rating and summary
    return json.dumps({
        "rating": rating,
        "positive": positive_count,
        "negative": negative_count,
        "neutral": neutral_count,
        "total_comments": total_comments
    })

# if __name__ == '__main__':
#     video_id = sys.argv[1]
#     print(analyze_comments(video_id))

if __name__ == '__main__':
    if len(sys.argv) < 2:
        print("Usage: python youtube_analysis.py VIDEO_ID")
        sys.exit(1)

    video_id = sys.argv[1]
    print(analyze_comments(video_id))
