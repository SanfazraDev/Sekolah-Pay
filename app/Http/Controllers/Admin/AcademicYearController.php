<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Support\Str;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AcademicYear\StoreRequest;
use App\Http\Requests\Admin\AcademicYear\UpdateRequest;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academicYears = AcademicYear::query()->when(request('search'), function ($result) {
            $result->where('title', 'like', '%' . request('search') . '%');
        })->latest()->paginate(10);

        $academicYears->appends('search', request('search'));

        $data = [
            'data' => $academicYears->items(),
            'links' => $academicYears->linkCollection(),
            'meta' => [
                'from' => $academicYears->firstItem(),
                'to' => $academicYears->lastItem(),
                'total' => $academicYears->total(),
            ],
        ];

        return Inertia::render('Admin/AcademicYear/Index', [
            'academicYears' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/AcademicYear/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            
            DB::beginTransaction();
            $academicYear = AcademicYear::query()->create([
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('title')),
            ]);
            DB::commit();

            return redirect()->route('admin.academic.years.index')
                ->with('success', 'Data Tahun Ajaran Berhasil Ditambahkan!')
                ->with('status', 'success');

        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->route('admin.academic.years.index')
                ->with('error', 'Data Tahun Ajaran Gagal Ditambahkan!')
                ->with('status', 'error');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicYear $academicYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicYear $academicYear)
    {
        return Inertia::render('Admin/AcademicYear/Edit', [
            'academicYear' => $academicYear
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, AcademicYear $academicYear)
    {
        try {
            
            DB::beginTransaction();
            $academicYear->update([
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('title')),
            ]);
            DB::commit();

            return redirect()->route('admin.academic.years.index')
                ->with('success', 'Data Tahun Ajaran Berhasil Diubah!')
                ->with('status', 'success');

        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->route('admin.academic.years.index')
                ->with('error', 'Data Tahun Ajaran Gagal Diubah!')
                ->with('status', 'error');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicYear $academicYear)
    {
        try {
            
            DB::beginTransaction();
            $academicYear->delete();
            DB::commit();

            return redirect()->route('admin.academic.years.index')
                ->with('success', 'Data Tahun Ajaran Berhasil Dihapus!')
                ->with('status', 'success');

        } catch (\Throwable $th) {

            DB::rollBack();

            return redirect()->route('admin.academic.years.index')
                ->with('error', 'Data Tahun Ajaran Gagal Dihapus!')
                ->with('status', 'error');

        }
    }
}
