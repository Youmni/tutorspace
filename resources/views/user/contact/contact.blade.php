<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TutorSpace - Contact</title>
    <style>
        body {
            background-color: #f9fafb; 
            color: #111827; 
            font-family: 'Inter', sans-serif; 
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 10px rgba(66, 66, 66, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 24px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 800;
            color:rgb(40, 77, 136); 
            margin: 0;
        }
        .content p {
            margin-bottom: 12px;
            font-size: 16px;
            line-height: 1.6;
        }

        .content p strong {
            font-weight: 700;
            color: #111827;
        }

        .content p span {
            color: #4b5563;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Contact Message</h1>
        </div>
        <div class="content">
            <p><strong>Email:</strong> <span>{{ $email }}</span></p>
        </div>
        <div class="content">
            <p><strong>Subject:</strong> <span>{{ $subject }}</span></p>
        </div>
        <div class="content">
            <p><strong>Message:</strong></p>
            <p>{{ $messageContent }}</p>
        </div>
    </div>
</body>
</html>
