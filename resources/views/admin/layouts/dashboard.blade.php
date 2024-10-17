@extends('admin.layouts.app')

@section('container')
    <style>
        .hover-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            background-color: #f8f9fa;
            /* Light background */
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .icon-style {
            font-size: 60px;
            /* Larger icon size */
            margin-bottom: 10px;
            color: #ffffff;
            padding: 20px;
            /* Increase padding */
            border-radius: 50%;
        }

        .icon-style.bx-book {
            background-color: #007bff;
            /* Blue for courses */
        }

        .icon-style.bx-file {
            background-color: #28a745;
            /* Green for content */
        }

        .icon-style.bx-calendar-event {
            background-color: #ffc107;
            /* Yellow for events */
        }

        .card-title {
            margin-bottom: 5px;
        }

        .card-text {
            font-size: 24px;
            /* Larger text for counts */
            font-weight: bold;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Welcome {{ Auth::user()->name }}! 🎉</h5>
                                <p class="mb-4">
                                    {{ $randomQuote }}
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cards for Course, Content, and Kegiatan -->
            <div class="col-lg-4 mb-4">
                <div class="card hover-card text-center">
                    <div class="card-body">
                        <i class="bx bx-book icon-style"></i>
                        <h5 class="card-title">Total Courses</h5>
                        <p class="card-text">{{ $courseCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-4">
                <div class="card hover-card text-center">
                    <div class="card-body">
                        <i class="bx bx-file icon-style"></i>
                        <h5 class="card-title">Total Content</h5>
                        <p class="card-text">{{ $contentCount }}</p>
                    </div>
                </div>
            </div>
            @if (Auth::user()->role == 'admin')
                <div class="col-lg-4 mb-4">
                    <div class="card hover-card text-center">
                        <div class="card-body">
                            <i class="bx bx-calendar-event icon-style"></i>
                            <h5 class="card-title">Total Events</h5>
                            <p class="card-text">{{ $eventCount }}</p>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
