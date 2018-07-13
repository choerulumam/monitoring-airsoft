@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <button type="button" id="createDevices" data-toggle="modal" data-target="#myModal" class="btn btn-success pull-right">
            <i class="fa fa-plus fa-lg"></i>
        </button>
        <div class="col-md-12">
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
                                <button class="btn btn-primary edit-data" data-item="{{$item->id}},{{$item->name}},{{$item->description}},{{$item['deviceTypes']['id']}},{{$item->weight}}">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button class="btn btn-danger delete-data" data-item="{{$item->id}}">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $devices->links("pagination::bootstrap-4") }}
        </div>
    </div>
</div>


<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pull-left">Create Devices</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <div class="col-md-3">
                            <label for="name">Name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="description">Description</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="description" class="form-control" id="description" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label for="type">Device Types</label>
                        </div>
                        <div class="col-md-8">
                            <select type="text" name="type" class="form-control" id="type" required>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="text" id="idUpdate" hidden="true">
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
                <button type="button" id="actionBtn" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@push('script')
<script>
    $('.edit-data').on('click', function (){
        var detail =  $(this).data('item').split(',');
        fillmodalData(detail);
        $('#actionBtn').removeClass('add-data-btn');
        $('#actionBtn').addClass('edit-data-btn');
        $('#actionBtn').html('Update');
        $('#myModal').modal('show');
    });

    $('#createDevices').on('click', function (){
        $('#actionBtn').removeClass('edit-data-btn');
        $('#actionBtn').addClass('add-data-btn');
        $('#actionBtn').html('Save');
        $('#name').val('');
        $('#description').val('');
        $('#type').val('');
        $('#weight').val('');
        $('#myModal').modal('show');
    });

    $(document).on('click', '.delete-data', function () {
        var data = $(this).data('item');
        console.log(data);
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('devices.delete') }}',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': data
                    },
                    success: function(data) {
                         $(document).ajaxSuccess(function(){
                            $('#myModal').modal('toggle');
                            $('.modal-backdrop').remove();
                            swal({
                                title: "Success",
                                text: "Your record have been added",
                                type: "success",
                                timer: 4000
                            });
                            setTimeout(function(){
                                window.location.reload();
                            }, 3000);
                        });
                    }
                });
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        }
);
    });

    $(document).on('click', '.add-data-btn', function() {
        $.ajax({
            type: 'POST',
            url: '{{ route('devices.create') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'name': $('#name').val(),
                'description': $('#description').val(),
                'types_id': $('#type').val(),
                'weight': $('#weight').val()
            },
            success: function(data) {
                 $(document).ajaxSuccess(function(){
                    $('#myModal').modal('toggle');
                    $('.modal-backdrop').remove();
                    swal({
                        title: "Success",
                        text: "Your record have been added",
                        type: "success",
                        timer: 4000
                    });
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                });
            }
        });
    });

    $(document).on('click', '.edit-data-btn', function() {
        $.ajax({
            type: 'POST',
            url: '{{ route('devices.update') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'name': $('#name').val(),
                'description': $('#description').val(),
                'types_id': $('#type').val(),
                'weight': $('#weight').val(),
                'id'    : $('#idUpdate').val()
            },
            success: function(data) {
                 $(document).ajaxSuccess(function(){
                    $('#myModal').modal('toggle');
                    $('.modal-backdrop').remove();
                    swal({
                        title: "Success",
                        text: "Your record have been updated",
                        type: "success",
                        timer: 4000
                    });
                    setTimeout(function(){
                        window.location.reload();
                    }, 3000);
                });
            }
        });
    });

    function fillmodalData(details){
        $('#idUpdate').val(details[0]);
        $('#name').val(details[1]);
        $('#description').val(details[2]);
        $('#type').val(details[3]);
        $('#weight').val(details[4]);
        $('#myModal').modal('show');
    };

</script>
@endpush
@endsection
