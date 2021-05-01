<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BannerRequest;

// Models
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'desc')->get();

        return view('pages.admins.banner.index', [
            'title' => 'Banner',
            'banners' => $banners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admins.banner.create', ['title' => 'Banner']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        $bannerRequests = $request->validated();

        $banners = Banner::all();
        
        $filePath = 'images/banner';

        $bannerRequests['gallery_path'] = $request->file('gallery_path')->store($filePath, 'public');

        $bannerRequests['status'] = $banners->count() < 3 ? 1 : 0;

        Banner::create($bannerRequests);

        return redirect()
                    ->route('admins.banners.index')
                    ->with('alert-store-success', 'Gambar banner berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);

        $banner->delete();
        
        return redirect()
                    ->route('admins.banners.index')
                    ->with('alert-delete-success', 'Gambar banner berhasil dihapus.');
    }

    public function updateStatus(Request $request, $id) {
        $baner = Banner::find($id);

        $baner->status = $request->status == 0 ? 1 : 0;
        $baner->save();

        return redirect()
                ->route('admins.banners.index')
                ->with('alert-update-status-success', 'Status gambar banner berhasil diubah.'); 
    }
}
