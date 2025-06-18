@extends('layouts.master')

@section('title', 'Category Management')

@section('page-header')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Category List
                    </h2>
                </div>
                <!-- Tombol Tambah Kategori -->
                <div class="col-auto ms-auto d-print-none">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        New Category
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Category Data</h3>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th class="w-1">No.</th>
                        <th>Name</th>
                        <th>Product Count</th>
                        <th>Created At</th>
                        <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $index => $category)
                        <tr>
                            <td><span class="text-muted">{{ $categories->firstItem() + $index }}</span></td>
                            <td>{{ $category->name }}</td>
                            <td>
                                {{-- Menampilkan jumlah produk. Membutuhkan withCount('products') di controller untuk efisiensi. --}}
                                <span class="badge bg-purple-lt">{{ $category->products_count ?? 0 }}</span>
                            </td>
                            <td>{{ $category->created_at->format('d M Y') }}</td>
                            <td class="text-end">
                                <div class="btn-list flex-nowrap">
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-secondary">
                                        Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                        class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                No categories found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Paginasi --}}
        @if ($categories->hasPages())
            <div class="card-footer d-flex align-items-center">
                <p class="m-0 text-muted">
                    Showing <span>{{ $categories->firstItem() }}</span> to <span>{{ $categories->lastItem() }}</span> of
                    <span>{{ $categories->total() }}</span> entries
                </p>
                <div class="ms-auto">
                    {{ $categories->links() }}
                </div>
            </div>
        @endif
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
