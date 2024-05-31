@extends('layout.index2')

@section('title')
    Detail SOP - Budgeting System
@endsection

@section('content')
<div style="margin-left: 24px">
    <!--Badan Isi-->
    <a href="/sop" style="text-decoration: none">
        <button class="navback">
            <svg xmlns="http://www.w3.org/2000/svg " width="10" height="17 " viewBox="0 0 10 17 " fill="none ">
              <path
                d="M0 8.0501C0 8.4501 0.2 8.8501 0.4 9.0501L7 15.6501C7.6 16.2501 8.6 16.2501 9.2 15.6501C9.8 15.0501 9.8 14.0501 9.2 13.4501L3.8 8.0501L9.2 2.6501C9.8 2.0501 9.8 1.0501 9.2 0.450097C8.6 -0.149902 7.6 -0.149902 7 0.450097L0.6 6.8501C0.2
          7.2501 0 7.6501 0 8.0501Z "
                fill="#4A25AA "
              />
            </svg>
            Back
          </button>
    </a>


    <div class="tablenih" style="padding-top: -24px;">
        <div id="pdf-container"></div>
    </div>
</div>
@endsection

@section('custom-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.9.359/pdf.min.js"></script>
<script>
  const pdfUrl = "{{ asset('asset/sop/narasi.pdf')  }}";

  // Fungsi untuk merender PDF
  const renderPdf = async () => {
    const loadingTask = pdfjsLib.getDocument(pdfUrl);
    const pdf = await loadingTask.promise;

    // Loop melalui setiap halaman
    for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
      const page = await pdf.getPage(pageNum);
      const viewport = page.getViewport({ scale: 1.5 });

      // Buat sebuah canvas untuk merender halaman PDF
      const canvas = document.createElement('canvas');
      const context = canvas.getContext('2d');
      canvas.height = viewport.height;
      canvas.width = viewport.width;

      // Render halaman PDF ke canvas
      await page.render({
        canvasContext: context,
        viewport: viewport
      }).promise;

      // Dapatkan data gambar dalam bentuk URL
      const imageDataUrl = canvas.toDataURL('image/png');

      // Buat sebuah elemen gambar
      const img = document.createElement('img');
      img.src = imageDataUrl;
      img.alt = `Page ${pageNum}`;
      img.className = 'pdf-page'; // Tambahkan kelas untuk gaya CSS

      // Tambahkan elemen gambar ke dalam container
      document.getElementById('pdf-container').appendChild(img);
    }
  };

  renderPdf();
  //disable right click
  window.addEventListener('contextmenu', function (e) {
    e.preventDefault();
});
</script>
@endsection
