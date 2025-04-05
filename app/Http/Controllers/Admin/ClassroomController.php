<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ClassroomResource;
use App\Http\Requests\Admin\Classroom\StoreRequest;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::query()->when(request('search'), function($result) {
            $result->where('name', 'like', '%' . request('search') . '%');
        })->latest()->paginate(10);

        $classrooms->appends('search', request('search'));

        $data = [
            'data' => ClassroomResource::collection($classrooms)->resolve(),
            'links' => $classrooms->linkCollection(),
            'meta' => [
                'from' => $classrooms->firstItem(),
                'to' => $classrooms->lastItem(),
                'total' => $classrooms->total(),
            ],
        ];

        return Inertia::render('Admin/Classroom/Index', [
            'classrooms' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Classroom/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            
            DB::beginTransaction();
            $classroom = Classroom::query()->create([
                'name' => $request->input('name'),
                'slug' => Str::slug($request->input('name')),
            ]);
            DB::commit();

            return redirect()->route('admin.classrooms.index')
                ->with('success', 'Data Kelas berhasil ditambahkan!')
                ->with('status', 'success');
                

        } catch (\Throwable $th) {
            
            DB::rollBack();

            return redirect()->route('admin.classrooms.index')
                ->with('error', 'Data Kelas gagal ditambahkan!')
                ->with('status', 'error');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        return Inertia::render('Admin/Classroom/Edit', [
            'classroom' => new ClassroomResource($classroom),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        try {
            
            DB::beginTransaction();
            $classroom->update([
                'name' => $request->input('name'),
                'slug' => Str::slug($request->input('name')),
            ]);
            DB::commit();

            return redirect()->route('admin.classrooms.index')
                ->with('success', 'Data Kelas berhasil diubah!')
                ->with('status', 'success');

        } catch (\Throwable $th) {
            
            DB::rollBack();

            return redirect()->route('admin.classrooms.index')
                ->with('error', 'Data Kelas gagal diubah!')
                ->with('status', 'error');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        try {
            
            DB::beginTransaction();
            $classroom->delete();
            DB::commit();

            return redirect()->route('admin.classrooms.index')
                ->with('success', 'Data Kelas berhasil dihapus!')
                ->with('status', 'success');

        } catch (\Throwable $th) {
            
            DB::rollBack();

            return redirect()->route('admin.classrooms.index')
                ->with('error', 'Data Kelas gagal dihapus!')
                ->with('status', 'error');

        }
    }
}
