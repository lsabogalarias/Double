<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <title>Double V</title>
        <link rel="stylesheet" href="{{ asset('/css/styles.css') }}">       
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        
    </head>
    <body>
        <div class="container">
            <form class="row g-3" name='formulariobuscar' action='' method='post'>
            @csrf 
            <div class="row justify-content-center align-items-center vh-100">                
                <table class="table table-bordered justify-center">     
                    <thead class="table-primary">
                        <th scope="col" colspan="2" class="table-primary text-center"> PERFIL DE USUARIO</th>
                    </thead>                   
                    <tr>
                        <td rowspan="5" class="col-4">
                            <img src="{{$resources[0]['avatar_url']}}" alt="texto descriptivo" />
                        </td>
                        <td class="table-primary">Id: {{$resources[0]['id']}}</td>
                    </tr>
                    <tr>
                        <td>Login: {{$resources[0]['login']}}</td>
                    </tr>
                    <tr class="table-primary">    
                        <td  class="table-primary">Tipo: {{$resources[0]['type']}}</td>
                    </tr>
                    <tr>    
                        <td>Github: {{$resources[0]['url']}}</td>
                    </tr>
                    <tr class="table-primary">    
                        <td>Tipo: {{$resources[0]['html_url']}}</td>
                    </tr>
                </table>                           
                <br><br>
                <canvas id="barChart"></canvas>
            </div>            
            </form>
        </div>  
        <!-- En tu archivo PHP -->
        <script>
            const topUsers = <?php echo json_encode($topUsers); ?>;
            const followersCounts = <?php echo json_encode($followersCounts); ?>;
        </script>

        <script src="{{asset('js/index.js')}}"></script>          
    </body>  
</html>
