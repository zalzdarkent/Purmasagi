@extends('client.layouts.app')

@section('title', $course->judul)

@section('container')
    {{-- Hero --}}
    <div class="relative isolate overflow-hidden">
        <img src="{{ $course->thumbnail ? asset('storage/' . $course->thumbnail) : asset('assets/img/contents/image-not-found.png') }}"
            alt="{{ $course->title }}" class="absolute inset-0 -z-10 h-full w-full object-cover">
        <div class="opacity-85 absolute inset-0 -z-10 bg-black"></div>

        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <div class="mx-auto max-w-xl px-6 py-16">
            <div class="text-center">
                <h1 class="text-balance text-4xl font-bold tracking-tight text-white">{{ $course->judul }}</h1>
                <p class="mt-6 text-center text-base leading-8 text-gray-300 lg:text-lg">{{ $course->deskripsi }}
                    @php
                        $initials = strtoupper(
                            collect(explode(' ', $course->admin->name))
                                ->take(2)
                                ->map(function ($word) {
                                    return substr($word, 0, 1);
                                })
                                ->join(''),
                        );
                        $avatarColor = \App\Helpers\TextHelpers::getColorFromName($course->admin->name);
                    @endphp
                <div class="mt-6 flex items-center justify-center space-x-4">
                    @if ($course->admin->foto_profil)
                        <img class="h-8 w-8 rounded-full" src="{{ asset('storage/' . $course->admin->foto_profil) }}"
                            alt="{{ $course->admin->name }}">
                    @else
                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full"
                            style="background-color: {{ $avatarColor }}; color: white;">
                            {{ $initials }}
                        </span>
                    @endif
                    <span class="text-sm text-white">Diajarkan oleh <span
                            class="underline">{{ $course->admin->name }}</span></span>
                </div>

                </p>
            </div>
        </div>
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
            aria-hidden="true">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
    </div>

    {{-- Main --}}
    <div class="mx-auto my-6 max-w-2xl px-8 text-gray-700 sm:px-6">
        {{-- <h2 class="mb-6 text-2xl font-semibold text-gray-800">Content</h2> --}}
        @if (session('success'))
            <div class="alert-dismissible fade show alert alert-success" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert-danger alert-dismissible fade show alert" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- Pertemuan 1 dan Modal --}}
        @if ($contents->count() > 0)
            @foreach ($contents as $content)
                <div class="mb-4">
                    <div class="rounded-lg border border-gray-300">
                        <button
                            class="flex w-full items-center justify-between rounded-lg bg-white p-4 text-left focus:outline-none focus:ring focus:ring-indigo-500"
                            onclick="toggle({{ $content->pertemuan }})">
                            <span class="text-base font-medium lg:text-lg">Pertemuan {{ $content->pertemuan }}</span>
                            <svg id="pertemuan-icon-{{ $content->pertemuan }}"
                                class="h-6 w-6 transition-transform duration-200" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.70711 9.71069C5.31658 10.1012 5.31658 10.7344 5.70711 11.1249L10.5993 16.0123C11.3805 16.7927 12.6463 16.7924 13.4271 16.0117L18.3174 11.1213C18.708 10.7308 18.708 10.0976 18.3174 9.70708C17.9269 9.31655 17.2937 9.31655 16.9032 9.70708L12.7176 13.8927C12.3271 14.2833 11.6939 14.2832 11.3034 13.8927L7.12132 9.71069C6.7308 9.32016 6.09763 9.32016 5.70711 9.71069Z"
                                    fill="#0F0F0F"></path>
                            </svg>
                        </button>
                        <div id="pertemuan-{{ $content->pertemuan }}" class="hidden border-t border-gray-200 p-4">
                            <p class="mb-4 text-base text-gray-500">{{ $content->deskripsi_konten }}</p>
                            <div class="flex flex-wrap gap-2 md:gap-4">
                                @foreach (json_decode($content->file_paths) as $file_path)
                                    @if (strpos($file_path, '.mp4') !== false)
                                        <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                                            class="mt-2 flex rounded-lg bg-indigo-600 px-5 py-2.5 text-center text-xs font-medium text-white hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300 md:text-sm"
                                            type="button"
                                            onclick="showMedia('{{ asset('storage/' . $file_path) }}', 'video')">

                                            Video
                                        </button>
                                    @elseif (strpos($file_path, '.jpg') !== false || strpos($file_path, '.png') !== false)
                                        <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                                            class="mt-2 flex rounded-lg bg-indigo-600 px-5 py-2.5 text-center text-xs font-medium text-white hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300 md:text-sm"
                                            type="button"
                                            onclick="showMedia('{{ asset('storage/' . $file_path) }}', 'image')">
                                            Gambar
                                        </button>
                                    @else
                                        <a href="{{ asset('storage/' . $file_path) }}" target="_blank"
                                            class="mt-2 flex rounded-lg bg-indigo-600 px-5 py-2.5 text-center text-xs font-medium text-white hover:bg-indigo-500 focus:outline-none focus:ring-4 focus:ring-indigo-300 md:text-sm">
                                            Dokumen
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="mt-4 justify-end">
                                @if (in_array($content->id, $absensi))
                                    {{-- Tombol dinonaktifkan jika sudah absen --}}
                                    <button
                                        class="rounded-lg bg-gray-400 px-5 py-2.5 text-center text-xs font-medium text-white cursor-not-allowed md:text-sm"
                                        type="button" disabled>
                                        Sudah Absen
                                    </button>
                                @else
                                    {{-- Tombol aktif jika belum absen --}}
                                    <button data-modal-target="absen-modal" data-modal-toggle="absen-modal"
                                        class="rounded-lg bg-green-600 px-5 py-2.5 text-center text-xs font-medium text-white hover:bg-green-500 focus:outline-none focus:ring-4 focus:ring-green-300 md:text-sm"
                                        onclick="handleAbsen({{ $content->id }})">
                                        Absen
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Modal --}}
                    <div id="default-modal" tabindex="-1" aria-hidden="true"
                        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
                        <div class="relative max-h-full w-full max-w-2xl p-4">
                            <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                                {{-- Modal header --}}
                                <div
                                    class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-white lg:text-2xl">Pertemuan
                                        {{ $content->pertemuan }}
                                    </h3>
                                    <button type="button"
                                        class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="default-modal" onclick="stopVideo()">
                                        <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Close</span>
                                    </button>
                                </div>
                                {{-- Modal body --}}
                                <div class="space-y-6 p-6" id="media-content">
                                    {{-- Content (DOM) --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="my-20">
                <h2 class="text-center text-gray-500">Mohon maaf, belum ada pertemuan yang tersedia saat ini.</h2>
            </div>
        @endif
    </div>

    {{-- Modal Form Absen --}}
    <!-- Tempatkan modal ini di LUAR -->
    <div id="absen-modal" tabindex="-1" aria-hidden="true"
        class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
        <div class="relative max-h-full w-full max-w-md p-4">
            <div class="relative rounded-lg bg-white shadow dark:bg-gray-700">
                <!-- Modal Header -->
                <div class="flex items-center justify-between rounded-t border-b p-4 dark:border-gray-600 md:p-5">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white lg:text-2xl">Form Absen</h3>
                    <button type="button"
                        class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="absen-modal">
                        <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close</span>
                    </button>
                </div>

                <div id="loading-location" class="hidden text-center mb-4">
                    <div
                        class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-green-500 mb-2">
                    </div>
                    <p class="text-sm text-gray-600">Mendapatkan lokasi...</p>
                </div>

                <div id="location-success" class="hidden mb-4">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        <span class="block sm:inline">Lokasi berhasil didapatkan!</span>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="space-y-6 p-6">
                    <div id="map-preview" class="hidden mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Preview Lokasi</label>
                        <iframe
                            id="map-iframe"
                            class="w-full h-48 rounded-lg"
                            frameborder="0" 
                            style="border:0"
                            allowfullscreen="" 
                            aria-hidden="false" 
                            tabindex="0">
                        </iframe>
                    </div>
                    <form id="absen-form" method="POST" action="{{ route('siswa.absen.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        {{-- Hidden Inputs --}}
                        <input type="hidden" name="id_siswa" value="{{ auth()->guard('siswa')->id() }}">
                        <input type="hidden" name="id_guru" value="{{ $course->admin_id }}">
                        <input type="hidden" name="id_course" value="{{ $course->id }}">
                        <input type="hidden" id="modal-id-content" name="id_content" value="">
                        <input type="hidden" id="latitude" name="latitude" value="">
                        <input type="hidden" id="longitude" name="longitude" value="">

                        {{-- Status --}}
                        <div class="mb-4">
                            <label for="status"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                            <select id="status" name="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                onchange="toggleKeteranganInput()" required>
                                <option value="" disabled selected>Pilih</option>
                                <option value="hadir">Hadir</option>
                                <option value="izin">Izin</option>
                                <option value="sakit">Sakit</option>
                            </select>
                        </div>

                        {{-- Keterangan (Hidden by Default) --}}
                        <div class="mb-4 hidden" id="keterangan-container">
                            <label for="keterangan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan</label>
                            <textarea id="keterangan" name="keterangan"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                rows="3"></textarea>
                        </div>

                        {{-- Foto Absensi --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Foto Absensi</label>
                            
                            {{-- Preview foto --}}
                            <div id="preview-container" class="hidden mt-2 mb-4">
                                <img id="preview-image" class="max-w-full h-48 object-cover rounded-lg" src="" alt="Preview">
                                <button type="button" id="retake-photo" 
                                    class="mt-2 w-full rounded-lg bg-gray-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-500 focus:outline-none focus:ring-4 focus:ring-gray-300">
                                    Ambil Ulang Foto
                                </button>
                            </div>

                            {{-- Tombol ambil foto --}}
                            <button type="button" id="take-photo"
                                class="w-full rounded-lg bg-blue-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-300 disabled:opacity-50 disabled:cursor-not-allowed"
                                disabled>
                                Buka Kamera
                            </button>

                            {{-- Input file hidden untuk menyimpan foto --}}
                            <input type="file" id="foto_absensi" name="foto_absensi" accept="image/*" capture="environment" 
                                class="hidden" required>
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" id="submit-btn"
                            class="w-full rounded-lg bg-green-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-green-500 focus:outline-none focus:ring-4 focus:ring-green-300">
                            Kirim
                        </button>
                    </form>
                </div>

                <!-- Tambahkan ini di dalam modal body, sebelum preview-container -->
                <div id="camera-container" class="hidden mb-4">
                    <video id="camera-view" autoplay playsinline class="w-full h-48 object-cover rounded-lg"></video>
                    <div class="flex gap-2 mt-2">
                        <button type="button" id="capture-photo"
                            class="flex-1 rounded-lg bg-green-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-green-500 focus:outline-none focus:ring-4 focus:ring-green-300">
                            Ambil Foto
                        </button>
                        <button type="button" id="close-camera"
                            class="flex-1 rounded-lg bg-gray-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-500 focus:outline-none focus:ring-4 focus:ring-gray-300">
                            Tutup Kamera
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let watchId = null;
        let maxWaitTime = 30000; // 30 detik maksimal menunggu
        let startTime;
        let bestAccuracy = Infinity;
        let bestPosition = null;

        function getAccuracyColor(accuracy) {
            if (accuracy <= 20) return 'bg-green-100 border-green-400 text-green-700';
            if (accuracy <= 100) return 'bg-yellow-100 border-yellow-400 text-yellow-700';
            return 'bg-red-100 border-red-400 text-red-700';
        }

        function getAccuracyText(accuracy) {
            if (accuracy <= 20) return 'Sangat Akurat';
            if (accuracy <= 100) return 'Cukup Akurat';
            return 'Kurang Akurat';
        }

        function updateLocationStatus(position) {
            const accuracy = position.coords.accuracy;
            const successMessage = document.getElementById('location-success');
            const colorClasses = ['bg-green-100', 'border-green-400', 'text-green-700',
                                'bg-yellow-100', 'border-yellow-400', 'text-yellow-700',
                                'bg-red-100', 'border-red-400', 'text-red-700'];
            
            // Remove all possible color classes
            colorClasses.forEach(cls => successMessage.classList.remove(cls));
            
            // Add new color classes
            const newColors = getAccuracyColor(accuracy).split(' ');
            newColors.forEach(cls => successMessage.classList.add(cls));
            
            // Save existing retry button if it exists
            const existingRetryBtn = successMessage.querySelector('.retry-button');
            const retryBtnHtml = existingRetryBtn ? existingRetryBtn.outerHTML : '';
            
            // Update message
            successMessage.innerHTML = `
                <span class="block sm:inline">Lokasi ditemukan - ${getAccuracyText(accuracy)} (${Math.round(accuracy)}m)</span>
                ${accuracy > 100 ? `
                <button onclick="resetLocation()" 
                        class="retry-button mt-2 w-full rounded-lg bg-blue-600 px-3 py-1.5 text-sm text-white hover:bg-blue-500">
                    Coba Dapatkan Lokasi Lebih Akurat
                </button>` : ''}`;
        }

        function resetLocation() {
            if (watchId !== null) {
                navigator.geolocation.clearWatch(watchId);
                watchId = null;
            }
            const loadingIndicator = document.getElementById('loading-location');
            const successMessage = document.getElementById('location-success');
            
            loadingIndicator.classList.remove('hidden');
            successMessage.classList.add('hidden');
            
            // Reset variables
            startTime = Date.now();
            bestAccuracy = Infinity;
            bestPosition = null;
            
            // Try getting location again
            getLocation();
        }

        function handleLocationError(error) {
            console.error("Error getting location:", error);
            const loadingIndicator = document.getElementById('loading-location');
            const successMessage = document.getElementById('location-success');
            loadingIndicator.classList.add('hidden');
            
            let errorMessage = "Terjadi kesalahan saat mendapatkan lokasi: ";
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage += "Akses lokasi ditolak. Mohon izinkan akses lokasi di browser Anda.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage += "Informasi lokasi tidak tersedia. Pastikan GPS aktif dan Anda berada di area terbuka.";
                    break;
                case error.TIMEOUT:
                    errorMessage += "Waktu mendapatkan lokasi habis. Silakan coba lagi dengan menekan tombol 'Coba Lagi'.";
                    break;
                default:
                    errorMessage += "Terjadi kesalahan yang tidak diketahui.";
            }

            // Show error message and retry button
            successMessage.innerHTML = `
                <div class="mb-2 rounded-lg border border-red-400 bg-red-100 p-4 text-red-700">
                    <p>${errorMessage}</p>
                    <button onclick="resetLocation()" 
                            class="mt-2 w-full rounded-lg bg-blue-600 px-3 py-1.5 text-sm text-white hover:bg-blue-500">
                        Coba Lagi
                    </button>
                </div>
            `;
            successMessage.classList.remove('hidden');
        }

        function handleAbsen(contentId) {
            document.getElementById('modal-id-content').value = contentId;
            const modal = document.getElementById('absen-modal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.setAttribute('aria-hidden', 'false');
                getLocation(); // Panggil getLocation saat modal dibuka
            }
        }

        function toggleKeteranganInput() {
            const status = document.getElementById('status').value;
            const keteranganContainer = document.getElementById('keterangan-container');
            const keteranganInput = document.getElementById('keterangan');

            if (status === 'izin' || status === 'sakit') {
                // Tampilkan input dan tambahkan required
                keteranganContainer.classList.remove('hidden');
                keteranganInput.setAttribute('required', 'required');
            } else {
                // Sembunyikan input dan hapus required
                keteranganContainer.classList.add('hidden');
                keteranganInput.removeAttribute('required');
                keteranganInput.value = ''; // Kosongkan keterangan jika hadir
            }
        }

        function getLocation() {
            const loadingIndicator = document.getElementById('loading-location');
            const successMessage = document.getElementById('location-success');
            const submitButton = document.getElementById('submit-btn');
            const takePhotoBtn = document.getElementById('take-photo');
            const mapPreview = document.getElementById('map-preview');
            const mapIframe = document.getElementById('map-iframe');

            loadingIndicator.classList.remove('hidden');
            successMessage.classList.add('hidden');
            mapPreview.classList.add('hidden'); // Sembunyikan peta saat loading
            submitButton.disabled = true;
            takePhotoBtn.disabled = true; // Nonaktifkan tombol foto

            if (navigator.geolocation) {
                // Reset state
                if (watchId !== null) {
                    navigator.geolocation.clearWatch(watchId);
                }
                startTime = Date.now();
                bestAccuracy = Infinity;
                bestPosition = null;

                const options = {
                    enableHighAccuracy: true,
                    timeout: 30000, // Increased timeout to 30 seconds
                    maximumAge: 0
                };

                watchId = navigator.geolocation.watchPosition(
                    function(position) {
                        const accuracy = position.coords.accuracy;
                        const elapsedTime = Date.now() - startTime;
                        console.log('Current accuracy:', accuracy, 'meters');

                        // Update best position if this one is more accurate
                        if (accuracy < bestAccuracy) {
                            bestAccuracy = accuracy;
                            bestPosition = position;
                            const lat = position.coords.latitude;
                            const lon = position.coords.longitude;

                            // Update hidden inputs
                            document.getElementById('latitude').value = lat;
                            document.getElementById('longitude').value = lon;

                            // Update map
                            const zoomLevel = Math.min(0.002, Math.max(0.0005, accuracy / 100000));
                            const mapUrl = `https://www.openstreetmap.org/export/embed.html?bbox=${lon-zoomLevel},${lat-zoomLevel},${lon+zoomLevel},${lat+zoomLevel}&layer=mapnik&marker=${lat},${lon}`;
                            const mapIframe = document.getElementById('map-iframe');
                            
                            if (mapIframe.src !== mapUrl) {
                                mapIframe.src = mapUrl;
                            }
                            mapPreview.classList.remove('hidden');
                            updateLocationStatus(position);

                            // Tambahkan tombol retry jika akurasi masih rendah
                            const successMessage = document.getElementById('location-success');
                            const existingRetryBtn = successMessage.querySelector('.retry-button');
                            
                            if (accuracy > 100) {
                                if (!existingRetryBtn) {
                                    successMessage.innerHTML += `
                                        <button onclick="resetLocation()" 
                                                class="retry-button mt-2 w-full rounded-lg bg-blue-600 px-3 py-1.5 text-sm text-white hover:bg-blue-500">
                                            Coba Dapatkan Lokasi Lebih Akurat
                                        </button>`;
                                }
                            } else if (existingRetryBtn) {
                                existingRetryBtn.remove();
                            }
                        }

                        // If we have good accuracy or have waited too long, stop watching
                        if (accuracy <= 20 || elapsedTime >= maxWaitTime) {
                            if (watchId !== null) {
                                navigator.geolocation.clearWatch(watchId);
                                watchId = null;
                            }
                        }

                        loadingIndicator.classList.add('hidden');
                        successMessage.classList.remove('hidden');

                        // Enable buttons based on accuracy
                        if (accuracy <= 100) // Sedikit lebih toleran untuk penggunaan
                        {
                            submitButton.disabled = false;
                            takePhotoBtn.disabled = false;
                            takePhotoBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                        } else {
                            submitButton.disabled = true;
                            takePhotoBtn.disabled = true;
                            takePhotoBtn.classList.add('opacity-50', 'cursor-not-allowed');
                        }
                    },
                    function(error) {
                        handleLocationError(error);
                    },
                    options
                );
            } else {
                loadingIndicator.classList.add('hidden');
                alert("Geolocation tidak didukung oleh browser ini");
                submitButton.disabled = true;
                takePhotoBtn.disabled = true; // Tetap nonaktifkan tombol foto
                takePhotoBtn.classList.add('opacity-50', 'cursor-not-allowed'); // Tambah style disabled
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const absenModal = document.getElementById('absen-modal');
            if (absenModal) {
                absenModal.addEventListener('shown.bs.modal', getLocation);
            }
        });

        // Tambahkan kode untuk handling kamera
        let stream = null;
        const takePhotoBtn = document.getElementById('take-photo');
        const retakePhotoBtn = document.getElementById('retake-photo');
        const cameraContainer = document.getElementById('camera-container');
        const cameraView = document.getElementById('camera-view');
        const captureBtn = document.getElementById('capture-photo');
        const closeBtn = document.getElementById('close-camera');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        const fileInput = document.getElementById('foto_absensi');

        async function startCamera() {
            try {
                const latitude = document.getElementById('latitude').value;
                const longitude = document.getElementById('longitude').value;

                // Cek apakah lokasi sudah didapat
                if (!latitude || !longitude) {
                    alert('Mohon izinkan akses lokasi terlebih dahulu');
                    return;
                }

                // Pastikan tidak ada stream yang aktif
                if (stream) {
                    stopCamera();
                }

                // Coba akses kamera belakang terlebih dahulu
                stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: { exact: "environment" }
                    },
                    audio: false
                }).catch(async () => {
                    // Jika gagal, coba akses kamera depan
                    return await navigator.mediaDevices.getUserMedia({
                        video: true,
                        audio: false
                    });
                });

                const videoElement = document.getElementById('camera-view');
                videoElement.srcObject = stream;
                await videoElement.play();
                
                document.getElementById('camera-container').classList.remove('hidden');
                document.getElementById('take-photo').classList.add('hidden');
            } catch (err) {
                console.error('Error accessing camera:', err);
                alert('Gagal mengakses kamera. Pastikan browser Anda mendukung akses kamera dan izin kamera telah diberikan.');
            }
        }

        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
            document.getElementById('camera-container').classList.add('hidden');
            if (!fileInput.files.length) {
                document.getElementById('take-photo').classList.remove('hidden');
            }
        }

        function capturePhoto() {
            const canvas = document.createElement('canvas');
            canvas.width = cameraView.videoWidth;
            canvas.height = cameraView.videoHeight;
            canvas.getContext('2d').drawImage(cameraView, 0, 0);
            
            // Convert to file
            canvas.toBlob((blob) => {
                const file = new File([blob], "foto_absensi.jpg", { type: "image/jpeg" });
                const dt = new DataTransfer();
                dt.items.add(file);
                fileInput.files = dt.files;
                
                // Show preview
                previewImage.src = canvas.toDataURL('image/jpeg');
                previewContainer.classList.remove('hidden');
                takePhotoBtn.classList.add('hidden');
                
                stopCamera();
            }, 'image/jpeg', 0.8);
        }

        takePhotoBtn.addEventListener('click', startCamera);
        
        retakePhotoBtn.addEventListener('click', () => {
            previewContainer.classList.add('hidden');
            takePhotoBtn.classList.remove('hidden');
            fileInput.value = '';
            startCamera();
        });

        captureBtn.addEventListener('click', capturePhoto);
        
        closeBtn.addEventListener('click', () => {
            stopCamera();
            if (!fileInput.files.length) {
                previewContainer.classList.add('hidden');
                takePhotoBtn.classList.remove('hidden');
            }
        });

        // Update form validation
        document.getElementById('absen-form').addEventListener('submit', function(e) {
            const latitude = document.getElementById('latitude').value;
            const longitude = document.getElementById('longitude').value;

            if (!latitude || !longitude) {
                e.preventDefault();
                alert('Mohon tunggu hingga lokasi didapatkan');
                getLocation();
                return;
            }

            if (!fileInput.files || !fileInput.files[0]) {
                e.preventDefault();
                alert('Mohon ambil foto terlebih dahulu');
                return;
            }
        });
    </script>
@endsection
