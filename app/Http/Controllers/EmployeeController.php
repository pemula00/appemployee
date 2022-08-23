<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Employee::where('name','LIKE','%' .$request->search. '%')->paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        } else {
            $data = Employee::paginate(5);
            Session::put('halaman_url', request()->fullUrl());
        }

        return view('datapegawai',[
            "title" => "Data Pegawai"], compact('data'));
    }

    public function tambah()
    {
        return view('tambahdata',[
            "title" => "Tambah Data"],);
    }
    public function insert(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:6|max:40',
            'notelp' => 'required|min:11|max:13'
        ]);

        $data = Employee::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect('pegawai')->with('success','Data Berhasil Disimpan!!');
    }


    public function edit($id)
    {
        $data = Employee::find($id);
        return view('editdata',[
            "title" => "Edit Data"], compact('data'));
    }
    public function update(Request $request, $id)
    {
       $data = Employee::find($id);
       $data->update($request->all());
        if (session('halaman_ufl')) {
            return redirect(session('halaman_url'))->with('success','Data Berhasil Diupdate!!');
        }

       return redirect('pegawai')->with('success','Data Berhasil Diupdate!!');
    }

    public function delete($id)
    {
        $data = Employee::find($id);
        $data->delete();
        return redirect('pegawai')->with('success','Data Berhasil Dihapus!!');
    }

    public function exportpdf()
    {
        $data = Employee::all();
        view()->share('data', $data);
        $pdf = PDF::loadview('datapegawai-pdf');
        return $pdf->download('datapegawai.pdf');
    }

    public function exportexcel()
    {
        return Excel::download(new EmployeeExport, 'datapegawai.xlsx');
    }

    public function importexcel(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('EmployeeData', $namafile);

        Excel::import(new EmployeeImport, \public_path('/EmployeeData/'.$namafile));
        return redirect()->back();
    }
}

