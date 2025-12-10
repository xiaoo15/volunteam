<!DOCTYPE html>
<html>
<head>
    <title>Sertifikat Penghargaan</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; text-align: center; border: 10px solid #4f46e5; padding: 50px; }
        .header { font-size: 50px; font-weight: bold; color: #333; margin-bottom: 20px; }
        .sub-header { font-size: 20px; color: #555; }
        .name { font-size: 40px; font-weight: bold; color: #4f46e5; margin: 20px 0; text-transform: uppercase; border-bottom: 2px solid #ddd; display: inline-block; padding-bottom: 10px;}
        .content { font-size: 18px; color: #555; line-height: 1.6; margin-bottom: 30px; }
        .footer { margin-top: 50px; font-size: 14px; color: #888; }
        .signature { margin-top: 50px; text-align: right; margin-right: 50px; }
        .sign-line { border-top: 1px solid #333; width: 200px; display: inline-block; margin-top: 50px; }
    </style>
</head>
<body>
    <div class="header">SERTIFIKAT</div>
    <div class="sub-header">Diberikan Sebagai Apresiasi Kepada:</div>
    
    <div class="name">{{ $name }}</div>
    
    <div class="content">
        Atas partisipasi dan dedikasinya yang luar biasa sebagai<br>
        <strong>VOLUNTEER</strong><br>
        pada acara:
        <h3 style="color: #333;">"{{ $event_title }}"</h3>
        yang diselenggarakan pada tanggal {{ $date }}.
    </div>

    <div class="signature">
        <p>Hormat Kami,</p>
        <br><br>
        <div class="sign-line"></div><br>
        <strong>Panitia Pelaksana</strong>
    </div>

    <div class="footer">
        Dicetak otomatis oleh sistem VolunTeam pada {{ date('d F Y') }}
    </div>
</body>
</html>