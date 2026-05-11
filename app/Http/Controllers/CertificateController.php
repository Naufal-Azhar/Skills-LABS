<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CertificateController extends Controller
{
    public function index(): View
    {
        $certificates = auth()
            ->user()
            ->certificates()
            ->with("lab.category")
            ->latest()
            ->get();

        return view("certificates.index", compact("certificates"));
    }

    public function verify(string $code): View
    {
        $certificate = Certificate::with(["user.major.faculty", "lab.category"])
            ->where("certificate_code", $code)
            ->firstOrFail();

        return view("certificates.verify", compact("certificate"));
    }

    public function download(string $code)
    {
        $certificate = Certificate::with(["user.major.faculty", "lab"])
            ->where("certificate_code", $code)
            ->where("user_id", auth()->id())
            ->firstOrFail();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView(
            "certificates.pdf",
            compact("certificate"),
        );
        $pdf->setPaper("A4", "landscape");

        return $pdf->download(
            "sertifikat-" . $certificate->certificate_code . ".pdf",
        );
    }
}
