@extends('layouts.app')
@section('title', 'Sign up')


@section('content')
    <main>
        <form class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Login</h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6">
                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email
                            address</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-2">
                        </div>
                    </div>

                    <div class="my-3">
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                        </div>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-2">
                        </div>
                    </div>

                    <div>
                        <button id="button-login-account"
                            class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Login</button>
                    </div>

                </form>
            </div>
        </form>
    </main>

    <script>
        (() => {
            const buttonSubmit = document.getElementById("button-login-account");
            buttonSubmit.addEventListener("click", (e) => {
                e.preventDefault();

                const email = document.getElementById("email").value;
                const password = document.getElementById("password").value;

                const validEmail = isAValidEmail(email);

                if (validEmail && password.trim() !== "") {
                    initLoadingRequest();
                    fetch('/api/login', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                email: email,
                                password: password,
                            }),
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw response;
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Almacenar el token en localStorage
                            localStorage.setItem('authToken', data.token);

                            Toastify({
                                text: "Successful login.",
                                duration: 1500,
                                close: false,
                                gravity: "top",
                                position: 'right',
                                backgroundColor: "green",
                            }).showToast();

                            // Redirigir al usuario a la página de inicio
                            window.location.href = '/';
                        })
                        .catch((responseError) => {
                            responseError.json().then(errors => {
                                renderErrors(errors);
                            });
                        })
                        .finally(() => {
                            stoptLoadingRequest();
                        });
                }

            });

            function isAValidEmail(email) {
                var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

                if (regex.test(email)) {
                    return true;
                } else {
                    Toastify({
                        text: "Add a valid email address",
                        duration: 1500,
                        close: false,
                        gravity: "top", // `top` or `bottom`
                        position: 'right', // `left`, `center` or `right`
                        backgroundColor: "red",
                    }).showToast();
                    return false;
                }
            }

            function initLoadingRequest() {
                buttonSubmit.disabled = true;
                buttonSubmit.innerHTML = `
              <div
                class="inline-block h-8 w-8 animate-spin rounded-full border-4 border-solid border-current border-r-transparent align-[-0.125em] motion-reduce:animate-[spin_1.5s_linear_infinite]"
                role="status">
                <span
                  class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
                  >Loading...</span
                >
              </div>`
            }

            function stoptLoadingRequest() {
                buttonSubmit.disabled = false;
                buttonSubmit.innerHTML = `Login`
            }

            function renderErrors(responseError) {
                for (let field in responseError.error) {
                    responseError.error[field].forEach((errorMessage) => {
                        Toastify({
                            text: errorMessage,
                            duration: 1500,
                            close: false,
                            gravity: "top", // `top` or `bottom`
                            position: 'right', // `left`, `center` or `right`
                            backgroundColor: "red",
                        }).showToast();
                    });
                }
            }
        })()
    </script>

@endsection
