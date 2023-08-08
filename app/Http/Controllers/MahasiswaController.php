<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Intervention\Image\Image as image;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required',
            'survei' => 'required',
            'name' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'univ' => 'required',
            'hp' => 'required',
            'peruntuk' => 'required',
            'perolehan' => 'required',
            'bentuk_informasi' => 'required',
            'surat_LP' => 'required',
            'surat_0' => 'required',
            'proposal' => 'required',
            'ktp' => 'required',
            'ktm' => 'required',
            'jenis_informasi' => 'required',
            'unsur' => 'required',
            'ket' => 'required|min:8',
            'lokasi' => 'required',
            'PWaktu' => 'required',
            'panjang_data' => 'required'
        ]);

        // Artikel
        $storage = "storage/file-materi";
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->ket, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                $filePath = ("$storage/$fileNameContentRand.$mimetype");
                $image = image::make($src)->encode($mimetype, 100)->save(public_path($filePath));
                $new_src = asset($filePath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        if ($request->file('survei')) {
            $validatedData['survei'] = $request->file('survei')->store('file-survei');
        }

        if ($request->file('surat_LP')) {
            $validatedData['surat_LP'] = $request->file('surat_LP')->store('file-surat_LP');
        }

        if ($request->file('surat_0')) {
            $validatedData['surat_0'] = $request->file('surat_0')->store('file-surat_0');
        }

        if ($request->file('proposal')) {
            $validatedData['proposal'] = $request->file('proposal')->store('file-proposal');
        }

        if ($request->file('ktp')) {
            $validatedData['ktp'] = $request->file('ktp')->store('file-ktp');
        }

        if ($request->file('ktm')) {
            $validatedData['ktm'] = $request->file('ktm')->store('file-ktm');
        }

        $unsur = $request->input('unsur');

        if (!empty($unsur)) {
            $validatedData['unsur'] = json_encode($unsur);
        }

        $jenis_informasi = $request->input('jenis_informasi');

        if (!empty($jenis_informasi)) {
            $validatedData['jenis_informasi'] = json_encode($jenis_informasi);
        }

        Mahasiswa::create(array_merge(
            ['ket' => $dom->saveHTML()],
            $validatedData,
        ));


        return redirect('/mahasiswa')->with('success', 'Permintaan berhasil dibuat');
    }
}
