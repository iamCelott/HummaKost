@extends('app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <h3 class="card-title">
                                Furniture Lists
                                <br>
                                <small>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magni totam, eaque voluptas
                                    veritatis nisi consequuntur.</small>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mt-4">
                        <div class="col-12 col-lg-8 mt-4">
                            <form action="" method="GET" class="d-flex w-100 ">
                                @csrf
                                <div class="d-flex align-items-center border rounded w-100 px-3">
                                    <input type="text" name="search" id="searchInput" class="form-control border-none"
                                        value="{{ request()->input('search') }}" placeholder="Search...">
                                    <a href="{{ route('user.index') }}" style="display: none" id="clearSearch"
                                        class="btn-close"></a>
                                </div>
                                <script>
                                    const key = document.getElementById('searchInput');
                                    const close = document.getElementById('clearSearch');

                                    document.addEventListener('DOMContentLoaded', function() {
                                        if (key.value.trim() !== '') {
                                            close.style.display = 'block';
                                        } else {
                                            close.style.display = 'none';
                                        }
                                    });

                                    key.addEventListener('input', function() {
                                        if (key.value.trim() !== '') {
                                            close.style.display = 'block';
                                        } else {
                                            close.style.display = 'none';
                                        }
                                    });
                                </script>
                        </div>
                        <div class="col-12 mt-4 col-lg-4">
                            <div class="d-flex align-items-center w-100 px-3 justify-content-between">
                                <button class="btn btn-secondary w-25" type="submit"><i
                                        class="mdi ri-search-line"></i></button>
                                </form>
                                <button type="button" class="btn btn-primary w-50 " data-bs-toggle="modal"
                                    data-bs-target="#createModal">
                                    Add user
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- furnitures --}}
                    <div class="row row-cols-1 row-cols-md-3 g-6 my-5">
                        @forelse ($furnitures as $furniture)
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row justify-content-between">
                                            <div class="col-12 col-lg-12 mb-6">
                                                <h3 class="card-title m-0 p-0">{{ $furniture->name }}</h3>
                                                <p class="card-text">{{ $furniture->description }}</p>
                                            </div>
                                            <div class="d-flex gap-3">
                                                <button type="button" data-bs-target="#updateModal" data-bs-toggle="modal"
                                                    class="btn btn-warning">Edit</button>

                                                <div class="modal fade" id="updateModal" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog ">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit
                                                                    Furniture {{ $furniture->name }}</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('furnitures.update', $furniture->id) }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">

                                                                        <div class="mb-3">
                                                                            <label for="photo"
                                                                                class="form-label">Furniture Name:</label>
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="photo"
                                                                                value="{{ $furniture->name }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="name"
                                                                                class="form-label">Description:</label>
                                                                            <input type="text" class="form-control"
                                                                                name="description" id="name"
                                                                                value="{{ $furniture->description }}">
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" name="submit"
                                                                    class="btn btn-primary">Save changes</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>


                                                <form action="{{ route('furnitures.destroy', $furniture->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="">Belum Ada Furniture</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        {{ $furnitures->links() }}
    </div>
    {{-- Store Modal --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Add Furniture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('furnitures.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="photo" class="form-label">Furniture Name:</label>
                            <input type="text" class="form-control" name="name" id="photo">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Description:</label>
                            <input type="text" class="form-control" name="description" id="name">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Furniture</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Store Modal --}}
@endsection
