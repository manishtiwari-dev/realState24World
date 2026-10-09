@extends('agent.layouts.app')
@section('content')
    <div id="content" class="app-content">
        <div class="block-header">
            <h1 class="page-header">{{ __('Dashboard') }}</h1>
        </div>
        {{-- Dashboard Tab Section --}}
        <div class="row">
            <div class="col-lg-3">
                <a href="hello">
                    <div class="card">
                        <div class="card-body no-padding" style="height:208px">
                            <div class="alert alert-callout alert-info no-margin">
                                <strong class="text-xl" style="font-size: 50px;">28</strong><br>
                                <span class="opacity-90">Total Order</span>
                                <h1 class="pull-right text-warning"><img src="{{ asset('assets/img/order.png') }}"></h1>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4">
                        <a href="hello">
                            <div class="card">
                                <div class="card-body no-padding">
                                    <div class="alert alert-callout alert-warning no-margin">
                                        <h1 class="pull-right text-warning"><img
                                                src="{{ asset('assets/img/thismonthrevenue.png') }}" width="60px;"></h1>
                                        <strong class="text-xl">3,200</strong><br />
                                        <span class="opacity-50">This Month Revenue</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4">
                        <a href="hello">
                            <div class="card">
                                <div class="card-body no-padding">
                                    <div class="alert alert-callout alert-danger no-margin">
                                        <h1 class="pull-right text-warning"><img src="{{ asset('assets/img/totaluser.png') }}" width="60px;"></h1>
                                        <strong class="text-xl">57</strong><br />
                                        <span class="opacity-50">Total User</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4">
                        <a href="hello">
                            <div class="card">
                                <div class="card-body no-padding">
                                    <div class="alert alert-callout alert-success no-margin">
                                        <h1 class="pull-right text-warning"><img
                                                src="{{ asset('assets/img/review.png') }}" width="60px;"></h1>
                                        <strong class="text-xl">120</strong><br />
                                        <span class="opacity-50">Total Review</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4">
                        <a href="hello">
                            <div class="card">
                                <div class="card-body no-padding">
                                    <div class="alert alert-callout alert-warning no-margin">
                                        <h1 class="pull-right text-warning"><img
                                                src="{{ asset('assets/img/totalrevenue.png') }}" width="60px;"></h1>
                                        <strong class="text-xl"> 32,829</strong><br />
                                        <span class="opacity-50">Total Revenue</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4">
                        <a href="hello">
                            <div class="card">
                                <div class="card-body no-padding">
                                    <div class="alert alert-callout alert-danger no-margin">
                                        <h1 class="pull-right text-warning"><img
                                                src="{{ asset('assets/img/discount.png') }}" width="60px;"></h1>
                                        <strong class="text-xl">5</strong><br />
                                        <span class="opacity-50">Running Discounts</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4">
                        <a href="hello">
                            <div class="card">
                                <div class="card-body no-padding">
                                    <div class="alert alert-callout alert-success no-margin">
                                        <h1 class="pull-right text-warning"><img
                                                src="{{ asset('assets/img/product.png') }}" width="60px;"></h1>
                                        <strong class="text-xl">46</strong><br />
                                        <span class="opacity-50">Total Product</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Dashboard Tab Section --}}
        {{-- Table --}}
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-inverse" data-sortable-id="table-basic-6">
                    <div class="panel-heading">
                        <h4 class="panel-title">New Orders</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                                    class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i
                                    class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i
                                    class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i
                                    class="fa fa-times"></i></a>
                        </div>
                    </div>

                {{-- @dd(session()->all()); --}}

                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Email Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Nicky Almera</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="deb0b7bdb5a79eb6b1aab3bfb7b2f0bdb1b3">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Edmund Wong</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="c3a6a7aeb6ada783baa2abacaceda0acae">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Harvinder Singh</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="cba3aab9bda2a5afaeb98baca6aaa2a7e5a8a4a6">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Harvinder Singh</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="cba3aab9bda2a5afaeb98baca6aaa2a7e5a8a4a6">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Harvinder Singh</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="cba3aab9bda2a5afaeb98baca6aaa2a7e5a8a4a6">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Harvinder Singh</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="cba3aab9bda2a5afaeb98baca6aaa2a7e5a8a4a6">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Harvinder Singh</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="cba3aab9bda2a5afaeb98baca6aaa2a7e5a8a4a6">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Nicky Almera</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="deb0b7bdb5a79eb6b1aab3bfb7b2f0bdb1b3">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Edmund Wong</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="c3a6a7aeb6ada783baa2abacaceda0acae">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>



            <div class="col-lg-6">
                <div class="panel panel-inverse" data-sortable-id="table-basic-6">

                    <div class="panel-heading">
                        <h4 class="panel-title">New User Registration</h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i
                                    class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i
                                    class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning"
                                data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i
                                    class="fa fa-times"></i></a>
                        </div>
                    </div>


                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Email Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Nicky Almera</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="deb0b7bdb5a79eb6b1aab3bfb7b2f0bdb1b3">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Edmund Wong</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="c3a6a7aeb6ada783baa2abacaceda0acae">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Harvinder Singh</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="cba3aab9bda2a5afaeb98baca6aaa2a7e5a8a4a6">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Nicky Almera</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="deb0b7bdb5a79eb6b1aab3bfb7b2f0bdb1b3">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Edmund Wong</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="c3a6a7aeb6ada783baa2abacaceda0acae">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Harvinder Singh</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="cba3aab9bda2a5afaeb98baca6aaa2a7e5a8a4a6">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Nicky Almera</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="deb0b7bdb5a79eb6b1aab3bfb7b2f0bdb1b3">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Edmund Wong</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="c3a6a7aeb6ada783baa2abacaceda0acae">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Harvinder Singh</td>
                                        <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                data-cfemail="cba3aab9bda2a5afaeb98baca6aaa2a7e5a8a4a6">[email&#160;protected]</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        {{-- Table End --}}

    </div>
@endsection
