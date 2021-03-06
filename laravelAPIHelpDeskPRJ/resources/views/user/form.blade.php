<div class="form-row">
    <div class="form-group col-md-5 offset-md-1">
        <div class="custom-control custom-radio custom-control-inline">
            <input class="custom-control-input" type="radio" value="1" @if($user->sexo == '1') checked='checked' @endif name="sexo" id="sexom">
            <label class="custom-control-label" for="sexom">Masculino</label>
        </div>

        <div class="custom-control custom-radio custom-control-inline">
            <input class="custom-control-input" type="radio" value="2" @if($user->sexo == '2') checked='checked' @endif name="sexo" id="sexof">
            <label class="custom-control-label" for="sexof">Feminino</label>
        </div>        
        <div id="sexo_feedback" class="invalid-feedback"></div>
    </div>
    
</div>

<div class="form-row">
    <div class="form-group col-md-5 offset-md-1">
        <label for="name">Nome</label>
        <input type="text" class="form-control" maxlength="200" name="name" id="name" value="{{$user->name}}" placeholder="">
        <div id="name_feedback" class="invalid-feedback"></div>
    </div>
    <div class="form-group col-md-5 ">
        <label for="last_name">Sobrenome</label>
        <input type="text" class="form-control" maxlength="200" name="last_name" id="last_name" value="{{$user->last_name}}" placeholder="">
        <div id="last_name_feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-10 offset-md-1">
        <label for="documento">Documento/CPF</label>
        <input type="text" name="documento" class="form-control" id="documento" value="{{$user->documento}}" maxlength="50" placeholder="">
        <div id="documento_feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-5 offset-md-1">
        <label for="login">Login</label>
        <input type="text" class="form-control" maxlength="200" name="login" id="login" value="{{$user->login}}" placeholder="">
        <div id="login_feedback" class="invalid-feedback"></div>
    </div>

    <div class="form-group col-md-5 ">
        <label for="email">Email</label>
        <input type="email" class="form-control" maxlength="200" name="email" id="email" value="{{$user->email}}" placeholder="">
        <div id="email_feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-5 offset-md-1">
        <label for="password">Senha</label>
        <input type="password" class="form-control" maxlength="50" name="password" id="password" value="" placeholder="">
        <div id="password_feedback" class="invalid-feedback"></div>
    </div>
    <div class="form-group col-md-5 ">
        <label for="password_confirmation">Confirmação da Senha</label>
        <input type="password" class="form-control" maxlength="50" name="password_confirmation" id="password_confirmation" value="" placeholder="">
        <div id="password_confirmation_feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-10 offset-md-1">
        <label for="roles">Perfis</label>
        <select name="roles" style="width: 100%" class="form-control" id="roles" multiple></select>
        <div id="roles_feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-10 offset-md-1">
        <label for="organizacao_origem">Organização de Origem</label>
        <select name="organizacao_origem" style="width: 100%" class="form-control" id="organizacao_origem" ></select>
        <div id="organizacao_origem_feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-10 offset-md-1">
        <label for="organizacao_visivel">Organizações Visiveis</label>
        <select name="organizacao_visivel" style="width: 100%" class="form-control" id="organizacao_visivel" multiple></select>
        <div id="organizacao_visivel_feedback" class="invalid-feedback"></div>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-10 offset-md-1">
        <label for="status">Status</label>
        <select name="status" class="form-control" style="width: 100%" id="status">
            <option @if($user->status == '1') selected='selected' @endif value="1">ATIVO</option>
            <option @if($user->status == '0') selected='selected' @endif value="0">INATIVO</option>
        </select>
        <div id="status_feedback" class="invalid-feedback"></div>
    </div>
</div>