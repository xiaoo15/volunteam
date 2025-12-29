<!DOCTYPE html>
<html>
<head>
    <title>Sertifikat Penghargaan</title>
    <style>
        @page { margin: 0; size: landscape; }
        body { 
            font-family: 'Times New Roman', serif; 
            text-align: center; 
            margin: 0; padding: 0;
            background: #fff;
            color: #1a1a1a;
        }
        .container {
            width: 100%; height: 100vh;
            padding: 40px;
            box-sizing: border-box;
            background-color: #fff; 
            position: relative;
        }
        /* Border Frame Keren */
        .frame-outer {
            border: 5px solid #1e293b; /* Dark Blue */
            padding: 5px;
            height: 90%;
        }
        .frame-inner {
            border: 2px solid #4f46e5; /* Primary Purple */
            height: 98%;
            padding: 40px;
            background: radial-gradient(circle, rgba(255,255,255,1) 0%, rgba(240,249,255,1) 100%);
            position: relative;
        }
        /* Ornamen Sudut (Pake CSS Border) */
        .corner {
            position: absolute; width: 50px; height: 50px;
            border-color: #d97706; /* Gold */
            border-style: solid;
        }
        .top-left { top: 10px; left: 10px; border-width: 4px 0 0 4px; }
        .top-right { top: 10px; right: 10px; border-width: 4px 4px 0 0; }
        .bottom-left { bottom: 10px; left: 10px; border-width: 0 0 4px 4px; }
        .bottom-right { bottom: 10px; right: 10px; border-width: 0 4px 4px 0; }

        .logo { font-size: 24px; font-weight: bold; letter-spacing: 2px; color: #4f46e5; text-transform: uppercase; margin-bottom: 30px; }
        .title { font-size: 60px; font-weight: bold; color: #1e293b; margin: 0; letter-spacing: 2px; text-transform: uppercase; }
        .subtitle { font-size: 18px; color: #64748b; margin-top: 10px; text-transform: uppercase; letter-spacing: 4px; }
        
        .presented-to { margin-top: 40px; font-size: 16px; font-style: italic; color: #555; }
        .name { 
            font-size: 48px; font-weight: bold; color: #d97706; /* Gold Name */
            margin: 20px 0; 
            font-family: 'Great Vibes', 'Brush Script MT', cursive; /* Cursive Style if available */
            border-bottom: 1px solid #ddd; display: inline-block; padding: 0 40px 10px;
        }
        
        .content { font-size: 18px; color: #333; line-height: 1.6; margin: 30px auto; max-width: 800px; }
        .event-name { font-weight: bold; color: #1e293b; font-size: 22px; }
        
        .footer-grid { margin-top: 60px; width: 100%; }
        .sign-box { width: 40%; display: inline-block; text-align: center; }
        .sign-line { border-top: 1px solid #333; width: 80%; margin: 60px auto 10px; }
        .sign-name { font-weight: bold; font-size: 16px; }
        .sign-role { font-size: 12px; color: #666; text-transform: uppercase; letter-spacing: 1px; }

        .serial { position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); font-size: 10px; color: #ccc; letter-spacing: 2px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="frame-outer">
            <div class="frame-inner">
                {{-- Ornamen Sudut Gold --}}
                <div class="corner top-left"></div>
                <div class="corner top-right"></div>
                <div class="corner bottom-left"></div>
                <div class="corner bottom-right"></div>

                <div class="logo">VolunTeam Indonesia</div>
                
                <h1 class="title">Sertifikat Apresiasi</h1>
                <div class="subtitle">Penghargaan Dedikasi Relawan</div>

                <div class="presented-to">Diberikan dengan bangga kepada:</div>
                <div class="name">{{ $name }}</div>

                <div class="content">
                    Atas kontribusi waktu, tenaga, dan semangat kemanusiaan yang luar biasa sebagai 
                    <strong>RELAWAN INTI</strong> dalam misi kebaikan:
                    <br><br>
                    <span class="event-name">"{{ $event_title }}"</span>
                    <br><br>
                    Diselenggarakan pada tanggal {{ date('d F Y', strtotime($date)) }}.
                </div>

                <div class="footer-grid">
                    <div class="sign-box">
                        <div class="sign-line"></div>
                        <div class="sign-name">Revan (Founder)</div>
                        <div class="sign-role">Direktur Eksekutif VolunTeam</div>
                    </div>
                    <div class="sign-box">
                        <div class="sign-line"></div>
                        <div class="sign-name">Panitia Pelaksana</div>
                        <div class="sign-role">Koordinator Lapangan</div>
                    </div>
                </div>

                <div class="serial">NO. SERI: VLNT-{{ strtoupper(substr(md5($name . $event_title), 0, 8)) }}-2025</div>
            </div>
        </div>
    </div>
</body>
</html>