@extends('layouts.app')

@section('content')
@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center" style="margin: 1%">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="p-2 bd-highlight" style="font-weight: bold;">{{ __('Sửa danh mục') }}</div>

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
                    <form method="POST" action="{{route('danhmuc.update', [$danhmuc->id])}}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên danh mục</label>
                            <input type="text" name="tendanhmuc" value="{{$danhmuc->tendanhmuc}}" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên danh mục</label>
                            <input type="text" name="slug_danhmuc" value="{{$danhmuc->slug_danhmuc}}" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="describe" class="form-label">Mô tả danh mục</label>
                            <input type="text" name="motadanhmuc" class="form-control" value="{{$danhmuc->mota}}" id="describe">
                        </div>

                        <label for="exampleInputEmail1" class="form-label">Tình trạng</label>
                        <select class="form-select form-select-lg mb-3" name="tinhtrang" value="{{$danhmuc->tinhtrang}}" aria-label=".form-select-lg example">
                            @if ($danhmuc->tinhtrang == 0)
                                <option selected value="0">Đã công bố</option>
                                <option value="1">Chưa được công bố</option>
                            @else
                                <option value="0">Đã công bố</option>
                                <option selected value="1">Chưa được công bố</option>
                            @endif
                            
                        </select>
                        <button type="submit" class="btn btn-primary" style="width: 80px">Lưu</button>

                    </form>

                </div>
            </div>


        </div>


    </div>
</div>
@endsection