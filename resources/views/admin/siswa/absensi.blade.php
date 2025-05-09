@extends('admin.layouts.app')

@section('title', 'Absensi')


@section('container')
    <style>
        .sortable {
            cursor: pointer;
            position: relative;
            padding-right: 20px;
        }

        .sort-indicator {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.8rem;
            color: #666;
        }

        .sort-asc::after {
            content: " ▲";
        }

        .sort-desc::after {
            content: " ▼";
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        {{-- <div class="d-flex justify-content-start mb-3">
            <a href="#" type="button" class="btn btn-success">
                Tambah Absen
            </a>
        </div> --}}

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Absen Siswa</h5>
                <div class="col-auto">
                    <input type="text" id="searchInput" class="form-control" style="width: 250px;"
                        placeholder="Cari Siswa...">
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th class="sortable">Nama Siswa <span class="sort-indicator"></span></th>
                            <th class="sortable">Nama Guru <span class="sort-indicator"></span></th>
                            <th class="sortable">Pelajaran <span class="sort-indicator"></span></th>
                            <th class="sortable">Pertemuan <span class="sort-indicator"></span></th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="tableBody">
                        @if ($absensi->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center">No data available</td>
                            </tr>
                        @else
                            @foreach ($absensi as $item)
                                <tr>
                                    <td>
                                        <i class="fab fa-angular fa-lg text-danger me-3"></i>
                                        <strong>{{ $item->siswa->nama }}</strong>
                                    </td>
                                    <td>{{ $item->guru->name }}</td>
                                    <td>{{ $item->course->judul }}</td>
                                    <td>{{ $item->content->pertemuan }}</td>
                                    <td>
                                        {{-- <span class="badge bg-label-success me-1">{{ $item->status }}</span> --}}
                                        @if ($item->status == 'Hadir')
                                            <span class="badge bg-label-success me-1">{{ ucfirst($item->status) }}</span>
                                        @elseif ($item->status == 'Izin')
                                            <span
                                                class="badge bg-warning text-white me-1">{{ ucfirst($item->status) }}</span>
                                        @elseif ($item->status == 'Sakit')
                                            <span
                                                class="badge bg-label-danger text-white me-1">{{ ucfirst($item->status) }}</span>
                                        @else
                                            <span
                                                class="badge bg-label-secondary text-white me-1">{{ ucfirst($item->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('siswa.absen.show', $item->id) }}"
                                            class="btn-primary btn btn-sm"><i class="bx bx-show me-1"></i>Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const searchInput = document.getElementById('searchInput');
                    const tableBody = document.getElementById('tableBody');
                    const rows = tableBody.getElementsByTagName('tr');

                    // Simpan semua baris awal untuk reset
                    const originalRows = Array.from(rows).map(row => {
                        return {
                            element: row,
                            content: [
                                row.cells[0]?.textContent.toLowerCase() || '',
                                row.cells[1]?.textContent.toLowerCase() || '',
                                row.cells[2]?.textContent.toLowerCase() || '',
                                row.cells[3]?.textContent.toLowerCase() || '',
                                row.cells[4]?.textContent.toLowerCase() || '',
                            ]
                        };
                    });

                    function performSearch() {
                        const term = searchInput.value.toLowerCase().trim();

                        let matchFound = false;

                        originalRows.forEach(({
                            element,
                            content
                        }) => {
                            if (element.cells.length === 1 && element.cells[0].textContent.trim() ===
                                'No data available') {
                                return;
                            }

                            const matches = content.some(text => text.includes(term));

                            if (matches) {
                                element.style.display = '';
                                matchFound = true;
                            } else {
                                element.style.display = 'none';
                            }
                        });

                        // Tampilkan atau sembunyikan pesan "Tidak ditemukan"
                        const notFoundMessage = document.getElementById('not-found-message');
                        if (term && !matchFound) {
                            if (!notFoundMessage) {
                                const message = document.createElement('div');
                                message.id = 'not-found-message';
                                message.className = 'alert alert-info text-center mt-3';
                                message.textContent = 'Data tidak ditemukan.';
                                document.querySelector('.table-responsive').after(message);
                            }
                        } else {
                            if (notFoundMessage) {
                                notFoundMessage.remove();
                            }
                        }
                    }

                    searchInput.addEventListener('input', performSearch);
                });
            </script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const headers = document.querySelectorAll('th.sortable');
                    let sortColumn = -1;
                    let sortAsc = true;
            
                    headers.forEach((header, index) => {
                        header.addEventListener('click', () => {
                            if (sortColumn === index) {
                                sortAsc = !sortAsc;
                            } else {
                                sortColumn = index;
                                sortAsc = true;
                            }
            
                            updateSortIndicator();
                            sortTable(index, sortAsc);
                        });
                    });
            
                    function updateSortIndicator() {
                        headers.forEach((header, index) => {
                            header.classList.remove('sort-asc', 'sort-desc');
                            if (index === sortColumn) {
                                header.classList.add(sortAsc ? 'sort-asc' : 'sort-desc');
                            }
                        });
                    }
            
                    function sortTable(columnIndex, asc) {
                        const tableBody = document.getElementById('tableBody');
                        const rowsArray = Array.from(tableBody.getElementsByTagName('tr'));
            
                        // Abaikan baris "No data available"
                        const validRows = rowsArray.filter(row => {
                            return !(row.cells.length === 1 && row.cells[0].textContent.trim() === 'No data available');
                        });
            
                        validRows.sort((a, b) => {
                            const cellA = a.cells[columnIndex]?.textContent.trim().toLowerCase() || '';
                            const cellB = b.cells[columnIndex]?.textContent.trim().toLowerCase() || '';
            
                            if (cellA < cellB) return asc ? -1 : 1;
                            if (cellA > cellB) return asc ? 1 : -1;
                            return 0;
                        });
            
                        // Hapus semua baris lama
                        validRows.forEach(row => tableBody.removeChild(row));
            
                        // Tambahkan urutan baru
                        validRows.forEach(row => tableBody.appendChild(row));
                    }
                });
            </script>
        </div>
    </div>
@endsection
