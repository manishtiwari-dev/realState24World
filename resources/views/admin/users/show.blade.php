@extends('admin.layouts.app')
@section('content')
<div id="content" class="app-content p-3">
    <div class="d-flex align-items-center mb-3">
        <div>
            <h1 class="page-header mb-0">User Detail & Activity</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Settings</a></li>
                <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Users</li>
            </ol>
        </div>
        @can('user-list')
        <div class="ms-auto">
            <div class="btn-group w-100">
                <a href="{{ route(getRolePrefix().'users.index') }}" class="btn btn-default px-3 me-2 btn-sm"><i class="fa fa-arrow-left fa-lg ms-n2 "></i> Back</a>
                @can('user-status') 
                    @if($user->is_status == '1')
                        <form method="POST" action="{{ route(getRolePrefix().'users.status') }}" style="display:inline">
                            @csrf
                            <input type="hidden" name="status" value="0"> 
                            <input type="hidden" name="user_id" value="{{ $user->id }}"> 
                            <button type="submit" class="btn btn-warning rounded-0 px-3 btn-sm" onClick="if(confirm('Are you sure want to block this user')){ return true;} else { return false; }"> Block Account</button>
                        </form>
                    @else 
                        <form method="POST" action="{{ route(getRolePrefix().'users.status') }}" style="display:inline">
                            @csrf
                            <input type="hidden" name="status" value="1"> 
                            <input type="hidden" name="user_id" value="{{ $user->id }}"> 
                            <button type="submit" class="btn btn-success rounded-0 px-3 btn-sm" onClick="if(confirm('Are you sure want to unblock this user')){ return true;} else { return false; }"> Unblock Account</button>
                        </form>
                    @endif
                @endcan
                @can('user-delete')      
                    <form method="POST" action="{{ route(getRolePrefix().'users.destroy', $user->id) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger rounded-0 px-3 btn-sm" onClick="if(confirm('Are you sure want to delete this user')){ return true;} else { return false; }"><i class="fa-solid fa-trash"></i> Delete Account</button>
                    </form>
                @endcan
            </div>
        </div>
        @endcan
        {{-- @if (auth()->user()->roles->pluck('name')->contains('Superadmin'))
            <h1>{{ 'Superadmin' }}</h1>
        @endif --}}
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card border-0 mb-4">
                    <div class="card-header h6 mb-0 bg-none p-3">
                        <i class="fa fa-list fa-lg fa-fw text-dark text-opacity-50 me-1"></i>User Detail
                    </div>
                    <div class="card-body h-500px">
                        <div class="row">
                            <div class="lead">
                                <strong>Name:</strong>
                                {{ $user->name }}
                            </div>
                            <div class="lead">
                                <strong>Mobile No:</strong>
                                {{ $user->phone }}
                            </div>
                            <div class="lead">
                                <strong>Email:</strong>
                                {{ $user->email }}
                            </div>
                            <div class="lead">
                                <strong>Password:</strong>
                               {{ base64_decode($user->password_backup) }}
                            </div> 

                            <div class="lead">
                                <strong>Roles:</strong>
                                @if(!empty($user->getRoleNames()))
                                    @if ($user->name=='Super Admin')
                                        <span class="badge bg-success"> All Permission </span>
                                    @else
                                        @foreach($user->getRoleNames() as $v)
                                            <span class="badge bg-success">{{ $v }}</span>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card border-0 mb-4">
                    <div class="card-header h6 mb-0 bg-none p-3">
                        <i class="fa fa-list fa-lg fa-fw text-dark text-opacity-50 me-1"></i>User Activity Logs
                    </div>
                    <div class="card-body">   
                        <div class="row">
                            <div class="h-450px p-3" data-scrollbar="true">
                                {{-- logs --}}
                                @if(count($logsresult) > 0)
                                    <div class="tree-structure activities">
                                        @foreach ($logsresult as $logs)
                                            @php
                                                switch ($logs->query_type) {
                                                    case 'Login': $bgcolor = 'text-warning'; break;
                                                    case 'Create': $bgcolor = 'text-success'; break;
                                                    case 'Update': $bgcolor = 'text-warning'; break;
                                                    case 'Delete': $bgcolor = 'text-danger'; break;
                                                    case 'general': $bgcolor = 'text-primary'; break;
                                                    default: $bgcolor = 'text-info';
                                                }
                                            @endphp
                                            <div class="history-list border rounded p-3 mb-3 shadow-sm">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <p class="fw-700 {{ $bgcolor }} mb-1"><i class="fa fa-exclamation-circle"></i> {{ $logs->subject }}</p>
                                                        <small class="text-muted">
                                                            <i class="fa fa-calendar-alt me-2"></i><span class="fw-bold text-dark">{{ \Carbon\Carbon::parse($logs->created_at)->format('d M, Y h:i A') }} </span>
                                                        </small>
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
                                @else
                                    <div class="history-list text-center p-4 border rounded">
                                        <div class="text-muted">No Activities Yet ..!!!</div>
                                    </div>
                                @endif  
                                {{-- logs --}}
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-javascript')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.toggle-details').forEach(button => {
            button.addEventListener('click', function() {
                let details = this.closest('.history-list').querySelector('.details');
                details.style.display = details.style.display === 'none' ? 'block' : 'none';
                this.innerHTML = details.style.display === 'none' 
                    ? '<i class="fa fa-eye"></i> Show Details' 
                    : '<i class="fa fa-eye-slash"></i> Hide Details';
            });
        });
    });
</script>
@endsection