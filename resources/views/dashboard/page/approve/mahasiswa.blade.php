@extends('dashboard.component.main')
@section('title', 'Data Permintaan')
@section('page-heading', 'Data Permintaan')

@section('content')

    {{--  ALERT  --}}
    <div class="row mt-3">
        <div class="col">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    {{--  ALERT  --}}

    {{--  CONTENT  --}}
    <div class="row mt-3 mb-5">
        <div class="col">
            <div class="card mt-3 col-sm-6 col-md-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('DashboardUmum.index') }}">Umum</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('DashboardMahasiswa.index') }}">Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('DashboardIntansi.index') }}">Instansi</a>
                    </li>
                </ul>
                <div class="card-body">

                    {{-- tables --}}
                    <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Universitas</th>
                                <th>No Hp/Wa</th>
                                <th>Peruntuk Data</th>
                                <th>Cara Perolehan Data</th>
                                <th>Bentuk Informasi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswas as $mahasiswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mahasiswa->name }}</td>
                                    <td>{{ $mahasiswa->email }}</td>
                                    <td>{{ $mahasiswa->alamat }}</td>
                                    <td>{{ $mahasiswa->univ }}</td>
                                    <td>{{ $mahasiswa->hp }}</td>
                                    <td>{{ $mahasiswa->peruntuk }}</td>
                                    <td>{{ $mahasiswa->perolehan }}</td>
                                    <td>{{ $mahasiswa->bentuk_informasi }}</td>
                                    <td>
                                        @if ($mahasiswa->status == 0)
                                            <span class="badge bg-warning p-2">
                                                Belum Ada Tindakan
                                            </span>
                                        @elseif ($mahasiswa->status == 2)
                                            <span class="badge bg-danger p-2">
                                                Di Tolak
                                            </span>
                                        @else
                                            <span class="badge bg-success p-2">
                                                Di Terima
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <button id="button" class="btn btn-primary" id="button" data-bs-toggle="modal"
                                            data-bs-target="#infoModal{{ $loop->iteration }}">
                                            <i class="fa-solid fa-circle-info"></i>
                                        </button>
                                        @if ($mahasiswa->status == 1 || $mahasiswa->status == 2)
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#checkModal{{ $loop->iteration }}" disabled>
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#crossModal{{ $loop->iteration }}" disabled>
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#checkModal{{ $loop->iteration }}">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#crossModal{{ $loop->iteration }}">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                                {{--  Check Modal  --}}
                                <div class="modal fade" id="checkModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Approve Data Mahasiswa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('ApproveMahasiswa.put', $mahasiswa->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $mahasiswa->id }}">
                                                    <p class="fs-5">Apakah anda yakin akan terima data
                                                        <b>{{ $mahasiswa->name }} ?</b>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Approve</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--  Check Modal --}}

                                {{--  cross Modal  --}}
                                <div class="modal fade" id="crossModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Disapprove Data Mahasiswa
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('DisapproveMahasiswa.put', $mahasiswa->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $mahasiswa->id }}">
                                                    <p class="fs-5">Apakah anda yakin akan tolak data
                                                        <b>{{ $mahasiswa->name }} ?</b>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Disapprove</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--  cross Modal --}}

                                {{--  info Modal  --}}
                                <div class="modal fade" id="infoModal{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Data Mahasiswa
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-5">
                                                <div class="row">
                                                    <div class="col d-flex justify-content-between">
                                                        <div class="mb-3">
                                                            <p class="fw-bold">Unsur</p>
                                                            <p class="fw-thin">
                                                                {{ str_replace(['[', ']', "'", '"'], '', $mahasiswa->unsur) }}
                                                            </p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p class="fw-bold">Jenis Informasi</p>
                                                            <p class="fw-thin">
                                                                {{ str_replace(['[', ']', "'", '"'], '', $mahasiswa->jenis_informasi) }}
                                                            </p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p class="fw-bold">Keterangan</p>
                                                            <p class="fw-thin">{!! $mahasiswa->ket !!}</p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p class="fw-bold">Lokasi</p>
                                                            <p class="fw-thin">{{ $mahasiswa->lokasi }}</p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p class="fw-bold">Periode Waktu</p>
                                                            <p class="fw-thin">{{ $mahasiswa->PWaktu }}</p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p class="fw-bold">Panjang Data</p>
                                                            <p class="fw-thin">{{ $mahasiswa->panjang_data }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row p-3">
                                                    <div class="col d-flex justify-content-center align-items-center">
                                                        <div class="mb-3 card p-3 me-1">
                                                            <p class="fw-bold">File Survei</p>
                                                            @if (pathinfo($mahasiswa->survei, PATHINFO_EXTENSION) === 'pdf')
                                                                <a href="{{ asset('storage/' . $mahasiswa->survei) }}"
                                                                    class="btn btn-primary" download>Unduh PDF</a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $mahasiswa->survei) }}"
                                                                    class="" download>
                                                                    <img class="rounded-3" style="object-fit: cover"
                                                                        src="{{ asset('storage/' . $mahasiswa->survei) }}"
                                                                        alt="" height="250" width="350">
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="mb-3 card p-3 me-1">
                                                            <p class="fw-bold">Surat 0 Rupiah</p>
                                                            @if (pathinfo($mahasiswa->surat_0, PATHINFO_EXTENSION) === 'pdf')
                                                                <a href="{{ asset('storage/' . $mahasiswa->surat_0) }}"
                                                                    class="btn btn-primary" download>Unduh PDF</a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $mahasiswa->surat_0) }}"
                                                                    class="" download>
                                                                    <img class="rounded-3" style="object-fit: cover"
                                                                        src="{{ asset('storage/' . $mahasiswa->surat_0) }}"
                                                                        alt="" height="250" width="350">
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="mb-3 card p-3 me-1">
                                                            <p class="fw-bold">Proposal</p>
                                                            @if (pathinfo($mahasiswa->proposal, PATHINFO_EXTENSION) === 'pdf')
                                                                <a href="{{ asset('storage/' . $mahasiswa->proposal) }}"
                                                                    class="btn btn-primary" download>Unduh PDF</a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $mahasiswa->proposal) }}"
                                                                    class="" download>
                                                                    <img class="rounded-3" style="object-fit: cover"
                                                                        src="{{ asset('storage/' . $mahasiswa->proposal) }}"
                                                                        alt="" height="250" width="350">
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row p-3">
                                                    <div class="col d-flex justify-content-center align-items-center">

                                                        <div class="mb-3 card p-3 me-1">
                                                            <p class="fw-bold">File Surat Permohonan Kepala Lembaga Pendidikan</p>
                                                            @if (pathinfo($mahasiswa->surat_LP, PATHINFO_EXTENSION) === 'pdf')
                                                                <a href="{{ asset('storage/' . $mahasiswa->surat_LP) }}"
                                                                    class="btn btn-primary" download>Unduh PDF</a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $mahasiswa->surat_LP) }}"
                                                                    download><img class="rounded-3"
                                                                        style="object-fit: cover"
                                                                        src="{{ asset('storage/' . $mahasiswa->surat_LP) }}"
                                                                        alt="" height="250" width="350">
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="mb-3 card p-3 me-1">
                                                            <p class="fw-bold">KTP</p>
                                                            @if (pathinfo($mahasiswa->ktp, PATHINFO_EXTENSION) === 'pdf')
                                                                <a href="{{ asset('storage/' . $mahasiswa->ktp) }}"
                                                                    class="btn btn-primary" download>Unduh PDF</a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $mahasiswa->ktp) }}"
                                                                    class="" download>
                                                                    <img class="rounded-3" style="object-fit: cover"
                                                                        src="{{ asset('storage/' . $mahasiswa->ktp) }}"
                                                                        alt="" height="250" width="350">
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="mb-3 card p-3 me-1">
                                                            <p class="fw-bold">KTM</p>
                                                            @if (pathinfo($mahasiswa->ktm, PATHINFO_EXTENSION) === 'pdf')
                                                                <a href="{{ asset('storage/' . $mahasiswa->ktm) }}"
                                                                    class="btn btn-primary" download>Unduh PDF</a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $mahasiswa->ktm) }}"
                                                                    class="" download>
                                                                    <img class="rounded-3" style="object-fit: cover"
                                                                        src="{{ asset('storage/' . $mahasiswa->ktm) }}"
                                                                        alt="" height="250" width="350">
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--  info Modal --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--  CONTENT  --}}

@endsection
