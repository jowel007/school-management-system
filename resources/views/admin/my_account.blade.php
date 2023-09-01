@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Account</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row" style="margin-left: 10%">
                    <!-- left column -->
                    <div class="col-md-8">
                        @include('_message')
                        <!-- general form elements -->
                        <div class="card card-primary">


                            <form method="post" action="">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" value="{{ old('name',$getRecord->name)  }}" name="name" required placeholder="Enter Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" value="{{ old('email',$getRecord->email)  }}" name="email" required placeholder="Enter email">
                                        <div style="color: red">{{ $errors->first('email') }}</div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>

                            </form>
                        </div>
                        <!-- /.card -->


                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

@endsection
