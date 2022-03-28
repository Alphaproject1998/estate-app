@extends("layout.master")

@section("pageTitle", "Upload")
    
@section("styles")
<link async="" rel="stylesheet" href="{{asset('css/main.css')}}" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link async rel="stylesheet" href="{{asset('css/main.css')}}"></noscript>
@endsection

@section("content")
<h4>Upload CSV</h4><br/>
<div class="file-upload">
    <form method="post" action="{{route('submit')}}" class="file-select" enctype="multipart/form-data">
        @csrf
        <div>
            <div class="file-select-button" id="fileName">Choose file</div>
            <div class="file-select-name" id="noFile">No file chosen...</div>
            <input type="file" name="file" accept=".csv" id="chooseFile" onchange='triggerValidation(this)'>
        </div>
        <br/>
        <div class="text-center">
            <button class="button hidden" id="sbm_button" type="submit" role="button">Submit</button>
        </div>
    </form>
</div>

@section("scripts")
<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="{{asset('js/main.js')}}"></script>
<script>
var regex = new RegExp("(.*?)\.(csv)$");

function triggerValidation(el) {
  if (!(regex.test(el.value.toLowerCase()))) {
    el.value = '';
    alert('Please select correct file format');
  }
}
</script>
@endsection