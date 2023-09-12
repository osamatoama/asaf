@extends('website.layouts.main')

@section('content')
    {{-- TODO: Use These info as a first option of the quiz and then delete the un useful data --}}
    {{-- Male ID => 1 , Female ID => 2 --}}
    {{-- You can put gender image depend on gender id --}}
{{--    <select class="form-control" name="gender_id" id="gender_id" aria-label="Gender">--}}
{{--        @foreach($genders as $id => $name)--}}
{{--            <option value="{{ $id }}">{{ $name }}</option>--}}
{{--        @endforeach--}}
{{--    </select>--}}
{{----------------------------------------------------------------}}
    <div class="user-preferences-form-container" data-quiz-url="{{ route('api.quiz') }}">
        <h1 class="main-heading">اعرف عطرك حسب شخصيتك</h1>
        <div class="multistep-form-wrapper hidden switch-effect">
            <div class="steps-header">
                <div class="steps-wrapper"></div>
            </div>
            <div class="form-container">
                <form>
                    <div class="form-steps-wrapper"></div>
                    <div class="buttons-wrapper no-prev" data-current-step="1">
                        <button class="back-to-prev-step-btn" data-move="backward">السابق</button>
                        <button class="move-to-next-step-btn" data-move="forward">التالي</button>
                        <button type="submit" class="submit-form-btn hidden" data-action="submit" data-url="{{ route('api.results') }}">تأكيد</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="preferences-test-done switch-effect hidden">
            <div class="result-wrapper">
                <h2 class="result-title">العطور المناسبة لشخصيتك</h2>
                <div class="products-container"></div>
                <button class="start-over">إعادة الإختبار</button>
            </div>
        </div>
    </div>
@endsection
