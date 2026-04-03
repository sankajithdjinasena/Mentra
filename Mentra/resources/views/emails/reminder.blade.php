<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reminder Notification</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4fdf7;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.1);
            border-left: 5px solid #10b981;
        }

        h2 {
            color: #047857;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
        }

        .reminder-detail {
            background-color: #ecfdf5;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #6b7280;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Hello {{ $reminder->user->name }},</h2>

        <p>This is a friendly reminder for your upcoming scheduled task:</p>

        <div class="reminder-detail">
            <p><strong>📝 Reminder:</strong> {{ $reminder->reminder }}</p>
            <p><strong>📅 Date:</strong> {{ \Carbon\Carbon::parse($reminder->date)->format('F j, Y') }}</p>
            <p><strong>⏰ Time:</strong> {{ \Carbon\Carbon::parse($reminder->time)->format('h:i A') }}</p>
        </div>

        <p>Wishing you a focused and productive day! 🌿</p>

        <div class="footer">
            — The Mentra Team
            <br>Stay focused. Stay Zen.
        </div>
    </div>
</body>
</html>
