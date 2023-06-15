<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <title>Double V</title>
        <link rel="stylesheet" href="{{ asset('/css/styles.css') }}"> 
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">   
    </head>
    <body>
        <div class="container">
            <form class="row g-3" name='formulariobuscar' action='{{route('user.list')}}' method='post'>
            @csrf
            <div class="row justify-content-center align-items-center vh-100">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <input type="text" onblur="validarCampo(event)" class="form-control mr-2" id="username" name="username" minlength="4" maxlength="20" required placeholder="Ingrese su usuario">
                        <button type="submit" class="mr-3 btn btn-primary">Buscar</button>
                    </div>
                    <div class="d-flex alert alert-danger" role="alert" id="error_username">Nombre de usuario no válido</div>
                </div>
            </div>
            </form>  
            @if($paginatedResults != '')  
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6">
                    <table class="table table-bordered justify-center">                        
                        <thead class="table-primary">
                            <tr>
                                <td class="text-center"><i class="fas fa-regular fa-id-card"></i> User.id</td>
                                <td class="text-center"><i class="fas fa-regular fa-users"></i> User.login</td>
                                <td class="text-center"><i class="fas fa-solid fa-eye"></i></td>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($paginatedResults as $user)
                        <tr>
                            <td>{{$user['id']}}</td>
                            <td>{{$user['login']}} </td>                        
                            <td class="text-center">
                                <a href="{{ route('user.show', ['id' => $user['login']]) }}" id="{{$user['login']}}" name="{{$user['login']}}">
                                    <i class="fas fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>    
                        @endforeach                        
                        </tbody>
                    </table> 
                    <br><br>
                                                                
                </div>
            </div>
            @endif
        </div>
        <script src="{{asset('js/custom.js')}}"></script>    
    </body>  
</html>
