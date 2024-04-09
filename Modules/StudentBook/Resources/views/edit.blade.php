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
                            <form method="POST"
                                action="{{ route('studentBook.update', ['studentBook' => $studentBook->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Người mượn (*)</label>
                                        <select name="id_student" id="id_student" class="form-control select2bs4">
                                            <option value="">Chọn học sinh</option>
                                            @foreach ($students as $student)
                                                <option value="{{ $student->id }}"
                                                    {{ isset($studentBook) && $studentBook->id_student == $student->id ? 'selected' : '' }}>
                                                    {{ $student->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Sách (*)</label>
                                        <select name="id_book" id="id_book" class="form-control select2bs4">
                                            <option value="">Chọn sách</option>
                                            @foreach ($books as $book)
                                                @if ($book->quantity > $book->quantity_lent)
                                                    <option value="{{ $book->id }}"
                                                        {{ isset($studentBook) && $studentBook->id_book == $book->id ? 'selected' : '' }}>
                                                        {{ $book->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="descriptions">Ngày mượn (*)</label>
                                        <input type="date" name="checkout_date" class="form-control" id="checkout_date"
                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                            value="{{ isset($studentBook) ? $studentBook->checkout_date : '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Ngày trả (*)</label>
                                        <input type="date" name="return_date" class="form-control" id="return_date"
                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                            value="{{ isset($studentBook) ? $studentBook->return_date : '' }}">
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
