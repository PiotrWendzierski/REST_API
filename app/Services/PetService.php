<?php

namespace App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Log;

class PetService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://petstore.swagger.io/v2/',
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ]);
    }

    public function getAllPets()
    {
        try
        {
            $response = $this->client->get('pet/findByStatus', ['query' => ['status' => 'available']]);
            return json_decode($response->getBody(), true);
        }
        catch (RequestException $e)
        {
            Log::error('Error fetching pets', ['exception' => $e]);
            throw new \Exception('Unable to fetch pets at this time.');
        }
        catch (ServerException $e)
        {
            Log::error('Server error fetching pets', ['exception' => $e]);
            throw new \Exception('The PetStore API is currently unavailable. Please try again later.');
        }
        catch (ConnectException $e)
        {
            Log::error('Connection error fetching pets', ['exception' => $e]);
            throw new \Exception('Could not connect to the PetStore API.');
        }
        catch (ClientException $e)
        {
            Log::error('Client error fetching pets', ['exception' => $e]);
            throw new \Exception('An error occurred while fetching pets. Please try again.');
        }
    }

    public function getPet($id)
    {
        try
        {
            $response = $this->client->get("pet/{$id}");
            return json_decode($response->getBody(), true);
        }
        catch (RequestException $e)
        {
            Log::error("Error fetching pet with ID: {$id}", ['exception' => $e]);
            throw new \Exception("Unable to fetch pet with ID: {$id}");
        }
        catch (ServerException $e)
        {
            Log::error('Server error fetching pets', ['exception' => $e]);
            throw new \Exception('The PetStore API is currently unavailable. Please try again later.');
        }
        catch (ConnectException $e)
        {
            Log::error('Connection error fetching pets', ['exception' => $e]);
            throw new \Exception('Could not connect to the PetStore API.');
        }
        catch (ClientException $e)
        {
            Log::error('Client error fetching pets', ['exception' => $e]);
            throw new \Exception('An error occurred while fetching pets. Please try again.');
        }
    }

    public function createPet($data)
    {
        try
        {
            $response = $this->client->post('pet', [
            'json' => $data
        ]);
        return json_decode($response->getBody(), true);
        }
        catch (RequestException $e)
        {
            Log::error('Error creating pet', ['exception' => $e]);
            throw new \Exception('Unable to create pet at this time.');
        }
        catch (ServerException $e)
        {
            Log::error('Server error fetching pets', ['exception' => $e]);
            throw new \Exception('The PetStore API is currently unavailable. Please try again later.');
        }
        catch (ConnectException $e)
        {
            Log::error('Connection error fetching pets', ['exception' => $e]);
            throw new \Exception('Could not connect to the PetStore API.');
        }
        catch (ClientException $e)
        {
            Log::error('Client error fetching pets', ['exception' => $e]);
            throw new \Exception('An error occurred while fetching pets. Please try again.');
        }
    }

    public function updatePet($data)
    {
        try
        {
            $response = $this->client->put('pet', [
            'json' => $data
            ]);
            return json_decode($response->getBody(), true);
        }
        catch (RequestException $e)
        {
            Log::error('Error updating pet', ['exception' => $e]);
            throw new \Exception('Unable to update pet at this time.');
        }
        catch (ServerException $e)
        {
            Log::error('Server error fetching pets', ['exception' => $e]);
            throw new \Exception('The PetStore API is currently unavailable. Please try again later.');
        }
        catch (ConnectException $e)
        {
            Log::error('Connection error fetching pets', ['exception' => $e]);
            throw new \Exception('Could not connect to the PetStore API.');
        }
        catch (ClientException $e)
        {
            Log::error('Client error fetching pets', ['exception' => $e]);
            throw new \Exception('An error occurred while fetching pets. Please try again.');
        }
    }

    public function deletePet($id)
    {
        try
        {
            $response = $this->client->delete("pet/{$id}");
        return json_decode($response->getBody(), true);
        }
        catch (RequestException $e)
        {
            Log::error("Error deleting pet with ID: {$id}", ['exception' => $e]);
            throw new \Exception("Unable to delete pet with ID: {$id}");
        }
        catch (ServerException $e)
        {
            Log::error('Server error fetching pets', ['exception' => $e]);
            throw new \Exception('The PetStore API is currently unavailable. Please try again later.');
        }
        catch (ConnectException $e)
        {
            Log::error('Connection error fetching pets', ['exception' => $e]);
            throw new \Exception('Could not connect to the PetStore API.');
        }
        catch (ClientException $e)
        {
            Log::error('Client error fetching pets', ['exception' => $e]);
            throw new \Exception('An error occurred while fetching pets. Please try again.');
        }
    }
}
