<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat - {{ $application->user->name }}</title>

    {{-- Font Keren --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Plus+Jakarta+Sans:wght@400;600;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f0f2f5;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* UKURAN KERTAS A4 LANDSCAPE */
        .certificate-container {
            width: 297mm;
            height: 210mm;
            background: white;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            border: 1px solid #ddd;
        }

        /* BINGKAI ORNAMEN */
        .border-pattern {
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border: 2px solid #C5A059;
            /* Emas */
            z-index: 1;
        }

        .border-pattern::before {
            content: '';
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border: 4px double #1e293b;
            /* Biru Gelap */
        }

        /* SUDUT HIASAN */
        .corner {
            position: absolute;
            width: 100px;
            height: 100px;
            z-index: 2;
        }

        .top-left {
            top: 0;
            left: 0;
            border-top: 20px solid #C5A059;
            border-left: 20px solid #C5A059;
        }

        .top-right {
            top: 0;
            right: 0;
            border-top: 20px solid #C5A059;
            border-right: 20px solid #C5A059;
        }

        .bottom-left {
            bottom: 0;
            left: 0;
            border-bottom: 20px solid #C5A059;
            border-left: 20px solid #C5A059;
        }

        .bottom-right {
            bottom: 0;
            right: 0;
            border-bottom: 20px solid #C5A059;
            border-right: 20px solid #C5A059;
        }

        /* LOGO WATERMARK */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 500px;
            opacity: 0.03;
            z-index: 0;
            filter: grayscale(100%);
        }

        /* KONTEN */
        .content {
            z-index: 10;
            position: relative;
            width: 80%;
        }

        .header-title {
            font-size: 3rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 5px;
            color: #1e293b;
            margin-bottom: 10px;
            border-bottom: 2px solid #C5A059;
            display: inline-block;
            padding-bottom: 10px;
        }

        .sub-title {
            font-size: 1.2rem;
            color: #64748b;
            margin-bottom: 40px;
            letter-spacing: 2px;
        }

        .present-to {
            font-size: 1rem;
            color: #94a3b8;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .recipient-name {
            font-family: 'Great Vibes', cursive;
            font-size: 4.5rem;
            color: #C5A059;
            /* Emas */
            margin: 10px 0 30px;
            line-height: 1;
            text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.1);
        }

        .description {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #334155;
            margin-bottom: 50px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            width: 80%;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
        }

        .sig-box {
            text-align: center;
            width: 250px;
        }

        .sig-line {
            border-bottom: 1px solid #1e293b;
            margin-bottom: 10px;
            height: 50px;
        }

        .sig-name {
            font-weight: 800;
            color: #1e293b;
            font-size: 1.1rem;
        }

        .sig-title {
            font-size: 0.9rem;
            color: #64748b;
        }

        /* TOMBOL PRINT (Hidden pas ngeprint) */
        .print-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #4f46e5;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.4);
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            z-index: 1000;
        }

        .print-btn:hover {
            transform: translateY(-5px);
            background: #4338ca;
        }

        /* SETTINGAN PRINTER */
        @media print {
            body {
                background: white;
                -webkit-print-color-adjust: exact;
            }

            .certificate-container {
                box-shadow: none;
                border: none;
                width: 100%;
                height: 100vh;
            }

            .print-btn {
                display: none;
            }

            @page {
                size: landscape;
                margin: 0;
            }
        }
    </style>
</head>

<body>

    <button onclick="window.print()" class="print-btn">
        <i class="fa-solid fa-print"></i> Cetak Sertifikat
    </button>

    <div class="certificate-container">
        {{-- Hiasan --}}
        <div class="border-pattern"></div>
        <div class="corner top-left"></div>
        <div class="corner top-right"></div>
        <div class="corner bottom-left"></div>
        <div class="corner bottom-right"></div>

        {{-- Logo samar di tengah --}}
        <i class="fa-solid fa-hand-holding-heart watermark fa-10x"></i>

        <div class="content">
            <h1 class="header-title">Sertifikat Penghargaan</h1>
            <p class="sub-title">Certificate of Appreciation</p>

            <p class="present-to">Diberikan dengan bangga kepada:</p>

            {{-- NAMA USER (DINAMIS) --}}
            <h2 class="recipient-name">{{ $application->user->name }}</h2>

            <p class="description">
                Atas dedikasi dan kontribusi luar biasa sebagai <strong>Relawan</strong> dalam kegiatan sosial: <br>
                <span
                    style="font-size: 1.5rem; font-weight: 800; color: #1e293b; margin-top: 10px; display: block;">"{{ $application->event->title }}"</span>
                <span style="display: block; font-size: 0.9rem; margin-top: 5px; color: #64748b;">
                    Dilaksanakan di {{ $application->event->location }} pada
                    {{ \Carbon\Carbon::parse($application->event->event_date)->translatedFormat('d F Y') }}
                </span>
            </p>

            <div class="signatures">
                <div class="sig-box">
                    {{-- QR Code Palsu tapi Keren --}}
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ route('certificate.print', $application->id) }}"
                        style="margin-bottom: 10px; opacity: 0.8;">
                    <div class="sig-title" style="font-size: 0.7rem;">ID:
                        {{ strtoupper(substr(md5($application->id), 0, 8)) }}</div>
                    <div class="sig-title" style="font-size: 0.7rem;">Scan untuk verifikasi</div>
                </div>

                <div class="sig-box">
                    {{-- Tanda Tangan Gambar (Pake Font Script aja biar cepet) --}}
                    <div
                        style="font-family: 'Great Vibes', cursive; font-size: 2rem; color: #1e293b; height: 50px; border-bottom: 2px solid #1e293b; margin-bottom: 10px;">
                        {{ $application->event->organizer->name }}
                    </div>
                    <div class="sig-name">{{ $application->event->organizer->name }}</div>
                    <div class="sig-title">Organizer / Penyelenggara</div>
                </div>

                <div class="sig-box">
                    <div
                        style="font-family: 'Great Vibes', cursive; font-size: 2rem; color: #1e293b; height: 50px; border-bottom: 2px solid #1e293b; margin-bottom: 10px;">
                        Revan Andi Laksono
                    </div>
                    <div class="sig-name">Revan Andi Laksono</div>
                    <div class="sig-title">CEO VolunTeam Indonesia</div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>