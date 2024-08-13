@extends('src.layouts.owner.layout')
@section('title', 'Data Order')
@section('css')
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css" /> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid py-4 ">
        <div class="row">
            <div class="col-12 ">
                <div class="card mb-4 ">
                    <div class="card-header pb-0">
                        <h6 class="d-lg-none">Data Order</h6>
                        <div class="d-flex align-items-center">
                            <h6 class="d-none d-lg-block">Data Order</h6>

                            <div class="d-flex flex-wrap align-items-center ms-auto gap-2">

                                <button type="button" class="btn btn-primary btn-sm ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Tambah Order
                                </button>

                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="myTable" class="table table-borderless align-items-center display">
                                <thead>
                                    <tr>
                                        {{-- <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                            No</th> --}}
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                            Nama Order</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                            Foto Order</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                            Kode Warna</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                            Tanggal Order</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                            Deadline</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                            Keuntungan</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                            Status Order</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder">
                                            Foto Status Order</th>
                                        {{-- <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder">
                                            Item Belanja</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder">
                                            Sisa Bahan</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder">
                                            Log Update Status</th> --}}
                                        <th class="text-secondary text-xs ">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer pt-3  ">
            @include('src.component.owner.footer.footer')
        </footer>
    </div>

    <!-- Modal Create Data-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pendaftaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/owner/order/create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-control-label">Nama
                                        Order</label>
                                    <input name="nama_order" type="text" class="form-control" placeholder="Nama Order"
                                        aria-label="Name" value="{{ old('nama_order') }}">
                                    @error('nama_order')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-control-label">Foto Order</label>
                                    <input name="gamabar_order" type="file" class="form-control"
                                        placeholder="Gambar Order" aria-label="Name" value="{{ old('gamabar_order') }}">
                                    @error('gamabar_order')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-control-label">Kode Warna</label>
                                    <input name="kode_warna" type="color" class="form-control" placeholder="Kode Warna"
                                        aria-label="Name" value="{{ old('kode_warna') }}">
                                    @error('kode_warna')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-control-label">Tanggal Order</label>
                                    <input name="tanggal_order" type="date" placeholder="Tanggal Order"
                                        class="form-control" value="{{ old('tanggal_order') }}">
                                    @error('tanggal_order')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-control-label">Deadline</label>
                                    <input name="deadline" type="date" placeholder="Tempat lahir" class="form-control"
                                        value="{{ old('deadline') }}">
                                    @error('deadline')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-control-label">Keuntungan</label>
                                    <input name="keuntungan" type="number" class="form-control"
                                        placeholder="Keuntungan" aria-label="Name" value="{{ old('keuntungan') }}">
                                    @error('keuntungan')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-control-label">Status Order</label>
                                    <select name="tracking_id" id="" class="form-control form-select">
                                        <option value="">Pilih</option>
                                        @foreach ($statusTracking as $data)
                                            <option value="{{ $data->id }}"
                                                @if (old('tracking_id') == '{{ $data->tracking_id }}') selected @endif>
                                                {{ $data->nama_tracking }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('tracking_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-control-label">Foto Status
                                        Order</label>
                                    <input name="gambar_status" placeholder="Gambar Status Tracking" class="form-control"
                                        type="file" value="{{ old('gambar_status') }}">
                                    @error('gambar_status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-control-label">Item Belanja</label>
                                    <textarea name="item_belanja" type="text" id="editor" class="form-control" placeholder="item_belanja"
                                        aria-label="Name" value="{{ old('item_belanja') }}"> </textarea>
                                    @error('item_belanja')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-control-label">Sisa Bahan</label>
                                    <textarea name="sisa_bahan" type="text" id="editor2" class="form-control" placeholder="sisa_bahan"
                                        aria-label="Name" value="{{ old('sisa_bahan') }}"></textarea>
                                    @error('sisa_bahan')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-control-label">Log Update Status</label>
                                    <input name="log_update" placeholder="Log Update Status" class="form-control"
                                        type="text" value="{{ old('log_update') }}">
                                    @error('log_update')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Create Data-->

    <!-- Modal Verifikasi Data-->
    {{-- @foreach ($pendaftaran as $item)
        <div class="modal fade" id="updateStatus{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Status Tracking</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/dashboard/pendaftaran/update/status/' . $item->id) }}" method="Post">
                            @csrf
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Status Tracking</label>
                                    <select class="form-control form-select" name="status_pendaftaran"
                                        aria-label=".form-select-sm example" id="">
                                        <option selected>Pilih...</option>
                                        @foreach ($statusTracking as $data)
                                        @endforeach
                                        <option value="Terverifikasi">Terverifikasi</option>

                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach --}}
    <!-- End Modal Verifikasi Data-->

    <div id="modals-container"></div>
@endsection
@push('script')
    <!-- Tautkan file JavaScript jQuery -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <!-- Initialize CKEditor -->
    <script type="text/javascript">
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                // console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                // console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#editor3'))
            .catch(error => {
                // console.error(error);
            });

        $(document).ready(function() {
            loadData();

            function loadData() {
                var table = $('#myTable').DataTable({
                    processing: true,
                    pagination: true,
                    responsive: true,
                    serverSide: true,
                    searching: true,
                    ordering: true,
                    ajax: {
                        url: "{{ url('/owner/order') }}",
                        data: function(d) {
                            d.filter_kota = $('#filter_kota').val();
                        }
                    },
                    columns: [
                        // {
                        //     data: "no",
                        //     name: "no"
                        // },
                        {
                            data: "nama_order",
                            name: "nama_order"
                        },
                        {
                            data: "gamabar_order",
                            name: "gamabar_order"
                        },
                        {
                            data: "kode_warna",
                            name: "kode_warna"
                        },
                        {
                            data: "tanggal_order",
                            name: "tanggal_order"
                        },
                        {
                            data: "deadline",
                            name: "deadline"
                        },
                        {
                            data: "keuntungan",
                            name: "keuntungan"
                        },
                        {
                            data: "status_order",
                            name: "status_order"
                        },
                        {
                            data: "gambar_status",
                            name: "gambar_status"
                        },
                        // {
                        //     data: "item_belanja",
                        //     name: "item_belanja"
                        // },
                        // {
                        //     data: "sisa_bahan",
                        //     name: "sisa_bahan"
                        // },
                        // {
                        //     data: "log_update",
                        //     name: "log_update"
                        // },
                        {
                            data: "action",
                            name: "action"
                        },
                    ],
                    drawCallback: function(settings) {
                        var api = this.api();

                        $('#modals-container').empty();
                        api.rows().every(function(rowIdx, tableLoop, rowLoop) {
                            var data = this.data();
                            var modalId = data.id;
                            var statusTracking = @json($statusTracking);
                            $('#modals-container').append(`
                            <!-- Delete Modal -->
                            <div class="modal fade" id="delete${data.id}" tabindex="-1" aria-labelledby="deleteLabel${data.id}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteLabel${data.id}">Delete Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/owner/order/destroy/') }}/${data.id}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <p>Apakah anda yakin ingin menghapus data ${data.nama_order} ?</p>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Update Modal -->
                            <div class="modal fade" id="update${data.id}" tabindex="-1" aria-labelledby="updateLabel${data.id}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateLabel${data.id}">Update Data ${data.nama_order}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/owner/order/update/') }}/${data.id}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="nama_order${data.id}" class="form-control-label">Nama Order</label>
                                                            <input name="nama_order" type="text" class="form-control" id="nama_order${data.id}" placeholder="Nama Order" value="${data.nama_order}">
                                                            @error('nama_order')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="gamabar_order${data.id}" class="form-control-label">Foto Order</label>
                                                            <input name="gamabar_order" type="file" class="form-control" id="gamabar_order${data.id}" placeholder="Foto Order">
                                                            @error('gamabar_order')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="kode_warna${data.id}" class="form-control-label">Kode Warna</label>
                                                            <input name="kode_warna" type="color" class="form-control" id="kode_warna${data.id}" placeholder="Kode Warna" value="${data.kode_warna}">
                                                            @error('kode_warna')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="tanggal_order${data.id}" class="form-control-label">Tanggal Order</label>
                                                            <input name="tanggal_order" type="date" class="form-control" id="tanggal_order${data.id}" value="${formatTanggalKeISO(data.tanggal_order)}">
                                                            @error('tanggal_order')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="deadline${data.id}" class="form-control-label">Deadline</label>
                                                            <input name="deadline" type="date" class="form-control" id="deadline${data.id}" value="${formatTanggalKeISO(data.deadline)}">
                                                            @error('deadline')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="keuntungan${data.id}" class="form-control-label">Keuntungan</label>
                                                            <input name="keuntungan" type="text" class="form-control" id="keuntungan${data.id}" value="${data.keuntungan}">
                                                            @error('keuntungan')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="example-text-input" class="form-control-label">Status Tracking</label>
                                                            <select class="form-control form-select" name="tracking_id" aria-label=".form-select-sm example">
                                                            <option selected>Pilih...</option>
                                                                ${statusTracking.map(status => `<option value="${status.id}" ${status.id === data.tracking_id ? 'selected' : ''}>${status.nama_tracking}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </option>`)}
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="gambar_status${data.id}" class="form-control-label">Foto Status Order</label>
                                                            <input name="gambar_status" type="file" class="form-control" id="gambar_status${data.id}" placeholder="Foto Status Order" >
                                                            @error('gambar_status')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="item_belanja${data.id}" class="form-control-label">Item Belanja</label>
                                                            <textarea name="item_belanja" id="item_belanja${data.id}" class="form-control">${data.item_belanja}</textarea>
                                                            @error('item_belanja')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="sisa_bahan${data.id}" class="form-control-label">Sisa Bahan</label>
                                                            <textarea name="sisa_bahan" id="sisa_bahan${data.id}" class="form-control">${data.sisa_bahan}</textarea>
                                                            @error('sisa_bahan')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="updateStatus${data.id}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Update Status Tracking</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/owner/order/updatestatusorder') }}/${data.id}" method="Post">
                                                @csrf
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Status Tracking</label>
                                                        <select class="form-control form-select" name="tracking_id" aria-label=".form-select-sm example">
                                                            <option selected>Pilih...</option>
                                                                ${statusTracking.map(status => `<option value="${status.id}" ${status.id === data.tracking_id ? 'selected' : ''}>${status.nama_tracking}</option>`)}
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="view${data.id}" tabindex="-1" aria-labelledby="updateLabel${data.id}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateLabel${data.id}">View Order</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/owner/order/update/') }}/${data.id}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="nama_order${data.id}" class="form-control-label">Nama Order</label>
                                                            <p>${data.nama_order}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="gambar_order${data.id}" class="form-control-label">Foto Order</label>
                                                            <div>${data.gamabar_order}</div>
                                                        
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="kode_warna${data.id}" class="form-control-label">Kode Warna</label>
                                                            <p>${data.kode_warna}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="tanggal_order${data.id}" class="form-control-label">Tanggal Order</label><p>${data.tanggal_order}</p>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="deadline${data.id}" class="form-control-label">Deadline</label>
                                                            <p>${data.deadline}</p>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="keuntungan${data.id}" class="form-control-label">Keuntungan</label>
                                                            <p>${data.keuntungan}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="tracking_id${modalId}" class="form-control-label">Status Tracking</label>
                                                            <p>${data.status_order}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="gambar_status${data.id}" class="form-control-label">Foto Status Order</label>
                                                            <div>${data.gambar_status}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="item_belanja${data.id}" class="form-control-label">Item Belanja</label>
                                                            <div>${data.item_belanja}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="item_belanja${data.id}" class="form-control-label">Item Belanja</label>
                                                            <div>${data.sisa_bahan}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="log_update${data.id}" class="form-control-label">Log</label>
                                                            <div>${data.log_update}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);

                            // Inisialisasi CKEditor untuk textarea dengan ID dinamis
                            ClassicEditor.create(document.querySelector(
                                `#item_belanja${data.id}`)).catch(error => {
                                console.error(error);
                            });
                            ClassicEditor.create(document.querySelector(
                                `#sisa_bahan${data.id}`)).catch(error => {
                                console.error(error);
                            });

                        });
                    }

                });

                $('#filterForm').on('submit', function(e) {
                    e.preventDefault();
                    table.ajax.reload();
                });
            }

        });

        document.addEventListener('DOMContentLoaded', function() {
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            });
        });

        function formatTanggal(tanggal) {
            // Convert to Date object
            let dateObj = new Date(tanggal);

            // Define options for toLocaleDateString
            let options = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };

            // Convert to desired format
            return dateObj.toLocaleDateString('id-ID', options);
        }

        function formatTanggalKeISO(tanggal) {
            // Pemetaan bulan dalam Bahasa Indonesia ke angka
            const bulanMap = {
                "Januari": "01",
                "Februari": "02",
                "Maret": "03",
                "April": "04",
                "Mei": "05",
                "Juni": "06",
                "Juli": "07",
                "Agustus": "08",
                "September": "09",
                "Oktober": "10",
                "November": "11",
                "Desember": "12"
            };

            // Pisahkan tanggal menjadi bagian-bagian
            const parts = tanggal.split(' ');

            // Dapatkan hari, bulan, dan tahun
            const day = parts[0];
            const month = bulanMap[parts[1]];
            const year = parts[2];

            // Gabungkan dalam format YYYY-MM-DD
            return `${year}-${month}-${day.padStart(2, '0')}`;
        }
    </script>
@endpush
