<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Elasticsearch\ClientBuilder;
use Elasticquent\ElasticquentTrait;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $client = ClientBuilder::create()
        // ->setHosts(['http://localhost:9200/'])
        // ->build();
        

        // $params = [
        //     'index' => 'my_index',
        //     'body' => [
        //         'settings' => [
        //             'number_of_shards' => 3,
        //             'number_of_replicas' => 2
        //         ],
        //         'mappings' => [
        //             '_source' => [
        //                 'enabled' => true
        //             ],
        //             'properties' => [
        //                 'first_name' => [
        //                     'type' => 'keyword'
        //                 ],
        //                 'age' => [
        //                     'type' => 'integer'
        //                 ]
        //             ]
        //         ]
        //     ]
        // ];

        // $response = $client->indices()->create($params);
        // dd($response);
        return view('home');
    }
}
