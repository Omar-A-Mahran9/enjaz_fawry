@extends('layouts.dashboard')
@push('page_styles')

@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        <!--begin::Portlet-->
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            تعديل السؤال
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                                <a href="{{ route('dashboard.common_questions.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>اضافة سؤال </span>
                                </span>
                            </a>
                        </li>    
                        <li class="m-portlet__nav-item">
                                <a href="{{ route('dashboard.common_questions.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="fa fa-stream"></i>
                                    <span>جميع الاسئلة</span>
                                </span>
                            </a>
                        </li>
                        <li class="m-portlet__nav-item"></li>
                    </ul>
                </div>
            </div>

            <!--begin::Form-->
            <form method="POST" action="{{ route('dashboard.common_questions.update', ['id' => $question->id]) }}" class="m-form m-form--fit m-form--label-align-right" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="m-portlet__body">
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">السؤال </label>
                        <div class="col-lg-6">
                            <textarea name="question" id="" cols="30" rows="3" class="form-control m-input m-input--solid">{{$question->question}}</textarea>
                        </div>
                    </div>
                  
                    <div class="form-group m-form__group row">
                        <label class="col-lg-2 col-form-label">الاجابة </label>
                        <div class="col-lg-6">
                            <textarea name="answer" id="" cols="30" rows="3" class="form-control m-input m-input--solid summernote">{{$question->answer}}</textarea>
                        </div>
                    </div>
                   
                    <div class="m-form__group m-form__group--last form-group row">
                        <label class="col-lg-2 col-form-label">الحالة</label>
                        <div class="col-lg-6">
                            <div class="m-checkbox-inline">
                                <label class="m-checkbox">
                                    <input type="radio" name="status" value="1"  @if ($question->status == 1) checked @endif> منشور
                                    <span></span>
                                </label>
                                <label class="m-checkbox">
                                    <input type="radio" name="status" value="0"  @if ($question->status == 0) checked @endif> غير منشور 
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>

                   
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions m-form__actions--solid">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-accent">تحديث</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            <!--end::Form-->
        </div>

        <!--end::Portlet-->            
    </div>
</div>
@endsection

@push('page_vendors')

@endpush

@push('page_scripts')
<script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@endpush
