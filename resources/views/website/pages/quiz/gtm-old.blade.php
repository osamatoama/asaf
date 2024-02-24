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

  container.innerHTML = "\n    <div class=\"intro-loader\">\n        <div class=\"spinner\"></div>\n    </div>\n    <div class=\"intro\">\n        <div class=\"intro-logo\">\n            <img src=\"https://perfumes-quiz-w8ghy.ondigitalocean.app/quiz/images/logo.png\" alt=\"logo\">\n        </div>\n        <div class=\"intro-text\" data-quiz-info-url=\"https://perfumes-quiz-w8ghy.ondigitalocean.app/api/v1/quiz/info\">\n            <p class=\"intro-title text-bold-light\"></p>\n            <p class=\"intro-description text-white\"></p>\n            \n            <button class=\"start-quiz hidden\">\u0627\u0643\u062A\u0634\u0641 \u0630\u0648\u0642\u0643</button>\n        </div>\n    </div>\n    <div class=\"user-preferences-form-container hidden switch-effect\" data-quiz-url=\"https://perfumes-quiz-w8ghy.ondigitalocean.app/api/v1/quiz\">\n        <h1 class=\"main-heading\">\u0627\u0639\u0631\u0641 \u0639\u0637\u0631\u0643 \u062D\u0633\u0628 \u0634\u062E\u0635\u064A\u062A\u0643</h1>\n        <div class=\"multistep-form-wrapper\">\n            <div class=\"steps-header\">\n                <div class=\"steps-wrapper\"></div>\n            </div>\n            <div class=\"form-container\">\n                <form>\n                    <div class=\"form-steps-wrapper\"></div>\n                    <div class=\"buttons-wrapper no-prev\" data-current-step=\"1\">\n                        <button class=\"back-to-prev-step-btn\" data-move=\"backward\">\u0627\u0644\u0633\u0627\u0628\u0642</button>\n                        <button class=\"move-to-next-step-btn\" data-move=\"forward\">\u0627\u0644\u062A\u0627\u0644\u064A</button>\n                        <button type=\"submit\" data-user-id=\"".concat(userData.userId, "\" data-customer-id=\"").concat(userData.customerId, "\" data-is-guest=\"").concat(userData.isGuest, "\" data-email=\"").concat(userData.email, "\" data-phone=\"").concat(userData.phone, "\" class=\"submit-form-btn hidden\" data-action=\"submit\" data-url=\"https://perfumes-quiz-w8ghy.ondigitalocean.app/api/v1/results\">\u062A\u0623\u0643\u064A\u062F</button>\n                    </div>\n                </form>\n            </div>\n        </div>\n        <div class=\"preferences-test-done switch-effect hidden\">\n            <div class=\"result-wrapper\">\n                <h2 class=\"result-title\">\u0639\u0637\u0640\u0631\u0643 \u0627\u0644\u0645\u0646\u0627\u0633\u0628 \u0647\u0648...</h2>\n                <div class=\"products-container\"></div>\n                <button class=\"start-over\">\u0625\u0639\u0627\u062F\u0629 \u0627\u0644\u0627\u062E\u062A\u0628\u0627\u0631</button>\n            </div>\n        </div>\n    </div>\n");
  </script>
  <script src="https://perfumes-quiz-w8ghy.ondigitalocean.app/quiz/js/script.js?version=1.0.2" defer></script>
