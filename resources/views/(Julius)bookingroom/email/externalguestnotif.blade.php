<html>
<head>
    <title>Meeting Invitation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
            text-align: left;
        }
        .logo {
            text-align:left;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 150px;
        }
        h3 {
            color: #333;
            text-align: center;
        }
        p, ul {
            color: #555;
        }
        ul {
            padding-left: 20px;
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 8px 0;
            vertical-align: top;
            font-size: 14px;
        }
        .label {
            width: 30%;
            font-weight: bold;
        }
        .value {
            width: 70%;
        }
    </style>
</head>
<body>
    <div  style="background-color: #eeeeee; padding-top: 64px; padding-bottom: 64px;">
        <div class="logo container" style="text-align: center">
            <img src="https://imgur.com/GYooEjc.png" alt="Company Logo"  style="display: inline-block;">
        </div>
        <div class="email-container">
        <h3>Dear {{ $email }},</h3>
        <h3>You have been invited to a Meeting.</h3>
        <table>

            <tr>
                <td class="label">Description</td>
                <td class="value">:  {{ $booking->description }}</td>
            </tr>
            <tr>
                <td class="label">Location</td>
                <td class="value">: INTILAND TOWER LT. 20, Jl. Jend. Sudirman Kav. 32, Jakarta Pusat, 10220</td>
            </tr>
            <tr>
                <td class="label">Room</td>
                <td class="value">: {{ $booking->room->room_name }}</td>
            </tr>
            <tr>
                <td class="label">Start Time</td>
                <td class="value">: {{ $booking->start_time }}</td>
            </tr>
            <tr>
                <td class="label">End Time</td>
                <td class="value">: {{ $booking->end_time }}</td>
            </tr>
        </table>
        <hr>
        <h3>Thank You!</h3>
    </div>
    </div>


</body>
</html>
