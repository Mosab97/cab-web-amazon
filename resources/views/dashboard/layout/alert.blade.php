@if (session()->has("true"))
 @section('notify')
   <script>
      toastr.success('{{ session()->get("true") }}', '', { "progressBar": true });
   </script>
 @endsection
 @endif
 @if (session()->has("info"))
 @section('notify')
   <script>
       toastr.info('{{ session()->get("info") }}', '', { "progressBar": true });
   </script>
 @endsection
 @endif
 @if(isset($errors) && count($errors) > 0)
 @section('notify')
   <script>
     @foreach($errors->all() as $error)
          toastr.error('{{ $error }}', '', { "progressBar": true });
     @endforeach
   </script>
 @endsection
 @endif
 @if (session()->has("false"))
   @section('notify')
   <script>
     toastr.warning('{{ session()->get("false") }}', '', { "progressBar": true });
   </script>
 @endsection
 @endif
