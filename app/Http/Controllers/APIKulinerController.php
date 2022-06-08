<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\WisataKuliner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class APIKulinerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            "wisatas" => WisataKuliner::latest()->filter(request(['search']))->get()
        ];
        return response($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // //
        // try {
        //     $this->validate($request, [
        //         'category_id' => "required",
        //         'nama_tempat' => "required",
        //         'alamat' => 'required',
        //         'deskripsi' => 'required|max:2056',
        //         'gambar' => "required|mimes:jpeg,jpg,png"
        //     ]);

        //     $url = $request->file('gambar')->store('kuliner');

        //     WisataKuliner::create([
        //         'category_id' => $request->category_id,
        //         'nama_tempat' => $request->nama_tempat,
        //         'alamat' => $request->alamat,
        //         'deskripsi' => $request->deskripsi,
        //         'gambar' => "storage/" . $url
        //     ]);
        //     return redirect('/');
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     dd($e);
        //     return response("form yang diisi tidak valid", 400);
        // } catch (\Exception $e) {
        //     dd($e);
        //     return response("Internal Server Error", 500);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WisataKuliner  $wisataKuliner
     * @return \Illuminate\Http\Response
     */
    public function show(WisataKuliner $wisataKuliner)
    {
        // $comments = Comment::all();
        $comments = Comment::where('kuliner_id', $wisataKuliner->id)->get();

        return view('profileKuliner', [
            "profil" => $wisataKuliner,
            "comments" => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WisataKuliner  $wisataKuliner
     * @return \Illuminate\Http\Response
     */
    public function edit(WisataKuliner $wisataKuliner)
    {
        // return view('editKuliner',[
        //     "kuliner" => $wisataKuliner
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WisataKuliner  $wisataKuliner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WisataKuliner $wisataKuliner)
    {
        // try {

        //     // $url = $request->file('gambar')->store('kuliner');

        //     // DB::table('wisata_kuliners')->where('id',$request->id)->update([
        //     //     'category_id' => $request->category_id,
        //     //     'nama_tempat' => $request->nama_tempat,
        //     //     'alamat' => $request->alamat,
        //     //     'deskripsi' => $request->deskripsi,
        //     //     'gambar' => "storage/" . $url
        //     // ]);

        //     $this->validate($request, [
        //         'category_id' => "required",
        //         'nama_tempat' => "required",
        //         'alamat' => 'required',
        //         'deskripsi' => 'required|max:2056',
        //         'gambar' => "mimes:jpeg,jpg,png"
        //     ]);

        //     $kulinerUpdate = WisataKuliner::where('id', $wisataKuliner->id);

        //     if ($request->hasFile("gambar")) {
        //         $url = $request->file('gambar')->store('kuliner');

        //         File::delete($wisataKuliner->gambar);


        //         $kulinerUpdate->update([
        //             'category_id' => $request->category_id,
        //             'nama_tempat' => $request->nama_tempat,
        //             'alamat' => $request->alamat,
        //             'deskripsi' => $request->deskripsi,
        //             'gambar' => "storage/" . $url
        //         ]);

        //     }else{

        //         $kulinerUpdate->update([
        //             'category_id' => $request->category_id,
        //             'nama_tempat' => $request->nama_tempat,
        //             'alamat' => $request->alamat,
        //             'deskripsi' => $request->deskripsi,
        //         ]);

        //     }
        //     // dd($kulinerUpdate);
        //     return redirect('/wisata')->with('success', 'edit berhasil');
        // } catch (\Exception $e) {
        //     dd($e);
        //     return redirect('/wisata')->with('error', 'Edit user gagal');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WisataKuliner  $wisataKuliner
     * @return \Illuminate\Http\Response
     */
    public function destroy(WisataKuliner $wisataKuliner)
    {
        // try{
        //     WisataKuliner::where('id', $wisataKuliner->id)->delete();
        // } catch (\Exception $e) {
        //     dd($e);
        // }
        // return redirect('/wisata')->with('success', 'Post berhasil dihapus');
    }
}
