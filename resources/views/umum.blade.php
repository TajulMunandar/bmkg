@extends('layout.main')

@section('content')
    <div class="container">
        <h1 class="text-center text-info">Form Layanan</h1>
        <div class="row">
            <div class="col d-flex justify-content-center">
                <ul class="nav nav-pills p-5">
                    <li class="nav-item col-4 p-2">
                        <a class="nav-link p-3 active border" aria-current="page" href="{{ route('umum.index') }}">
                            <img src="{{ asset('asset/image/umum.webp') }}" alt=""
                                style="background-size: cover; width: 30%; " loading="lazy">
                            Umum
                        </a>
                    </li>
                    <li class="nav-item col-4 p-2">
                        <a class="nav-link p-3 border" aria-current="page" href="{{ route('instansi.index') }}">
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
            <p class="fw-bold fs-5">Layanan ini adalah layanan berbayar sesuai dengan Peraturan Pemerintah No. 47 Tahun
                2018. Ketentuan tarif dapat dilihat di Menu Tarif PNBP. Lakukan pembayaran setelah mengisi form di Menu
                Pembayaran.</p>
            <p class="fw-bold fs-5">Jenis layanan yang dapat dilayani oleh Stasiun Meteorologi Sultan Iskandar Muda :</p>
            <ol>
                <li>Informasi Meteorologi dan Klimatologi</li>
                <li>Jasa Konsultasi Meteorologi dan Klimatologi.</li>
            </ol>
            <p class="fw-bold fs-5">Dengan persyaratan sebagai berikut :</p>
            <ol>
                <li>Melampirkan identitas diri pemohon</li>
                <li>Melampirkan surat peromohonan yang ditandatangani oleh Pimpinan Perusahaan.</li>
                <li>Membayar tarif Penerimaan Negara Bukan Pajak (PNBP).</li>
            </ol>
            <p>Isi<a href="https://eskm.bmkg.go.id/survey/418106/0/1/2022-04/2022/0" style="text-decoration: none"> survey
                    kepuasan masyarakat</a> sebelum mengisi <span class="fw-bold">Form</span> dibawah ini, lalu unggah bukti
                <i>screenshoot</i> jika sudah
                selesai mengisi survey.
            </p>
            <form action="{{ route('umum.store') }}" method="POST" enctype="multipart/form-data">
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
                @csrf
                <input type="hidden" name="status" id="" value="0">
                <div class="mb-3">
                    <label for="survey" class="form-label">Unggah bukti pengisian survey (PNG, JPG, JPEG, PDF)</label>
                    <input class="form-control @error('survey') is-invalid @enderror" type="file" id="survey"
                        name="survei">
                    @error('survey')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pembayaran" class="form-label">Unggah bukti pembayaran (PNG, JPG, JPEG, PDF)
                        <a class="text-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Tarif Pembayaran
                        </a>
                    </label>
                    <input class="form-control @error('pembayaran') is-invalid @enderror" type="file" id="pembayaran"
                        name="pembayaran">
                    @error('pembayaran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal Tarif Pembayaran</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>No Rekening (BSI) :</p>
                                <p>2002060804 A.n Mifzal</p>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Tarif</th>
                                            <th scope="col">Satuan</th>
                                            <th scope="col">Tarif</th>
                                            <th scope="col">Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th colspan="5" class="text-center bg-primary text-white">INFROMASI
                                                METEOROLOGI, KLIMATOLOGI DAN GEOFISIKA</th>
                                        </tr>
                                        <tr>
                                            <th>1</th>
                                            <td>Analisis dan Prakiraan Hujan Bulanan</td>
                                            <td>per buku</td>
                                            <td>Rp. 65.000</td>
                                            <td>3 Hari</td>
                                        </tr>
                                        <tr>
                                            <th>2</th>
                                            <td>Prakiraan Musim Kemarau</td>
                                            <td>per buku</td>
                                            <td>Rp. 230.000</td>
                                            <td>3 Hari</td>
                                        </tr>
                                        <tr>
                                            <th>3</th>
                                            <td>Prakiraan Musim Hujan</td>
                                            <td>per buku</td>
                                            <td>Rp. 230.000</td>
                                            <td>3 Hari</td>
                                        </tr>
                                        <tr>
                                            <th>4</th>
                                            <td>Atlas Normal Temperatur Priode 1981-2010</td>
                                            <td>per buku</td>
                                            <td>Rp. 1.500.000</td>
                                            <td>5 Hari</td>
                                        </tr>
                                        <tr>
                                            <th>5</th>
                                            <td>Atlas Potensi Rawan Banjir</td>
                                            <td>per Atlas</td>
                                            <td>Rp. 350.000</td>
                                            <td>3 Hari</td>
                                        </tr>
                                        <tr>
                                            <th>6</th>
                                            <td>Atlas WindRose Wilayah Indonesia Priode 1981-2010</td>
                                            <td>per Buku</td>
                                            <td>Rp. 1.500.000</td>
                                            <td>5 Hari</td>
                                        </tr>
                                        <tr>
                                            <th>7</th>
                                            <td>Publikasi Berupa Informasi Perubahan Iklim dan Kualitas Udara</td>
                                            <td>per Buku</td>
                                            <td>Rp. 100.000</td>
                                            <td>3 Hari</td>
                                        </tr>
                                        <tr>
                                            <th>8</th>
                                            <td>Atlas Kerentanan Perubahan Iklim</td>
                                            <td>per Atlas</td>
                                            <td>Rp. 450.000</td>
                                            <td>3 Hari</td>
                                        </tr>
                                        <tr>
                                            <th>9</th>
                                            <td>Atlas Potensi Energi Matahari di Indonesia</td>
                                            <td>per Atlas</td>
                                            <td>Rp. 300.000</td>
                                            <td>3 Hari</td>
                                        </tr>
                                        <tr>
                                            <th>10</th>
                                            <td>Atlas Potensi Energi Angin di Indonesia</td>
                                            <td>per Atlas</td>
                                            <td>Rp. 300.000</td>
                                            <td>3 Hari</td>
                                        </tr>
                                        <tr>
                                            <th>11</th>
                                            <td>Informasi Particulate Matter(PM) - 10</td>
                                            <td>per stasiun/tahun</td>
                                            <td>Rp. 70.000</td>
                                            <td>3 Hari</td>
                                        </tr>
                                        <tr>
                                            <th>12</th>
                                            <td>Informasi Meteorologi Untuk Keperluan Klaim Asuransi</td>
                                            <td>per lokasi/hari</td>
                                            <td>Rp. 185.000</td>
                                            <td>3 Hari</td>
                                        </tr>
                                        <tr>
                                            <th>13</th>
                                            <td>Peta Tingkat Kerawanan Petir</td>
                                            <td>per lokasi/tahun</td>
                                            <td>Rp. 200.000</td>
                                            <td>3 Hari</td>
                                        </tr>
                                        <tr>
                                            <th>14</th>
                                            <td>Informasi Meteorologi Khusus Untuk Pendukung Kegiatan Proyek, Survei, dan
                                                Penelitian Komersil</td>
                                            <td>per lokasi</td>
                                            <td>Rp. 3.750.000</td>
                                            <td>5 Hari</td>
                                        </tr>
                                        <tr>
                                            <th colspan="5" class="text-center bg-success text-white">INFROMASI
                                               KHUSUS METEOROLOGI, KLIMATOLOGI DAN GEOFISIKA SESUAI PERMINTAAN</th>
                                        </tr>
                                        <tr>
                                            <th>15</th>
                                            <td>Analisis Iklim</td>
                                            <td>per lokasi</td>
                                            <td>Rp. 9.500.000</td>
                                            <td>5 Hari</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end modal --}}
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap Sesuai KTP</label>
                            <input type="name" class="form-control" id="nama" placeholder="Anton"
                                name="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Pemohon</label>
                            <input type="email" class="form-control" id="email" placeholder="Email"
                                name="email">
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="name" class="form-control" id="alamat" placeholder="Alamat"
                                name="alamat">
                        </div>
                        <div class="mb-3">
                            <label for="peroleh" class="form-label">Pilih Cara Perolehan Data</label>
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
                            <input type="name" class="form-control" id="perusahaan" placeholder="Perusahaan"
                                name="instansi">
                        </div>
                        <div class="mb-3">
                            <label for="hp" class="form-label">Nomor HP/WA</label>
                            <input type="number" class="form-control" id="hp" placeholder="No Hp"
                                name="hp">
                        </div>
                        <div class="mb-3">
                            <label for="data2" class="form-label">Peruntukan Data</label>
                            <input type="name" class="form-control" id="data2" placeholder="Peruntukan Data"
                                name="peruntuk">
                        </div>
                        <div class="mb-3">
                            <label for="informasi" class="form-label">Pilih Bentuk Informasi</label>
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
                    <label for="permohonan" class="form-label">Surat Permohonan Ditandatangani Oleh Pimpinan Perusahaan
                        (PNG,
                        JPG, JPEG, PDF)</label>
                    <input class="form-control" type="file" id="permohonan" name="surat_LP">
                </div>
                <div class="mb-3">
                    <label for="ktp" class="form-label">KTP (PNG, JPG, JPEG, PDF)</label>
                    <input class="form-control" type="file" id="ktp" name="ktp">
                </div>
                <div class="row">
                    <div class="col">
                        <label for="formFile" class="form-label">Pilih Unsur</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="suhu" id="flexCheckDefault"
                                name="unsur[]">
                            <label class="form-check-label" for="flexCheckDefault">
                                Suhu
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="tekanan" id="flexCheckChecked"
                                name="unsur[]">
                            <label class="form-check-label" for="flexCheckChecked">
                                Tekanan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="angin" id="angin"
                                name="unsur[]">
                            <label class="form-check-label" for="angin">
                                Angin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="kelembaban" id="kelembaban"
                                name="unsur[]">
                            <label class="form-check-label" for="kelembaban">
                                Kelembaban
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="matahari" id="matahari"
                                name="unsur[]">
                            <label class="form-check-label" for="matahari">
                                Matahari
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="penguapan" id="penguapan"
                                name="unsur[]">
                            <label class="form-check-label" for="penguapan">
                                Penguapan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="curah hujan" id="curah"
                                name="unsur[]">
                            <label class="form-check-label" for="curah">
                                Curah Hujan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="kualitas udara" id="udara"
                                name="unsur[]">
                            <label class="form-check-label" for="udara">
                                Kualitas Udara
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="semua" id="semua"
                                name="unsur[]">
                            <label class="form-check-label" for="semua">
                                Pilih Semua
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <label for="formFile" class="form-label">Jenis Informasi</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="analisis" id="analisis"
                                name="jenis_informasi[]">
                            <label class="form-check-label" for="analisis">
                                Analisis
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="prakiraan" id="prakiraan"
                                name="jenis_informasi[]">
                            <label class="form-check-label" for="prakiraan">
                                Prakiraan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="semua" id="pilihSemua"
                                name="jenis_informasi[]">
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
                    <label for="exampleFormControlInput1" class="form-label">Periode Waktu</label>
                    <select class="form-select" aria-label="Default select example" name="PWaktu">
                        <option selected>Periode Waktu</option>
                        <option value="Langsung">Tahunan</option>
                        <option value="Link Web">Bulanan</option>
                        <option value="Pos">Mingguan</option>
                        <option value="Fax">Harian</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Panjang Data (cth. 1 Agustus 2020 - 30
                        September 2020)</label>
                    <input type="name" class="form-control" id="exampleFormControlInput1"
                        placeholder="Panjang Data (cth. 1 Agustus 2020 - 30 September 2020)" name="panjang_data">
                </div>
                <button type="submit" class="btn btn-primary mb-3">kirim</button>
            </form>
        </section>
    </div>
@endsection
