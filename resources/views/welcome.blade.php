<x-layout>
    @if(session()->has('message'))
    <div class="flex flex-row justify-center my-2 alert alert-success">
        {{session('message')}}
    </div>
    @endif
    <x-header title="Flash.it" />
    <h2 class="h2-show-custom mt-3 d-flex justify-content-center display-7">{{__('ui.welcome')}}</h2>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                
                <video class="video-custom" autoplay muted loop id="myVideo">
                    <source src="./img/video-sfondo3.mp4" type="video/mp4">
                </video>
                
            </div>
        </div>
    </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <h2 class="h2-show-custom mt-3 display-7">{{__('ui.allAnnouncements')}}</h2>
            </div>
        <div class="row justify-content-beetwen">
            @foreach ($announcements as $announcement)
                <div class=" col-12 col-md-4 my-5 d-flex justify-content-center">
                    <div class="card" style="width:22rem">
                        <div class="card-body shadow p-2">

                            <img src="{{ $announcement->images->isNotEmpty() ? $announcement->images->first()->getUrl(400, 300) : 'https://picsum.photos/200/200' }}"
                                class="card-img-top rounded" alt="...">
                            <div class="px-2">
                                <h5 class="card-title m-2 fw-bold">{{ $announcement->title }}</h5>
                                <p class=" fw-bold">{{ $announcement->body }}</p>
                                <p class="card-text m-2">{{ $announcement->price }}$</p>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('announcements.show', compact('announcement')) }}"
                                    class="btn btn-vis shadow m-2">Visualizza</a>
                                <a href="{{ route('categoryShow', ['category' => $announcement->category]) }}"
                                    class="my-2 pt-2 card-link shadow btn btn-cat m-2">Categoria:{{ $announcement->category->name }}</a>
                            </div>
                            <p class="card-footer">Pubblicato il: {{ $announcement->created_at->format('d/m/Y') }} -
                                Autore
                                {{ $announcement->user->name ?? '' }}</p>


                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>

</x-layout>
