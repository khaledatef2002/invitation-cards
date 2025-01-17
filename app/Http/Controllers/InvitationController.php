<?php

namespace App\Http\Controllers;

use App\ArabicGD;
use App\ArPHP\Arabic;
use App\Models\InvitationDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class InvitationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $inv = InvitationDetail::firstOrFail();
        return view('front.invitation-display', compact('inv'));
    }

    public function generate(Request $request, String $type)
    {
        if(!in_array($type, ['long', 'wide']))
        {
            return response()->json([
                "status" => "error",
                "message" => "يرجى اختيار الحجم المطلوب (عرضي أو طولي)"
            ], 400);
        }
        if(!$request->has('name'))
        {
            return response()->json([
                "status" => "error",
                "message" => "يرجى ادخال الاسم"
            ], 400);
        }
        if(!$request->has('captcha'))
        {
            return response()->json([
                "status" => "error",
                "message" => "يرجى ادخال رمز التحقق"
            ], 400);
        }
        if($request->captcha != session('captcha_code'))
        {
            return response()->json([
                "status" => "error",
                "message" => "رمز التحقق الذي ادخلته غير صحيح"
            ], 400);
        }

        $inv = InvitationDetail::firstOrFail();

        $image_path = ($type === 'wide') ? Storage::disk('public')->path($inv->wide) :Storage::disk('public')->path($inv->long);
        $x = ($type === 'wide') ? $inv->x_wide : $inv->x_long;
        $y = ($type === 'wide') ? $inv->y_wide : $inv->y_long;
        $font_size = ($type === 'wide') ? $inv->font_size_wide : $inv->font_size_long;

        $manager = new ImageManager(new Driver());
        $image = $manager->read($image_path);

        $Arabic = new Arabic('Glyphs');
        $name = $Arabic->utf8Glyphs($request->name);

        $image->text($name, $x, $y, function($font) use ($font_size) {
            $font->file(public_path('front/fonts/text.ttf'));
            $font->size($font_size);
            $font->color('#ffffff');
            $font->align('center');
            $font->valign('top');
        });

        return response()->streamDownload(function () use ($image) {
            echo $image->encodeByMediaType('image/jpeg');
        }, 'generated_card.jpg', [
            'Content-Type' => 'image/jpeg',
            'Content-Disposition' => 'attachment; filename="generated_card.jpg"'
        ]);
    }
}
