<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class activityLog extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $aktivitasGalih = Activity::orderBy('created_at', 'desc');

        if ($request->date1 and $request->date2) {
            $aktivitasGalih->whereBetween('created_at', [$request->date1, $request->date2]);
        }
        if ($request->nama) {
            $aktivitasGalih->whereHas('users', fn($q) => $q->where('nama_lengkap', 'like', '%' . $request->nama . '%'));
        }

        $dataGalih['aktivitasGalih'] = $aktivitasGalih->paginate(10);
        return view('admin.activityLog.activityLog', $dataGalih);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
