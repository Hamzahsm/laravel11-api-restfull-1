<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // controller untuk front-end
    public function index()
    {
        //
        $client = new Client(); //guzzle http
        $url = "http://127.0.0.1:8000/api/buku";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents(); //mengambil content di body
        $contentArray = json_decode($content, true);
        $data = $contentArray['data']; //berhasil ambil data
        return view('buku.index', [
            'data' => $data,
        ]);

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
        $judul = $request->judul;
        $pengarang = $request->pengarang;
        $tanggal_publikasi = $request->tanggal_publikasi;
        $parameter = [
            'judul' => $judul,
            'pengarang' => $pengarang,
            'tanggal_publikasi' => $tanggal_publikasi,
        ];

        $client = new Client(); //guzzle http
        $url = "http://127.0.0.1:8000/api/buku";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter), //mengubah dari array to json
        ]); //method menggunakan post
        $content = $response->getBody()->getContents(); //mengambil content di body
        $contentArray = json_decode($content, true);
        if($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('buku')->withErrors($error)->withInput();
        } else {
            return redirect()->to('buku')->with('success', 'berhasil menambahkan data !');
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
        $client = new Client(); //guzzle http
        $url = "http://127.0.0.1:8000/api/buku/$id"; //tambahkan id / parameter slug di belakang url
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents(); //mengambil content di body
        $contentArray = json_decode($content, true);
        if($contentArray['status'] != true) {
            $error = $contentArray['message'];
            return redirect()->to('buku')->withErrors($error);
        } else {
            $data = $contentArray['data'];
            return view('buku.index', [
                'data' => $data,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $judul = $request->judul;
        $pengarang = $request->pengarang;
        $tanggal_publikasi = $request->tanggal_publikasi;
        $parameter = [
            'judul' => $judul,
            'pengarang' => $pengarang,
            'tanggal_publikasi' => $tanggal_publikasi,
        ];

        $client = new Client(); //guzzle http
        $url = "http://127.0.0.1:8000/api/buku/$id";
        $response = $client->request('PUT', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter), //mengubah dari array to json
        ]); //method menggunakan post
        $content = $response->getBody()->getContents(); //mengambil content di body
        $contentArray = json_decode($content, true);
        if($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('buku')->withErrors($error)->withInput();
        } else {
            return redirect()->to('buku')->with('success', 'berhasil update data !');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $client = new Client(); //guzzle http
        $url = "http://127.0.0.1:8000/api/buku/$id";
        $response = $client->request('DELETE', $url); //method menggunakan post
        $content = $response->getBody()->getContents(); //mengambil content di body
        $contentArray = json_decode($content, true);
        if($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('buku')->withErrors($error)->withInput();
        } else {
            return redirect()->to('buku')->with('success', 'berhasil menghapus data !');
        }
    }
}
