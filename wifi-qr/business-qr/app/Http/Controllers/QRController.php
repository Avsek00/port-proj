<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Zxing\QrReader;
use Illuminate\Support\Facades\Log;

class QRController extends Controller
{
    public function showForm()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->file('qr_code')->isValid()) {
            $path = $request->file('qr_code')->store('qr_codes', 'public');
            return $this->processQr($path);
        }

        return response()->json(['error' => 'Failed to upload QR Code'], 400);
    }

    private function processQr($path)
    {
        $qrReader = new QrReader(storage_path("app/public/{$path}"));
        $text = $qrReader->text();

        if ($text && preg_match('/^WIFI:S:(.*);T:(.*);P:(.*);;$/', $text, $matches)) {
            return response()->json([
                'ssid' => $matches[1],
                'encryption' => $matches[2],
                'password' => $matches[3]
            ]);
        }

        return response()->json(['message' => 'QR code does not contain Wi-Fi information']);



        try {
            $qrReader = new QrReader(storage_path("app/public/{$path}"));
            $text = $qrReader->text();
            Log::info("QR Text: " . $text); // Log QR code text
    
            if ($text && preg_match('/^WIFI:S:(.*);T:(.*);P:(.*);;$/', $text, $matches)) {
                return response()->json([
                    'ssid' => $matches[1],
                    'encryption' => $matches[2],
                    'password' => $matches[3]
                ]);
            } else {
                Log::warning("QR code does not contain Wi-Fi information.");
                return response()->json(['message' => 'QR code does not contain Wi-Fi information']);
            }
        } catch (\Exception $e) {
            Log::error("Error processing QR code: " . $e->getMessage());
            return response()->json(['error' => 'Failed to read QR code'], 400);
        }
    }

    
}
