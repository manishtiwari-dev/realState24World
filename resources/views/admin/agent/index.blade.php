@extends('admin.layouts.app')
@section('title', 'Manage User')
@section('content')
    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <div class="d-flex align-items-center mb-3">
            <div>
                <h1 class="page-header mb-0">Agent's List</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route(getRolePrefix().'home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Agent</a></li>
                    <li class="breadcrumb-item active"><i class="fa fa-arrow-back"></i> Agent's List</li>
                </ol>
            </div>

            @can('agent-create')
                <div class="ms-auto">
                    <a href="{{ route(getRolePrefix() .'agent.create') }}" class="btn btn-primary px-4"><i
                            class="fa fa-user-plus fa-lg ms-n2 "></i> CREATE NEW AGENT</a>
                </div>
            @endcan
        </div>
        <!-- BEGIN panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading bg-theme-based">
                <h4 class="panel-title" style="text-transform: capitalize;">AGENT'S LIST</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                            class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i
                            class="fa fa-redo"></i></a>
                </div>
            </div>
            <!-- END panel-heading -->
            @if (\Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-0">
                    <strong> Success! </strong> {{ \Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
                </div>
            @endif
            <!-- BEGIN panel-body -->
            <div class="panel-body">
                <table id="data-table-default" width="100%"
                    class="table table-striped table-bordered align-middle text-nowrap">
                    <thead>
                        <tr>
                            <th width="1%"></th>
                            <th width="1%" data-orderable="false"></th>
                            <th class="text-nowrap">Code</th>
                            <th class="text-nowrap">Name</th>
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap">Phone</th>
                            <th class="text-nowrap">Created On</th>
                            <th class="text-nowrap" width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($data as $key => $user)
                            <tr class="odd gradeX">
                                <td width="1%" class="fw-bold">{{ ++$i }}</td>
                                <td width="1%" class="with-img">
                                    @if(empty($user->profile_photo))
                                        <img src="https://ui-avatars.com/api/?background=random&name={{ $user->name }}" class="rounded h-30px my-n1 mx-n1" />
                                    @else
                                        <img src="{{ asset('uploads/agents/'.$user->profile_photo.'') }}" class="rounded h-30px my-n1 mx-n1"/>
                                    @endif
                                </td>
                                <td><a href="{{ route('admin.agent.show', $user->id) }}"><span class="fw-600">{{ $user->agent_code }}</span></a></td>
                                <td><span class="fw-600">{{ $user->name }}</span></td>
                                <td><a class="fw-600" href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                <td><span class="fw-600">{{ !empty($user->phone) ? $user->phone : 'N/A' }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y h:i A') }}</td>
                                <td>
                                    <a class="btn btn-green btn-xs" href="{{ route(getRolePrefix().'agent.show', $user->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                                    @can('agent-edit')
                                        <a class="btn btn-primary btn-xs" href="{{ route(getRolePrefix().'agent.edit', $user->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    @endcan
                                    @can('agent-delete')
                                        <form method="POST" action="{{ route(getRolePrefix().'agent.destroy', $user->id) }}"
                                            style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs" onClick="if(confirm('Are you sure want to delete this user')){ return true;} else { return false; }"><i class="fa-solid fa-trash"></i> Delete</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('custom-javascript')
   
@endsection
