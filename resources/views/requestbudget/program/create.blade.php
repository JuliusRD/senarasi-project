@extends('layout.index')

@section('title')
    Create Request Budget - Budgeting System
@endsection

@section('content')
    <style>
        .select2-container--default .select2-selection--single {
            height: 40px;
            /* Adjust the height as needed */
            font-size: 16px;
            /* Adjust the font size as needed */
        }

        .select2-container {
            width: 100% !important;
            /* Make the select box full width */
        }
    </style>
    <a href="{{ url()->previous() }}" style="text-decoration: none;"> <button class="navback">
            <svg xmlns="http://www.w3.org/2000/svg " width="10 " height="17 " viewBox="0 0 10 17 " fill="none ">
                <path d="M0 8.0501C0 8.4501 0.2 8.8501 0.4 9.0501L7 15.6501C7.6 16.2501 8.6 16.2501 9.2 15.6501C9.8 15.0501 9.8 14.0501 9.2 13.4501L3.8 8.0501L9.2 2.6501C9.8 2.0501 9.8 1.0501 9.2 0.450097C8.6 -0.149902 7.6 -0.149902 7 0.450097L0.6 6.8501C0.2
                                                                                          7.2501 0 7.6501 0 8.0501Z "
                    fill="#4A25AA " />
            </svg>
            Back
        </button>
    </a>
    <!--blablabla -->
    <div class="judulhalaman" style="text-align: start">Request Budget</div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active tablinks" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true" disabled>General</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tablinks" id="data1-tab" data-bs-toggle="tab" data-bs-target="#data1-tab-pane"
                type="button" role="tab" aria-controls="data1-tab-pane" aria-selected="false"
                disabled>Performer</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tablinks" id="data2-tab" data-bs-toggle="tab" data-bs-target="#data2-tab-pane"
                type="button" role="tab" aria-controls="data2-tab-pane" aria-selected="false" disabled>Production
                Crews</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tablinks" id="data3-tab" data-bs-toggle="tab" data-bs-target="#data3-tab-pane"
                type="button" role="tab" aria-controls="data3-tab-pane" aria-selected="false" disabled>Production
                Tools</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tablinks" id="data4-tab" data-bs-toggle="tab" data-bs-target="#data4-tab-pane"
                type="button" role="tab" aria-controls="data4-tab-pane" aria-selected="false"
                disabled>Operational</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tablinks" id="data5-tab" data-bs-toggle="tab" data-bs-target="#data5-tab-pane"
                type="button" role="tab" aria-controls="data1-tab-pane" aria-selected="false"
                disabled>Location</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tablinks" id="preview-tab" data-bs-toggle="tab" data-bs-target="#preview-tab-pane"
                type="button" role="tab" aria-controls="preview-tab-pane" aria-selected="false"
                disabled>Preview & Submit</button>
        </li>
        <li class="nav-item" role="presentation">
        </li>
    </ul>


    <div class="tab-content" id="myTabContent" style="margin-top: 24px">
        <!-- home -->
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <form action="{{ route('request-budget.store') }}" method="POST" class="formrequest">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div style="display: grid; gap: 24px; grid-template-columns: 1fr 1fr">
                    <div class="mb-3">
                        <label for="Select " class="form-label">Select Program</label>
                        <select name="program_id" id="program_option">
                            <option disabled selected>Choose One</option>
                            @forelse ($programs as $program_id => $program_name)
                                <option value="{{ $program_id }}">{{ $program_name }}</option>
                            @empty
                                <option disabled selected>Data not found</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Select" class="form-label">Select Month</label>
                        <select name="month" id="month" class="form-select">
                            <option disabled selected>Choose One</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">
                                    {{ strtoupper(DateTime::createFromFormat('!m', $i)->format('F')) }}</option>
                            @endfor
                        </select>
                    </div>

                </div>
                <div style="display: grid; gap: 24px; grid-template-columns: 1fr 1fr">
                    <div class="mb-3">
                        <label for="producer_id" class="form-label">PIC</label>
                        <select id="producer_option" name="producer_id">
                            <option disabled selected>Choose One</option>
                            @forelse ($users as $user)
                                <option value="{{ $user->employee_id }}">{{ $user->full_name }}</option>
                            @empty
                                <option disabled>Data not found</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="mb-3">
                        <fieldset disabled>
                            <label for="manager_id" class="form-label">Manager Name</label>
                            {{-- <select id="manager_id" name="manager_id" class="form-select"> --}}
                            <input type="text " name="manager_name" id="manager_display" class="form-control"
                                placeholder="{{ $managerName }}" value="{{ $managerName }}"
                                style="text-transform: uppercase;" readonly />
                        </fieldset>
                        <!-- Hidden input field to store the manager_id -->
                        <input type="hidden" id="manager_id" name="manager_id" value="{{ $managerId }}">
                    </div>
                </div>
                <fieldset disabled>
                    <div style="display: grid; gap: 24px; grid-template-columns: 1fr 1fr">
                        <div class="mb-3"><label for="disabledTextInput" class="form-label">Budget Code</label>
                            <input type="text" name="budget_code_display" id="budget_code_display"
                                class="form-control" placeholder=" " />
                        </div>
                        <div class="mb-3">
                            <label for="disabledTextInput " class="form-label">Budget Allocation</label>
                            <input type="text" name="budget_display" id="budget_display" class="form-control"
                                placeholder="" />
                        </div>
                    </div>
                </fieldset>
                <input type="hidden" name="budget_code" id="budget_code" />
                <input type="hidden" name="budget" id="budget_input" />
                <input type="hidden" name="quarterly_budget_id" id="quarterly_budget_id" />
                <input type="hidden" name="reviewer_id" id="reviewer_id" value="3" />
                <input type="hidden" name="finance1_id" id="finance1_id" value="5" />
                <input type="hidden" name="finance2_id" id="finance2_id" value="6" />
                <input type="hidden" name="hc_id" id="hc_id" value="7" />


                <div style="display: grid; gap: 24px; grid-template-columns: 1fr 1fr">
                    <div class="mb-3">
                        <label for="disabledTextInput " class="form-label">Program / Activity Name</label>
                        <input type="text" name="episode" id="disabledTextInput " class="form-control"
                            placeholder="" oninput="this.value = this.value.toUpperCase()" />
                    </div>
                    <div class="mb-3">
                        <label for="disabledTextInput " class="form-label">Location</label>
                        <input type="text" name="location" id="disabledTextInput " class="form-control"
                            placeholder="" oninput="this.value = this.value.toUpperCase()" />
                    </div>
                </div>

                <div style="display: grid; gap: 24px; grid-template-columns: 1fr 1fr">
                    <div class="mb-3">
                        <label for="managerform" class="form-label">Date of Production</label>
                        <input type="date" name="date_start" id="disabledTextInput " class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="managerform" class="form-label">
                            Date of Completion of Shooting</label>
                        <input type="date" name="date_end" id="disabledTextInput " class="form-control" />
                    </div>
                </div>
                <div style="display: grid; gap: 24px; grid-template-columns: 1fr 1fr;">
                    <div class="mb-3">
                        <label for="Select " class="form-label">Production Type</label>
                        <select id="type" name="type" id="type" class="form-select">
                            <option disabled selected>Choose One</option>
                            <option value="TAPPING">TAPPING</option>
                            <option value="LIVE STREAMING">LIVE STREAMING</option>
                            <option value="EVENT">EVENT</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="managerform" class="form-label">Date of Upload</label>
                        <input type="date" name="date_upload" id="disabledTextInput " class="form-control" />
                    </div>
                </div>
                <button type="submit" class="button-departemen"
                    style="justify-content: center; align-items: center; display: flex; gap: 16px" id="nextButton">Next
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19"
                        fill="none">
                        <path d="M17 10L10.1429 4M17 10L10.1429 16M17 10H1" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
@endsection

@section('custom-js')
    {{-- <script src="{{ asset('js/formrequest.js') }}"></script> --}}
    {{-- get monthly budget based on program & month --}}
    {{-- <script type='text/javascript'>
        $(document).ready(function() {
            $('#program_option, #month').on('change', function() {
                var programId = $('#program_option').val();
                var month = $('#month').val();

                if (programId && month) {
                    $.ajax({
                        url: '{{ route('getMonthlyBudget') }}',
                        type: 'GET',
                        data: {
                            program_id: programId,
                            month: month
                        },
                        success: function(data) {
                            $('#budget_code_display').val(data.budget_code);
                            $('#budget_code').val(data.budget_code);
                            // Format monthly_budget before setting it to #budget input
                            var formattedBudget = parseFloat(data.monthly_budget)
                                .toLocaleString(); // Using toLocaleString for number formatting
                            $('#budget_display').val(formattedBudget);
                            $('#budget_input').val(data.monthly_budget);
                            console.log($('#budget_input').length);
                            console.log($('#budget_input'));
                            $('#monthly_budget_id').val(data.monthly_budget_id);
                        },
                        error: function() {
                            $('#budget_code_display').val('');
                            $('#budget_display').val('');
                            $('#budget_code').val('');
                            $('#budget').val('');
                            $('#monthly_budget_id').val('');
                        }
                    });
                } else {
                    $('#budget_code_display').val('');
                    $('#budget_display').val('');
                    $('#budget_code').val('');
                    $('#budget').val('');
                    $('#monthly_budget_id').val('');
                }
            });
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $('form button[type="submit"]').attr('disabled', true);
            $('#program_option, #month').change(function() {
                var program_id = $('#program_option').val();
                var month = $('#month').val();

                if (program_id && month) {
                    $.ajax({
                        url: '{{ route('get-budget-data') }}',
                        type: 'GET',
                        data: {
                            program_id: program_id,
                            month: month
                        },
                        beforeSend: function() {
                            // Disable submit button to prevent early submission
                            $('form button[type="submit"]').attr('disabled', true);
                        },
                        success: function(response) {
                            console.log(response);
                            $('#budget_code_display').val(response.budget_code);
                            $('#budget_code').val(response.budget_code);
                            // Format quartely_budget before setting it to #budget input
                            var formattedBudget = parseFloat(response.quarterly_budget)
                                .toLocaleString(); // Using toLocaleString for number formatting
                            $('#budget_display').val(formattedBudget);
                            $('#budget_input').val(response.quarterly_budget);
                            $('#quarterly_budget_id').val(response.quarterly_budget_id);
                        },
                        complete: function() {
                            // Re-enable the submit button
                            $('form button[type="submit"]').attr('disabled', false);
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#program_option').selectize({
                placeholder: "Type to search...", // Placeholder text for the dropdown
                allowClear: true,
                onDropdownOpen: function() {
                    // Automatically focus the input when the dropdown opens
                    this.clear();
                    this.$control_input.focus();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#producer_option').selectize({
                placeholder: "Type to search...", // Placeholder text for the dropdown
                allowClear: true,
                onDropdownOpen: function() {
                    // Automatically focus the input when the dropdown opens
                    this.clear();
                    this.$control_input.focus();
                }
            });
        });
    </script>
@endsection
