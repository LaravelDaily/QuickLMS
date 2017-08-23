@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.lessons.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.lessons.fields.course')</th>
                            <td>{{ $lesson->course->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.title')</th>
                            <td>{{ $lesson->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.slug')</th>
                            <td>{{ $lesson->slug }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.lesson-image')</th>
                            <td>@if($lesson->lesson_image)<a href="{{ asset('uploads/' . $lesson->lesson_image) }}" target="_blank"><img src="{{ asset('uploads/thumb/' . $lesson->lesson_image) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.short-text')</th>
                            <td>{!! $lesson->short_text !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.full-text')</th>
                            <td>{!! $lesson->full_text !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.position')</th>
                            <td>{{ $lesson->position }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.downloadable-files')</th>
                            <td> @foreach($lesson->getMedia('downloadable_files') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.free-lesson')</th>
                            <td>{{ Form::checkbox("free_lesson", 1, $lesson->free_lesson == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.lessons.fields.published')</th>
                            <td>{{ Form::checkbox("published", 1, $lesson->published == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#tests" aria-controls="tests" role="tab" data-toggle="tab">Tests</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="tests">
<table class="table table-bordered table-striped {{ count($tests) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.tests.fields.course')</th>
                        <th>@lang('global.tests.fields.lesson')</th>
                        <th>@lang('global.tests.fields.title')</th>
                        <th>@lang('global.tests.fields.description')</th>
                        <th>@lang('global.tests.fields.questions')</th>
                        <th>@lang('global.tests.fields.published')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($tests) > 0)
            @foreach ($tests as $test)
                <tr data-entry-id="{{ $test->id }}">
                    <td>{{ $test->course->title or '' }}</td>
                                <td>{{ $test->lesson->title or '' }}</td>
                                <td>{{ $test->title }}</td>
                                <td>{!! $test->description !!}</td>
                                <td>
                                    @foreach ($test->questions as $singleQuestions)
                                        <span class="label label-info label-many">{{ $singleQuestions->question }}</span>
                                    @endforeach
                                </td>
                                <td>{{ Form::checkbox("published", 1, $test->published == 1 ? true : false, ["disabled"]) }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.tests.restore', $test->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.tests.perma_del', $test->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('test_view')
                                    <a href="{{ route('admin.tests.show',[$test->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('test_edit')
                                    <a href="{{ route('admin.tests.edit',[$test->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('test_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.tests.destroy', $test->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.lessons.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop