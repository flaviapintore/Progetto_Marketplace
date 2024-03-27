<x-layout>
    <div class="container-fluid p-5 bg-grandient shadow mb-4 rev-custom">
        <div class="row">
            <div class="col-12 text-center p-5">
                <h1 class="display-2">
                    {{ $announcement_to_check ? 'Annunci da revisionare' : 'Non ci sono annunci da revisionare' }}
                </h1>
            </div>
        </div>
    </div>
    @if ($announcement_to_check)
        <div class="container d-flex justify-content-between">
            <div class="row justify-content-center">
                <div class="col-12 mt-5">


                    <div id="carouselExample" class="carousel slide">

                        <div class="carousel-inner">
                            @forelse($announcement_to_check->images as $image)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    <img src="{{ $image->getUrl(400, 300) }}" class="d-block w-100" alt="...">
                                </div>
                            @empty
                                <div class="carousel-item active">
                                    <img src="https://picsum.photos/200/200" class="d-block w-100" alt="...">
                                </div>
                            @endforelse
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                            <i class="fa-solid fa-arrow-left"aria-hidden="true"></i>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
                            <i class="fa-solid fa-arrow-right"aria-hidden="true"></i>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>


            <div class="d-flex justify-content-around mt-5">
                <form
                action="{{ route('revisor.accept_announcement', ['announcement' => $announcement_to_check]) }}"
                method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-success shadow">Accetta</button>
            </form>

            <form
                action="{{ route('revisor.reject_announcement', ['announcement' => $announcement_to_check]) }}"
                method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-danger shadow">Rifiuta</button>
            </form>

            </div>
                    
                </div>
            




            <div class="col-md-6">
                <h4 class="mt-5 text-label">Titolo: <span class="text-label2">{{ $announcement_to_check->title }}</span></h4>
                    <h5 class="text-label">Descrizione: <span class="text-label2">{{ $announcement_to_check->body }}</span></h5>
                    <h5 class="text-label">Pubblicato il:
                    <span class="text-label2">{{ $announcement_to_check->created_at->format('d/m/Y') }}</span></h5>
                <h5 class="text-label mt-5">Tags</h5>
                @foreach ($announcement_to_check->images as $image)
                    @if ($image->labels)
                        @foreach ($image->labels as $label)
                            <p class="d-inline title-label"><span class="text-label2">{{ $label }}</span></p>
                        @endforeach
                    @endif
                @endforeach
                <div class="card-body mt-3">
                    @foreach ($announcement_to_check->images as $image)
                        <h5 class="text-label">Revisione immagini</h5>
                        <p class="text-light">Adulti: <span class="{{ $image->adult }}"></span></p>
                        <p class="text-light">Satira: <span class="{{ $image->spoof }}"></span></p>
                        <p class="text-light">Medicina: <span class="{{ $image->medical }}"></span>
                        </p>
                        <p class="text-light">Violenza: <span class="{{ $image->violence }}"></span></p>
                        <p class="text-light">Contenuto ammiccante: <span
                                class="{{ $image->racy }}"></span></p>
                    @endforeach
                </div>
            </div>


        </div>
    @endif
</x-layout>
