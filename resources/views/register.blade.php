@extends('layout')

@section('title', 'Trang Chủ')
@section('titlepage', 'Trang Chủ')

@section('content')
<!-- Start Hero Section -->
<div class="hero mt-5">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Registration</h1>
                </div>
            </div>
            <div class="col-lg-7"></div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section">
    <div class="container">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Registration Form -->
                        <form>
                            <div class="mb-3">
                                <label
                                    for="regFirstName"
                                    class="form-label"
                                    >First Name</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="regFirstName"
                                />
                            </div>
                            <div class="mb-3">
                                <label
                                    for="regLastName"
                                    class="form-label"
                                    >Last Name</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="regLastName"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="regEmail" class="form-label"
                                    >Email address</label
                                >
                                <input
                                    type="email"
                                    class="form-control"
                                    id="regEmail"
                                />
                            </div>
                            <div class="mb-3">
                                <label
                                    for="regPassword"
                                    class="form-label"
                                    >Password</label
                                >
                                <input
                                    type="password"
                                    class="form-control"
                                    id="regPassword"
                                />
                            </div>
                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                Register
                            </button>
                        </form>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

