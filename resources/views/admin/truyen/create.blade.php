@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center" style="margin: 1%">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="p-2 bd-highlight" style="font-weight: bold;">{{ __('Tạo sách truyện') }}</div>

                </div>

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
                    <form method="POST" action="{{route('truyen.store')}}" enctype='multipart/form-data'>
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên truyện</label>
                            <input type="text" id="slug" name="ten" value="{{old('ten')}}" onkeyup="ChangeToSlug()" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Slug truyện</label>
                            <input type="text" id="convert_slug" name="slug" value="{{old('slug')}}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Tóm tắt truyện</label>
                            <textarea class="form-control" rows="5" style="resize: none" name="tomtat" value="{{old('tomtat')}}" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <label for="exampleInputEmail1" class="form-label">Danh mục truyện</label>
                        <select class="form-select form-select-lg mb-3" name="danhmuctruyen" value="{{old('danhmuctruyen')}}" aria-label=".form-select-lg example">
                            @foreach ($danhmuc as $key => $data)
                                <option value="{{$data->id}}">{{$data->tendanhmuc}}</option>
                            @endforeach
                        </select>

                        <label for="inputGroupFile02" class="form-label">Hình ảnh</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="inputGroupFile02" name="hinhanh">
                            <label class="input-group-file" for="inputGroupFile02"></label>
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