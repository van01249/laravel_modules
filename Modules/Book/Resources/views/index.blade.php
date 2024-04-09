@extends('master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('layouts.break_crumb')

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <form action="">
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    <input type="text" name="keyword" id="keyword" class="form-control"
                                        placeholder="ID, Tên sách"
                                        value="{{ isset($dataRequest['keyword']) ? $dataRequest['keyword'] : '' }}">
                                </div>
                                <div class="col-2">
                                    <input type="text" name="author" id="author" class="form-control"
                                        placeholder="Tác giả"
                                        value="{{ isset($dataRequest['author']) ? $dataRequest['author'] : '' }}">
                                </div>
                                <div class="col-2">
                                    <input type="text" name="genre" id="genre" class="form-control"
                                        placeholder="Thể loại"
                                        value="{{ isset($dataRequest['genre']) ? $dataRequest['genre'] : '' }}">
                                </div>
                                <div class="col-2">
                                    <input type="text" name="publisher" id="publisher" class="form-control"
                                        placeholder="Nhà xuất bản"
                                        value="{{ isset($dataRequest['publisher']) ? $dataRequest['publisher'] : '' }}">
                                </div>
                                <div class="col-2">
                                    <input type="number" name="ISBN" id="ISBN" class="form-control"
                                        placeholder="ISBN"
                                        value="{{ isset($dataRequest['ISBN']) ? $dataRequest['ISBN'] : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <input type="submit" class="form-control" value="Tìm kiếm">
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                <!-- /.card-body -->
            </div>
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Tên sách</th>
                            <th>Tác giả</th>
                            <th>Thể loại</th>
                            <th>Nhà xuất bản</th>
                            <th>Ngày xuất bản</th>
                            <th>Số lượng</th>
                            <th>Đã cho mượn</th>
                            <th>Có sẵn</th>
                        </tr>
                        @foreach ($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->genre }}</td>
                                <td>{{ $book->publisher }}</td>
                                <td>{{ $book->publish_date }}</td>
                                <td>{{ $book->quantity }}</td>
                                <td>{{ $book->quantity_lent }}</td>
                                <td>
                                    @if ($roles['edit'] == 1)
                                        <input data-href="{{ route('book.active', ['id' => $book->id]) }}" type="checkbox"
                                            class="available" {{ $book->available == 1 ? 'checked' : '' }}>
                                    @endif

                                </td>
                                <td>
                                    @if ($roles['edit'] == 1)
                                        <a class="btn btn-success"
                                            href="{{ route('book.edit', ['book' => $book->id]) }}">Sửa</a>
                                    @endif
                                    @if ($roles['delete'] == 1)
                                        <button class="btn btn-danger btn_delete"
                                            data-href="{{ route('book.destroy', ['book' => $book->id]) }}">Xóa</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            {{ $books->links() }}
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- jsGrid -->
@endsection
@section('cjs')
    <script>
        $(function() {
            $('.available').on('change', function() {
                if (confirm('Bạn có chắc chắn muốn cập nhật không?')) {
                    let url = $(this).attr('data-href');
                    let check = $(this).prop('checked') ? 1 : 0;

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: {
                            check: check
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.result) {
                                window.location.reload();
                            } else {
                                alert(data.message);
                            }
                        },
                        error: function(error) {
                            console.log(error)
                        }
                    })
                }
            })
        })
    </script>
@endsection
