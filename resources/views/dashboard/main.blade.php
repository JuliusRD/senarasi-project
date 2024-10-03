
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Senarasi</title>
        {{-- ngok meta tag --}}
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('asset/image/narasi_logomark.png') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('asset/fontawesome/css/all.css') }}" />
        <!-- Summernote CSS -->
        <link href="{{ asset('asset/summernote/summernote-lite.min.css') }}" rel="stylesheet">

        <!-- Data Tables -->
        <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.31/dist/fancybox.css">

        <style>

h1{
    text-shadow: 0.2vmin 0.2vmin 0 #999999;
}

.headerone {
        position: relative;
        text-align: start;
        background: url('{{ asset('asset/image/bannernarasi.jpeg') }}');
        background-repeat: no-repeat;
        background-size: cover; /* Membuat gambar memenuhi seluruh elemen */
        /* background-position: center -70px; */
        color: white;
        margin-top: 70px;
        overflow: hidden;
    }

    .headerone::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(74, 37, 170, 0.7); /* Overlay with #4a25aa color and 70% opacity */
        z-index: 1;
    }

.inner-header {
  height:25vh;
  width:100%;
  margin: 0;
  z-index: 2;
  padding: 32px;
}

.flex { /*Flexbox for containers*/
  display: flex;
  justify-content: start;
  align-items: center;
  text-align: start;
  z-index: 2;
}

.waves {
  position:relative;
  width: 100%;
  height:15vh;
  min-height:70px;
  z-index: 2;
  max-height:100px;
}

.wkwk {
    color: #ffe900;

    font: 400 16px Narasi Sans, sans-serif;
    letter-spacing: 1px;
    z-index: 2;
}

.wikwik {

    color: #ffe900;
    font: 400 16px Narasi Sans, sans-serif;
    letter-spacing: 1px;
    z-index: 2;
}
.indie{
    font-style: italic;
    color:#bababa;
    margin-top:-8px;
}

.apaniha{
    color: black;
}
.apaniha:hover{
    color: #4a25aa;
    text-decoration: none;

}
.apaniha:hover svg path {
    fill: #4a25aa;
}


.buttonannouncemain {
    display: flex;
    padding: 16px 24px;
    gap: 8px;
    border-radius: 8px;
    border: none;
    background: var(--Primary-Main, #4a25aa);
    color: #ffe900;
    font: 600 16px Narasi Sans, sans-serif;
    box-shadow: 0px 4px 24px -1px rgba(74, 37, 170, 0.2);
    width: 100%;
    text-decoration: none;
    justify-content: center;
    margin-top: 16px
}

.buttonannouncemain:hover {
    background: #34128c;

}

.header-unique {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.profile-info-unique {
    display: flex;
    align-items: center;
    gap: 10px; /* Add gap between icon and text */
}

.profile-info-unique i {
    font-size: 40px;
    color: #007bff;
}

.text-info-unique {
    line-height: 1.2;
}

.date-unique {
    font-size: 0.9em;
    color: #888;
    white-space: nowrap; /* Prevent date from wrapping */
}

.content-unique {
    margin-top: 24px;
    margin-bottom: 32px
}

.content-unique strong {
    display: block;
    font-size: 1.2em;
    margin-bottom: 16px;
}

.badge-unique {
    background-color: #ece4ff;
    color: #4a25aa;
    font-size: 0.8em;
    font-weight: 500;
    padding: 5px 10px;
    border-radius: 15px;
    margin-bottom: 10px;
    display: inline-block;
}

.attachment-unique {
    display: flex;
    align-items: center;
    margin-top: 20px;
    border-top: 1px solid #ddd;
    padding-top: 10px;
}

.attachment-unique i {
    font-size: 1.5em;
    color: #4a25aa;
    margin-right: 10px;
}

.attachment-unique a {
    color: #4a25aa;
    text-decoration: none;
}

.file-container {
      display: flex;
      align-items: center;
      border: 1px solid #e0e0e0;
      border-radius: 5px;
      height:48px;
      max-width: 400px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

 a img{
    border-radius: 12px;
    width: 100%;
    /* max-height: 400px; */
}

    .file-icon {
      background-color: #4a25aa;
      padding: 10px;
      border-radius: 5px 0 0 5px;
      display: flex;
      align-items: center;
      justify-content: center;
      height:100%;
    }

    .file-icon i {
      color: white;
      font-size: 24px;
    }

    .file-info {
      flex-grow: 1;
      padding-left: 10px;
      display: flex;
      align-items: center;
    }

    .file-info span {
      font-size: 16px;
      color: #333;
    }

    .file-download {
      margin-left: auto;
      padding-right: 10px;
    }

    .file-download svg {
      font-size: 18px;
      color: #cfcfcf;
      cursor: pointer;
    }

    .file-download i:hover {
      color: #333;
    }


/* Animation */
/*
.parallax > use {
  animation: move-forever 25s cubic-bezier(.55,.5,.45,.5)     infinite;
}
.parallax > use:nth-child(1) {
  animation-delay: -2s;
  animation-duration: 7s;
}
.parallax > use:nth-child(2) {
  animation-delay: -3s;
  animation-duration: 10s;
}
.parallax > use:nth-child(3) {
  animation-delay: -4s;
  animation-duration: 13s;
}
.parallax > use:nth-child(4) {
  animation-delay: -5s;
  animation-duration: 20s;
}
@keyframes move-forever {
  0% {
   transform: translate3d(-90px,0,0);
  }
  100% {
    transform: translate3d(85px,0,0);
  }
} */
/*Shrinking for mobile*/
@media (max-width: 768px) {
  .waves {
    height:40px;
    min-height:40px;
  }


  h1 {
    font-size:24px;
  }
  .wkwk {
    font-size:12px;
  }
  .wikwik {
    font-size:12px;
  }
}
@media (max-width: 991px) {
  .buttonannouncemain {
margin-bottom: 24px;

  }


}
        </style>
    </head>
    <body class="antialiased">
        <div class="wrapper">
            @include('layout.navbarold')
            <div style="margin-top: 70px;">

            </div>
            <div class="headerone">
                <!--Content before waves-->
                <div class="inner-header flex" style="justify-content: space-between">

                        <div class="row">
                            <div style="display:inline-flex; gap:8px;vertical-align: middle">
                                <div class="wkwk"></div>
                                <div class="wikwik"></div>

                            </div>
                            <div style="z-index: 2;">
                                @guest
                                <h1 id="greeting">Good Morning, Guest !</h1>
                                @else
                                <h1 id="greeting">Good Morning, {{ Auth::user()->name }}!</h1>
                                @endguest
                            </div>
                        </div>
                        <img style="width: 112px; height: 112px; margin-right: 32px; z-index: 2;" src="{{ asset('asset/image/narasi_logomark.png') }}" alt="">
                </div>




    <!--Waves Container-->
    <div>
    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
    viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
    <defs>
    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
    </defs>
    <g class="parallax">
    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
    </g>
    </svg>
    </div>
    <!--Waves end-->

    </div>
    <!--Header ends-->

    <div class="body" style="margin-left: 132px; min-height: 100vh;">
        <div class="badanisi" style="margin-left: -140px; margin-top: 20px">
            @include('layout.modalin')
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="tablenih" style="height: auto">

                                <p style="font-size:24px; font-weight: 700; color: red ;margin: 16px 8px 24px 8px;letter-spacing: 0.5px">Quick Links</p>

                           <div class="nih" style="margin-left: 8px;">
                            <a class="apaniha" href="{{ route('dashboard.budget') }}" style="text-decoration: none; display: flex;">
                                <svg style="margin-top: 6px; margin-right: 8px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="margin-right: 8px; transform: translateY(2px);">
                                    <path fill="#a6a6a6" d="M14.143 15.962a.5.5 0 0 1-.244.68l-9.402 4.193c-1.495.667-3.047-.814-2.306-2.202l3.152-5.904c.245-.459.245-1 0-1.458L2.191 5.367c-.74-1.388.81-2.87 2.306-2.202l3.525 1.572a2 2 0 0 1 .974.932z"/>
                                    <path fill="#a6a6a6" d="M15.533 15.39a.5.5 0 0 0 .651.233l4.823-2.15c1.323-.59 1.323-2.355 0-2.945L12.109 6.56a.5.5 0 0 0-.651.68z" opacity="0.5"/>
                                </svg>
                                <div>
                                    <span style="font-size: 18px; font-weight: 500;">Budgeting System</span>
                                    <p style="font-style: italic; color:#bababa; margin-top: -8px;">Budget Information and Budget Requests</p>
                                </div>
                            </a>

                            <a class="apaniha" href="{{ route('company-document.index') }}"style="text-decoration: none; display: flex;">
                                <svg style="margin-top: 6px; margin-right: 8px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="margin-right: 8px; transform: translateY(2px);">
                                    <path fill="#a6a6a6" d="M14.143 15.962a.5.5 0 0 1-.244.68l-9.402 4.193c-1.495.667-3.047-.814-2.306-2.202l3.152-5.904c.245-.459.245-1 0-1.458L2.191 5.367c-.74-1.388.81-2.87 2.306-2.202l3.525 1.572a2 2 0 0 1 .974.932z"/>
                                    <path fill="#a6a6a6" d="M15.533 15.39a.5.5 0 0 0 .651.233l4.823-2.15c1.323-.59 1.323-2.355 0-2.945L12.109 6.56a.5.5 0 0 0-.651.68z" opacity="0.5"/>
                                </svg>
                                <div>
                                    <span style="font-size: 18px; font-weight: 500;">(DEMO MODE)Company File Documents</span>
                                    <p style="   font-style: italic; color:#bababa; margin-top:-8px;">List of Company File Document </p>
                                </div>
                            </a>

                            <a class="apaniha"  href="" style="text-decoration: none; display: flex;">
                                <svg style="margin-top: 6px; margin-right: 8px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="margin-right: 8px; transform: translateY(2px);">
                                    <path fill="#a6a6a6" d="M14.143 15.962a.5.5 0 0 1-.244.68l-9.402 4.193c-1.495.667-3.047-.814-2.306-2.202l3.152-5.904c.245-.459.245-1 0-1.458L2.191 5.367c-.74-1.388.81-2.87 2.306-2.202l3.525 1.572a2 2 0 0 1 .974.932z"/>
                                    <path fill="#a6a6a6" d="M15.533 15.39a.5.5 0 0 0 .651.233l4.823-2.15c1.323-.59 1.323-2.355 0-2.945L12.109 6.56a.5.5 0 0 0-.651.68z" opacity="0.5"/>
                                </svg>
                                <div>
                                    <span style="font-size: 18px; font-weight: 500;">(ON PROGRESS)Transportation Request</span>
                                    <p style="   font-style: italic; color:#bababa; margin-top:-8px;">Request Driver and Transportation</p>
                                </div>
                            </a>

                            <a class="apaniha"  href="{{ route('bookingroom.index') }}" style="text-decoration: none; display: flex;">
                                <svg style="margin-top: 6px; margin-right: 8px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="margin-right: 8px; transform: translateY(2px);">
                                    <path fill="#a6a6a6" d="M14.143 15.962a.5.5 0 0 1-.244.68l-9.402 4.193c-1.495.667-3.047-.814-2.306-2.202l3.152-5.904c.245-.459.245-1 0-1.458L2.191 5.367c-.74-1.388.81-2.87 2.306-2.202l3.525 1.572a2 2 0 0 1 .974.932z"/>
                                    <path fill="#a6a6a6" d="M15.533 15.39a.5.5 0 0 0 .651.233l4.823-2.15c1.323-.59 1.323-2.355 0-2.945L12.109 6.56a.5.5 0 0 0-.651.68z" opacity="0.5"/>
                                </svg>
                                <div>
                                    <span style="font-size: 18px; font-weight: 500;">(DEMO MODE)Booking Room</span>
                                    <p style="   font-style: italic; color:#bababa; margin-top:-8px;">Book Room Meeting</p>
                                </div>
                            </a>
                        </div>

                    </div>
                    {{-- <a href="{{ route('announcement.create') }}" type="button" style=" background;" class="buttonannouncemain"> --}}
                    <button type="button" class="buttonannouncemain" data-bs-toggle="modal" data-bs-target="#modal-create-announcement">
                        Add Announcement<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                            fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.99995 2.7002C9.23865 2.7002 9.46756 2.79502 9.63635 2.9638C9.80513 3.13258 9.89995 3.3615 9.89995 3.6002V8.10019H14.4C14.6386 8.10019 14.8676 8.19502 15.0363 8.3638C15.2051 8.53258 15.3 8.7615 15.3 9.0002C15.3 9.23889 15.2051 9.46781 15.0363 9.63659C14.8676 9.80537 14.6386 9.9002 14.4 9.9002H9.89995V14.4002C9.89995 14.6389 9.80513 14.8678 9.63635 15.0366C9.46756 15.2054 9.23865 15.3002 8.99995 15.3002C8.76126 15.3002 8.53234 15.2054 8.36355 15.0366C8.19477 14.8678 8.09995 14.6389 8.09995 14.4002V9.9002H3.59995C3.36126 9.9002 3.13234 9.80537 2.96356 9.63659C2.79477 9.46781 2.69995 9.23889 2.69995 9.0002C2.69995 8.7615 2.79477 8.53258 2.96356 8.3638C3.13234 8.19502 3.36126 8.10019 3.59995 8.10019H8.09995V3.6002C8.09995 3.3615 8.19477 3.13258 8.36355 2.9638C8.53234 2.79502 8.76126 2.7002 8.99995 2.7002Z"
                                fill="white" />
                        </svg>
                    </button>
                    {{-- </a> --}}
                    @include('dashboard.modal_add_announcement')
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                    @foreach ($announcements as $announcement )
                    <div class="tablenih p-4">
                        <div class="header-unique">
                            <div class="profile-info-unique align-middle">
                                <i class="fas fa-user-circle" style="color: #cfcfcf"></i>
                                <div class="text-info-unique">
                                    <strong>{{ $announcement->user->name }}</strong><br>
                                    <span>{{ $announcement->user->role }}</span>
                                </div>
                            </div>
                            <div class="date-unique">{{ \Carbon\Carbon::parse($announcement->created_at)->translatedFormat('d F Y H:i')}}</div>
                        </div>

                        <div class="content-unique">
                            <div class="row">
                                <div class="col">
                                    <span class="badge-unique">{{ $announcement->announcementCategory->category_name }}</span>
                                </div>
                                <div class="col">
                                    <span style="display: flex; gap: 2px; justify-content:right">
                                        <a type="button" class="btn btn-outline-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modal-edit-announcement-{{ $announcement->id}}" >
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('announcement.destroy', $announcement->id )}}" class="" onsubmit="return confirmDelete()">
                                          @csrf
                                          @method('delete')
                                          <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                      </form>
                                    </span>
                                </div>
                                @include('dashboard.modal_edit_announcement', ['data' => $announcement])
                            </div>


                            <strong>{{ $announcement->title}}</strong>

                            <p>
                                {!! $announcement->content !!}
                            </p>
                        </div>
                        @php
                            // Mengambil ekstensi file dari path attachment
                            $attachmentExtension = pathinfo($announcement->attachment, PATHINFO_EXTENSION);
                        @endphp
                        @if (in_array($attachmentExtension, ['jpg', 'jpeg', 'png', 'gif', 'svg']))
                        <div class="image-container text-center">
                            <a data-fancybox="gallery" href="{{ $announcement->attachment() }}" >
                              <img src="{{ $announcement->attachment() }}" class="img-fluid" alt="Gambar" style="cursor:pointer; width:50%;">
                            </a>
                        </div>
                        @endif
                        @if (in_array($attachmentExtension, ['pdf', 'doc', 'docx']))
                        <a href="{{ $announcement->attachment() }}" style="text-decoration: none" download>
                            <div class="file-container">
                                <div class="file-icon">
                                    <i class="far fa-file"></i>
                                </div>
                                <div class="file-info">
                                <span>{{ basename($announcement->attachment) }}</span>
                                </div>
                                <div class="file-download">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                        @endif
                        {{-- <div class="attachment-unique">
                            <i class="fas fa-file-pdf"></i>
                            <a href="#">MEMO INTERNAL SPD.pdf</a>
                        </div> --}}
                    </div>

                    @endforeach

                    {{-- <div class="tablenih p-4">
                        <div class="header-unique">
                            <div class="profile-info-unique align-middle">
                                <i class="fas fa-user-circle" style="color: #cfcfcf"></i>
                                <div class="text-info-unique">
                                    <strong>Primadhiaz</strong><br>
                                    <span>IT Support</span>
                                </div>
                            </div>
                            <div class="date-unique">24 Jun 2024 2:30 PM</div>
                        </div>

                        <div class="content-unique">
                            <span class="badge-unique">Company announcement</span>

                            <strong>Lampiran Pertanggungjawaban Perdiems dalam Laporan Pertanggungjawaban</strong>

                            <p>Dear Narasi People,</p>
                            <p>Dikarenakan adanya perubahan kebijakan dari tim finance terkait pertanggungjawaban uang muka perjalanan dinas, maka dengan ini berikut kami lampirkan memo perubahan kebijakan tersebut. Adapun kebijakan ini berlaku pada saat dokumen ini dikirimkan. Jika ada pertanyaan dapat menghubungi tim finance.</p>
                            <p>Terima kasih<br>Salam,<br>Finance Team</p>
                        </div>




                    </div> --}}


                </div>
            </div>
        </div>

    </div>

        </div>
        @include('layout.footer')
        </div>
        {{-- @yield('modal') --}}
        <!-- Libs JS -->
        <!-- Tabler Core -->
        {{-- <script src="{{ asset('js/script.js') }}"></script> --}}
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }} "></script>
        <script src="{{ asset('js/datatables.min.js')}}"></script>
        <script src="{{ asset('js/datatables.init.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.31/dist/fancybox.umd.js"></script>
        <script src="{{ asset('asset/summernote/summernote-lite.min.js') }}"></script>
        <script>
          function confirmDelete() {
              return confirm('Are you sure you want to delete this announcement?');
          }
      </script>
        <script>
            $(document).ready(function() {
                $('#content').summernote({
                    height: 300, // Atur tinggi editor
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', [ 'codeview', 'help']]
                    ]
                });
                $('[id^=content-edit-]').each(function() {
                $(this).summernote({
                    height: 250, // Set editor height
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['codeview', 'help']]
                    ]
                });
            });
            });
        </script>
        <script>

            Fancybox.bind('[data-fancybox="gallery"]', {
              Toolbar: {
                display: ["download", "close"],  // Hanya menampilkan tombol close dan download
              },
              caption: function (fancybox, carousel, slide) {
                return slide.$trigger.dataset.caption || '';
              },
              // Tambahan custom class agar bisa digunakan untuk styling
              classNames: {
                caption: 'fancybox-caption-custom'
              }
            });
          </script>

        <script>
            // Mengambil elemen-elemen dengan kelas yang sesuai
            const wkwkElement = document.querySelector('.wkwk');
            const wikwikElement = document.querySelector('.wikwik');
            const greetingElement = document.getElementById('greeting');

            // Mendapatkan nama pengguna dari server-side Laravel
            const userName = '@auth, {{ Auth::user()->name }}! @else  @endauth';

            // Fungsi untuk mendapatkan tanggal dan jam saat ini
            function updateDateTime() {
                // Mendapatkan waktu saat ini
                const now = new Date();

                // Array nama bulan dalam bahasa Indonesia
                const monthNames = [
                    "Januari", "Februari", "Maret",
                    "April", "Mei", "Juni", "Juli",
                    "Agustus", "September", "Oktober",
                    "November", "Desember"
                ];

                // Mendapatkan tanggal dalam format 'DD MonthName YYYY'
                const date = now.getDate() + ' ' + monthNames[now.getMonth()] + ' ' + now.getFullYear();

                // Mendapatkan jam, menit, dan detik
                const hour = ('0' + now.getHours()).slice(-2); // Menambahkan 0 di depan jika jam hanya satu digit
                const minute = ('0' + now.getMinutes()).slice(-2); // Menambahkan 0 di depan jika menit hanya satu digit
                const second = ('0' + now.getSeconds()).slice(-2); // Menambahkan 0 di depan jika detik hanya satu digit

                // Format jam dalam format 'HH:MM:SS WIB'
                const time = hour + ':' + minute + ':' + second + ' WIB';

                // Memasukkan tanggal dan jam ke dalam elemen-elemen
                if (wkwkElement) wkwkElement.textContent = date;
                if (wikwikElement) wikwikElement.textContent = time;

                // Mengubah ucapan berdasarkan jam
                let greeting;
                const currentHour = now.getHours();

                if (currentHour < 12) {
                    greeting = 'Good Morning' + userName;
                } else if (currentHour < 18) {
                    greeting = 'Good Afternoon' + userName;
                } else {
                    greeting = 'Good Evening' + userName;
                }

                if (greetingElement) greetingElement.textContent = greeting;
            }

            // Memanggil fungsi updateDateTime setiap detik (untuk mengupdate waktu secara otomatis)
            setInterval(updateDateTime, 1000);

            // Memanggil updateDateTime saat pertama kali halaman dimuat
            updateDateTime();
        </script>
</html>