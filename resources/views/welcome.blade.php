@extends('layouts.app')
@section('content')
<!-- Scripts -->
<script src="{{ secure_asset('js/app.js') }}" defer></script>  

<div id="app"> 
    <router-view ></router-view>
</div>

</html>

@endsection