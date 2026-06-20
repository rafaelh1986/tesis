@extends('template.index')
@section('encabezado')
<div class="d-flex justify-content-between align-items-center">
    <h4 class="m-0 font-weight-bold text-primary">Usuario</h4>
    <a href="{{route('usuario.create')}}" class="btn btn-sm btn-info">
        <i class="fas fa-plus"></i>Agregar
    </a>
</div>
@endsection
@section('contenido')
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <td><b>CI</b></td>
                <td><b>Nombre completo</b></td>
                <td><b>Usuario</b></td>
                <td><b>Opciones</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{$usuario->persona->ci}}</td>
                <td>{{$usuario->persona->nombres.' '.$usuario->persona->apellidos}}</td>
                <td>{{$usuario->email}}</td>
                <td>
                    <a href="{{route('usuario.show' , $usuario->id)}}"
                        class="btn btn-sm btn-primary">
                        <i class="fas fa-eye"></i>
                    </a>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#resetPasswordModal{{$usuario->id}}">
                        <i class="fas fa-unlock-alt"></i>
                    </button>
                    <a href="{{route('usuario.edit' , $usuario->id)}}"
                        class="btn btn-sm btn-info">
                        <i class="fas fa-pen"></i>
                    </a>
                    @php
                    if($usuario->estado==0)
                    {
                    $icono_delete="redo";
                    $bg_btn = "warning";
                    $msj = "restaurar";
                    }
                    else{
                    $icono_delete="trash";
                    $bg_btn = "danger";
                    $msj = "eliminar";
                    }
                    @endphp
                    <a href="{{route('usuario.destroy' , $usuario->id)}}"
                        class="btn btn-sm btn-{{$bg_btn}}" onclick="return confirm('¿Estas seguro?')">
                        <i class="fas fa-{{$icono_delete}}"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @foreach($usuarios as $usuario)
    <div class="modal fade" id="resetPasswordModal{{$usuario->id}}" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModalLabel{{$usuario->id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetPasswordModalLabel{{$usuario->id}}">Cambiar contraseña</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('usuario.update_password') }}" method="POST" class="reset-password-form" data-user-id="{{ $usuario->id }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="usuario_id" value="{{ $usuario->id }}">

                        <div class="form-group">
                            <label for="password_{{$usuario->id}}">Nueva contraseña</label>
                            <input type="password" name="password" id="password_{{$usuario->id}}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation_{{$usuario->id}}">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation_{{$usuario->id}}" class="form-control" required>
                        </div>
                        <div class="alert alert-danger d-none" id="passwordError{{$usuario->id}}"></div>
                        <ul class="list-unstyled small" id="passwordRules{{$usuario->id}}">
                            <li id="ruleLength{{$usuario->id}}" class="text-danger">• Mínimo 8 caracteres</li>
                            <li id="ruleUpper{{$usuario->id}}" class="text-danger">• Al menos una letra mayúscula</li>
                            <li id="ruleNumber{{$usuario->id}}" class="text-danger">• Al menos un número</li>
                            <li id="ruleSymbol{{$usuario->id}}" class="text-danger">• Al menos un carácter especial</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <form method="GET" class="d-flex flex-column flex-sm-row align-items-center mb-2">
        <div class="d-flex flex-column flex-sm-row align-items-center w-100">
            <label for="per_page" class="mr-sm-2 mb-2 mb-sm-0">Mostrar</label>
            <select name="per_page" id="per_page" class="form-control mr-sm-2 mb-2 mb-sm-0" onchange="this.form.submit()">
                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
            </select>
        </div>
        <small class="text-muted d-block d-sm-inline mt-2 mt-sm-0">registros por página</small>
    </form>
</div>
<hr class="sidebar-divider d-none d-sm-block" style color="#b7b9cc">
<div class="d-flex justify-content-center mt-3">{{$usuarios -> appends(request()->except('page'))->links() }}</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.reset-password-form').forEach(function(form) {
            form.addEventListener('submit', function(event) {
                var userId = form.getAttribute('data-user-id');
                var password = document.getElementById('password_' + userId).value;
                var confirmation = document.getElementById('password_confirmation_' + userId).value;
                var errorDiv = document.getElementById('passwordError' + userId);
                var errors = [];

                if (password.length < 8) {
                    errors.push('La contraseña debe tener al menos 8 caracteres.');
                }
                if (!/[A-Z]/.test(password)) {
                    errors.push('La contraseña debe contener al menos una letra mayúscula.');
                }
                if (!/[0-9]/.test(password)) {
                    errors.push('La contraseña debe contener al menos un número.');
                }
                if (!/[\W_]/.test(password)) {
                    errors.push('La contraseña debe contener al menos un carácter especial.');
                }
                if (password !== confirmation) {
                    errors.push('Las contraseñas no coinciden.');
                }

                var ruleLength = document.getElementById('ruleLength' + userId);
                var ruleUpper = document.getElementById('ruleUpper' + userId);
                var ruleNumber = document.getElementById('ruleNumber' + userId);
                var ruleSymbol = document.getElementById('ruleSymbol' + userId);

                function setRule(element, valid) {
                    if (!element) return;
                    element.classList.toggle('text-success', valid);
                    element.classList.toggle('text-danger', !valid);
                }

                setRule(ruleLength, password.length >= 8);
                setRule(ruleUpper, /[A-Z]/.test(password));
                setRule(ruleNumber, /[0-9]/.test(password));
                setRule(ruleSymbol, /[\W_]/.test(password));

                if (errors.length > 0) {
                    event.preventDefault();
                    errorDiv.innerHTML = errors.join('<br>');
                    errorDiv.classList.remove('d-none');
                } else {
                    errorDiv.classList.add('d-none');
                }
            });

            var passwordInput = document.getElementById('password_' + form.getAttribute('data-user-id'));
            if (passwordInput) {
                passwordInput.addEventListener('input', function() {
                    var userId = form.getAttribute('data-user-id');
                    var pwd = passwordInput.value;
                    var ruleLength = document.getElementById('ruleLength' + userId);
                    var ruleUpper = document.getElementById('ruleUpper' + userId);
                    var ruleNumber = document.getElementById('ruleNumber' + userId);
                    var ruleSymbol = document.getElementById('ruleSymbol' + userId);
                    if (ruleLength) ruleLength.classList.toggle('text-success', pwd.length >= 8);
                    if (ruleLength) ruleLength.classList.toggle('text-danger', pwd.length < 8);
                    if (ruleUpper) ruleUpper.classList.toggle('text-success', /[A-Z]/.test(pwd));
                    if (ruleUpper) ruleUpper.classList.toggle('text-danger', !/[A-Z]/.test(pwd));
                    if (ruleNumber) ruleNumber.classList.toggle('text-success', /[0-9]/.test(pwd));
                    if (ruleNumber) ruleNumber.classList.toggle('text-danger', !/[0-9]/.test(pwd));
                    if (ruleSymbol) ruleSymbol.classList.toggle('text-success', /[\W_]/.test(pwd));
                    if (ruleSymbol) ruleSymbol.classList.toggle('text-danger', !/[\W_]/.test(pwd));
                });
            }
        });
    });
</script>
@endsection