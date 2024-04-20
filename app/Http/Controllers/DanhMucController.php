<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use Illuminate\Http\Request;


class DanhMucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DanhMuc::all();
        return view('admin.danhmuc.index')->with(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.danhmuc.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'tendanhmuc' => 'required|unique:danhmuc|max:255',
                'motadanhmuc' => 'required|max:255',
                'tinhtrang' => 'required',
            ],
            [
                'tendanhmuc.required' => '"Tên danh mục" không được để trống',
                'motadanhmuc.required' => '"Mô tả danh mục" không được để trống',
                'tendanhmuc.unique' => '"Tên danh mục" đã tồn tại',

            ]
        );
        $danhmuctruyen = new DanhMuc();
        $danhmuctruyen->tendanhmuc = $validated['tendanhmuc'];
        $danhmuctruyen->mota = $validated['motadanhmuc'];
        $danhmuctruyen->tinhtrang = $validated['tinhtrang'];
        $danhmuctruyen->save();
        return redirect()->back()->with('status', 'Thêm danh mục thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DanhMuc  $danhMuc
     * @return \Illuminate\Http\Response
     */
    public function show(DanhMuc $danhMuc)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DanhMuc  $danhMuc
     * @return \Illuminate\Http\Response
     */
    public function edit(DanhMuc $danhmuc)
    {
        Danhmuc::find($danhmuc->id);
        return view('admin.danhmuc.edit')->with(compact('danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DanhMuc  $danhMuc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DanhMuc $danhmuc)
    {
        $validated = $request->validate(
            [
                'tendanhmuc' => 'required|max:255',
                'motadanhmuc' => 'required|max:255',
                'tinhtrang' => 'required',
            ],
            [
                'tendanhmuc.required' => '"Tên danh mục" không được để trống',
                'motadanhmuc.required' => '"Mô tả danh mục" không được để trống',
            ]
        );
        $danhmuctruyen = Danhmuc::find($danhmuc->id);
        $danhmuctruyen->tendanhmuc = $validated['tendanhmuc'];
        $danhmuctruyen->mota = $validated['motadanhmuc'];
        $danhmuctruyen->tinhtrang = $validated['tinhtrang'];
        $danhmuctruyen->save();
        return redirect()->back()->with('status', 'Cập nhật danh mục thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DanhMuc  $danhMuc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Danhmuc::find($id)->delete();
        return redirect()->back()->with('status', 'Xoá danh mục thành công!');
    }
}
