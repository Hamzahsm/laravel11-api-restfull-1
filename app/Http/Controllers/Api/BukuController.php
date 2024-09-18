<?php

namespace App\Http\Controllers\Api;

use App\Models\Buku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //controller untuk back end 
    public function index()
    {
        $data = Buku::orderBy('judul', 'asc')->paginate(10);
        return response()->json([
            'status' =>true,
            'message' => 'Data Ditemukan',
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $dataBuku = new Buku;

        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Gagal memasukkan data !',
                'data' => $validator->errors(),
            ]);
        }

        $dataBuku->judul = $request->judul;
        $dataBuku->pengarang = $request->pengarang;
        $dataBuku->tanggal_publikasi = $request->tanggal_publikasi;

        $post = $dataBuku->save();

        return response()->json([
            'status' =>true,
            'message' => 'Berhasil menambahkan Data !',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = Buku::find($id);
        if($data) {
            return response()->json([
                'status' =>true,
                'message' => 'Data Ditemukan',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 'false',
                'message' => 'Data tidak ditemukan !',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $dataBuku = Buku::find($id);
        //jika tidak ada beritahu keterangan
        if(empty($dataBuku)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan !',
            ], 404);
        }

        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            'tanggal_publikasi' => 'required|date',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status' => 'false',
                'message' => 'Gagal memperbarui data !',
                'data' => $validator->errors(),
            ]);
        }

        $dataBuku->judul = $request->judul;
        $dataBuku->pengarang = $request->pengarang;
        $dataBuku->tanggal_publikasi = $request->tanggal_publikasi;

        $post = $dataBuku->save();

        return response()->json([
            'status' =>true,
            'message' => 'Berhasil memperbarui Data !',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         //
         $dataBuku = Buku::find($id);
         //jika tidak ada beritahu keterangan
         if(empty($dataBuku)) {
             return response()->json([
                 'status' => false,
                 'message' => 'Data tidak ditemukan !',
             ], 404);
         }
         $post = $dataBuku->delete();
 
         return response()->json([
             'status' =>true,
             'message' => 'Berhasil menghapus Data !',
         ]);

    }
}
