<?php
// app/Services/ShareFileService.php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\FacadesLog;
use Illuminate\Support\Facades\Log;
use App\Models\PatientMedicalRecords;

class ShareFileService
{
    protected $client;
    protected $clientId;
    protected $clientSecret;
    protected $username;
    protected $password;
    protected $subdomain;

    public function __construct()
    {
        $this->client = new Client();
        $this->clientId = config('services.shareFile.sharefile_client_id');
        $this->clientSecret = config('services.shareFile.sharefile_client_secret');
        $this->username = config('services.shareFile.sharefile_username');
        $this->password = config('services.shareFile.sharefile_password');
        $this->subdomain = config('services.shareFile.sharefile_subdomain');
    }

    public function getAccessToken() {
        try {
            $response = $this->client->post("https://{$this->subdomain}.sharefile.com/oauth/token", [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'username' => $this->username,
                    'password' => $this->password,
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            return $data['access_token'];
        } catch (RequestException $e) {
            // Handle error
            throw new \Exception("Error obtaining access token: " . $e->getMessage());
        }
    }

    public function getFolderId($parentId, $folderName) {
        $accessToken = $this->getAccessToken();

        try {
            $response = $this->client->get("https://{$this->subdomain}.sharefile.com/sf/v3/Items($parentId)/Children", [
                'headers' => [
                    'Authorization' => "Bearer $accessToken",
                    'Accept' => 'application/json',
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            foreach ($data['value'] as $item) {
                if ($item['Name'] === $folderName && $item['odata.type'] === "ShareFile.Api.Models.Folder") {
                    return $item['Id'];
                }
            }

            return null;
        } catch (RequestException $e) {
            throw new \Exception("Error checking folder existence: " . $e->getMessage());
        }
    }

    public function createFolder($parentId, $folderName) {
        $accessToken = $this->getAccessToken();

        try {
            $response = $this->client->post("https://{$this->subdomain}.sharefile.com/sf/v3/Items($parentId)/Folder", [
                'headers' => [
                    'Authorization' => "Bearer $accessToken",
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'Name' => $folderName,
                    'Description' => 'Folder created via API',
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            return $data['Id'];
        } catch (RequestException $e) {
            throw new \Exception("Error creating folder: " . $e->getMessage());
        }
    }    

    public function uploadFile($request, $file, $folderId)
    {
        $token = $this->getAccessToken();        
        $local_path = $request->file('file')->getPathname();

        if (!$file) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        $local_path = $file->getPathname();
        $original_filename = $file->getClientOriginalName();

        $uri = "https://{$this->subdomain}.sf-api.com/sf/v3/Items(" . $folderId . ")/Upload";
        
        Log::error('File upload link - : '.$uri);

        $headers = $this->getAuthorizationHeader($token); // Implement this function to get authorization headers

        $client = new Client([
            'verify' => false,
            'timeout' => 300,
            'headers' => $headers
        ]);

        try {
            $response = $client->get($uri);
            $upload_config = json_decode($response->getBody()->getContents());

            if ($response->getStatusCode() == 200) {
                $multipart = [
                    [
                        'name'     => 'File1',
                        'contents' => fopen($local_path, 'r'),
                        'filename' => $original_filename
                    ]
                ];

                $uploadResponse = $client->post($upload_config->ChunkUri, [
                    'multipart' => $multipart,
                    'headers' => $headers // Use the same headers for the post request
                ]);

                //Save medical records data 
                PatientMedicalRecords::insert([
                    'patient_id' => $request->patient_id,
                    'document_name' => $original_filename,
                    'folder_id' => $folderId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                return response()->json(['success']);
            } else {
                return response()->json(['error'], $response->getStatusCode());
            }
        } catch (RequestException $e) {
            Log::error('File upload error: '.$e->getMessage());
            if ($e->hasResponse()) {
                $responseBody = $e->getResponse()->getBody()->getContents();
                Log::error('Response: '.$responseBody);
                return response()->json(['error' => $responseBody], $e->getResponse()->getStatusCode());
            } else {
                return response()->json(['error' => 'Failed to connect to server'], 500);
            }
        }
    }

    private function getHostname($token)
    {
        // Implement your logic to get the hostname based on the token
    }

    private function getAuthorizationHeader($token)
    {
        // Implement your logic to get the authorization header based on the token
        return [
            'Authorization' => 'Bearer ' . $token
        ];
    }

    private function getToken()
    {
        // Implement your logic to get the token
    }
    


    public function ensureFolderExistsAndUploadFile($request, $folderName, $filePath) {
        $rootFolderId = $this->getPersonalRootFolderId();

        if ($rootFolderId === null) {
            throw new \Exception("Root folder ID not found.");
        }

        $folderId = $this->getFolderId($rootFolderId, $folderName);

        if ($folderId === null) {
            $folderId = $this->createFolder($rootFolderId, $folderName);
        }

        return $this->uploadFile($request, $filePath, $folderId);
    }

    public function getPersonalRootFolderId() {
        $accessToken = $this->getAccessToken();

        try {
            $response = $this->client->get("https://{$this->subdomain}.sharefile.com/sf/v3/Items", [
                'headers' => [
                    'Authorization' => "Bearer $accessToken",
                    'Accept' => 'application/json',
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            
            if (isset($data['Name']) && $data['Name'] === 'Personal Folders') {
                return $data['Id'];
            }

            return null; // Personal root folder not found
        } catch (RequestException $e) {
            throw new \Exception("Error obtaining personal root folder ID: " . $e->getMessage());
        }
    }
}
?>