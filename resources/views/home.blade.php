@extends('layouts.app')

@section('content')

    <layout-navbar></layout-navbar>

    <div class="container-fluid" >
        <div class="row">
            <layout-sidebar class="d-print-none"></layout-sidebar>
            <main role="main" class="main col-12 col-md-9 ml-sm-auto col-lg-10 pt-3 px-4" >
                <div class="container-fluid main-container" >
                    <div class="row">
                        <div class="col">
                            <router-view :key="$route.name + ($route.params.id || '')"></router-view>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

@endsection
