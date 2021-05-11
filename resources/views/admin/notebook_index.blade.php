<x-admin.app-layout>

    <x-slot name="tabTitle"> Notebook </x-slot>

    <x-slot name="header">
        <x-admin.content-header>
            <x-slot name="title">
                <h1> Notebook </h1>
            </x-slot>
            <a onclick="notebook_form('{{ route('admin.notebooks.store') }}')" data-toggle="modal" data-target="#notebookForm" href="#" class="btn btn-primary"> <i class="fas fa-plus mr-1"></i> New Notebook </a>
        </x-admin.content-header>
    </x-slot>

    <div class="card card-info">
        <div class="card-body">
            
            <table id="data_table" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th> Sl </th>
                        <th> Category </th>
                        <th> Name </th>
                        <th> User ID </th>
                        <th> Pin </th>
                        <th> Action </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($notebooks as $notebook)
                        <tr>
                            <td> {{ ++$loop->index }} </td>
                            <td> {{ $notebook->category->name }} </td>
                            <td> {{ $notebook->name }} </td>
                            <td> {{ $notebook->userid }} </td>
                            <td> {{ $notebook->pin }} </td>
                            <td>
                                <div class="dropdown">
                                    <a class="d-block" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-align-left"></i>
                                    </a>
                                  
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                      <a class="dropdown-item" onclick="notebook_form('{{ route('admin.notebooks.update', $notebook->id) }}', '{{ $notebook->category_id }}', '{{ $notebook->name }}', '{{ $notebook->userid }}', '{{ $notebook->pin }}')" data-toggle="modal" data-target="#notebookForm" href="#"> Edit </a>
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

    {{-- notebook form modal --}}
    <div class="modal fade" id="notebookForm" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="notebookFormLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notebookFormLabel">
                        Notebook
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="notebookFormTag" method="POST">
                        @csrf

                        <div class="form-group">
                            <x-label for="category_id" :require="true"> Category </x-label>
                            <select name="category_id" class="select2_category form-control @error('name') is-invalid @enderror" id="category_id" required style="width: 100% !important;">
                                <option value="" selected disabled> Select a Category </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}> {{ $category->name }} </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <x-label for="notebook_name" :require="true"> Name </x-label>
                            <div class="input-group mb-2">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="notebook_name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <x-label for="userid" :require="true"> User ID </x-label>
                            <div class="input-group mb-2">
                                <input type="number" name="userid" class="form-control @error('userid') is-invalid @enderror" id="userid" value="{{ old('userid') }}" required>
                                @error('userid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <x-label for="pin" :require="true"> Pin </x-label>
                            <div class="input-group mb-2">
                                <input type="number" name="pin" class="form-control @error('pin') is-invalid @enderror" id="pin" value="{{ old('pin') }}" required>
                                @error('pin')
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
            // notebook form manipulate
            function notebook_form(form_url, category_id=null, notebook_name = null, userid = null, pin=null) {
                $("#notebookFormTag").attr("action", form_url)
                
                if(category_id) {
                    // put method is not exist, add this field
                    if(! $('#put_method').length){
                        let put_method_field = `<input type='hidden' name='_method' id='put_method' value='put' />`
                        $("#notebookFormTag").prepend(put_method_field)
                    }
                    
                    // notebook values
                    $("#category_id").val(category_id).change()
                    $("#notebook_name").val(notebook_name)
                    $("#userid").val(userid)
                    $("#pin").val(pin)

                } else {
                    if($('#put_method').length) {
                        // put method is exist, remove this field
                        $("#put_method").remove();
                    }
                }
            }

            // select2 for category
            $('.select2_category').select2({
                dropdownParent: $('#notebookForm'),
                width: 'resolve'
            })
        </script>
    @endpush

</x-admin.app-layout>