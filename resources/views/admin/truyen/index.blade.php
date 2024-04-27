@extends('layouts.app')

@section('content')
<!-- navbar bootstrap  -->
@include('layouts.nav')

<div class="container">
    <div class="row justify-content-around">
        <div class="col-md-8" style="width: 100%">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="p-2 bd-highlight">{{ __('Danh mục quản lý') }}</div>
                    <a class="btn btn-primary btn-sm" href="{{route('truyen.create')}}" role="button" style="margin: 0.5%;">Thêm mới</a>
                </div>

                <!-- <div class="card-header">{{ __('Danh mục') }}</div> -->

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <!-- Create table -->
                    <div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên truyện</th>
                                    <th scope="col">Slug truyệnc</th>
                                    <th scope="col">Tóm tắt truyện</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list_truyen as $key => $truyen)
                                <tr>
                                    <th scope="row">{{$key}}</th>
                                    <td>{{$truyen -> tentruyen}}</td>
                                    <td>{{$truyen -> slug_truyen}}</td>
                                    <td>{{$truyen -> mota}}</td>
                                    <td>
                                        @if($truyen->tinhtrang == 0)
                                        <span class="text text-success">Đã công bố</span>
                                        @else
                                        <span class="text text-danger">Chưa được công bố</span>
                                        @endif

                                    </td>
                                    <td>
                                        <div class="container" style="display: flex;justify-content: center;">
                                            {{-- edit button --}}
                                            <a class="btn btn-primary" href="{{route('truyen.edit', [$truyen->id])}}" role="button" style="margin-right: 5px">Edit</a>

                                            {{-- delete button --}}
                                            <form action="{{route('truyen.destroy', [$truyen->id])}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger" onclick="return confirm('Dữ liệu sẽ bị xoá, có chắc bạn muốn xoá không?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
{{-- 'truyen' => $truyen->id --}}
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>


@endsection