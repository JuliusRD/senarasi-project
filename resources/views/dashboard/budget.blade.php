@extends('layout.index')
@section('title')
    Budget Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4 col-sm-6">
            <div class="card-budget">
                <div class="text-body-tertiary">Remaining Budget</div>
                <div class="d-flex align-items-center">
                    <div class="text-sisa"> Rp. {{ number_format($totalRemainingBudget, 2) }}</div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="text-body-tertiary me-1"> From total </div>
                    <div class="text-success ">Rp. {{ number_format($totalBudget, 2) }}</div>
                </div>

            </div>
        </div>
        <div class="col-lg-4 col-sm-6">
            <div class="card-budget">
                <div class="text-body-tertiary">Spending Budget</div>
                <div class="d-flex align-items-center">
                    <div class="text-sisa"> Rp. {{ number_format($totalSpendingBudget, 2) }}</div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="text-body-tertiary me-1"> From total </div>
                    <div class="text-success ">Rp. {{ number_format($totalBudget, 2) }}</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12">
            <div class="button-dashboard">
                <button class="button-ini mb-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    INPUT
                    <span style="color: #ffe900">BUDGET</span>
                </button>
                <a href="{{ route('request-budget.create') }}" class="text-decoration-none text-end">
                    <button class="button-ini">REQUEST <span style="color: #ffe900">BUDGET</span></button>
                </a>
            </div>
        </div>
    </div>

    <div class="tablenih mb-4" style="border: none; box-shadow: 0px 1px 8px -1px rgba(76, 37, 176, 0.505);">
        <div class="row p-3">
            <div class="col-lg-8 col-sm-12">
                <div id="columnchart_material" style="height: 600px; position:relative; z-index:-1;"></div>
            </div>
            <div class="col-lg-4 col-sm-12" style="margin-right:0px;">
                <div style="font: 350 Narasi sans, sans-serif; ">
                    <label for="chartType" class="form-label">Select Graphics by Program: </label>
                    <select id="chartType" class="form-select" onchange="changeChartType()">
                        <option selected disabled>Select Program</option>
                        <option value="total">Total Budget</option>
                        @forelse ($yearlybudget as $budget)
                            <option value="{{ $budget->program_id }}">{{ $budget->program->program_name }}</option>
                        @empty
                            <option disabled selected>Data not found</option>
                        @endforelse
                    </select>
                </div>
                <div id="donutchart" style=" height: 500px;"></div>
            </div>
        </div>
    </div>

    <div class="tablenih" style="border: none; box-shadow: 0px 1px 8px -1px rgba(76, 37, 176, 0.505);">
        <table class="table table-hover"
            style="font: 300 16px Narasi Sans, sans-serif; width: 100%; margin-top: 12px; margin-bottom: 12px; text-align: center">
            <thead style="font-weight: 500">
                <tr class="dicobain">
                    <th scope="col ">NO</th>
                    <th scope="col ">Request Number</th>
                    <th scope="col ">Nama Program</th>
                    <th scope="col ">Approval 1</th>
                    <th scope="col ">Approval 2</th>
                    <th scope="col ">Approval 3</th>
                    <th scope="col ">User Submit</th>
                    <th scope="col ">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row ">1</th>
                    <td>1</td>
                    <td>Mata Najwa</td>
                    <td>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <circle cx="12" cy="12" r="12" fill="#E73638" />
                        </svg>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="gap: 8px; display: flex; justify-content: center">
                        <a href="/detail-request" class="text-decoration-none text-end"><button type="button "
                                class="button-general" style="width: fit-content">DETAIL</button>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
@section('modal')
    <!-- Modal 1 -->
    <div class="modal justify-content-center fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body bg-white">
                    <form action="{{ route('budget.store') }}" method="POST" class="modal-form-check"
                        style="font: 500 14px Narasi Sans, sans-serif">
                        @csrf
                        {{-- <fieldset disabled> --}}
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">User</label>
                            <input type="text" id="display_name" class="form-control" name="display_name"
                                value="{{ Auth::user()->full_name }}" placeholder="{{ Auth::user()->full_name }}" disabled/>
                            <input type="hidden" id="employee_id" name="employee_id"
                                value="{{ Auth::user()->employee_id }}" />
                        </div>
                        {{-- </fieldset> --}}
                        <div class="mb-3">
                            <label for="program_name" class="form-label">Nama Program</label>
                            {{-- <input type="text " class="form-control" id="namaprogram " /> --}}
                            <select name="program_id" id="program_option" class="selectize">
                                <option selected disabled>Select Program</option>
                                @forelse ($program as $program_id => $program_name)
                                    <option value="{{ $program_id }}">{{ $program_name }}</option>
                                @empty
                                    <option disabled selected>Data not found</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="quarter" class="form-label">Quarter</label>
                                {{-- <input type="text " class="form-control" id="quarter" /> --}}
                                <select name="quarter" id="quarter" class="selectize">
                                    <option selected disabled>Choose One</option>
                                    <option value="1">Q1</option>
                                    <option value="2">Q2</option>
                                    <option value="3">Q3</option>
                                    <option value="4">Q4</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="budget_code" class="form-label">Kode Budget</label>
                                <input type="text " class="form-control p-2" name="budget_code" id="budget_code" />
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="quarter_budget" class="form-label">Budget Quarter</label>
                            <input type="text" class="form-control" name="quarter_budget" id="quarter_budget"
                                name="budget" required />
                            <!-- Input field for entering the budget value -->
                            <input type="hidden" id="raw_budget" name="raw_budget" />
                            <!-- Hidden input field for storing the raw numeric value -->

                        </div>
                        <button type="submit" class="button-submit">Submit</button>
                        <button type="button" class="button-tutup" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
                <img class="img-8" src="{{ asset('image/Narasi_Logo.svg') }}" alt=" " />
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#staticBackdrop').on('hidden.bs.modal', function() {
                $(this).find('form')[0].reset();
            });
        });
    </script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar', 'corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            drawChart1(); // By default, draw the column chart
            drawChart2(); // By default, draw the pie chart
        }

        function changeChartType() {
            var selectedProgramId = document.getElementById("chartType").value;

            if (selectedProgramId) {
                fetch(`/api/getProgramData/${selectedProgramId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            console.error('Error from API:', data.error);
                        } else {
                            drawPieChart(data); // Pass the fetched data to the drawPieChart function
                        }
                    })
                    .catch(error => console.error('Error fetching program data:', error));
            }
        }

        function drawPieChart(data) {
            // Example using Google Charts
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(function() {
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn('string', 'Type');
                dataTable.addColumn('number', 'Amount');

                data.forEach(item => {
                    var usedBudget = item.yearly_budget - item.remaining_budget;
                    dataTable.addRow(['Remaining Budget', item
                        .remaining_budget
                    ]);
                    dataTable.addRow(['Used Budget', usedBudget]);
                });

                var options = {
                    title: 'Budget Distribution by Program',
                    pieHole: 0.4,
                    backgroundColor: 'transparent',
                    chartArea: {
                        width: '100%',
                        height: '100%',
                        left: 60,
                        top: 50,
                    },
                };

                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(dataTable, options);
            });
        }

        function drawChart1() {
            var data = google.visualization.arrayToDataTable([
                ['Month', 'Mata Najwa', 'Musyawarah', 'Mata Najwa', 'Musyawarah', 'Mata Najwa'],
                ['Jan', 1000, 400, 200, 500, 300],
                ['Feb', 1170, 460, 250, 460, 500],
                ['March', 660, 1120, 300, 400, 200],
                ['Apr', 1030, 540, 350, 550, 750],
                ['May', 1000, 400, 200, 500, 300],
                ['Jun', 1170, 460, 250, 460, 500],
                ['Jul', 660, 1120, 300, 400, 200],
                ['Aug', 1030, 540, 350, 550, 750],
                ['Sept', 1000, 400, 200, 500, 300],
                ['Okt', 1170, 460, 250, 460, 500],
                ['Nov', 660, 1120, 300, 400, 200],
                ['Des', 1030, 540, 350, 550, 750]
            ]);

            var options = {
                chart: {
                    title: 'Company Performance',
                    subtitle: 'Sales, Expenses, and Profit: 2014-2017',
                    backgroundColor: 'transparent',
                    chartArea: {
                        width: '200px',
                        height: '100%',
                        left: 60,
                        top: 50
                    },
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }

        function drawChart2() {
            var totalYearlyBudget = "{{ $totalBudget }}";
            var totalRemainingBudget = "{{ $totalSpendingBudget }}";
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Budget'],
                ['Total Yearly Budget', parseInt(totalYearlyBudget)],
                ['Total Remaining Budget', parseInt(totalRemainingBudget)]
            ]);

            var options = {
                title: 'Budget Distribution by Total',
                pieHole: 0.4,
                backgroundColor: 'transparent',
                chartArea: {
                    width: '100%',
                    height: '100%',
                    left: 60,
                    top: 50,
                },
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
    <script>
        var budgetInput = document.getElementById('quarter_budget');
        var rawBudgetInput = document.getElementById('raw_budget');

        budgetInput.addEventListener('keyup', function(e) {
            var formattedBudget = formatRupiah(this.value, 'Rp');
            budgetInput.value = formattedBudget; // Update the budget input field with the formatted value
            var rawValue = parseRawBudget(formattedBudget); // Parse the raw numeric value
            rawBudgetInput.value = rawValue; // Store the raw numeric value in the hidden input field
        });

        /* Dengan Rupiah */
        var budgettahunan = document.getElementById('quarter_budget');
        budgettahunan.addEventListener('keyup', function(e) {
            budgettahunan.value = formatRupiah(this.value, 'Rp');
        });

        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? 'Rp ' + rupiah : '';
        }

        function parseRawBudget(formattedBudget) {
            // Remove any non-numeric characters from the formatted budget value
            var rawValue = formattedBudget.replace(/[^\d]/g, '');
            return rawValue;
        }
    </script>
    <script>
        $(document).ready(function () {
            $('.selectize').selectize({
                placeholder: "Type to search...",
                        allowClear: true,
                        create: false
            });
        });
    </script>
@endsection
