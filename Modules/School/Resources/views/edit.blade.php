@extends('master')

@section('content')
    <div class="content-wrapper">
        @include('layouts.break_crumb')

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <!-- /.card-header -->
                            <!-- form start -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('school.update', ['school' => $school->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Tên trường (*)</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Nhập trường" value="{{ isset($school) ? $school->name : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Địa chỉ (*)</label>
                                        <input type="text" name="address" class="form-control" id="address"
                                            placeholder="Nhập địa chỉ" value="{{ isset($school) ? $school->address : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="descriptions">Mô tả (*)</label>
                                        <input type="text" name="descriptions" class="form-control" id="descriptions"
                                            placeholder="Nhập mô tả"
                                            value="{{ isset($school) ? $school->descriptions : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại (*)</label>
                                        <input type="number" name="phone" class="form-control" id="phone"
                                            placeholder="Nhập số điện thoại"
                                            value="{{ isset($school) ? $school->phone : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email (*)</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Nhập email" value="{{ isset($school) ? $school->email : '' }}">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
