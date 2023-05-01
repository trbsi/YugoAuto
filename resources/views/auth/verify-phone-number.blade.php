<?php
/** @var \App\Models\User $user */

use App\Enum\CoreEnum;

?>

<x-app-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo/>
        </x-slot>

        <div class="mt-4">
            @if(!$canVerify)
                <x-alert role="danger" :content="__('Phone verification quota exceeded')"></x-alert>
            @else
                <h1 class="text-2xl text-center">{{__('Verify phone number')}}</h1>
                <form>
                    @csrf
                    <div class="mt-4">
                        <x-label for="phone_number" value="{{ __('Phone number') }}"/>
                        <x-input id="phone_number"
                                 class="block mt-1 w-full"
                                 :disabled="$user->hasPhoneNumber()"
                                 required
                                 type="text"
                                 name="phone_number"
                                 placeholder="+385..."
                                 :value="$user->getPhoneNumber()"/>
                    </div>

                    <div class="mt-4 hidden" id="verification_code_input_wrapper">
                        <x-label for="verification_code" value="{{ __('Verification code') }}"/>
                        <x-input id="verification_code"
                                 class="block mt-1 w-full"
                                 required
                                 type="text"
                                 name="verification_code"/>

                        <div class="mt-4">
                            <x-alert role="info" :content="__('Wait for a while for phone code to arrive')"></x-alert>
                        </div>
                    </div>

                    <div class="mt-4" id="send_verification_code_btn">
                        <x-button id="send_code" type="submit" class="w-full justify-center">
                            {{ __('Send verification code') }}
                        </x-button>
                    </div>

                    <div class="mt-4 hidden" id="confirm_verification_code_wrapper">
                        <x-button id="verify_code" type="submit" class="w-full justify-center">
                            {{ __('Confirm verification code') }}
                        </x-button>

                        <x-anchor role="light"
                                  :url="route('phone-verification.show')"
                                  :text="__('Try again')"></x-anchor>
                    </div>
                </form>
            @endif
        </div>
    </x-authentication-card>

    @if($canVerify)
        @push('javascript')
            <script type="module">
                //This is made thanks to ChatGPT and https://firebase.google.com/docs/auth/web/phone-auth?hl=en&authuser=0#web-version-9_5
                import {initializeApp} from "https://www.gstatic.com/firebasejs/9.19.1/firebase-app.js";
                import {
                    getAuth,
                    RecaptchaVerifier,
                    signInWithPhoneNumber
                } from "https://www.gstatic.com/firebasejs/9.19.1/firebase-auth.js";

                const firebaseConfig = {
                    apiKey: '{{config('firebase.config.apiKey')}}',
                    authDomain: '{{config('firebase.config.authDomain')}}',
                    projectId: '{{config('firebase.config.projectId')}}',
                    messagingSenderId: '{{config('firebase.config.messagingSenderId')}}',
                    appId: '{{config('firebase.config.appId')}}',
                }

                const app = initializeApp(firebaseConfig);
                const auth = getAuth(app);
                const sendCodeButton = $("#send_code");
                const verifyCodeButton = $("#verify_code");
                const verificationCodeInputWrapper = $('#verification_code_input_wrapper');
                const sendVerificationCodeButton = $('#send_verification_code_btn');
                const confirmVerificationCodeWrapper = $('#confirm_verification_code_wrapper');
                const phoneNumberInput = $('#phone_number');
                const verificationCodeInput = $("#verification_code");

                sendCodeButton.click(function (e) {
                    e.preventDefault();
                    if (!(phoneNumberInput.val()).match({{CoreEnum::PHONE_REGEX->value}})) {
                        Swal.fire({
                            title: '{{__('Whoops! Something went wrong.')}}',
                            text: '{!! __('validation.phone_number_validation_message') !!}',
                            icon: 'warning',
                            confirmButtonText: 'OK',
                        });
                        return;
                    }


                    sendRequest(
                        'POST',
                        '{{route('phone-verification.can-verify')}}',
                        {},
                        function () {
                            verifyPhone();
                        }
                    );
                });


                function resetForm() {
                    verificationCodeInputWrapper.hide();
                    confirmVerificationCodeWrapper.hide();
                    sendVerificationCodeButton.show();
                }

                function verifyPhone() {
                    const recaptcha = new RecaptchaVerifier('send_code', {
                        size: 'invisible',
                    }, auth);

                    verificationCodeInputWrapper.show();
                    confirmVerificationCodeWrapper.show();
                    sendVerificationCodeButton.hide();

                    signInWithPhoneNumber(auth, phoneNumberInput.val(), recaptcha)
                        .then((confirmationResult) => {
                            const verificationId = confirmationResult.verificationId;
                            localStorage.setItem("firebaseVerificationId", verificationId);

                            sendRequest(
                                'POST',
                                '{{route('phone-verification.verify-phone', ['type' => 'code-sent'])}}',
                                {verification_id: verificationId, phone_number: phoneNumberInput.val()}
                            );

                            verifyCodeButton.click(function (e) {
                                e.preventDefault();
                                confirmationResult.confirm(verificationCodeInput.val()).then((result) => {
                                    verifyCodeButton.prop('disabled', true);
                                    sendRequest(
                                        'POST',
                                        '{{route('phone-verification.verify-phone', ['type' => 'verify'])}}',
                                        {
                                            verification_id: verificationId,
                                            phone_number: phoneNumberInput.val()
                                        },
                                        function () {
                                            window.location = '{{route('phone-verification.show')}}';
                                        }
                                    );

                                }).catch((error) => {
                                    verifyCodeButton.prop('disabled', false);
                                    resetForm();
                                    triggerAlert(error);
                                });
                            });
                        })
                        .catch((error) => {
                            resetForm();
                            triggerAlert(error);
                        });
                }

                function triggerAlert(error) {
                    sendRequest('POST', '{{route('phone-verification.log-error')}}', {
                        message: JSON.stringify(error),
                        phoneNumberInput: phoneNumberInput.val()
                    });

                    Swal.fire({
                        title: '{{__('Whoops! Something went wrong.')}}',
                        text: '{{__('Phone number could not be verified')}}',
                        icon: 'warning',
                        confirmButtonText: 'OK',
                    });
                }
            </script>
        @endpush
    @endif
</x-app-layout>
