import sys
from googleapiclient.discovery import build
import re
import emoji
from vaderSentiment.vaderSentiment import SentimentIntensityAnalyzer

API_KEY = ''

def analyze_comments(video_id):
    youtube = build('youtube', 'v3', developerKey=API_KEY)

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
        return "No comments available for analysis."

    positive_ratio = positive_count / total_comments
    negative_ratio = negative_count / total_comments

    rating = 1 + (positive_ratio - negative_ratio) * 4  
    rating = max(1, min(5, round(rating))) 
    # print(rating)
 
    return f"Video Sentiment Rating: {rating}/5\n" \
           f"Positive: {positive_count}, Negative: {negative_count}, Neutral: {neutral_count}"
 
if __name__ == '__main__':
    video_id = sys.argv[1]
    print(analyze_comments(video_id))


# if __name__ == '__main__':
#     # if len(sys.argv) < 2:
#     #     print("Usage: python youtube_analysis.py VIDEO_ID")
#     #     sys.exit(1)

#     video_id = "dQw4w9WgXcQ"
#     print(analyze_comments(video_id))
