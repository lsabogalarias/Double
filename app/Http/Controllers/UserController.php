<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class UserController extends Controller
{   
    // Metodo de inicialización encargado de cargar el buscador de usuarios
    public function index(){
        $result = "";
        $usersArray = "";
        $paginatedResults = "";
        
        return view('welcome', compact('usersArray', 'result', 'paginatedResults'));        
    }
    // Método encargado de mostrar y paginar los primeros 10 registros obtenidos de la búsqueda inicial
    public function user(Request $request){        
        
        $perPage = 10; // Número de elementos por página
        $username = $request->username; 
        $page = $request->input('page', 1); // Obtener el número de página actual

        $users = HTTP::get('https://api.github.com/search/users?q=' . $request->username);
        $usersArray = $users->json();
        $result = $usersArray['items'];

        // Calcula el índice inicial y final para la porción de resultados
        $startIndex = ($page - 1) * $perPage;
        $paginatedResults = array_slice($result, $startIndex, $perPage);

        // Se crea una instancia de Collection para los resultados paginados
        $paginatedCollection = new Collection($paginatedResults);

        // Se crea una instancia de LengthAwarePaginator con los resultados paginados
        $paginatedResults = new LengthAwarePaginator(
            $paginatedCollection,
            count($result),
            $perPage,
            $page,
            [
                'path' => route('user.list'), // Especificar la ruta de la página actual
            ]
        );

        return view('welcome', compact('usersArray', 'result', 'username', 'paginatedResults'));
    }
    // Metodo encargado de mostrar los datos de perfil de un usuario determinado
    public function show($id)
    {        
        // Obtiene la información de un usuario
        /*$user = HTTP::get('https://api.github.com/search/users?q='.$id);                   
        $usersArray = $user->json(); 
        $result = $usersArray['items']; 
        $username = $id;
        // Filtro la información por exactamente el nombre del usuario
        $resources = array_filter($result, function ($var) use ($id) {
            return strlen($var['login']) === strlen($id);
        });         
        //$followersnum = $this->getFollowers($resources);          
        //$data = $resources;
        //dd($result2); 
        //echo ($resources[0]['followers_url']); die();   
        return view('profile', compact('resources', 'username'));*/

        $user = HTTP::get('https://api.github.com/search/users?q=' . $id);
        $usersArray = $user->json();
        $result = $usersArray['items'];
        $username = $id;

        $resources = array_filter($result, function ($var) use ($id) {
            return strlen($var['login']) === strlen($id);
        });

        $followersnum = $this->getFollowers($resources);

        // Obtener los 10 primeros usuarios ordenados por el número de seguidores
        $topUsers = array_slice($resources, 0, 10);
        $followersCounts = array_map(function ($user) {
            return $this->getFollowers([$user]);
        }, $topUsers);
        
        return view('profile', compact('resources', 'topUsers', 'followersCounts', 'username'));
    }

    public function getFollowers($resources){
        $followersnum = 0;
        // Obtiene el numero de seguidores
        $followers = HTTP::get($resources[0]['followers_url']);
        $data = json_decode($followers, true);
        $followersnum = count($data); 
        
        return $followersnum;
    }
}
