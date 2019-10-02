@extends('layouts.user')

@section('title', 'Update operation')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@lang('user.editOperation')</h4>
                    <form action="{{route('operation.update', ['operation' => $operation->id])}}" method="post" class="form-horizontal m-t-40">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label>@lang('user.sum')</label>
                            <input type="text" name="sum" class="form-control" value="{{$operation->sum}}" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>@lang('user.category')</label>
                            <select name="category_id" class="custom-select col-12" id="inlineFormCustomSelect">
                                <option disabled selected>@lang('user.chooseCategory')</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($operation->category_id == $category->id)selected @endif>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>@lang('user.description')</label>
                            <textarea name="description" class="form-control" rows="5">{{$operation->description}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">@lang('user.submit')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection