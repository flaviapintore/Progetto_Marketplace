<div class="container mt-5 border shadow">

    <h2 class="h2-show-custom text-center mt-5">Inserisci il tuo prodotto</h2>

    @if (session()->has('message'))
        <div class="flex flex-row justify-center my-2 alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-8">
            <form wire:submit.prevent='store'>
                @csrf
                <div class="form-row mt-5 mb-5">
                    <div class="form-group">
                        <label for="inputEmail4">Nome prodotto</label>
                        <input wire:model="title" type="text"
                            class="form-control @error('title') is-invalid @enderror">
                        @error('title')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group mt-5 mb-5">
                        <label for="inputPassword4">Descrizione prodotto</label>
                        <textarea wire:model="body" class="form-control @error('body') is-invalid @enderror"></textarea>
                        @error('body')
                            <p>{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="form-group">
                    <label for="inputAddress">Prezzo</label>
                    <input wire:model="price" type="number" class="form-control @error('price') is-invalid @enderror">
                    @error('price')
                        <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-5 mb-5 form-group">
                    <label for="category">Categoria</label>
                    <select wire:model.defer="category" id="category" class="form-control">
                        <option value="">Scegli la categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        is-invalid
                    @enderror
                    @error('category')
                        <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 form-group">
                    <label for="images">Immagine</label>
                    <input wire:model='temporary_images' type="file" name="images" multiple
                        class="form-control shadow @error('temporary_images.*') is-invalid @enderror"
                        placeholder="Img" />
                    @error('temporary_images.*')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>

                @if (!empty($images))
                    <div class="row">
                        <div class="col-12">
                            <p>Photo preview:</p>
                            <div class="row border-4 border-cus roundend shadow py-4">
                                @foreach ($images as $key => $image)
                                    <div class="col my-3">
                                        <div class="img-preview mx-auto shadow rounded"
                                            style="background-image: url({{ $image->temporaryUrl() }});"></div>
                                        <button type="button"
                                            class="btn btn-danger shadow d-block text-center mt-2 mx-auto"
                                            wire:click="removeImage({{ $key }})">Cancella</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                @endif
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn-cat-ven mt-5 mb-5 ">Vendi</button>
                        </div>
                        
                    </div>
                
            </form>
        </div>
    </div>
</div>

