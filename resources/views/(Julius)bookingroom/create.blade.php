@extends('bookingroom.layout.app')

@section('title')
    Booking Room
@endsection

@auth
    <script>
        window.authUserId = {{ auth()->user()->employee_id }};
        window.userRole = "{{ Auth::user()->role }}";
    </script>
@endauth
@section('costum-css')
    <style>
        .tagify {
            width: 100%;
            height: auto;
        }

        .tagify_input {
            width: 100% !important;
            min-width: 200px;
            /* Adjust as necessary */
            min-height: fit-content;
            padding:
        }
    </style>
@endsection
@section('content')
    <!--Badan Isi-->
    <div style="margin-left: 24px">
        <div class="row justify-content-center" style="margin-top: -12px">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success ms-2" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger  ms-2" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="col-md-8">

                <div class="tablenih" style="padding-top: -24px; margin-top: 32px;">

                    <p style="font: 700 24px Narasi Sans, sans-serif; color: #4A25AA; margin: 12px;">{{ $room->room_name }}
                        Calendar</p>

                    <div id="calendar" class="p-3"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tablenih p-3" style="padding-top: -24px; margin-top: 32px;">
                    <p style="font: 700 24px Narasi Sans, sans-serif; color: #4A25AA; margin: 12px;">Form Booking Room</p>
                    <form method="POST" action="{{ route('bookingroom.store') }}" style="margin:12px">
                        @csrf

                        <input type="hidden" class="form-control" name="room_id" value="{{ $room->room_id }}">
                        <div class="row">
                            <div class="col mb-3">
                                <label class="d-flex" for="inputroom_name">Room Name </label>
                                <input type="text" class="form-control" id="inputroom_name" name="room_name"
                                    value="{{ old('room_name') ?? $room->room_name }} " disabled>
                            </div>

                            <div class="col mb-3">
                                <label class="d-flex" for="inputcapacity">Max Capacity</label>
                                <input type="text" class="form-control" id="inputcapacity" name="capacity"
                                    value="{{ old('capacity') ?? $room->capacity }}" disabled>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="d-flex" for="inputdesc">Description </label>
                            <input type="text" class="form-control @error('desc') is-invalid @enderror" id="inputdesc"
                                name="description" value="{{ old('desc') }} ">
                            @error('desc')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="d-flex" for="inputstart">Start Time</label>
                                <input type="text"
                                    class="form-control datetimepicker @error('start') is-invalid @enderror" id="inputstart"
                                    name="start_time" value="{{ old('start') }}">
                                @error('start')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col mb-3">
                                <label class="d-flex" for="inputend">End Time</label>
                                <input type="text" class="form-control datetimepicker @error('end') is-invalid @enderror"
                                    id="inputend" name="end_time" value="{{ old('end') }}">
                                @error('end')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        {{-- <input disabled type="hidden" class="form-control @error('phone') is-invalid @enderror"
                            id="phone" name="phone" value="{{ auth()->user()->phone }} ">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror --}}

                        <div class="mb-3">
                            <label for="guests" class="d-flex">Employee</label>
                            <select class="form-control @error('guests') is-invalid @enderror" id="select2"
                                name="internalGuest[]" multiple="multiple">
                                @foreach ($users as $user)
                                    @if ($user->employee_id !== auth()->id())
                                        <option value="{{ $user->employee_id }}">{{ $user->full_name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error('guests')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- <div class="mb-3">
                            <label for="additional_emails" class="d-flex">External Guests</label>
                            <input type="text" class="form-control @error('additional_emails') is-invalid @enderror" id="additional_emails" name="additional_emails[]" placeholder="Enter email addresses of external guests" multiple="multiple">
                            @error('additional_emails')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> --}}

                        <div class="mb-3">
                            <label for="additional_emails" class="d-flex">External Guests</label>
                            <select class="form-control @error('additional_emails') is-invalid @enderror"
                                id="additional_emails" name="additional_emails[]" multiple="multiple">
                                <!-- Options will be added dynamically by Select2 -->
                            </select>
                            @error('additional_emails')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="uwuq w-100 mt-3">Book</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modal')
    <div class="modal justify-content-center fade" id="eventModal" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body  bg-white">
                    <div class="mb-2"><strong> Description : </strong> <span id="eventModalDesc"></span></div>
                    <div class="row mb-2">
                        <div class="col">
                            <strong>Start:</strong> <span class="fw-lighter" id="eventModalStart"></span>
                        </div>
                        <div class="col">
                            <strong>End:</strong> <span class="fw-lighter" id="eventModalEnd"></span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col"><strong>Booked By : </strong> <span class="fw-lighter"
                                id="eventModalUser"></span></div>
                        <div class="col"><strong>CP Booking (WA) : </strong> <a style="text-decoration: none"
                                id="eventModalTelephone" href="#" target="_blank"></a></div>
                    </div>

                    <div class="mb-2"><strong class="mb-2">Employee : </strong>
                        <ul class="fw-lighter mb-2" id="eventModalGuests"></ul>
                    </div>

                    <div class="mb-2"><strong class="mb-2">External Guests : </strong>
                        <ul class="fw-lighter mb-2" id="eventModalExternalGuests"></ul>
                    </div>

                    <input type="hidden" id="eventModalBookingId" value="">
                    <div class="text-end">
                        <button type="button" class="btn btn-primary" style="background-color: #4a25aa; border: 0px"
                            id="editBookingBtn">Edit</button>
                        <button type="button" class="btn btn-danger" id="deleteBookingBtn">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
                <img class="img-8" src="{{ asset('asset/image/Narasi_Logo.svg') }}" alt=" " />
            </div>
        </div>
    @endsection

    @section('custom-js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                console.log('DOM fully loaded and parsed'); // Add logging
                var calendarEl = document.getElementById('calendar');
                console.log('Calendar element:', calendarEl); // Add logging
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    },
                    navLinks: true,
                    editable: true,
                    displayEventTime: true,
                    displayEventEnd: true,
                    dayMaxEvents: true,
                    eventTimeFormat: { // Menentukan format waktu
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: false
                    },
                    drop: function(arg) {
                        // is the "remove after drop" checkbox checked?
                        if (document.getElementById('drop-remove').checked) {
                            // if so, remove the element from the "Draggable Events" list
                            arg.draggedEl.parentNode.removeChild(arg.draggedEl);
                        }
                    },
                    events: function(fetchInfo, successCallback, failureCallback) {
                        var room_id = '{{ $room->room_id }}'; // Get the room ID from the Blade variable
                        console.log('Fetching events for room_id:', room_id, 'from', fetchInfo.startStr,
                            'to', fetchInfo.endStr);
                        $.ajax({
                            url: '/getevents',
                            type: 'GET',
                            data: {
                                room_id: room_id,
                                start: fetchInfo.startStr,
                                end: fetchInfo.endStr,
                            },
                            success: function(response) {
                                console.log('Events fetched:', response);
                                // Log each event to ensure they are correctly structured
                                response.events.forEach(event => console.log('Event:', event));
                                successCallback(response.events);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error('AJAX request failed:', textStatus, errorThrown);
                                console.error('Response text:', jqXHR.responseText);
                                failureCallback();
                            },
                        });
                    },
                    eventClick: function(info) {
                        var startDate = moment(info.event.start).format('DD-MM-YYYY HH:mm');
                        var endDate = moment(info.event.end).format('DD-MM-YYYY HH:mm');

                        // Open modal and populate with event details
                        $('#eventModalDesc').text(info.event.title);
                        $('#eventModalUser').text(info.event.extendedProps.user.full_name);
                        $('#eventModalStart').text(startDate);
                        $('#eventModalEnd').text(endDate);

                        var telephone = info.event.extendedProps.user.phone;
                        var whatsappLink = 'https://wa.me/+62' + telephone.replace(/[^0-9]/g,
                            ''); // Clean non-numeric characters

                        $('#eventModalTelephone').text(telephone).attr('href', whatsappLink);
                        $('#eventModalBookingId').val(info.event.id);

                        // Show guests
                        var guestsList = $('#eventModalGuests');
                        guestsList.empty();
                        info.event.extendedProps.guests.forEach(function(guest) {
                            guestsList.append('<li>' + guest + '</li>');
                        });


                        // // Show external guests
                        // var externalGuestsList = $('#eventModalExternalGuests');
                        // externalGuestsList.empty();
                        // info.event.extendedProps.externalGuests.forEach(function(externalGuest) {
                        //     externalGuestsList.append('<li>' + externalGuest + '</li>');
                        // });

                        var externalGuestsList = $('#eventModalExternalGuests');
                        externalGuestsList.empty();
                        if (info.event.extendedProps.externalGuests && info.event.extendedProps
                            .externalGuests.length > 0) {
                            info.event.extendedProps.externalGuests.forEach(function(externalGuest) {
                                externalGuestsList.append('<li>' + externalGuest + '</li>');
                            });
                        } else {
                            externalGuestsList.append('<li>No external guests</li>');
                        }

                        // Show or hide delete button based on ownership
                        if (window.authUserId == info.event.extendedProps.user_id || window.userRole ===
                            'admin') {
                            $('#deleteBookingBtn').show();
                            $('#editBookingBtn').show();

                        } else {
                            $('#deleteBookingBtn').hide();
                            $('#editBookingBtn').hide();
                        }

                        $('#eventModal').modal('show');
                    }

                });
                console.log('Rendering calendar'); // Add logging
                calendar.render();

                // Handle delete booking
                $('#deleteBookingBtn').on('click', function() {
                    var bookingId = $('#eventModalBookingId').val();

                    $.ajax({
                        url: '/bookingroom/' + bookingId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}' // Add CSRF token
                        },
                        error: function(response) {
                            location.reload();
                        },
                        success: function(response) {
                            location.reload();
                            alert('Booking successfully deleted.');
                        },

                    });
                });

                $('#editBookingBtn').on('click', function() {
                    var bookingId = $('#eventModalBookingId').val();
                    window.location.href = '/bookingroom/' + bookingId + '/edit';
                });

            });

            // function choose start and end date
            $(function() {
                $('.datetimepicker').datetimepicker();
            });
        </script>

        {{-- function select user --}}
        <script>
            $(document).ready(function() {
                $("#select2").select2({
                    placeholder: "Select Guests"
                });
            });
        </script>

        {{-- input external email --}}
        <script>
            $(document).ready(function() {
                $('#additional_emails').select2({
                    tags: true,
                    tokenSeparators: [',', ' '],
                    placeholder: "Enter email addresses of external guests",
                    multiple: true,
                    createTag: function(params) {
                        // Ensure the tag is a valid email format
                        var term = $.trim(params.term);
                        if (term.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)) {
                            return {
                                id: term,
                                text: term
                            };
                        }
                        return null;
                    }
                });
            });
        </script>
    @endsection
