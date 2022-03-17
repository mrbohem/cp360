@section('title','Profile')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">Create Form</h3>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                     <div class="row">
                        <div class="col">
                            <button type="button" class="mb-3 btn btn-social-icon-text float-right btn-twitter"
                                data-toggle="modal" data-target="#tableModel">
                                <i class="mdi mdi-plus"></i>Add Field 
                            </button>
                        </div>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Label</th>
                                <th>Name</th>
                                <th>HTML</th>
                                <th>Options</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($table as $row)
                            <tr>
                                <td>{{ $row->label }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->html['type'] }} </td>
                                <td>
                                @if($row->html['type'] == "select")
                                @forelse($row->html['value'] as $key => $value)
                                    {{$key}} => {{$value}},<br>
                                @empty
                                    No Option Found
                                @endforelse
                                @endif
                                </td>
                                <td>
                                    @role('admin')
                                    <button >Edit</button>
                                    <button type="button" wire:click="deleteRow({{$row->id}})">Delete</button>
                                    @endrole
                                </td>
                            </tr>
                            @empty
                            <td>
                                No Record Found
                            </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="tableModel" tabindex="-1" role="dialog" aria-labelledby="modelLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form wire:submit.prevent='submit'>
                    <div class="modal-header">
                        <h5 class="modal-title" id="modelLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Field Label</label>
                            <input type="text" class="form-control" wire:model.lazy='model.label'>
                            @if($errors->has('model.label'))
                                <span class="error">{{ $errors->first('model.label') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Field Name</label>
                            <input type="text" class="form-control" wire:model.lazy='model.name'>
                            @if($errors->has('model.name'))
                                <span class="error">{{ $errors->first('model.name') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="parent_id">HTML</label>
                            <select class="form-control" wire:model="model.type">
                                @forelse (config('common.html_field') as $key => $value)
                                    <option value="{{$key}}">{{ $value }}</option>
                                @empty
                                @endforelse
                            </select>
                            @if($errors->has('model.type'))
                                <span class="error">{{ $errors->first('model.type') }}</span>
                            @endif

                            @if($model['type'] == "select")
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="parent_id">option value</label>
                                    <input type="text" class="form-control" wire:model.lazy='option.key'>
                                </div>
                                <div class="form-group col-6">
                                    <label for="parent_id">option name</label>
                                    <input type="text" class="form-control" wire:model.lazy='option.value'>
                                </div>
                            </div>
                            <button type="button" wire:click="AddOptions" class="btn btn-social-icon-text btn-twitter">
                                <i class="mdi mdi-plus"></i>Add Options
                            </button>

                            <table class="table table-bordered table-hover">
                                <tbody>
                                    @forelse($totalOptions as $key => $value)
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$value}}</td>
                                        <td>
                                            <button type="button" wire:click="deleteOptions('{{$key}}')">Delete</button>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table> 
                            @endif
                                
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@push('js')
<script>
</script>
@endpush