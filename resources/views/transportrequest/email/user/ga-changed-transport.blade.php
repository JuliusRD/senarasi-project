<!DOCTYPE html>
<html>
<head>
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
            margin-top:-24px;
            margin-bottom: 20px;

        }
        .logo img {
            max-width: 220px;
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
            font-size: 16px;
        }
        .label {
            width: 30%;
            font-weight: bold;
        }
        .value {
            width: 70%;
        }
        .alert {
        position: relative;
        padding: 5px 5px;
        margin-bottom: 1px;
        border: 1px solid transparent;
        border-radius: 0.20rem;
        font-size: 12px !important;

        }

        .alert-primary {
        color: #084298;
        background-color: #cfe2ff;
        border-color: #084298;
        }

        .alert-secondary {
        color: #41464b;
        background-color: #e2e3e5;
        border-color: #41464b;
        }

        .alert-success {
        color: #0f5132;
        background-color: #d1e7dd;
        border-color: #0f5132;
        }

        .alert-danger {
        color: #842029;
        background-color: #f8d7da;
        border-color: #842029;
        }

        .alert-warning {
        color: #664d03;
        background-color: #fff3cd;
        border-color: #664d03;
        }

        .alert-info {
        color: #055160;
        background-color: #cff4fc;
        border-color: #055160;
        }

        .alert-light {
        color: #636464;
        background-color: #fefefe;
        border-color: #636464;
        }

        .alert-dark {
        color: #141619;
        background-color: #d3d3d4;
        border-color: #141619;
        }

        .button-report {
            right: 0;
            color: #ffff !important;
            border-radius: 6px;
            background-color: #4a25aa;
            border: none;
            text-align: center;
            text-decoration: none;
            font: 400 16px Narasi Sans, sans-serif;
            align-self: center;
            padding: 10px 14px;
            margin-top: 12px;
            display: block;
        }
    </style>
</head>
<body>
    <div style="background-color: #f9f9f9; padding-top: 64px; padding-bottom: 64px;">
        <div class="logo container" style="text-align: center">
            <img src="https://imgur.com/GYooEjc.png" alt="Company Logo"  style="display: inline-block;">
        </div>
        <div class="email-container">

            <h3>Dear {{ $transportrequest->user->name }}, General Affair has changed your transportation details.</h3>
            <table>
                <tr>
                    <td class="label">Status</td>
                    <td>: <span class="alert alert-success">{{ $transportrequest->status }}</span></td>
                </tr>
                <tr>
                    <td class="label">Requested Date</td>

                    <td>: {{ \Carbon\Carbon::parse($transportrequest->date)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td class="label">Requested Time</td>
                    <td>: {{ \Carbon\Carbon::parse($transportrequest->start_time)->format('H:i') }} WIB - {{ \Carbon\Carbon::parse($transportrequest->end_time)->format('H:i')  }} WIB</td>
                </tr>

                    <td class="label">program</td>
                    <td>: {{ $transportrequest->program }}</td>
                </tr>
                <tr>
                    <td class="label">Activity</td>
                    <td>: {{ $transportrequest->activity }}</td>
                </tr>
                <tr>
                    <td class="label">Passanger</td>
                    <td>: {{ $transportrequest->person }}</td>
                </tr>
                <tr>
                    <td class="label">Start Location</td>
                    <td>: {{ $transportrequest->startLocation->start_loc }}</td>
                </tr>
                <tr>
                    <td class="label">Destination</td>
                    <td>: {{ $transportrequest->destination->final_loc }}</td>
                </tr>
                <tr>
                    <td class="label">Service Type</td>
                    <td>: {{ $transportrequest->service_type }}</td>
                </tr>

                <tr>
                    <td class="label">Notes</td>
                    <td>: {{ strip_tags($transportrequest->note) }}</td>
                </tr>
                @if ($transportrequest->transitLocations->isEmpty())
                <tr>
                    <td class="label">Transportation</td>
                    <td>: {{ $transportrequest->transport }}</td>
                </tr>
                @if ($transportrequest->transport == 'Grab' )
                <tr>
                    <td class="label">Voucher</td>
                    <td>: <span class="alert alert-primary">{{ $transportrequest->voucher}}</span></td>
                </tr>
                @endif
                @if ($transportrequest->transport == 'MRT' )
                <tr>
                    <td class="label">Card</td>
                    <td>:
                        <ul>
                            @foreach($transportrequest->transportCards as $card)
                            <li>
                                {{ $card->card_type}}
                            </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                @endif
                @else
                <tr>
                    <td class="label">Transportation details</td>
                    <td>:
                        <ol>
                            @php
                                $previousDestination = null; // Initialize a variable to store the previous destination
                            @endphp
                            @foreach ($transportrequest->transitLocations  as $index => $transit)
                            <li>
                                <div style="display: flex;">
                                    <p style="flex: 1;">Route</p>
                                    <p style="flex: 3;">:
                                        @if ($index == 0)
                                        {{ $transportrequest->startLocation->start_loc }} <!-- If it's the first transit, use the start location -->
                                        @else
                                            {{ $previousDestination }} <!-- For other transits, use the previous destination -->
                                        @endif
                                        -
                                        {{ $transit->destination }}
                                    </p>
                                </div>
                                <!-- Destination -->
                                {{-- <div style="display: flex;">
                                    <p style="flex: 1;">R</p>
                                    <p style="flex: 3;">: {{ $transit->destination }}</p>
                                </div> --}}
                                <!-- Transportation -->
                                <div style="display: flex;">
                                    <p style="flex: 1;">Transportation</p>
                                    <p style="flex: 3;">: {{ $transit->transport }}</p>
                                </div>

                                @if ($transit->transport == 'Grab')
                                <div style="display: flex;">
                                    <p style="flex: 1;">Voucher</p>
                                    <p style="flex: 3;">: {{ $transit->voucher ?? '-' }}</p>
                                </div>
                                @endif

                                @if ($transit->transport == 'MRT' || $transit->transport == 'KRL' || $transit->transport == 'LRT')
                                <div style="display: flex;">
                                    <p style="flex: 1;">Card</p>
                                    <p style="flex: 3;">:
                                        <ul>
                                            @foreach($transit->transportCards as $card)
                                            <li>
                                                {{ $card->card_type}}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </p>
                                </div>
                                @endif
                            </li>
                            @php
                            $previousDestination = $transit->destination; // Update the previous destination at the end of each iteration
                            @endphp
                            @endforeach

                        </ol>
                    </td>
                </tr>
                @endif
            </table>
            <h3 style="color: #dc3545; text-transform:uppercase">Please upload the report immediately after completing the trip</h3>
            <h3><a  href="{{ route('transport-request.formReport', $transportrequest->id) }}" class="button-report" >Upload Report</a></h3>
            <div>
            </div>
        </div>
    </div>

</body>
</html>
