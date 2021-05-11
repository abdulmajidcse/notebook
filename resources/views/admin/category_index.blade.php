<x-admin.app-layout>

    <x-slot name="tabTitle"> Category </x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> Category </h1>
            </x-slot>
            <a onclick="category_form('{{ route('admin.categories.store') }}')" data-toggle="modal" data-target="#categoryForm" href="#" class="btn btn-primary"> <i class="fas fa-plus mr-1"></i> New Category </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">
            
            <table id="data_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th> Sl </th>
                        <th> Name </th>
                        <th> Action </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td> {{ ++$loop->index }} </td>
                            <td> {{ $category->name }} </td>
                            <td>
                                <div class="dropdown">
                                    <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-left"></i>
                                    </a>
                                  
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                      <a class="dropdown-item" onclick="category_form('{{ route('admin.categories.update', $category->id) }}', '{{ $category->name }}')" data-toggle="modal" data-target="#categoryForm" href="#"> Edit </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- /.card-body -->
    </div>

    {{-- category form modal --}}
    <div class="modal fade" id="categoryForm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="categoryFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryFormLabel">
                        Category
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="categoryFormTag" method="POST">
                        @csrf

                        <div class="form-group">
                            <x-label for="category_name" :require="true"> Name </x-label>
                            <div class="input-group mb-2">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="category_name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="float-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel </button>
                            <button type="submit" class="btn btn-primary"> Save </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // category form manipulate
            function category_form(form_url, category_name = null) {
                $("#categoryFormTag").attr("action", form_url)
                
                if(category_name) {
                    // put method is not exist, add this field
                    if(! $('#put_method').length){
                        let put_method_field = `<input type='hidden' name='_method' id='put_method' value='put' />`
                        $("#categoryFormTag").prepend(put_method_field)
                    }
                    
                    // category value added in input field
                    $("#category_name").val(category_name)

                } else {
                    if($('#put_method').length) {
                        // put method is exist, remove this field
                        $("#put_method").remove();
                    }
                }
            }
        </script>
    @endpush

</x-admin.app-layout>