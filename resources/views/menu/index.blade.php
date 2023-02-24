@extends('layouts.user_type.auth')

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">

            <div class="card-header pb-0">
                <h5>Menu Section</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm border-top border-bottom">
                        <tbody>
                            @foreach($menuSection as $section)
                            <tr data-id="{{ $section->id }}">
                                <td><i role="button" class="fas fa-grip-vertical"></i></td>
                                <td class="text-capitalize">{{ $section->name }}</td>
                                <td class="w-0">
                                    <div class="text-end space-x-2">
                                        <i role="button" class="text-gradient text-info fa fa-sm fa-pen"></i>
                                        <i role="button" class="text-gradient text-danger fa fa-sm fa-trash"></i>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection