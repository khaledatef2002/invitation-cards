@extends('dashboard.layouts.app')

@section('title', __('dashboard.book.create'))

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-sm-auto ms-auto">
                <a href="{{ route('dashboard.tenants.index') }}"><button class="btn btn-light"><i class="ri-arrow-go-forward-fill me-1 align-bottom"></i> @lang('dashboard.return')</button></a>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>
<form id="create-tenant-form">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body checkout-tab">
                        <div class="step-arrow-nav mt-n3 mx-n3 mb-3">

                            <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3 active" id="company-info-tab" data-bs-toggle="pill" data-bs-target="#company-info" type="button" role="tab" aria-controls="company-info" aria-selected="true">
                                        Company Info
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3" id="website-info-tab" data-bs-toggle="pill" data-bs-target="#website-info" type="button" role="tab" aria-controls="website-info" aria-selected="false">
                                        Website Info
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3" id="cards-details-tab" data-bs-toggle="pill" data-bs-target="#cards-details" type="button" role="tab" aria-controls="cards-details" aria-selected="false">
                                       Card Details
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="company-info" role="tabpanel" aria-labelledby="company-info-tab">
                                <div class="text-center">
                                    <h5 class="mb-1">Company general info</h5>
                                    <p class="text-muted mb-4">Please fill all information below</p>
                                </div>
                                <div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Company Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter company name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="domain" class="form-label">Domain</label>
                                        <input type="text" class="form-control" id="domain" name="domain" placeholder="Enter domain">
                                    </div>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="website-info" role="tabpanel" aria-labelledby="website-info-tab">
                                <div class="text-center">
                                    <h5 class="mb-1">Website Info</h5>
                                    <p class="text-muted mb-4">Please fill all information below</p>
                                </div>
                                <div>
                                    <div>
                                        <h5 class="card-title mb-0">Choose Logo</h5>
                                        <p class="text-muted mb-3">Scale Ratio: (1: 1) (W:H)</p>
                                        <div class="auto-image-show">
                                            <input id="logo" name="logo" type="file" class="profile-img-file-input" accept="image/*" hidden>
                                            <label for="logo" class="border rounded-2 profile-photo-edit d-flex justify-content-center align-items-center" style="max-height: 150px;aspect-ratio: 1 / 1;overflow:hidden">
                                                <img src="{{ asset('back/images/users/user-dummy-img.jpg') }}" style="min-width:100%;min-height:100%;" alt="website logo">
                                            </label>
                                        </div>  
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter website title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" placeholder="Enter website description"></textarea>
                                    </div>
                                    <hr>
                                    <div>
                                        <h5 class="card-title mb-0">Choose Background</h5>
                                        <p class="text-muted mb-3">Scale Ratio: (1: 0.45) (W:H)</p>
                                        <div class="auto-image-show">
                                            <input id="background" name="background" type="file" class="profile-img-file-input" accept="image/*" hidden>
                                            <label for="background" class="border rounded-2 profile-photo-edit d-flex justify-content-center align-items-center" style="max-height: 200px;aspect-ratio: 1 / 0.45;overflow:hidden">
                                                <img src="{{ asset('back/images/nft/bg-pattern.png') }}" style="min-width:100%;min-height:100%;" alt="website background">
                                            </label>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="cards-details" role="tabpanel" aria-labelledby="cards-details-tab">
                                <div class="text-center">
                                    <h5 class="mb-1">Card Details</h5>
                                    <p class="text-muted mb-4">Please select and enter all information</p>
                                </div>
                                <div>
                                    <h5 class="mb-2">Submit Button:</h5>
                                    <div class="d-flex gap-2 col-12 flex-wrap">
                                        <div class="mb-3 flex-fill">
                                            <label for="button_color" class="form-label">Submit Text Color</label>
                                            <input type="color" class="form-control" id="button_color" name="button_color" placeholder="Enter submit text color">
                                        </div>
                                        <div class="mb-3 flex-fill">
                                            <label for="button_background" class="form-label">Submit background Color</label>
                                            <input type="color" class="form-control" id="button_background" name="button_background" placeholder="Enter submit background color">
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 col-12 flex-wrap">
                                        <div class="mb-3 flex-fill">
                                            <label for="border_color" class="form-label">Submit border Color</label>
                                            <input type="color" class="form-control" id="border_color" name="border_color" placeholder="Enter submit border color">
                                        </div>
                                        <div class="mb-3 flex-fill">
                                            <label for="button_border_width" class="form-label">Submit border width</label>
                                            <input type="number" class="form-control" id="border_width" name="border_width" placeholder="Enter submit border width">
                                        </div>
                                        <div class="mb-3 flex-fill">
                                            <label for="button_border-radius" class="form-label">Submit border radius</label>
                                            <input type="number" class="form-control" id="border_radius" name="border_radius" placeholder="Enter submit border radius">
                                        </div>
                                    </div>
                                    <hr>
                                    <h5 class="mb-2">Wide Card:</h5>
                                    <div>
                                        <h5 class="card-title mb-0">Choose Wide Background</h5>
                                        <p class="text-muted mb-3">Best Scale Ratio: (1: 0.45) (W:H)</p>
                                        <div class="auto-image-show">
                                            <input id="wide" name="wide" type="file" class="profile-img-file-input" accept="image/*" hidden>
                                            <label for="wide" class="border rounded-2 profile-photo-edit d-flex justify-content-center align-items-center" style="max-height: 200px;aspect-ratio: 1 / 0.45;overflow:hidden">
                                                <img src="{{ asset('back/images/nft/bg-pattern.png') }}" style="min-width:100%;min-height:100%;" alt="Wide Card">
                                            </label>
                                        </div>  
                                    </div>
                                    <div class="d-flex gap-2 col-12 flex-wrap">
                                        <div class="mb-3 flex-fill">
                                            <label for="x_wide" class="form-label">Wide x</label>
                                            <input type="number" min="1" class="form-control" id="x_wide" name="x_wide" placeholder="Enter wide x">
                                        </div>
                                        <div class="mb-3 flex-fill">
                                            <label for="y_wide" class="form-label">Wide y</label>
                                            <input type="number" min="1" class="form-control" id="y_wide" name="y_wide" placeholder="Enter wide y">
                                        </div>
                                        <div class="mb-3 flex-fill">
                                            <label for="font_size_wide" class="form-label">Wide font size</label>
                                            <input type="number" min="1" class="form-control" id="font_size_wide" name="font_size_wide" placeholder="Enter wide font size">
                                        </div>
                                    </div>
                                    <hr>
                                    <h5 class="mb-2">Long Card:</h5>
                                    <div>
                                        <h5 class="card-title mb-0">Choose Long Background</h5>
                                        <p class="text-muted mb-3">Best Scale Ratio: (1: 2) (W:H)</p>
                                        <div class="auto-image-show">
                                            <input id="long" name="long" type="file" class="profile-img-file-input" accept="image/*" hidden>
                                            <label for="long" class="border rounded-2 profile-photo-edit d-flex justify-content-center align-items-center" style="max-height: 200px;aspect-ratio: 1 / 2;overflow:hidden">
                                                <img src="{{ asset('back/images/nft/bg-pattern.png') }}" style="min-width:100%;min-height:100%;" alt="Long Card">
                                            </label>
                                        </div>  
                                    </div>
                                    <div class="d-flex gap-2 col-12 flex-wrap">
                                        <div class="mb-3 flex-fill">
                                            <label for="x_long" class="form-label">Long x</label>
                                            <input type="number" min="1" class="form-control" id="x_long" name="x_long" placeholder="Enter long x">
                                        </div>
                                        <div class="mb-3 flex-fill">
                                            <label for="y_long" class="form-label">Long y</label>
                                            <input type="number" min="1" class="form-control" id="y_long" name="y_long" placeholder="Enter long y">
                                        </div>
                                        <div class="mb-3 flex-fill">
                                            <label for="font_size_long" class="form-label">Long font size</label>
                                            <input type="number" min="1" class="form-control" id="font_size_long" name="font_size_long" placeholder="Enter long font size">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <button class="btn btn-success mt-2 d-block w-100" type="submit">Submit</button>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</form>

@endsection

@section('custom-js')
    <script src="{{ asset('back/js/tenants.js') }}"></script>
@endsection