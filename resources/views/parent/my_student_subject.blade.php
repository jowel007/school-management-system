@extends('layouts.app')

@section('content')

    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Student Subject <span style="color: red">({{ $getUser->name }} {{ $getUser->last_name }})</span></h1>
                    </div>
                    
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">

                    <!-- /.col -->
                    <div class="col-md-12">
                        @include("_message")
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">My Student Subject </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Subject Type</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($getRecord as $value)
                                        <tr>
                                            <th>{{ $value->subject_name }}</th>
                                            <th>{{ $value->subject_type }}</th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    
                                </table>
                                
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
