<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Batch;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Batch\StoreRequest;
use App\Http\Requests\Admin\Batch\UpdateRequest;
use App\Http\Resources\Admin\BatchResource;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batches = Batch::query()->when(request('search'), function($result) {
            $result->where('title', 'like', '%'.request('search').'%');
        })->latest()->paginate(10);

        $batches->appends('search', request('search'));

        // $batches->transform(function($batch) {
        //     return new BatchResource($batch);
        // });

        $data = [
            'data' => BatchResource::collection($batches)->resolve(),
            'links' => $batches->linkCollection(),
            'meta' => [
                'from' => $batches->firstItem(),
                'to' => $batches->lastItem(),
                'total' => $batches->total(),
            ],
        ];

        return Inertia::render('Admin/Batches/Index', [
            'batches' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Batches/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {   
        try {
            
            DB::transaction(function() use ($request) {

                $batch = Batch::query()->create([
                    'title' => $request->input('title'),
                    'slug' => Str::slug($request->input('title')),
                ]);

            });

            return redirect()->route('admin.batches.index')->with('success', 'Data Angkatan berhasil disimpan!');

        } catch (\Throwable $th) {
            
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data angkatan, silahkan di coba kembali');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Batch $batch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Batch $batch)
    {
        return Inertia::render('Admin/Batches/Edit', [
            'batch' => $batch
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Batch $batch)
    {
        try {
            
            DB::beginTransaction();
            $batch->update([
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('title')),
            ]);
            DB::commit();
            
            return redirect()->route('admin.batches.index')
                ->with('success', 'Data Angkatan berhasil diubah')
                ->with('status', 'success');
                
        } catch (\Throwable $th) {
            
            DB::rollBack();
            return back()->with('error', 'Gagal mengubah data angkatan')
                ->with('status', 'error')
                ->withInput();

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batch $batch)
    {
        try {
            
            DB::beginTransaction();
            $batch->delete();
            DB::commit();

            return redirect()->back()
                ->with('success', 'Data Angkatan berhasil dihapus')
                ->with('status', 'success');

        } catch (\Throwable $th) {
            
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Gagal menghapus Data Angkatan!')
                ->with('status', 'error');

        }
    }
}
