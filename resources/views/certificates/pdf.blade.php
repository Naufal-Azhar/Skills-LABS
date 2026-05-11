<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; background: #fff; }
        .cert { width: 100%; height: 100vh; border: 12px solid #1E40AF; padding: 40px; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; position: relative; }
        .logo { font-size: 24px; font-weight: 900; color: #1E40AF; letter-spacing: 2px; margin-bottom: 4px; }
        .subtitle { font-size: 12px; color: #64748b; margin-bottom: 30px; }
        .cert-title { font-size: 14px; color: #64748b; text-transform: uppercase; letter-spacing: 4px; margin-bottom: 20px; }
        .student-name { font-size: 42px; font-weight: 900; color: #0F172A; margin-bottom: 10px; border-bottom: 3px solid #06B6D4; padding-bottom: 10px; }
        .description { font-size: 14px; color: #64748b; margin: 20px 0 10px; }
        .lab-title { font-size: 26px; font-weight: 700; color: #1E40AF; margin-bottom: 6px; }
        .meta { font-size: 12px; color: #94a3b8; margin-bottom: 30px; }
        .footer { display: flex; justify-content: space-between; width: 100%; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e8f0; }
        .footer-item { text-align: center; }
        .footer-label { font-size: 10px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; }
        .footer-value { font-size: 12px; font-weight: 700; color: #334155; margin-top: 4px; }
        .badge { background: #f0fdf4; border: 2px solid #22c55e; color: #15803d; padding: 6px 16px; border-radius: 20px; font-size: 12px; font-weight: 700; margin-bottom: 20px; display: inline-block; }
    </style>
</head>
<body>
<div class="cert">
    <div class="logo">Skills LABS</div>
    <div class="subtitle">Institut Teknologi Batam (ITEBA)</div>
    <div class="cert-title">Sertifikat Penyelesaian</div>
    <div class="badge">✅ VERIFIED</div>
    <p class="description">Sertifikat ini diberikan kepada</p>
    <div class="student-name">{{ $certificate->user->name }}</div>
    <p style="font-size:13px; color:#64748b; margin-bottom:6px;">
        NIM: <strong>{{ $certificate->user->nim }}</strong> &nbsp;|&nbsp;
        {{ $certificate->user->major?->name ?? 'ITEBA' }}
    </p>
    <p class="description">telah berhasil menyelesaikan Hands-On Lab</p>
    <div class="lab-title">{{ $certificate->lab->title }}</div>
    <div class="meta">{{ $certificate->lab->category->name }} · {{ $certificate->lab->level_label ?? ucfirst($certificate->lab->level) }}</div>

    <div class="footer">
        <div class="footer-item">
            <div class="footer-label">Tanggal Diterbitkan</div>
            <div class="footer-value">{{ $certificate->issued_at->format('d F Y') }}</div>
        </div>
        <div class="footer-item">
            <div class="footer-label">Kode Sertifikat</div>
            <div class="footer-value" style="font-family: monospace;">{{ $certificate->certificate_code }}</div>
        </div>
        <div class="footer-item">
            <div class="footer-label">Institusi</div>
            <div class="footer-value">Skills LABS — ITEBA</div>
        </div>
    </div>
</div>
</body>
</html>
