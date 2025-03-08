<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>New Reservation</title>
  <style>
    body {
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #ffffff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      overflow: hidden;
    }

    .header {
      background-color: #28a745;
      color: #ffffff;
      text-align: center;
      padding: 20px;
      font-size: 24px;
      font-weight: bold;
    }

    .content {
      padding: 20px;
      color: #333;
    }

    .content h2 {
      color: #28a745;
      font-size: 22px;
      margin-bottom: 10px;
    }

    .details {
      background-color: #f9f9f9;
      padding: 15px;
      border-radius: 5px;
      margin-top: 15px;
    }

    .details ul {
      list-style-type: none;
      padding: 0;
    }

    .details li {
      padding: 8px 0;
      border-bottom: 1px solid #ddd;
    }

    .details li:last-child {
      border-bottom: none;
    }

    .footer {
      background-color: #28a745;
      color: #ffffff;
      text-align: center;
      padding: 15px;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">New Reservation</div>
    
    <div class="content">
      <h2>Dear {{ $reservation->participant->first_name }},</h2>
      <p>
        A new reservation has been created by a TutorSpace tutor: 
        (<strong>{{ $reservation->tutor->first_name }} {{ $reservation->tutor->last_name }}</strong>).
      </p>
      
      <div class="details">
        <h3>Reservation Details:</h3>
        <ul>
          <li><strong>Course:</strong> {{ $reservation->course->title }}</li>
          <li><strong>Client:</strong> {{ $reservation->participant->first_name }} {{ $reservation->participant->last_name }}</li>
          <li><strong>Start Time:</strong> {{ $reservation->start_time }}</li>
          <li><strong>End Time:</strong> {{ $reservation->end_time }}</li>
          <li><strong>Session Type:</strong> {{ ucfirst($reservation->session_type) }}</li>
          <li><strong>Price:</strong> €{{ number_format($reservation->price, 2, ',', '.') }}</li>
        </ul>
      </div>

      <p><strong>Action Required:</strong> Do not forget to accept it. You can do this by changing the status from <em>"pending"</em> to <em>"scheduled"</em>.</p>
      <p>In case there are any circumstances requiring cancellation, please alert the tutor and adjust the status of the reservation(s).</p>
      <p>You can review the reservation on TutorSpace.</p>
    </div>

    <div class="footer">
      Best regards,<br />Tutorspace
    </div>
  </div>
</body>
</html>
