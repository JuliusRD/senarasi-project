@extends('bookingroom.layout.app')

@section('title')
   Booking Room
@endsection

@section('content')
    <!--Badan Isi-->
    <div style="margin-left: 24px; ">
        <div class="judulhalaman" style="display: flex; align-items: center; ">Booking List</div>
            {{-- <div style="display: inline-flex; gap: 12px; margin-left:4px;">
                <button type="button" class="button-departemen" data-bs-toggle="modal" data-bs-target="#modal-sop"> Upload
                     <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                        fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8.99995 2.7002C9.23865 2.7002 9.46756 2.79502 9.63635 2.9638C9.80513 3.13258 9.89995 3.3615 9.89995 3.6002V8.10019H14.4C14.6386 8.10019 14.8676 8.19502 15.0363 8.3638C15.2051 8.53258 15.3 8.7615 15.3 9.0002C15.3 9.23889 15.2051 9.46781 15.0363 9.63659C14.8676 9.80537 14.6386 9.9002 14.4 9.9002H9.89995V14.4002C9.89995 14.6389 9.80513 14.8678 9.63635 15.0366C9.46756 15.2054 9.23865 15.3002 8.99995 15.3002C8.76126 15.3002 8.53234 15.2054 8.36355 15.0366C8.19477 14.8678 8.09995 14.6389 8.09995 14.4002V9.9002H3.59995C3.36126 9.9002 3.13234 9.80537 2.96356 9.63659C2.79477 9.46781 2.69995 9.23889 2.69995 9.0002C2.69995 8.7615 2.79477 8.53258 2.96356 8.3638C3.13234 8.19502 3.36126 8.10019 3.59995 8.10019H8.09995V3.6002C8.09995 3.3615 8.19477 3.13258 8.36355 2.9638C8.53234 2.79502 8.76126 2.7002 8.99995 2.7002Z"
                            fill="white" />
                    </svg>
                </button>
            </div> --}}

            <div class="tablenih" style="padding-top: -24px;">
                {{-- <div class="judulhalaman " style="text-align: start;">Booking Room</div> --}}
                <div class="table-responsive p-3">
                    <table id="datatable" class="table table-hover"
                    style="font: 300 16px Narasi Sans, sans-serif; margin-top: 12px; display: 100%; width: 100% ;  color: #4A25AA; ">
                    <thead style="font-weight: 500; text-align: center">
                        <tr class="text-center">
                            <th scope="col">No.</th>
                            <th scope="col">Room  Name</th>
                            <th scope="col">Booked by</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Title</th>
                            <th scope="col">Start Time</th>
                            <th scope="col">End Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody style="vertical-align: middle;" class="text-center">
                        {{-- @foreach ($bookings as $booking) --}}
                            <tr>
                                <th scope="row" class="text-center">1</th>
                                <td>Room 1</td>
                                <td>User 1</td>
                                <td>08123456787</td>
                                <td>Meeting</td>
                                <td>2024-06-12 10:30</td>
                                <td>2024-06-12 12:30</td>
                                <td>

                                    {{-- @can('owner', $booking)
                                        <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE') --}}
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        {{-- </form> --}}
                                    {{-- @endcan --}}


                                </td>

                            </tr>
                        {{-- @endforeach --}}
                    </tbody>
                    </table>
                </div>

            </div>

    </div>

@endsection

