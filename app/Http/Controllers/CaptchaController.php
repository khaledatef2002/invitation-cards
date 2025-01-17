<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\Geometry\Factories\LineFactory;
use Intervention\Image\ImageManager;

class CaptchaController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function generate(Request $request)
    {
        $captcha_code = '';
        $chars = '0123456789';
        for ($i = 0; $i < 3; $i++) {
            $captcha_code .= $chars[rand(0, strlen($chars) - 1)];
        }

        // Store the CAPTCHA code in session to validate later
        $request->session()->put('captcha_code', $captcha_code);

        $manager = new ImageManager(new Driver());

        // Create a new image with Intervention Image
        $image = $manager->create(120, 40)->fill('#ffffff');

        // Add random lines for noise
        for ($i = 0; $i < 5; $i++) {
            $image->drawLine(function (LineFactory $line){
                $line->from(rand(0, 120), rand(0, 40));
                $line->to(rand(0, 120), rand(0, 40));
                $line->color('#404040');
                $line->width(1);
            });
        }


        // Add the CAPTCHA code text
        $image->text($captcha_code, rand(10, 40), rand(25, 35), function ($font) {
            $font->file('front/fonts/captcha.ttf');
            $font->size(15);
            $font->color('#000000');
            $font->angle(rand(-10, 10));
        });
        
        // Output the image as PNG
        return response()->stream(function () use ($image) {
            echo $image->encodeByMediaType('image/png');
        }, 200, [
            'Content-Type' => 'image/png',
        ]);
    }

    public function read()
    {
        $captcha_code = session('captcha_code');
        return response()->json(['captcha_code' => $captcha_code]);
    }
}
