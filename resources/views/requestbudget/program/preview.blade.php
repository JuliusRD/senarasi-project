@extends('layout.index')

@section('title')
    Create Request Budget - Budgeting System
@endsection

@section('content')
    <a href="{{ url()->previous() }}" style="text-decoration: none;"> <button class="navback">
            <svg xmlns="http://www.w3.org/2000/svg " width="10 " height="17 " viewBox="0 0 10 17 " fill="none ">
                <path d="M0 8.0501C0 8.4501 0.2 8.8501 0.4 9.0501L7 15.6501C7.6 16.2501 8.6 16.2501 9.2 15.6501C9.8 15.0501 9.8 14.0501 9.2 13.4501L3.8 8.0501L9.2 2.6501C9.8 2.0501 9.8 1.0501 9.2 0.450097C8.6 -0.149902 7.6 -0.149902 7 0.450097L0.6 6.8501C0.2
                                              7.2501 0 7.6501 0 8.0501Z " fill="#4A25AA " />
            </svg>
            Back
        </button>
    </a>
    <!--blablabla -->
    <div class="judulhalaman" style="text-align: start">Request Budget</div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link tablinks" id="home-tab" data-bs-toggle="tab"
                data-url="{{ route('request-budget.edit', $id) }}" data-bs-target="#home-tab-pane" type="button"
                role="tab" aria-controls="home-tab-pane" aria-selected="false">Header</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tablinks" id="data1-tab" data-url="{{ route('request-budget.performer', $id) }}"
                data-bs-toggle="tab" data-bs-target="#data1-tab-pane" type="button" role="tab"
                aria-controls="data1-tab-pane" aria-selected="false">Performer</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tablinks" id="data2-tab" data-url="{{ route('request-budget.productioncrew', $id) }}"
                data-bs-toggle="tab" data-bs-target="#data2-tab-pane" type="button" role="tab"
                aria-controls="data2-tab-pane" aria-selected="false">Production Crews</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tablinks" id="data3-tab" data-url="{{ route('request-budget.productiontool', $id) }}"
                data-bs-toggle="tab" data-bs-target="#data3-tab-pane" type="button" role="tab"
                aria-controls="data3-tab-pane" aria-selected="false">Production
                Tools</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tablinks" id="data4-tab" data-url="{{ route('request-budget.operational', $id) }}"
                data-bs-toggle="tab" data-bs-target="#data4-tab-pane" type="button" role="tab"
                aria-controls="data4-tab-pane" aria-selected="false">Operational</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tablinks" id="data5-tab" data-url="{{ route('request-budget.location', $id) }}"
                data-bs-toggle="tab" data-bs-target="#data5-tab-pane" type="button" role="tab"
                aria-controls="data1-tab-pane" aria-selected="false">Venue</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link active tablinks" id="preview-tab" data-url="{{ route('request-budget.preview', $id) }}"
                data-bs-toggle="tab" data-bs-target="#preview-tab-pane" type="button" role="tab"
                aria-controls="preview-tab-pane" aria-selected="false" disabled>Preview & Submit</button>
        </li>
        <li class="nav-item" role="presentation">
        </li>
    </ul>


    <div class="tab-content" id="myTabContent" style="margin-top: 24px">
        <!-- PREVIEW -->
        <form id="mainForm" action=""></form>
        <div style="border: 1px solid #c4c4c4; margin: 12px; border-radius: 4px; margin-bottom: 24px; border-bottom:none">
            <table class="table table-hover"
                style="font: 300 16px Narasi Sans, sans-serif; width: 100%; margin-top: 12px; margin-bottom: 12px; text-align: center">
                <thead style="font-weight: 500">
                    <tr class="dicobain">
                        <th scope="col ">No</th>
                        <th scope="col ">Description</th>
                        <th scope="col ">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row ">1</th>
                        <td style="text-align: start">Performer/Host/Guest</td>

                        <td class="total-price" style="font-weight: 300; text-align: end; padding-left: 24px;">Rp.
                            {{ number_format($totalperformer) ?? 0 }}
                        </td>
                    </tr>
                    <tr>
                        <th scope=" row ">2</th>
                        <td style="text-align: start">Production Crews</td>

                        <td class="total-price" style="font-weight: 300; text-align: end; padding-left: 24px;">Rp.
                            {{ number_format($totalproductioncrew) ?? 0 }}</td>
                    </tr>
                    <tr>
                        <th scope="row ">3</th>
                        <td style="text-align: start">Production Tools</td>

                        <td class="total-price" style="font-weight: 300; text-align: end; padding-left: 24px;">Rp.
                            {{ number_format($totalproductiontool) ?? 0 }}</td>
                    </tr>
                    <tr>
                        <th scope="row ">4</th>
                        <td style="text-align: start">Operational</td>

                        <td class="total-price" style="font-weight: 300; text-align: end; padding-left: 24px;">Rp.
                            {{ number_format($totaloperational) ?? 0 }}
                        </td>
                    </tr>
                    <tr>
                        <th scope="row ">5</th>
                        <td style="text-align: start">Venue</td>

                        <td class="total-price" style="font-weight: 300; text-align: end; padding-left: 24px;">Rp.
                            {{ number_format($totallocation) ?? 0 }}
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #c4c4c4;">
                        <td colspan="2" class="text-right" style="font-weight: 500; background-color: #dbdee8">
                            Total</td>
                        <td class="total-price">Rp.
                            {{ number_format($totalAll) }}
                            / <span style="color: red">Rp.
                                {{ number_format($budget) }}</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex">
            <a href="{{ route('request-budget.report', $id) }}" target="_blank" type="button"
                class="button-permintaan"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                    viewBox="0 0 32 32" fill="none">
                    <path
                        d="M16 2C13.2311 2 10.5243 2.82109 8.22202 4.35943C5.91973 5.89777 4.12532 8.08427 3.06569 10.6424C2.00607 13.2006 1.72882 16.0155 2.26901 18.7313C2.80921 21.447 4.14258 23.9416 6.10051 25.8995C8.05845 27.8574 10.553 29.1908 13.2687 29.731C15.9845 30.2712 18.7994 29.9939 21.3576 28.9343C23.9157 27.8747 26.1022 26.0803 27.6406 23.778C29.1789 21.4757 30 18.7689 30 16C30 12.287 28.525 8.72601 25.8995 6.1005C23.274 3.475 19.713 2 16 2ZM23.447 16.895L11.447 22.895C11.2945 22.9712 11.1251 23.0072 10.9548 22.9994C10.7845 22.9917 10.619 22.9406 10.474 22.8509C10.329 22.7613 10.2093 22.636 10.1264 22.4871C10.0434 22.3381 9.99993 22.1705 10 22V10C10.0001 9.82961 10.0437 9.66207 10.1268 9.51327C10.2098 9.36448 10.3294 9.23936 10.4744 9.14981C10.6194 9.06025 10.7848 9.00921 10.955 9.00155C11.1252 8.99388 11.2946 9.02984 11.447 9.106L23.447 15.106C23.6129 15.1891 23.7524 15.3168 23.8498 15.4747C23.9473 15.6326 23.9989 15.8145 23.9989 16C23.9989 16.1855 23.9473 16.3674 23.8498 16.5253C23.7524 16.6832 23.6129 16.8109 23.447 16.894"
                        fill="white" />
                </svg>Preview</a>
        </div>
        <form method="POST" action="{{ route('preview.store') }}">
            @csrf
            <input type="hidden" name="manager_id" value="{{ $requestbudget->manager->employee_id }}">
            <input type="hidden" name="employee_id" value="{{ Auth::id() }}">
            <input type="hidden" name="request_budget_id" value="{{ $id }}">
            <input type="hidden" name="budget" value="{{ $requestbudget->budget }}">
            <input type="hidden" name="history_status" value="membuat">
            <div class="d-flex">
                <button type="submit" class="button-departemen">Submit</button>
            </div>
        </form>

        <div id="tableContainer"></div>
    </div>
@endsection

@section('custom-js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabButtons = document.querySelectorAll('.nav-link.tablinks');

            tabButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const targetUrl = button.getAttribute('data-url');

                    // Redirect to the URL specified in the data-url attribute
                    window.location.href = targetUrl;
                });
            });
        });
    </script>
    <script src="{{ asset('js/formrequest.js') }}"></script>
    <script type='text/javascript'>
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
                            $('#budget_code').val(data.budget_code);
                            $('#budget').val(data.monthly_budget);
                        },
                        error: function() {
                            $('#budget_code').val('');
                            $('#budget').val('');
                        }
                    });
                } else {
                    $('#budget_code').val('');
                    $('#budget').val('');
                }
            });
        });
    </script>
@endsection
