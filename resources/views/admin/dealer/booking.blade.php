@extends('admin.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Agent Booking</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix() . 'home') }}">Home</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Booking</li>
                </ol>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 mb-4">
                    <div class="card-header h6 mb-0 bg-none p-3">
                        <i class="fa fa-list fa-lg fa-fw text-dark text-opacity-50 me-1"></i> Booking LIST
                    </div>

                    <div class="card-body">
                        <table id="data-table-default" class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th width="1%"></th>
                                    <th>Agent</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th class="text-nowrap" width="20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($enquiry))
                                    @foreach ($enquiry as $key => $data)
                                        <tr class="odd gradeX">
                                            <?php $dash = ''; ?>
                                            <td class="fw-bold text-dark">{{ ++$i }}</td>
                                            <td>@if(!empty($data->dealer)){{ $data->dealer->name }}@endif</td>
                                            <td><b>{{ $data->name }}</b></td>

                                            <td>
                                               {{$data->phone}}
                                            </td>

                                            <td>{{ $data->message }} </td>
                                            <td>
                                                <a href="{{ route(getRolePrefix() . 'dealer.booking_delete', $data->id) }}"
                                                    class="btn btn-danger btn-xs btn-circle me-1 mb-1"
                                                    style="background-color: #9a1515;"
                                                    onClick="if(confirm('Are you sure want to delete this booking')){ return true;} else { return false; }"><i
                                                        class="fa fa-trash"></i>&nbsp;Delete</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
