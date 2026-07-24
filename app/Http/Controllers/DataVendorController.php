<?php

namespace App\Http\Controllers;

use App\Models\DataVendor;
use Illuminate\Http\Request;

class DataVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $data;
    public function __construct()
    {
        $this->data = new DataVendor();
    }
    public function index()
    {
        try {
            $data = $this->data::all();
            return response()->json([
                "msg" => "success",
                "data" => $data
            ]);
        } catch (\Exception $th) {
            return response()->json([
                "msg" => $th->getMessage()
            ]);
        }
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
        try {
            //code...

            $nama_perusahaan = $request->nama_perusahaan;
            $alamat = $request->alamat;
            $pic = $request->pic;
            $cp = $request->cp;
            $provinsi = $request->provinsi;
            $kota = $request->kota;
            $kecamatan = $request->kecamatan;
            $kode_pos = $request->kode_pos;
            $email_perusahaan = $request->email_perusahaan;

            $data = [
                "nama_perusahaan" => $nama_perusahaan,
                "alamat" => $alamat,
                "pic" => $pic,
                "cp" => $cp,
                "provinsi" => $provinsi,
                "kota" => $kota,
                "kecamatan" => $kecamatan,
                "kode_pos" => $kode_pos,
                "email_perusahaan" => $email_perusahaan,
            ];
            $req = $this->data::create($data);
            if ($req) {
                return response()->json([
                    "msg" => "success",
                ]);
            }
        } catch (\Exception $th) {
            return response()->json([
                "msg" => $th->getMessage()
            ]);
        }
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
