<div class="box-body">
    <img src="{{$consulente->user->googleAvatarOriginal ?: '/img/user-placeholder.png'}}" height="200" width="200"
         class="img-responsive center-block img-thumbnail img-circle" alt="Immagine Accout">
</div><!-- /.box-body -->
<div class="row">
    @if($consulente->user->googleAccount)
        <div class="col-md-12">
            <div class="login-logo" style="font-size:30px; color:#808080">
                {{$consulente->user->googleAccount}}
            </div>
        </div>
    @endif
    <div class="col-md-offset-3 col-md-6">
        @if($consulente->user->googleAccount)
            <div class="social-auth-links text-center">
                <a href="{{ url('/unlinkGoogle') }}" class="btn btn-block btn-social btn-primary btn-flat"
                   style="background-color: #4285F4"><i class="fab fa-google"></i> Scollega il tuo account
                    Google</a>
            </div>
        @else
            <div class="social-auth-links text-center">
                <a href="{{ url('/linkGoogle') }}" class="btn btn-block btn-social btn-primary btn-flat"
                   style="background-color: #4285F4"><i class="fab fa-google"></i> Accedi con il tuo account Google</a>
            </div>
        @endif
    </div>
</div>
