<style>
    .app-inner >div.container {
      position: relative;
    }
    .store-footer {
        margin-top: 0 !important;
    }
    .app-inner >div.container {
        max-width: unset !important;
        padding: 0 !important;
    }
    .intro,
    .intro .intro-text .start-quiz,
    .question-wrapper .answers-wrapper .answer-wrapper,
    .preferences-test-done .start-over,
    body {
        background: #fff !important;
        background-color: #fff !important;
    }
    .intro-text p,
    .intro .intro-text .start-quiz,
    .question-wrapper .question,
    .question-wrapper .answers-wrapper .answer-wrapper .answer,
    .form-container .buttons-wrapper .move-to-next-step-btn,
    .question-wrapper .answers-wrapper .answer-wrapper .answer-desc,
    .form-container .buttons-wrapper .submit-form-btn,
    .steps-header .steps-wrapper .step .step-desc .step-num,
    .product-wrapper .links-wrapper .see-more,
    .product-wrapper .discount-code,
    .product-wrapper .product-desc,
    .product-wrapper .product-title,
    .result-title,
    .preferences-test-done .start-over {
        color: black !important;
    }
    .question-wrapper .answers-wrapper .answer-wrapper {
        transition: 0.4s !important;
    }
    .intro .intro-text .start-quiz {
        padding: 8px 40px !important;
        border-radius: 6px !important;
    }
    .intro .intro-text .start-quiz:hover,
    .question-wrapper .answers-wrapper .answer-wrapper:hover,
    .question-wrapper .answers-wrapper .answer-wrapper.selected,
    .form-container .buttons-wrapper .move-to-next-step-btn:hover,
    .form-container .buttons-wrapper .submit-form-btn:hover,
    .preferences-test-done .start-over:hover {
        box-shadow: unset !important;
        background-color: black !important;
        color: #fff !important;
    }
    .steps-header .steps-wrapper .step .step-icon {
        color: black !important;
        font-weight: 600;
    }
    .steps-header .steps-wrapper .step.active .step-icon {
        background-color: black !important;
        color: #fff !important;
    }
    .form-container .buttons-wrapper .move-to-next-step-btn, .form-container .buttons-wrapper .submit-form-btn {
        background-color: unset !important;
    }
    .question-wrapper .answers-wrapper .answer-wrapper.selected p,
    .question-wrapper .answers-wrapper .answer-wrapper:hover p,
    .question-wrapper .answers-wrapper .answer-wrapper:hover .answer-desc,
    .question-wrapper .answers-wrapper .answer-wrapper.selected .answer-desc {
        color: #fff !important;
    }
    .preferences-test-done {
        box-shadow: 0 0 10px 0 #ababab !important;
    }
</style>

<link rel="stylesheet" href="https://perfumes-quiz-w8ghy.ondigitalocean.app/quiz/css/style.css">
<link rel="stylesheet" href="https://perfumes-quiz-w8ghy.ondigitalocean.app/quiz/css/style.responsive.css">

<script>
    var container = document.querySelector(".app-inner >div.container");
    var customerId = {{Customer Id}}
    var userId = {{User Id}}
    var isGuest = {{isGuest}}
    var email = {{Customer Email}}
    var phone = {{Customer Phone}}

    console.log(customerId)
    console.log(userId)

    var userData = {
        customerId: customerId || null,
        userId: userId || null,
        isGuest: isGuest || false,
        email: email ? email : null,
        phone: phone ? phone : null
    };

    console.log(userData)

    container.innerHTML = `
        <div class="intro-loader">
            <div class="spinner">
            </div>
        </div>
        <div class="intro">
            <div class="intro-logo">
                <img src="https://perfumes-quiz-w8ghy.ondigitalocean.app/quiz/images/logo.png" alt="logo">
            </div>
            <div class="intro-text" data-quiz-info-url="https://perfumes-quiz-w8ghy.ondigitalocean.app/api/v1/quiz/info">
                <p class="intro-title text-bold-light"></p>
                <p class="intro-description text-white"></p>
                <button class="start-quiz hidden">اكتشف ذوقك</button>
            </div>
        </div>
        <div class="user-preferences-form-container hidden switch-effect" data-quiz-url="https://perfumes-quiz-w8ghy.ondigitalocean.app/api/v1/quiz" data-quiz-entry-url="https://perfumes-quiz-w8ghy.ondigitalocean.app/api/v1/quiz/entries">
            <h1 class="main-heading">اعرف عطرك حسب شخصيتك</h1>
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
                            <button type="submit" data-user-id="${userData.userId}" data-customer-id="${userData.customerId}" data-is-guest="${userData.isGuest}" data-email="${userData.email}" data-phone="${userData.phone}" class="submit-form-btn hidden" data-action="submit" data-url="https://perfumes-quiz-w8ghy.ondigitalocean.app/api/v1/results">
                                تأكيد
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="preferences-test-done switch-effect hidden">
                <div class="result-wrapper">
                    <h2 class="result-title">عطرك المناسب هو...</h2>
                    <div class="products-container"></div>
                    <button class="start-over">إعادة الاختبار</button>
                </div>
            </div>
        </div>
    `

</script>
<script src="https://perfumes-quiz-w8ghy.ondigitalocean.app/quiz/js/script.js?version=1.0.3" defer></script>
