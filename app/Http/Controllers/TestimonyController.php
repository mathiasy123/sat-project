<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TestimonyRequest;

// Models
use App\Models\Testimony;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonies = Testimony::orderBy('created_at', 'desc')->get();

        return view('pages.admins.testimony.index', [
            'title' => 'Testimoni',
            'testimonies' => $testimonies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admins.testimony.create', ['title' => 'Testimoni']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonyRequest $request)
    {
        $testimonyRequests = $request->validated();
        $testimonyRequests['status'] = 1;

        Testimony::create($testimonyRequests);

        return redirect()
                ->route('admins.testimonies.index')
                ->with('alert-store-success', 'Testimoni berhasil ditambahkan.');
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
        $testimony = Testimony::find($id);

        if($testimony) {
            return view('pages.admins.testimony.edit', [
                'title' => 'Testimoni',
                'testimony' => $testimony
            ]);
        }

        return redirect()
                ->route('admins.testimonies.index')
                ->with('alert-not-found', 'Testimoni ini tidak ditemukan.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonyRequest $request, $id)
    {
        $testimony = Testimony::find($id);

        $testimony->update($request->validated());

        return redirect()
                ->route('admins.testimonies.index')
                ->with('alert-update-success', 'Testimoni berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimony = Testimony::find($id);

        $testimony->delete();

        return redirect()
                ->route('admins.testimonies.index')
                ->with('alert-delete-success', 'Testimoni berhasil dihapus.'); 
    }

    public function updateStatus(Request $request, $id) {
        $testimony = Testimony::find($id);

        $testimony->status = $request->status == 0 ? 1 : 0;
        $testimony->save();

        return redirect()
                ->route('admins.testimonies.index')
                ->with('alert-update-status-success', 'Status testimoni berhasil diubah.'); 
    }
}
