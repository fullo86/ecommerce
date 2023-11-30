@extends('adminarea/layouts/main')
@section('title', 'Administrator Area | Dashboard')

@section('dashboardAdminArea')
<section class="content-body">
    @if (Session::has('status'))
        <div id="flashMessage" class="alert alert-{{ Session::get('status') == 'success' ? 'success' : 'danger' }}">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-4">
            <div class="row">
                <div class="col-md-6 col-xl-12">
                    <section class="panel">
                        <div class="panel-body bg-primary">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon">
                                        <i class="fa fa-users"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Customer</h4>
                                        <div class="info">
                                            <strong class="amount">{{ $totalCustomer }}</strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a href="/admin-area/customer" class="text-uppercase">(view all)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-6 col-xl-12">
                    <section class="panel">
                        <div class="panel-body bg-secondary">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon">
                                        <i class="fa fa-cubes"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Produk</h4>
                                        <div class="info">
                                            <strong class="amount">{{ $totalProduct }}</strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a href="/admin-area/products" class="text-uppercase">(view all)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-6 col-xl-12">
                    <section class="panel">
                        <div class="panel-body bg-tertiary">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon">
                                        <i class="fa fa-life-ring"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Transaksi</h4>
                                        <div class="info">
                                            <strong class="amount">{{ $totalTrx }}</strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a href="/admin-area/transaction" class="text-uppercase">(view all)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-6 col-xl-12">
                    <section class="panel">
                        <div class="panel-body bg-quartenary">
                            <div class="widget-summary">
                                <div class="widget-summary-col widget-summary-col-icon">
                                    <div class="summary-icon">
                                        <i class="fa fa-life-ring"></i>
                                    </div>
                                </div>
                                <div class="widget-summary-col">
                                    <div class="summary">
                                        <h4 class="title">Pesan</h4>
                                        <div class="info">
                                            <strong class="amount">128</strong>
                                        </div>
                                    </div>
                                    <div class="summary-footer">
                                        <a class="text-uppercase">(view all)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>            

    <div class="col-md-6 col-xl-6" style="margin-top: 50px;">
        <section class="panel panel-group">
            <header class="panel-heading bg-primary">

                <div class="widget-profile-info">
                    <div class="profile-picture">
                        <img src="{{ asset('storage/images/profile/'.Auth::user()->image_profile) }}">
                    </div>
                    <div class="profile-info">
                        <h4 class="name text-semibold">{{ Auth::user()->name }}</h4>
                        <h5 class="role">{{ Auth::user()->roles->role_name }}</h5>
                        <div class="profile-footer">
                            <a href="/admin-area/edit/staff/{{ Auth::user()->id }}">(Edit Profile)</a>
                        </div>
                    </div>
                </div>

            </header>
            <div id="accordion">
                <div class="panel panel-accordion panel-accordion-first">
                    <div id="collapse1One" class="accordion-body collapse in">
                        <div class="panel-body">
                            <ul class="widget-todo-list">
                                <li>
                                    <b>Username : </b> {{ Auth::user()->username }}
                                </li>
                                <li>
                                    <b>No Handphone : </b> {{ Auth::user()->phone }}
                                </li>
                                <li>
                                    <b>Email : </b> {{ Auth::user()->email }}
                                </li>
                                <li>
                                    <b>Status : </b> {{ Auth::user()->active_status }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
@endsection