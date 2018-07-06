@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Devices</div>
                <div class="panel-body">
                    <button type="button" id="createDevices" class="btn btn-success pull-right">
                        <i class="fa fa-plus fa-lg"></i>
                    </button>
                    <table class="table table-responsive">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Device Types</th>
                            <th>Weight</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($devices as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item['deviceTypes']['name']}}</td>
                                    <td>{{$item->weight}} KG</td>
                                    <td>
                                        <button class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $devices->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create Devices</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="description">Description</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="description" class="form-control" id="description">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="type">Device Types</label>
                        </div>
                        <div class="col-md-8">
                            <select type="text" name="type" class="form-control" id="type">
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="weight">Weight</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" name="weight" id="weight">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="saveDevices" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@push('script')
<script>
    $('#createDevices').on('click', function(){
		$("#myModal").modal('show');
    });

    $('#saveDevices').on('click', function() {
        $.ajax({
            type: 'POST',
            url: '{{ route('admin.classroom.create') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'name': $('#name').val(),
                'description': $('#description').val(),
                'types_id': $('#type').val(),
                'weight': $('#weight').val()
            },
            success: function(data) {
                 $(document).ajaxSuccess(function(){
                    swal({
                        title: "Success",
                        text: "Your record have been added",
                        type: "success",
                        timer: 4000
                    }, 
                        function(){
                            location.reload(); 
                        }
                    );     
                });
            }
        });
    });
    
</script>
@endpush
@endsection
