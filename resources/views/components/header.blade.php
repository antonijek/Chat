<div >
    <nav class="navbar pt-0 ">
            <div class="d-flex container-fluid bg-success-subtle justify-content-around">
{{--                <a class="navbar-brand" href="#">--}}
{{--                    <img src="https://www.lebow.drexel.edu/sites/default/files/legacy/story/1501077931-network.jpg" alt="Logo" width="180" height="120" class="d-inline-block ">--}}
{{--                </a>--}}
                <div class=" text-end">
                    <h2 class="fs-1 text-success m-4 fw-bold ">Let's connect!</h2>
                </div>
                <div>
{{--                    Programmers network--}}
                </div>
                <div class="flex-center position-ref full-height">
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-success text-decoration-none h5">Home</a>
                            @else
                                <a href="{{ route('login') }}" class="text-success text-decoration-none h5">Log in</a>


                            @endauth
                        </div>
                    @endif
                </div>
            </div>
    </nav>

</div>
