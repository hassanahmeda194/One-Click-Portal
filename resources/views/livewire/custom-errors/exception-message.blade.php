<div class="page error-bg">
    <div class="page-content m-0">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="{{ asset('assets/images/png/error.png') }}" alt="img" class="mt-7">
                </div>
                <div class="col-md-7 mt-6">
                    <div class="display-1 text-primary  mb-2 font-weight-semibold" style="font-size: 4.5rem !important;"> Portal Error!!</div>
                    <h1 class="h3  mb-3 font-weight-semibold">Something went Wrong! Please Contact to Developer</h1>
                    <p class="h5 font-weight-normal mb-7 leading-normal">{{ $Message }}</p>
                    <a class="btn btn-primary" href="{{ route('Main.Dashboard') }}"><i class="fe fe-arrow-left-circle me-1"></i>Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
