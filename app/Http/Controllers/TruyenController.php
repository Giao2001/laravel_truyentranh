<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use App\Models\Truyen;
use Illuminate\Http\Request;

class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_truyen = Truyen::with('danhmuc')->orderBy('id', 'desc')->get();
        //dd($list_truyen);

        return view('admin.truyen.index')->with(compact('list_truyen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $danhmuc = Danhmuc::orderBy('id', 'desc')->get();
        return view('admin.truyen.create')->with(compact('danhmuc'));
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
                'ten' => 'required|unique:truyen|max:255',
                'slug' => 'required|unique:truyen|max:255',
                'tomtat' => 'required',
                'tinhtrang' => 'required',
                'danhmuctruyen' => 'required',
                'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            ],
            [
                'ten.required' => '"Tên truyện" không được để trống',
                'slug.required' => '"Slug truyện" không được để trống',
                'tomtat.required' => '"Tóm tắt truyện" không được để trống',
                'hinhanh.required' => '"Hình ảnh" phải được tải lên',
                'danhmuctruyen.required' => '"Danh mục truyện" không được để trống',
                'ten.unique' => '"Tên truyện" đã tồn tại',
                'slug.unique' => '"Slug truyện" đã tồn tại',
            ]
        );
        $truyen = new Truyen();
        $truyen->ten = $validated['ten'];
        $truyen->slug = $validated['slug'];
        $truyen->tomtat = $validated['tomtat'];
        $truyen->tinhtrang = $validated['tinhtrang'];
        $truyen->danhmuc_id = $validated['danhmuctruyen'];

        //upload anh vao folder
        $get_image = $request->hinhanh;
        $path = 'uploads/truyen/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $truyen->hinhanh = $new_image;

        $truyen->save();
        return redirect()->back()->with('status', 'Thêm truyện thành công!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truyen  $truyen
     * @return \Illuminate\Http\Response
     */
    public function show(Truyen $truyen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truyen  $truyen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $truyen = Truyen::find($id);
        $danhmuc = Danhmuc::orderBy('id', 'desc')->get();

        return view('admin.truyen.edit')->with(compact('truyen', 'danhmuc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truyen  $truyen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Truyen $truyen)
    {
        $validated = $request->validate(
            [
                'ten' => 'required|max:255',
                'slug' => 'required|max:255',
                'tomtat' => 'required',
                'tinhtrang' => 'required',
                'danhmuctruyen' => 'required',
                //'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            ],
            [
                'ten.required' => '"Tên truyện" không được để trống',
                'slug.required' => '"Slug truyện" không được để trống',
                'tomtat.required' => '"Tóm tắt truyện" không được để trống',
                //'hinhanh.required' => '"Hình ảnh" phải được tải lên',
                'danhmuctruyen.required' => '"Danh mục truyện" không được để trống',

            ]
        );
        $truyen = Truyen::find($truyen->id);
        $truyen->ten = $validated['ten'];
        $truyen->slug = $validated['slug'];
        $truyen->tomtat = $validated['tomtat'];
        $truyen->tinhtrang = $validated['tinhtrang'];
        $truyen->danhmuc_id = $validated['danhmuctruyen'];


        //upload anh vao folder
        $get_image = $request->hinhanh;
        if ($get_image) {
            $path = 'uploads/truyen/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $truyen->hinhanh = $new_image;
        }

        $truyen->save();


        return redirect()->back()->with('status', 'Thêm truyện thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truyen  $truyen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $truyen = Truyen::find($id);
        $path = 'uploads/truyen/' . $truyen->hinhanh;
        if (file_exists($path)) {
            unlink($path);
        }
        Truyen::find($id)->delete();
        return redirect()->back()->with('status', 'Xoá truyện thành công!');
    }
}
