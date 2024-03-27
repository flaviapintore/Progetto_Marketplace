<x-layout>
    <div class="container mb-5">
        <div class="row">
            <div class="col 12">
                <h2 class="h2-custom mt-5 text-center">Esplora la categoria {{$category->name}}</h2>
            </div>
        </div>
       
       <div class="row">
        @forelse ($category->announcements()->where('is_accepted', true)->get() as $announcement)
        <div class="col-12 col-md-4 my-2">
        
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
                                class="btn btn-vis border-dark shadow m-2">Visualizza</a>
                            <a href="{{ route('categoryShow', ['category' => $announcement->category]) }}"
                                class="my-2 border-top pt-2 border-dark card-link shadow btn btn-cat m-2">Categoria:{{ $announcement->category->name }}</a>
                        </div>
                        <p class="card-footer">Pubblicato il: {{ $announcement->created_at->format('d/m/Y') }} -
                            Autore
                            {{ $announcement->user->name ?? '' }}</p>

                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="h1 text-rev text-center">Non sono presenti annunci per questa categoria</p>
            <p  class="h2-show-custom text-center">Pubblicane uno: <a href="{{route('createAnnouncement')}}" class="btn btn-success shadow">Crea un nuovo annuncio</a></p>
        </div>
        @endforelse
       </div>
    </div>
</x-layout>