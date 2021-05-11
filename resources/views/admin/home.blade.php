<x-admin.app-layout>

    <x-slot name="tabTitle">Home</x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> Dashboard </h1>
            </x-slot>
        </x-admin.content-header>
    </x-slot>

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                <h3> {{ $totalCategory }} </h3>

                <p> Total Category </p>
                </div>
                <div class="icon">
                <i class="far fa-chart-bar"></i>
                </div>
                <a href="#" class="small-box-footer"> More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>  
        </div>
        <!-- ./col -->
        <div class="col-md-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                <h3> {{ $totalNotebook }} </h3>

                <p> Total Notebook </p>
                </div>
                <div class="icon">
                <i class="fas fa-book-open"></i>
                </div>
                <a href="#" class="small-box-footer"> More Info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

</x-admin.app-layout>
