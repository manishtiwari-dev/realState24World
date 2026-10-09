@extends('admin.layouts.app')
@section('title', 'Manage User')
@section('content')
<div id="content" class="app-content">
    <!-- BEGIN breadcrumb -->
    <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Activity Logs</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'settings.index') }}">Settings</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i>Activity Logs</li>
                </ol>
            </div>
            <div class="ms-auto">
                <div class="btn-group w-100">
                    <a href="{{ route(getRolePrefix().'home') }}" class="btn btn-default px-3 me-2 btn-sm"><i class="fa fa-arrow-left fa-lg ms-n2 "></i> Back</a>
                </div>
            </div>
        </div>
    <!-- BEGIN panel -->
    <div class="panel panel-inverse">
        <div class="panel-heading bg-theme-based">
            <h4 class="panel-title" style="text-transform: capitalize;">Activity Logs</h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
            </div>
        </div>
        <!-- END panel-heading -->
        <div style="background: #f2f3f4; padding: 10px; border-radius: 5px;">
            <div class="d-flex justify-content-end">
                <form action="{{ route(getRolePrefix().'settings.logactivities') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="input-group input-daterange">
                        <input type="text" class="form-control" id="datepicker-start" name="start" placeholder="Activities Start Date" value="{{ request()->input('start') }}">
                        <span class="input-group-text input-group-addon">TO</span>
                        <input type="text" class="form-control" id="datepicker-end" name="end" placeholder="Activities Date End" value="{{ request()->input('end') }}">
                        <button class="btn btn-sm btn-primary rounded-0">Filter</button>
                        <a href="{{ route(getRolePrefix().'settings.logactivities') }}" class="btn btn-sm btn-default rounded-0">Reset</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- BEGIN panel-body -->
        <div class="panel-body">
            <div class="h-450px p-3" data-scrollbar="true">
                @foreach ($logactivities as $logs)
                    @php
                        switch ($logs->query_type) {
                            case 'Login':
                                $bgcolor = 'text-warning';
                                break;
                            case 'Create':
                                $bgcolor = 'text-success';
                                break;
                            case 'Update':
                                $bgcolor = 'text-warning';
                                break;
                            case 'Delete':
                                $bgcolor = 'text-danger';
                                break;
                            case 'General':
                                $bgcolor = 'text-primary';
                                break;
                            default:
                                $bgcolor = 'text-info';
                        }
                    @endphp
                    <div class="history-list border rounded p-2 mb-3 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="fw-700 {{ $bgcolor }} mt-1 mb-2"><i class="fa fa-exclamation-circle"></i> {{ $logs->subject }}</p> 
                                <small class="text-muted">
                                    <i class="fa fa-calendar-alt me-2"></i><span class="fw-bold text-dark">{{ \Carbon\Carbon::parse($logs->created_at)->format('d M, Y h:i A') }} </span>
                                </small>
                            
                                <p class="mb-1 text-muted small">
                                    <i class="fa fa-user me-1"></i> <span class="fw-bold text-dark">{{ $logs->UserName }}</span>
                                </p>
                            </div>
                            <button class="btn btn-outline-secondary btn-sm toggle-details">
                                <i class="fa fa-eye"></i> Show Details
                            </button>
                        </div>
                        <div class="details mt-2" style="display: none;">
                            <pre class="bg-dark text-light p-3 rounded">{{ json_encode(json_decode($logs->query_request), JSON_PRETTY_PRINT) }}</pre>
                            <div><code>IP Address: {{ $logs->ip }}</code></div>
                            <div><code>Agent: {{ $logs->agent }}</code></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-javascript')
    <script>
        $("#datepicker-start").datepicker({
          todayHighlight: true,
          autoclose: true
        });
        $("#datepicker-end").datepicker({
          todayHighlight: true,
          autoclose: true
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.toggle-details').forEach(button => {
                button.addEventListener('click', function() {
                    let details = this.closest('.history-list').querySelector('.details');
                    details.style.display = details.style.display === 'none' ? 'block' : 'none';
                    this.innerHTML = details.style.display === 'none' ?
                        '<i class="fa fa-eye"></i> Show Details' :
                        '<i class="fa fa-eye-slash"></i> Hide Details';
                });
            });
        });
    </script>
@endsection