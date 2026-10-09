<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title> @yield('titlename') - {{ config('app.name', 'realState24world') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <!-- css   -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/plugins.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/color.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/toaster.css') }}" rel="stylesheet" />
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_RECAPTCHA_KEY') }}"></script>
</head>

<body>
    <div id="main">
        {{-- Header --}}
        @include('front.layouts.header')
        {{-- Content --}}
        @yield('content')
        {{-- Foter --}}
        @include('front.layouts.footer')
    </div>
    {{-- Script --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/toaster.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://kit.fontawesome.com/9056e64c50.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.min.js') }}" type="text/javascript"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.myDropdown').forEach(dropdown => {
                    dropdown.classList.remove('show');
                });
            }
        });
        document.querySelectorAll('.toggleDropdownBtn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                document.querySelectorAll('.myDropdown').forEach(d => d.classList.remove('show'));
                this.nextElementSibling.classList.toggle('show');
            });
        });
        $(document).ready(function() {
            $('.main-button-div').each(function() {
                $(this).find('.tagDataShow li').hide();
            });
            $('.main-button-div .tagWrap li').on('click', function() {
                const target = $(this).data('tab');
                const $parent = $(this).closest('.main-button-div');
                $parent.find('.tagDataShow li').hide();
                $parent.find('.tagDataShow li#' + target).show();
                $parent.find('.tagWrap li').removeClass('on');
                $(this).addClass('on');
            });
        });
        document.querySelectorAll('.openPopupBtn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('popupForm').style.display = 'block';
            });
        });
        document.getElementById("closePopupBtn").addEventListener("click", function() {
            document.getElementById("popupForm").style.display = "none";
        });
        window.addEventListener("click", function(e) {
            const popup = document.getElementById("popupForm");
            if (e.target === popup) {
                popup.style.display = "none";
            }
        });
        const inputs = document.querySelectorAll('.otp-input');
        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                const value = input.value;
                if (value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && input.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
        $(document).on("click", ".openPopupBtn", function() {
            var dealerId = $(this).data("id");
            var propertyId = $(this).data("property");
            $('#dealer_name').text('');
            $('#dealer_image').attr('src', 'images/blank-img.jpg');
            $.ajax({
                url: "{{ route('property.enquiry') }}",
                type: "POST",
                data: {
                    dealerId: dealerId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#dealer_id').val(response.id);
                    $('#property_id').val(propertyId);
                    $('#dealer_name').text(response.name);
                    $('#dealer_image').attr('src', response.image);
                },
                error: function() {
                    alert("Failed to load dealer detail.");
                }
            });
        });
        //save Enquiry form
        $(document).ready(function() {
            $('#dealerForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('properties.enquiry.form') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#formMsg').html('<div class="alert alert-success">' + response
                                .message + '</div>');
                            $('#dealerForm')[0].reset();
                            document.getElementById("popupForm").style.display = "none";
                            $('.originalno').show();
                            $('.defaultno').hide();
                            $('.originalemail').show();
                            $('.defaultemail').hide();
                        } else {
                            $('#formMsg').html(
                                '<div class="alert alert-danger">Something went wrong</div>'
                                );
                            $('.defaultno').show();
                            $('.originalno').hide();
                            $('.defaultemail').show();
                            $('.originalemail').hide();
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorHtml = '<div class="alert alert-danger"><ul>';
                        $.each(errors, function(key, value) {
                            errorHtml += '<li>' + value[0] + '</li>';
                        });
                        errorHtml += '</ul></div>';
                        $('#formMsg').html(errorHtml);
                        $('.defaultno').show();
                        $('.originalno').hide();
                        $('.defaultemail').show();
                        $('.originalemail').hide();
                    }
                });
            });
        });
    </script>
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @elseif (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @elseif ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>

    {{-- Custom JavaScript --}}
    @yield('custom-javascript')
</body>

</html>
