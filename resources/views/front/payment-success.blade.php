@extends('front.layouts.app')
@section('content')
    <div class="container text-center mt-5">
        <h2 class="text-success">✅ Payment Successful!</h2>
        <p>You will be redirected to the login page shortly...</p>
    </div>
@endsection
<script>
    setTimeout(function() {
        window.location.href = "{{ route('login') }}";
    }, 3000);
</script>
