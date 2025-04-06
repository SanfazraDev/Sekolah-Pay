<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Student\StoreRequest;
use App\Http\Requests\Admin\Student\UpdateRequest;
use App\Http\Resources\Admin\StudentResource;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::query()->when(request('search'), function ($result) {
            $result->where('name', 'like', '%' . request('search') . '%');
        })->latest()->paginate(10);

        $students->appends('search', request('search'));

        $data = [
            'data' => StudentResource::collection($students)->resolve(),
            'links' => $students->linkCollection(),
            'meta' => [
                'from' => $students->firstItem(),
                'to' => $students->lastItem(),
                'total' => $students->total(),
            ],
        ];

        return Inertia::render('Admin/Student/Index', [
            'students' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::query()->select('id', 'name')->get();
        return Inertia::render('Admin/Student/Create', [
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            
            DB::beginTransaction();
            $student = Student::query()->create([
                'classroom_id' => $request->input('classroom_id'),
                'name' => $request->input('name'),
                'nisn' => $request->input('nisn'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'password' => bcrypt($request->input('password')),
                'status' => $request->input('status'),
                'address' => $request->input('address'),
            ]);
            // $student->assignRole('student');
            DB::commit();

            return redirect()->route('admin.students.index')
                ->with('success', 'Data siswa berhasil ditambahkan!')
                ->with('status', 'success');

        } catch (\Throwable $th) {
            
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Data siswa gagal ditambahkan!')
                ->with('status', 'error');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load('classroom');
        return Inertia::render('Admin/Student/Show', [
            'student' => new StudentResource($student),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classrooms = Classroom::query()->select('id', 'name')->get();
        return Inertia::render('Admin/Student/Edit', [
            'student' => new StudentResource($student),
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Student $student)
    {
        try {
            
            DB::beginTransaction();
            $student->update([
                'classroom_id' => $request->input('classroom_id'),
                'name' => $request->input('name'),
                'nisn' => $request->input('nisn'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'status' => $request->input('status'),
                'address' => $request->input('address'),
            ]);
            DB::commit();

            return redirect()->route('admin.students.index')
                ->with('success', 'Data siswa berhasil diubah!')
                ->with('status', 'success');

        } catch (\Throwable $th) {
            
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Data siswa gagal diubah!')
                ->with('status', 'error');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        try {
            
            DB::beginTransaction();
            $student->delete();
            DB::commit();

            return redirect()->route('admin.students.index')
                ->with('success', 'Data siswa berhasil dihapus!')
                ->with('status', 'success');

        } catch (\Throwable $th) {
            
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Data siswa gagal dihapus!')
                ->with('status', 'error');

        }
    }
}
