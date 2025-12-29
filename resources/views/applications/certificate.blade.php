<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat - {{ $application->event->title }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Lato:ital,wght@0,400;0,700;1,400&display=swap');

        body {
            margin: 0;
            padding: 0;
            background: #f3f4f6;
            font-family: 'Lato', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .certificate-container {
            width: 297mm; /* A4 Landscape */
            height: 210mm;
            background: white;
            padding: 15mm;
            box-sizing: border-box;
            position: relative;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .border-pattern {
            width: 100%;
            height: 100%;
            border: 8px double #1e293b;
            outline: 2px solid #4f46e5;
            outline-offset: 4px;
            box-sizing: border-box;
            padding: 40px;
            text-align: center;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .header {
            font-family: 'Cinzel', serif;
            font-size: 48px;
            font-weight: 700;
            text-transform: uppercase;
            color: #1e293b;
            margin-bottom: 5px;
            letter-spacing: 4px;
        }
        .sub-header {
            font-size: 18px;
            color: #64748b;
            margin-bottom: 40px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .presented-to {
            font-style: italic;
            color: #64748b;
            margin-bottom: 10px;
        }
        .recipient-name {
            font-family: 'Cinzel', serif;
            font-size: 36px;
            font-weight: bold;
            color: #0f172a;
            border-bottom: 2px solid #e2e8f0;
            display: inline-block;
            padding-bottom: 10px;
            margin-bottom: 30px;
            min-width: 500px;
        }
        .description {
            font-size: 18px;
            line-height: 1.6;
            color: #334155;
            margin-bottom: 50px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        .event-title {
            font-weight: bold;
            color: #4f46e5;
            font-size: 20px;
        }
        .footer {
            display: flex;
            justify-content: space-around;
            margin-top: 40px;
        }
        .signature-line {
            width: 200px;
            border-top: 1px solid #1e293b;
            margin: 10px auto 5px;
        }
        .print-btn {
            position: fixed; bottom: 30px; right: 30px;
            background: #4f46e5; color: white; border: none;
            padding: 12px 24px; border-radius: 50px; cursor: pointer;
            font-weight: bold; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            transition: transform 0.2s;
        }
        .print-btn:hover { transform: scale(1.05); background: #4338ca; }
        @media print {
            body { background: white; margin: 0; }
            .certificate-container { box-shadow: none; width: 100%; height: 100%; page-break-after: always; }
            .print-btn { display: none; }
            @page { size: landscape; margin: 0; }
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="border-pattern">
            <div class="header">Sertifikat Penghargaan</div>
            <div class="sub-header">Certificate of Appreciation</div>

            <div class="presented-to">Diberikan kepada / Presented to:</div>
            <div class="recipient-name">{{ $application->user->name }}</div>

            <div class="description">
                Atas dedikasi dan kontribusinya yang luar biasa sebagai <strong>Volunteer</strong> dalam kegiatan
                <br>
                <span class="event-title">{{ $application->event->title }}</span>
            </div>

            <div class="footer">
                <div class="signature-box">
                    <div style="height: 40px;"></div> {{-- Space Tanda Tangan --}}
                    <div class="signature-line"></div>
                    <strong>{{ \Carbon\Carbon::parse($application->event->event_date)->format('d F Y') }}</strong><br>
                    <small class="text-muted">Tanggal Pelaksanaan</small>
                </div>
                <div class="signature-box">
                    <div style="height: 40px; font-family: 'Cinzel', serif; font-size: 24px; color: #cbd5e1;">
                        {{ substr($application->event->organizer->name, 0, 1) }}
                    </div>
                    <div class="signature-line"></div>
                    <strong>{{ $application->event->organizer->name }}</strong><br>
                    <small class="text-muted">Organizer / Penyelenggara</small>
                </div>
            </div>
        </div>
    </div>

    <button onclick="window.print()" class="print-btn">
        🖨️ Cetak / Simpan PDF
    </button>
</body>
</html>
