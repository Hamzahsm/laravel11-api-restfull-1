<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client; //pastikan sudah include class ini 
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // akses ke api menggunakan class guzzle http cek di composer.json kalau belum ada install -> composer require guzzlehttp/guzzle
        $client = new Client();
        $url = "http://127.0.0.1:8000/api/buku"; // alamat api
        $response = $client->request('GET', $url); //request berisi method get,put,post,patch
        // dd($response); //cek apakah sudah dapat data
        $content = $response->getBody()->getContents(); //menampilkan isi body data dari api, dalam bentuk json 
        // echo $content = $response->getStatusCode(); //menampilkan isi body data dari api, dalam bentuk json 
        $contentArray = json_decode($content, true); //mengubah json ke dalam array
        $data = $contentArray['data']; //setelah berhasil di rubah jadi array, kita ambil method datanya
        // print_r($data);
        return view('posts.index' , [
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
