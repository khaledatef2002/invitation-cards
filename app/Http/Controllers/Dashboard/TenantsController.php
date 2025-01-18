<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\InvitationDetail;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;
use Intervention\Image\Encoders\AutoEncoder;
use Yajra\DataTables\Facades\DataTables;

class TenantsController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $quotes = Tenant::get();
            return DataTables::of($quotes)
            ->rawColumns(['action'])
            ->addColumn('action', function($row){
                return 
                "<div class='d-flex align-items-center justify-content-center gap-2'>"
                .
                (Auth::user()->hasPermissionTo('roles_edit') ?
                "   
                    <a href='" . route('dashboard.tenants.edit', $row) . "'><i class='ri-settings-5-line fs-4' type='submit'></i></a>    
                "
                :"")
                .
                (Auth::user()->hasPermissionTo('roles_delete') ?
                "
                    <form id='remove_role' data-id='".$row['id']."' onsubmit='remove_role(event, this)'>
                        <input type='hidden' name='_method' value='DELETE'>
                        <input type='hidden' name='_token' value='" . csrf_token() . "'>
                        <button class='remove_button' onclick='remove_button(this)' type='button'><i class='ri-delete-bin-5-line text-danger fs-4'></i></button>
                    </form>
                " : "")
                .
                "</div>";
            })
            ->editColumn('domain', function(Tenant $tenant){
                return "<a href='http://{$tenant->domain}' target='_blank'>{$tenant->domain}</a>";
            })
            ->rawColumns(['domain', 'action'])
            ->make(true);
        }
        return view('dashboard.tenants.index');
    }

    public function create()
    {
        return view('dashboard.tenants.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'domain' => ['required', 'string', 'max:30', 'unique:tenants,domain'],
            'logo' => ['required', 'image', 'mimes:jpeg,png,jpg|max:10240'],
            'title' => ['required', 'string', 'max:30'],
            'description' => ['required', 'max: 255'],
            'background' => ['required', 'image', 'mimes:jpeg,png,jpg|max:10240'],
            'button_color' => ['required'],
            'button_background' => ['required'],
            'border_color' => ['required'],
            'border_width' => ['required', 'numeric', 'min:0'],
            'border_radius' => ['required', 'numeric', 'min:0'],
            'wide' => ['required', 'image', 'mimes:jpeg,png,jpg|max:10240'],
            'x_wide' => ['required', 'numeric', 'min:0'],
            'y_wide' => ['required', 'numeric', 'min:0'],
            'font_size_wide' => ['required', 'numeric', 'min:0'],
            'long' => ['required', 'image', 'mimes:jpeg,png,jpg|max:10240'],
            'x_long' => ['required', 'numeric', 'min:0'],
            'y_long' => ['required', 'numeric', 'min:0'],
            'font_size_long' => ['required', 'numeric', 'min:0'],
        ]);

        if ($request->hasFile('logo')) {

            $image = $request->file('logo');
            $imagePath = 'logos/' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            $manager = new ImageManager(new GdDriver());
            $optimizedImage = $manager->read($image)
                ->scale(width: 250)
                ->encode(new AutoEncoder(quality: 75));

            Storage::disk('public')->put($imagePath, (string) $optimizedImage);
    
            $data['logo'] = $imagePath;
        }

        if ($request->hasFile('background')) {

            $image = $request->file('background');
            $imagePath = 'background/' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            $manager = new ImageManager(new GdDriver());
            $optimizedImage = $manager->read($image)
                ->scale(width: 250)
                ->encode(new AutoEncoder(quality: 75));

            Storage::disk('public')->put($imagePath, (string) $optimizedImage);
    
            $data['background'] = $imagePath;
        }

        if ($request->hasFile('long')) {

            $image = $request->file('long');
            $imagePath = 'long/' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            $manager = new ImageManager(new GdDriver());
            $optimizedImage = $manager->read($image)
                ->scale(height: 600)
                ->encode(new AutoEncoder(quality: 75));

            Storage::disk('public')->put($imagePath, (string) $optimizedImage);
    
            $data['long'] = $imagePath;
        }

        
        if ($request->hasFile('wide')) {

            $image = $request->file('wide');
            $imagePath = 'wide/' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            $manager = new ImageManager(new GdDriver());
            $optimizedImage = $manager->read($image)
                ->scale(width: 600)
                ->encode(new AutoEncoder(quality: 75));

            Storage::disk('public')->put($imagePath, (string) $optimizedImage);
    
            $data['wide'] = $imagePath;
        }

        $scriptPath = '/var/scripts/add_domain_to_cloudpanel.sh';
        $command = "bash $scriptPath " . $data['domain'];
        $output = [];
        $statusCode = 0;

        exec($command, $output, $statusCode);


        $tenant = Tenant::create($data);

        $data['tenant_id'] = $tenant->id;

        $invitation_details = InvitationDetail::create($data);

        return response()->json(['redirectUrl' => route('dashboard.tenants.edit', $tenant)]);
    }

    public function edit(Tenant $tenant)
    {
        return view('dashboard.tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $details = InvitationDetail::where('tenant_id', $tenant->id)->first();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'logo' => ['image', 'mimes:jpeg,png,jpg|max:10240'],
            'title' => ['required', 'string', 'max:30'],
            'description' => ['required', 'max: 255'],
            'background' => ['image', 'mimes:jpeg,png,jpg|max:10240'],
            'button_color' => ['required'],
            'button_background' => ['required'],
            'border_color' => ['required'],
            'border_width' => ['required', 'numeric', 'min:0'],
            'border_radius' => ['required', 'numeric', 'min:0'],
            'wide' => ['image', 'mimes:jpeg,png,jpg|max:10240'],
            'x_wide' => ['required', 'numeric', 'min:0'],
            'y_wide' => ['required', 'numeric', 'min:0'],
            'font_size_wide' => ['required', 'numeric', 'min:0'],
            'long' => ['image', 'mimes:jpeg,png,jpg|max:10240'],
            'x_long' => ['required', 'numeric', 'min:0'],
            'y_long' => ['required', 'numeric', 'min:0'],
            'font_size_long' => ['required', 'numeric', 'min:0'],
        ]);

        if ($request->hasFile('logo')) {

            $image = $request->file('logo');
            $imagePath = 'logos/' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            $manager = new ImageManager(new GdDriver());
            $optimizedImage = $manager->read($image)
                ->scale(width: 250)
                ->encode(new AutoEncoder(quality: 75));

            Storage::disk('public')->put($imagePath, (string) $optimizedImage);
    
            $details->logo = $imagePath;
        }

        if ($request->hasFile('background')) {

            $image = $request->file('background');
            $imagePath = 'background/' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            $manager = new ImageManager(new GdDriver());
            $optimizedImage = $manager->read($image)
                ->scale(width: 250)
                ->encode(new AutoEncoder(quality: 75));

            Storage::disk('public')->put($imagePath, (string) $optimizedImage);
    
            $details->background = $imagePath;
        }

        if ($request->hasFile('long')) {

            $image = $request->file('long');
            $imagePath = 'long/' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            $manager = new ImageManager(new GdDriver());
            $optimizedImage = $manager->read($image)
                ->scale(height: 600)
                ->encode(new AutoEncoder(quality: 75));

            Storage::disk('public')->put($imagePath, (string) $optimizedImage);
    
            $details->long = $imagePath;
        }

        
        if ($request->hasFile('wide')) {

            $image = $request->file('wide');
            $imagePath = 'wide/' . uniqid() . '.' . $image->getClientOriginalExtension();
    
            $manager = new ImageManager(new GdDriver());
            $optimizedImage = $manager->read($image)
                ->scale(width: 600)
                ->encode(new AutoEncoder(quality: 75));

            Storage::disk('public')->put($imagePath, (string) $optimizedImage);
    
            $details->wide = $imagePath;
        }

        $tenant->name = $data['name'];
        $details->title = $data['title'];
        $details->description = $data['description'];
        $details->button_color = $data['button_color'];
        $details->button_background = $data['button_background'];
        $details->border_color = $data['border_color'];
        $details->border_width = $data['border_width'];
        $details->border_radius = $data['border_radius'];
        $details->x_wide = $data['x_wide'];
        $details->y_wide = $data['y_wide'];
        $details->font_size_wide = $data['font_size_wide'];
        $details->x_long = $data['x_long'];
        $details->y_long = $data['y_long'];
        $details->font_size_long = $data['font_size_long'];

        $tenant->save();
        $details->save();
    }

    public function destroy(Tenant $tenant)
    {
        $scriptPath = '/var/scripts/remove_domain_from_cloudpanel.sh';
        $command = "bash $scriptPath " . $tenant->domain;
        $output = [];
        $statusCode = 0;

        $tenant->delete();
        return response()->json(['message' => 'Tenant deleted successfully']);
    }
}
