@extends('layout.main')

@section('content')
    <div class="container">
        <h1 class="text-center text-info">Form Layanan</h1>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <ul class="nav nav-pills p-5">
                    <li class="nav-item col-4 p-2">
                        <a class="nav-link p-3 border" aria-current="page" href="{{ route('umum.index') }}">
                            <img src="{{ asset('asset/image/umum.webp') }}" alt=""
                                style="background-size: cover; width: 30%; " loading="lazy">
                            Umum
                        </a>
                    </li>
                    <li class="nav-item col-4 p-2">
                        <a class="nav-link p-3 active border" aria-current="page" href="{{ route('instansi.index') }}">
                            <img src="{{ asset('asset/image/kantor.webp') }}" alt=""
                                style="background-size: cover; width: 20%" loading="lazy">
                            Instansi
                        </a>
                    </li>
                    <li class="nav-item col-4 p-2">
                        <a class="nav-link p-3 border" aria-current="page" href="{{ route('mahasiswa.index') }}">
                            <img src="{{ asset('asset/image/mahasiswa.webp') }}" alt=""
                                style="background-size: cover; width: 24%" loading="lazy">
                            Mahasiswa
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <section class="px-5">
            <p class="fw-bold fs-5">Berdasarkan Peraturan Badan Metereologi, Klimatologi, dan Geofisika No. 12 Tahun 2019
                Tentang Tarif Rp. 0,00 dan Peraturan Kepala Badan Metereologi, Klimatologi, dan Geofisika No. 20 Tahun 2014.
                Kegiatan pengenaan tarif sebesar Rp. 0,00 (nol rupiah) terdapat beberapa persyaratan sebagai berikut :</p>
            <ol>
                <li>Melampirkan identitas diri pemohon.</li>
                <li>Melampirkan surat pengantar dari Instansi ditujukan kepada Stasiun Klimatologi Riau.</li>
                <li>Melampirkan proposal kegiatan.</li>
                <li>Cakupan lokasi dan waktu informasi maksimal 2 titik lokasi selama 2 tahun.</li>
            </ol>
            <p>Isi<a href="https://eskm.bmkg.go.id/survey/418106/0/1/2022-04/2022/0" style="text-decoration: none"> survey
                    kepuasan masyarakat</a> sebelum mengisi <span class="fw-bold">Form</span> dibawah ini, lalu unggah bukti
                <i>screenshoot</i> jika sudah
                selesai mengisi survey.
            </p>
            <form action="{{ route('instansi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                 {{--  ALERT  --}}
                 <div class="row mt-3">
                    <div class="col">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session()->has('failed'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('failed') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>
                {{--  ALERT  --}}
                <input type="hidden" name="status" value="0" id="">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Unggah bukti pengisian survey (PNG, JPG, JPEG, PDF)</label>
                    <input class="form-control" type="file" id="formFile" name="survei">
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap Sesuai KTP</label>
                            <input type="name" class="form-control" id="name" placeholder="Anton" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Pemohon</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="name" class="form-control" id="alamat" placeholder="Alamat" name="alamat">
                        </div>
                        <div class="mb-3">
                            <label for="perolehanData" class="form-label">Pilih Cara Perolehan Data</label>
                            <select class="form-select" aria-label="Default select example" name="perolehan">
                                <option selected>Pilih Cara Perolehan Data</option>
                                <option value="Langsung">Langsung</option>
                                <option value="Link Web">Link Web</option>
                                <option value="Pos">Pos</option>
                                <option value="Fax">Fax</option>
                                <option value="E-Mail">E-Mail</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="perusahaan" class="form-label">Nama Perusahaan/Instansi</label>
                            <input type="name" class="form-control" id="perusahaan"
                                placeholder="Nama Perusahaan/Instansi" name="instansi">
                        </div>
                        <div class="mb-3">
                            <label for="noHp" class="form-label">Nomor HP/WA</label>
                            <input type="number" class="form-control" id="noHp" placeholder="No Hp/Wa" name="hp">
                        </div>
                        <div class="mb-3">
                            <label for="peruntukanData" class="form-label">Peruntukan Data</label>
                            <input type="name" class="form-control" id="peruntukanData" placeholder="Peruntukan Data" name="peruntuk">
                        </div>
                        <div class="mb-3">
                            <label for="bentukInformasi" class="form-label">Pilih Bentuk Informasi</label>
                            <select class="form-select" aria-label="Default select example" name="bentuk_informasi">
                                <option selected>Pilih Bentuk Informasi</option>
                                <option value="Tercetak">Tercetak</option>
                                <option value="Terekam">Terekam</option>
                                <option value="Soft File">Soft File</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Proposal Kegiatan
                        (PDF)</label>
                    <input class="form-control" type="file" id="formFile" name="proposal">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Surat Permohonan Ditandatangani Oleh Kepala Instansi/Pejabat
                        Instansi
                        (PNG,
                        JPG, JPEG, PDF)</label>
                    <input class="form-control" type="file" id="formFile" name="surat_LP">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">KTP (PNG, JPG, JPEG, PDF)</label>
                    <input class="form-control" type="file" id="formFile" name="ktp">
                </div>
                <div class="row">
                    <div class="col">
                        <label for="formFile" class="form-label">Pilih Unsur</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="suhu" id="flexCheckDefault" name="unsur[]">
                            <label class="form-check-label" for="flexCheckDefault">
                                Suhu
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="tekanan" id="flexCheckChecked" name="unsur[]">
                            <label class="form-check-label" for="flexCheckChecked">
                                Tekanan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="angin" id="angin" name="unsur[]">
                            <label class="form-check-label" for="angin">
                                Angin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="kelembaban" id="kelembaban" name="unsur[]">
                            <label class="form-check-label" for="kelembaban">
                                Kelembaban
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="matahari" id="matahari" name="unsur[]">
                            <label class="form-check-label" for="matahari">
                                Matahari
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="penguapan" id="penguapan" name="unsur[]">
                            <label class="form-check-label" for="penguapan">
                                Penguapan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="curah hujan" id="curah" name="unsur[]">
                            <label class="form-check-label" for="curah">
                                Curah Hujan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="kualitas Udara" id="udara" name="unsur[]">
                            <label class="form-check-label" for="udara">
                                Kualitas Udara
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="semua" id="semua" name="unsur[]">
                            <label class="form-check-label" for="semua">
                                Pilih Semua
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <label for="formFile" class="form-label">Jenis Informasi</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="analisis" id="analisis" name="jenis_informasi[]">
                            <label class="form-check-label" for="analisis">
                                Analisis
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="prakiraan" id="prakiraan" name="jenis_informasi[]">
                            <label class="form-check-label" for="prakiraan">
                                Prakiraan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="semua" id="pilihSemua" name="jenis_informasi[]">
                            <label class="form-check-label" for="pilihSemua">
                                Pilih Semua
                            </label>
                        </div>
                    </div>
                </div>
                <label for="formFile" class="form-label mt-3">Keterangan/Spesifikasi</label>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Leave a comment here" id="summernote" name="ket"></textarea>
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="name" class="form-control" id="lokasi" placeholder="Lokasi" name="lokasi">
                </div>
                <div class="mb-3">
                    <label for="waktu" class="form-label">Periode Waktu</label>
                    <select class="form-select" aria-label="Default select example" name="PWaktu">
                        <option selected>Periode Waktu</option>
                        <option value="Langsung">Tahunan</option>
                        <option value="Link Web">Bulanan</option>
                        <option value="Pos">Mingguan</option>
                        <option value="Fax">Harian</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="panjangData" class="form-label">Panjang Data (cth. 1 Agustus 2020 - 30 September
                        2020)</label>
                    <input type="name" class="form-control" id="panjangData"
                        placeholder="Panjang Data (cth. 1 Agustus 2020 - 30 September 2020)" name="panjang_data">
                </div>
                <button type="submit" class="btn btn-primary mb-3">kirim</button>
            </form>
        </section>
    </div>
@endsection
