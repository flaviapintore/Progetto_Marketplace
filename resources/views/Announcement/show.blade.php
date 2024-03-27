<x-layout>
    <div class="container">
        <div class="row justify-content-around vh-100 align-items-center">
            <div class="col-12 col-md-5">
                <div id="carouselExample" class="carousel slide">

                         @if ($announcement->images)
                        <div class="carousel-inner">
                            @foreach ($announcement->images as $image )
                                <div class="carousel-item @if($loop->first)active @endif">
                                    <img src="{{ Storage::url($image->path)}}" class="img-fluid p-3 rounded" alt="">
                                </div>
                            @endforeach 
                        </div>  
                        @else
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src= 'https://picsum.photos/200/200' class="img-fluid p-3 rounded" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src='https://picsum.photos/200/200' class="img-fluid p-3 rounded" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src='https://picsum.photos/200/200' class="img-fluid p-3 rounded" alt="...">
                                </div>
                            </div>
                        @endif
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="card-show p-5 rounded-4">
                    <h3 class="card-title">{{ $announcement->title }}</h3>
                    <p class="text-light">Descrizione: {{ $announcement->body }}</p>
                    <p class="text-light">Prezzo: {{ $announcement->price }}$</p>
                    <a href="{{ route('categoryShow', ['category' => $announcement->category]) }}"
                        class="my-2 pt-2 btn btn-show">Categoria:
                        {{ $announcement->category->name }}</a>
                    <p class="text-light">Pubblicato il: {{ $announcement->created_at->format('d/m/Y') }}
                        -
                        Autore {{ $announcement->user->name ?? '' }}</p>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-layout>
