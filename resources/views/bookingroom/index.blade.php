@extends('bookingroom.layout.app')

@section('title')
   Booking Room
@endsection

@auth
    <script>
        window.authUserId = {{ auth()->user()->id }};
        window.userRole = "{{ Auth::user()->role }}";
    </script>
@endauth

@section('content')
    <!--Badan Isi-->
    <div style="margin-left: 24px; ">
        <div class="judulhalaman" style="display: flex; align-items: center; margin-top: -12px;">Booking Room Narasi</div>
        <div class="container-fluid">
            <div class="row" style="gap: 32px">
                <div class="tablenih" style="width: 770px; height: 380px">
                    <div style="display: flex; gap: 8px">
                        <div>
                            <p style="font-size: 28px;font-weight: 500; margin-bottom: 4px; margin-left: 8px">IMPORTANT INFORMATION</p>
                            <ol type="1">
                                <li>Room reservations can only be booked <b>two days</b> before the activity.</li>
                                <li>Room reservations can be made <b>one week </b> before the activity starts.</li>
                                <li>Milk</li>
                              </ol>
                        </div>
                    </div>
                </div>
                    <div class="tablenih" style="padding-top: -24px; max-width: 1000px; max-height: fit-content">
                        <div class="table-responsive p-3" >
                            <table id="datatable" class="table table-hover"
                            style="font: 300 16px Narasi Sans, sans-serif; margin-top: 12px; display: 100%; width: 100% ;  color: #4A25AA; ">
                            <thead style="font-weight: 500; text-align: center">
                                <tr class="text-center">
                                    <th scope="col" style="width: 120px">No.</th>
                                    <th scope="col">Room  Name</th>
                                    <th scope="col">Max Capacity</th>
                                    <th scope="col" style="width: 120px">Action</th>

                                </tr>
                            </thead>
                            <tbody style="vertical-align: middle;" class="text-center">
                                @foreach ($rooms as $room)
                                <tr>
                                    <th scope="row" class="text-center">{{$loop->iteration}}</th>
                                    <td>{{ $room->room_name }}</td>
                                    <td>{{ $room->capacity }}</td>
                                    <td>
                                        <a href="{{ route('bookingroom.create', $room->id )}}" class="text-decoration-none text-end">
                                           <button type="button" class="uwuq" style="width: fit-content;">Book</button>
                                       </a>
                                   </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
            </div>

        </div>


            <div class="tablenih" style="padding-top: -24px; margin-top: 32px;" >
                <p style="font: 700 24px Narasi Sans, sans-serif; color: #4A25AA; margin: 12px;">Room Calendar</p>
                <form id="roomFilterForm">
                    <div class="row form-group mb-3 text-center d-flex justify-content-center">
                        <div class="col-6">
                            <select class="form-select" name="room" id="roomSelect">
                                <option selected>Select Room</option>
                                @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->room_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="uwuq" style="width: fit-content;">{{ __('Filter') }}</button>
                        </div>
                    </div>
                </form>

                <div id="calendar" class="p-3"></div>
            </div>


    </div>

@endsection

@section('modal')
    <div class="modal justify-content-center fade" id="eventModal"  data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ">
            <div class="modal-content">
            <div class="modal-body  bg-white">
                <div class="mb-2"><strong> Description : </strong> <span  id="eventModalDesc"></span></div>
                <div class="row mb-2">
                    <div class="col">
                        <strong>Start:</strong> <span class="fw-lighter" id="eventModalStart"></span>
                    </div>
                    <div class="col">
                        <strong>End:</strong> <span class="fw-lighter" id="eventModalEnd"></span>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col"><strong>Booked By : </strong> <span class="fw-lighter" id="eventModalUser" ></span></div>
                    <div class="col"><strong>CP Booking (WA) : </strong> <a style="text-decoration: none" id="eventModalTelephone" href="#" target="_blank"></a></div>
                </div>

                <div class="mb-2"><strong class="mb-2">Employee : </strong>  <ul class="fw-lighter" class="mb-2" id="eventModalGuests"></ul></div>

                <input type="hidden" id="eventModalBookingId" value="">
                <div class="text-end">
                    <button type="button" class="btn btn-primary" style="background-color: #4a25aa; border: 0px" id="editBookingBtn">Edit</button>
                    <button type="button" class="btn btn-danger" id="deleteBookingBtn">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
            <img class="img-8" src="{{ asset('asset/image/Narasi_Logo.svg')  }}" alt=" " />
        </div>
    </div>
@endsection

@section('custom-js')
<script>

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var roomFilterForm = document.getElementById('roomFilterForm');
        var roomSelect = document.getElementById('roomSelect');

        // Initialize FullCalendar
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
            dayMaxEvents: true, // allow "more" link when too many events
            events: function(fetchInfo, successCallback, failureCallback) {
                var room_id = roomSelect.value;

                if (room_id === "Select Room") {
                    successCallback([]); // No events if no room selected
                    return;
                }

                $.ajax({
                    url: '/getevents',
                    type: 'GET',
                    data: {
                        room_id: room_id,
                        start: fetchInfo.startStr,
                        end: fetchInfo.endStr
                    },
                    success: function(response) {
                        successCallback(response.events);
                    },
                    error: function() {
                        failureCallback();
                    }
                });
            },
            eventClick: function(info) {
                var startDate = moment(info.event.start).format('DD-MM-YYYY HH:mm');
                var endDate = moment(info.event.end).format('DD-MM-YYYY HH:mm');

                // Open modal and populate with event details
                $('#eventModalDesc').text(info.event.title);
                $('#eventModalUser').text(info.event.extendedProps.user.name);
                $('#eventModalStart').text(startDate);
                $('#eventModalEnd').text(endDate);

                var telephone = info.event.extendedProps.telephone;
                var whatsappLink = 'https://wa.me/+62' + telephone.replace(/[^0-9]/g, ''); // Clean non-numeric characters

                $('#eventModalTelephone').text(telephone).attr('href', whatsappLink);
                $('#eventModalBookingId').val(info.event.id);


                // Show guests
                var guestsList = $('#eventModalGuests');
                guestsList.empty();
                info.event.extendedProps.guests.forEach(function(guest) {
                    guestsList.append('<li>' + guest + '</li>');
                });

                // Show or hide delete button based on ownership
                if (window.authUserId == info.event.extendedProps.user_id || window.userRole === 'admin') {
                    $('#deleteBookingBtn').show();
                    $('#editBookingBtn').show();

                } else {
                    $('#deleteBookingBtn').hide();
                    $('#editBookingBtn').hide();
                }

                $('#eventModal').modal('show');
            }
        });
        calendar.render();


        $('#editBookingBtn').on('click', function() {
            var bookingId = $('#eventModalBookingId').val();
            window.location.href = '/bookingroom/' + bookingId + '/edit';
        });

        // Handle delete booking
        $('#deleteBookingBtn').on('click', function() {
            var bookingId = $('#eventModalBookingId').val();

            $.ajax({
                url: '/bookingroom/' + bookingId,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}' // Add CSRF token
                },
                success: function(response) {
                    // Hide modal after booking is successfully deleted
                    location.reload();
                    alert('Booking successfully deleted.');
                },
                error: function(response) {
                    // Show error message
                    location.reload();
                }
            });
        });

        // Handle form submission
        roomFilterForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting the traditional way
            calendar.refetchEvents(); // Fetch events based on the selected room
        });
    });
</script>
@endsection
