<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genie Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #ffffff;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 30px auto;
            background-color: #0b0124;
            border-radius: 10px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(18deg, #35031e, #000359);
            color: #ffffff;
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: center;
        }
        .email-body {
            padding: 25px;
            font-size: 16px;
            line-height: 1.6;
        }

        /* Styling for the Appointment Details Container */
        .appointment-details {
            color: white; /* White text color */
            padding: 8px 10%;
            border-radius: 8px;
            margin: 8px auto;
            font-family: Arial, sans-serif;
        }

        /* Centered Heading with Line on Each Side */
        .appointment-details h3 {
            text-align: center;
            position: relative;
            font-size: 1.5em;
            margin: 0;
            padding: 10px 0;
            color: acdeff;
        }

        .appointment-details h3::before{
            content: "";
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: linear-gradient(to right, transparent, white);
        }

        .appointment-details h3::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: linear-gradient(to right, white, transparent);
        }

        .appointment-details h3::before {
            left: -60px;
        }

        .appointment-details h3::after {
            right: -60px;
        }

        /* Invisible Table Styling for Details */
        .appointment-details p {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        .appointment-details p strong {
            color: #acdeff; /* Light grey color for "header" text */
            font-weight: bold;
            text-align: left;
        }

        .appointment-details p span {
            color: white; /* White text color for details */
            text-align: right;
        }


        .email-footer {
            text-align: center;
            padding: 16px;
            font-size: 14px;
            color: #299fffec;
            background: linear-gradient(18deg, #35031e, #000359);
            border-top: 1px solid #dddddd;
        }

        .hr{
            display: inline-flex;
            justify-content: space-between;
            width: 100%;
            padding-bottom: 20px;
        }
        
        .hr1{
            content: "";
            width: 50%;
            height: 1px;
            background: linear-gradient(to right, white, transparent);
        }
        
        .hr2 {
            content: "";
            width: 50%;
            height: 1px;
            background: linear-gradient(to right, transparent, white);
        }

    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <svg id="aiChatBackgroundLogo" class="loader" xmlns="http://www.w3.org/2000/svg" width="68" height="68" viewBox="0 0 214 214" fill="none">
                <g opacity="0.5" filter="url(#filter0_f_18051_3015)">
                <path d="M164.771 106.773C156.816 106.773 149.467 105.266 142.474 102.297C135.477 99.2296 129.304 95.0495 124.129 89.874C118.954 84.6986 114.774 78.5266 111.707 71.5299C108.736 64.5345 107.23 57.1843 107.23 49.2285C107.23 49.1022 107.128 49 107.002 49C106.876 49 106.773 49.1022 106.773 49.2285C106.773 57.1831 105.219 64.532 102.152 71.5299C99.1807 78.5266 95.0501 84.6986 89.8747 89.874C84.7005 95.0495 78.5278 99.2289 71.5318 102.296C64.5358 105.266 57.1843 106.773 49.2285 106.773C49.1022 106.773 49 106.876 49 107.002C49 107.128 49.1022 107.23 49.2285 107.23C57.1824 107.23 64.5339 108.785 71.5318 111.852C78.5291 114.825 84.7011 118.956 89.8747 124.129C95.0501 129.306 99.1813 135.477 102.153 142.476C105.219 149.47 106.773 156.816 106.773 164.771C106.773 164.897 106.876 164.999 107.002 164.999C107.128 164.999 107.23 164.897 107.23 164.771C107.23 156.814 108.736 149.468 111.706 142.476C114.774 135.477 118.953 129.305 124.129 124.129C129.303 118.954 135.474 114.824 142.474 111.852C149.469 108.786 156.818 107.23 164.771 107.23C164.898 107.23 165 107.128 165 107.002C165 106.876 164.898 106.773 164.771 106.773Z" fill="url(#paint0_linear_18051_3015)"></path>
                </g>
                <path d="M164.771 106.773C156.816 106.773 149.467 105.266 142.474 102.297C135.477 99.2296 129.304 95.0495 124.129 89.874C118.954 84.6986 114.774 78.5266 111.707 71.5299C108.736 64.5345 107.23 57.1843 107.23 49.2285C107.23 49.1022 107.128 49 107.002 49C106.876 49 106.773 49.1022 106.773 49.2285C106.773 57.1831 105.219 64.532 102.152 71.5299C99.1807 78.5266 95.0501 84.6986 89.8747 89.874C84.7005 95.0495 78.5278 99.2289 71.5318 102.296C64.5358 105.266 57.1843 106.773 49.2285 106.773C49.1022 106.773 49 106.876 49 107.002C49 107.128 49.1022 107.23 49.2285 107.23C57.1824 107.23 64.5339 108.785 71.5318 111.852C78.5291 114.825 84.7011 118.956 89.8747 124.129C95.0501 129.306 99.1813 135.477 102.153 142.476C105.219 149.47 106.773 156.816 106.773 164.771C106.773 164.897 106.876 164.999 107.002 164.999C107.128 164.999 107.23 164.897 107.23 164.771C107.23 156.814 108.736 149.468 111.706 142.476C114.774 135.477 118.953 129.305 124.129 124.129C129.303 118.954 135.474 114.824 142.474 111.852C149.469 108.786 156.818 107.23 164.771 107.23C164.898 107.23 165 107.128 165 107.002C165 106.876 164.898 106.773 164.771 106.773Z" fill="url(#paint1_linear_18051_3015)"></path>
                <defs>
                <filter id="filter0_f_18051_3015" x="0" y="0" width="214" height="213.999" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape"></feBlend>
                <feGaussianBlur stdDeviation="24.5" result="effect1_foregroundBlur_18051_3015"></feGaussianBlur>
                </filter>
                <linearGradient id="paint0_linear_18051_3015" x1="85.1019" y1="123.981" x2="137.576" y2="79.7391" gradientUnits="userSpaceOnUse">
                <stop stop-color="#217BFE"></stop>
                <stop offset="0.27" stop-color="#078EFB"></stop>
                <stop offset="0.776981" stop-color="#A190FF"></stop>
                <stop offset="1" stop-color="#BD99FE"></stop>
                </linearGradient>
                <linearGradient id="paint1_linear_18051_3015" x1="85.1019" y1="123.981" x2="137.576" y2="79.7391" gradientUnits="userSpaceOnUse">
                <stop stop-color="#217BFE"></stop>
                <stop offset="0.27" stop-color="#078EFB"></stop>
                <stop offset="0.776981" stop-color="#A190FF"></stop>
                <stop offset="1" stop-color="#BD99FE"></stop>
                </linearGradient>
                </defs>
            </svg>
            <h3>Genie Medical Reminder</h3>
        </div>
        <div class="email-body">
            <p>Hi "{{ucFirst($details['name']??'N/A')}}"</p>
            <p>We’d like to remind you of your upcoming appointment for "{{$details['issue']}}" Visit your doctor in time. Here’s everything you need to know:</p>
            
            <div class="appointment-details">
                <h3>Appointment Details</h3>
                <p><strong>Date:</strong> {{$details['date'] ?? "N/A"}}</p>
                <p><strong>Time:</strong> {{$details['time'] ?? "N/A"}}</p>
                <p><strong>Location:</strong> {{$details['address'] ?? "Dhaka, Bangladesh"}}</p>
                <p><strong>Contact:</strong> {{$details['contact'] ?? "01777777771"}}</p>
            </div>

            <div class="hr">
                <span class="hr1"></span>
                <span class="hr2"></span>
            </div>
            <p style="justify-content: center; display: flex;">Note: Please be early and take every necessary medical documents.</p>
            
        </div>
        <div class="email-footer">
            <p>Thank you for choosing "Genie" the AI healthcare ally!</p>
        </div>
    </div>
</body>

</html>
