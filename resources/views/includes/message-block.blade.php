@if(count($errors)>0)
    <div class="row justify-content-center">
        <div class="col-lg-5 alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li><br>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@if(Session::has('message'))
    <div class="row justify-content-center">
        <div class="col-lg-5 alert alert-success">
            {{Session::get('message')}}
        </div>
    </div>
@endif

