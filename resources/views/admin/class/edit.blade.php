@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Class</h1>
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
            <!-- general form elements -->
            <div class="card card-primary">


              <form method="post" action="">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Class Name</label>
                        <input type="text" class="form-control" value="{{ $getRecord->name }}" name="name" required placeholder="Enter Class Name">
                    </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="0"></option>
                        <option value="0" {{ ($getRecord->status == 0) ? 'selected' : '' }}>Active</option>
                        <option value="1" {{ ($getRecord->status == 1) ? 'selected' : '' }}>InActive</option>
                    </select>
                  </div>
                  
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
