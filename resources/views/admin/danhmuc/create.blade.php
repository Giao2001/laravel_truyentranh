@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center" style="margin: 1%">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="p-2 bd-highlight" style="font-weight: bold;">{{ __('Tạo danh mục') }}</div>

                </div>

                <!-- <div class="card-header">{{ __('Danh mục') }}</div> -->

                <div class="card-body ">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif




                    <!-- Displaying The Validation Errors -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!-- Form -->
                    <form method="POST" action="{{route('danhmuc.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tên danh mục</label>
                            <input type="email" name="tendanhmuc" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Mô tả danh mục</label>
                            <input type="email" name="motadanhmuc" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>

                        <label for="exampleInputEmail1" class="form-label">Tình trạng</label>
                        <select class="form-select form-select-lg mb-3" name="tinhtrang" aria-label=".form-select-lg example">
                            <option value="0">Đã công bố</option>
                            <option value="1">Chưa được công bố</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Lưu và thêm mới</button>

                    </form>

                </div>
            </div>


        </div>


    </div>
</div>
@endsection