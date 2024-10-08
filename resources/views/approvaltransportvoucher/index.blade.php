@extends('layout.index3')

@section('title')
    Approval - Budgeting System
@endsection

@section('content')
<div style="margin-left: 24px">
    <div class="judulhalaman" style="display: flex; align-items: center; ">Approval
    </div>
        <div class="tablenih">
            <div class="table-responsive p-3">
                <table  id="datatable" class="table table-hover"
                style="font: 300 16px Narasi Sans, sans-serif;width: 100% ; margin-top: 12px; margin-bottom: 12px; text-align: center; ">
                    <thead style="font-weight: 500; ">
                        <tr class="dicobain">
                            <th scope="col ">No</th>
                            <th scope="col ">Date</th>
                            <th scope="col ">User</th>
                            <th scope="col ">User Phone</th>
                            <th scope="col ">Start Location</th>
                            <th scope="col ">Final Location</th>
                            <th scope="col ">Requirement</th>
                            <th scope="col ">Voucher</th>
                            <th scope="col ">Action</th>
                        </tr>
                    </thead>
                    <tbody style="vertical-align: middle;" >
                        <tr >
                            <th scope="row ">1</th>
                            <td>1</td>
                            <td> Mata Najwa</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="gap: 8px; display: flex; justify-content: center; ">
                                <a href="/approval-transportvoucher/detail" style="text-decoration: none"> <button type="button "
                                    class="button-general" style="width: fit-content; ">DETAIL</button>
                                </a></td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</div>


@endsection
