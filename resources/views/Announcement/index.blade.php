<x-layout>
    <div class="container-fluid p-5 bg-grandient shadow mb-4 rev-custom">
        <div class="row">
            <div class="col-12 text-center p-5">
            
                    <h1 class=" display-2 h2-custom d-flex justify-content-center">Tutti i prodotti</h1>
               
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            
            @forelse ($announcements as $announcement)
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
            @empty
                <div class="col-12">
                    <div class="alert alert-warning py-3 shadow">
                        <p class="lead">Non ci sono annunci per questa ricerca. Prova a cambiare </p>
                    </div>
                </div>
            @endforelse
            {{ $announcements->links() }}
        </div>
    </div>
</x-layout>
