<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DescriptionRequest;

// Models
use App\Models\Description;

class DescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $descriptions = Description::orderBy('created_at', 'desc')->get();

        return view('pages.admins.description.index', [
            'title' => 'Deskripsi',
            'descriptions' => $descriptions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admins.description.create', ['title' => 'Deskripsi']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DescriptionRequest $request)
    {
        $descriptionRequests = $request->validated();

        $descriptions = Description::all();

        $descriptionRequests['status'] = $descriptions->count() < 1 ? 1 : 0;

        Description::create($descriptionRequests);

        return redirect()
                    ->route('admins.descriptions.index')
                    ->with('alert-store-success', 'Deskripsi berhasil ditambahkan.');
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
    public function update(Request $request, $id)
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
        $description = Description::find($id);

        $description->delete();
        
        return redirect()
                    ->route('admins.descriptions.index')
                    ->with('alert-delete-success', 'Deskripsi berhasil dihapus.');
    }

    public function updateStatus(Request $request, $id) {
        $activeDescription = Description::where('status', 1)->count();

        if($request->active == 1) {
            if($activeDescription < 1) {
                $description = Description::find($id);

                $description->status = $request->status == 0 ? 1 : 0;

                $description->save();

                return redirect()
                        ->route('admins.descriptions.index')
                        ->with('alert-update-status-success', 'Status Deskripsi berhasil diubah.'); 
            }

            return redirect()
                    ->back()
                    ->with('alert-update-failed', 'Status deskripsi gagal diubah, deskripsi maksimal hanya 1 yang aktif, harap non-aktifkan salah satu deskripsi yang aktif');
        } else {
            $description = Description::find($id);

            $description->status = $request->status == 0 ? 1 : 0;

            $description->save();
    
            return redirect()
                    ->back()
                    ->with('alert-update-success', 'Status deskripsi berhasil diubah.');
        }
    }
}
