@extends('layouts.main')

@section('content')
    <section class="bg-light">
        <div class="container-fluid">
            <div class="py-5 row row-cols-1 justify-content-center">
                <div class="mb-4 col-xxl-7">
                    <div class="lc-block">
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_u1xuufn3.json" class="mx-auto"
                            background="transparent" speed="1" loop="" autoplay=""></lottie-player>
                    </div><!-- /lc-block -->
                </div><!-- /col -->
                <div class="text-center col">
                    <div class="lc-block">
                        <!-- /lc-block -->
                        <div class="mb-4 lc-block">
                            <div editable="rich">
                                <p class="rfs-11 fw-light"> The page you are looking for was moved, removed or might never
                                    existed.</p>
                            </div>
                        </div><!-- /lc-block -->
                        <div class="lc-block">
                            <a class="btn btn-lg btn-primary" href="{{ route('home') }}" role="button">Back to
                                Dashboard</a>
                        </div><!-- /lc-block -->
                    </div><!-- /lc-block -->
                </div><!-- /col -->
            </div>

        </div>
    </section>
@endsection
