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
                        <a class="nav-link" href="{{ route('DashboardMahasiswa.index') }}">Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('DashboardIntansi.index') }}">Instansi</a>
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
                                <th>Instansi</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>No Hp/Wa</th>
                                <th>Peruntuk Data</th>
                                <th>Cara Perolehan Data</th>
                                <th>Bentuk Informasi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($instansis as $instansi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $instansi->name }}</td>
                                    <td>{{ $instansi->instansi }}</td>
                                    <td>{{ $instansi->email }}</td>
                                    <td>{{ $instansi->alamat }}</td>
                                    <td>{{ $instansi->hp }}</td>
                                    <td>{{ $instansi->peruntuk }}</td>
                                    <td>{{ $instansi->perolehan }}</td>
                                    <td>{{ $instansi->bentuk_informasi }}</td>
                                    <td>
                                        @if ($instansi->status == 0)
                                            <span class="badge bg-warning p-2">
                                                Belum Ada Tindakan
                                            </span>
                                        @elseif ($instansi->status == 2)
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
                                        @if ($instansi->status == 1 || $instansi->status == 2)
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
                                                <h5 class="modal-title" id="exampleModalLabel">Approve Data Instansi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('ApproveInstansi.put', $instansi->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $instansi->id }}">
                                                    <p class="fs-5">Apakah anda yakin akan terima data
                                                        <b>{{ $instansi->name }} ?</b>
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
                                                <h5 class="modal-title" id="exampleModalLabel">Disapprove Data Instansi
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('DisapproveInstansi.put', $instansi->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $instansi->id }}">
                                                    <p class="fs-5">Apakah anda yakin akan tolak data
                                                        <b>{{ $instansi->name }} ?</b>
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
                                                <h5 class="modal-title" id="exampleModalLabel">Data Instansi
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
                                                                {{ str_replace(['[', ']', "'", '"'], '', $instansi->unsur) }}
                                                            </p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p class="fw-bold">Jenis Informasi</p>
                                                            <p class="fw-thin">
                                                                {{ str_replace(['[', ']', "'", '"'], '', $instansi->jenis_informasi) }}
                                                            </p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p class="fw-bold">Keterangan</p>
                                                            <p class="fw-thin">{!! $instansi->ket !!}</p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p class="fw-bold">Lokasi</p>
                                                            <p class="fw-thin">{{ $instansi->lokasi }}</p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p class="fw-bold">Periode Waktu</p>
                                                            <p class="fw-thin">{{ $instansi->PWaktu }}</p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <p class="fw-bold">Panjang Data</p>
                                                            <p class="fw-thin">{{ $instansi->panjang_data }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row p-3">
                                                    <div class="col d-flex justify-content-center align-items-center">
                                                        <div class="mb-3 card p-3 me-1">
                                                            <p class="fw-bold">File Survei</p>
                                                            @if (pathinfo($instansi->survei, PATHINFO_EXTENSION) === 'pdf')
                                                                <a href="{{ asset('storage/' . $instansi->survei) }}"
                                                                    class="btn btn-primary" download>Unduh PDF</a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $instansi->survei) }}"
                                                                    class="" download>
                                                                    <img class="rounded-3" style="object-fit: cover"
                                                                        src="{{ asset('storage/' . $instansi->survei) }}"
                                                                        alt="" height="250" width="350">
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="mb-3 card p-3 me-1">
                                                            <p class="fw-bold">Proposal</p>
                                                            @if (pathinfo($instansi->proposal, PATHINFO_EXTENSION) === 'pdf')
                                                                <a href="{{ asset('storage/' . $instansi->proposal) }}"
                                                                    class="btn btn-primary" download>Unduh PDF</a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $instansi->proposal) }}"
                                                                    class="" download>
                                                                    <img class="rounded-3" style="object-fit: cover"
                                                                        src="{{ asset('storage/' . $instansi->proposal) }}"
                                                                        alt="" height="250" width="350">
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="mb-3 card p-3 me-1">
                                                            <p class="fw-bold">File Surat Permohonan Kepala Instansi</p>
                                                            @if (pathinfo($instansi->surat_LP, PATHINFO_EXTENSION) === 'pdf')
                                                                <a href="{{ asset('storage/' . $instansi->surat_LP) }}"
                                                                    class="btn btn-primary" download>Unduh PDF</a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $instansi->surat_LP) }}"
                                                                    download><img class="rounded-3"
                                                                        style="object-fit: cover"
                                                                        src="{{ asset('storage/' . $instansi->surat_LP) }}"
                                                                        alt="" height="250" width="350">
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="mb-3 card p-3 me-1">
                                                            <p class="fw-bold">KTP</p>
                                                            @if (pathinfo($instansi->ktp, PATHINFO_EXTENSION) === 'pdf')
                                                                <a href="{{ asset('storage/' . $instansi->ktp) }}"
                                                                    class="btn btn-primary" download>Unduh PDF</a>
                                                            @else
                                                                <a href="{{ asset('storage/' . $instansi->ktp) }}"
                                                                    class="" download>
                                                                    <img class="rounded-3" style="object-fit: cover"
                                                                        src="{{ asset('storage/' . $instansi->ktp) }}"
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
