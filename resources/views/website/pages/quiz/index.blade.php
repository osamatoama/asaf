@extends('website.layouts.main')

@section('content')
    <div class="user-preferences-form-container" data-quiz-url="{{ route('api.quiz') }}">
        <h1 class="main-heading">اعرف عطرك حسب شخصيتك</h1>
        <div class="gender-selection hidden switch-effect">
            <h2>حدد النوع</h2>
            <div class="gender-options">
                <div class="gender selected" data-gender-id="1">
                    <div class="img-wrapper">
                        <img src="{{ asset('quiz/images/gender-1.png') }}" alt="male">
                    </div>
                    <span>ذكر</span>
                </div>
                <div class="gender" data-gender-id="2">
                    <div class="img-wrapper">
                        <img src="{{ asset('quiz/images/gender-2.png') }}" alt="female">
                    </div>
                    <span>أنثى</span>
                </div>
            </div>
            <button class="show-form hidden">ابدأ الأختبار</button>
        </div>
        <div class="multistep-form-wrapper">
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
                <h2 class="result-title">العطر المناسب لشخصيتك</h2>
                <div class="products-container"></div>
                <button class="start-over">إعادة الإختبار</button>
            </div>
        </div>
    </div>
@endsection
