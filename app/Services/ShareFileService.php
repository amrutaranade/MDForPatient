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
        if(!$this->checkInternetConnection()) {
            return response()->json(['error' => 'No internet connection'], 500);
        }
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

            // Log the access token for debugging purposes
            Log::info('Access Token Retrieved: ' . $data['access_token']);
            
            return $data['access_token'];
        } catch (RequestException $e) {
            // Handle error
            throw new \Exception("Error obtaining access token: " . $e->getMessage());
        }

        
    }

    public function getFolderId($parentId, $folderName) {
        if(!$this->checkInternetConnection()) {
            return response()->json(['error' => 'No internet connection'], 500);
        }
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
        if(!$this->checkInternetConnection()) {
            return response()->json(['error' => 'No internet connection'], 500);
        }
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
        if(!$this->checkInternetConnection()) {
            return response()->json(['error' => 'No internet connection'], 500);
        }
        
        $token = $this->getAccessToken();
        $successCount = 0;
        
        //foreach ($files as $file) {            
            
            $local_path = $file->getPathname();
            if (!$file) {
                return response()->json(['error' => 'No file uploaded'], 400);
            }

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
                        'patient_id' => session("patient_id") ?? $request->patient_id,
                        'document_name' => $original_filename,
                        'folder_id' => $folderId,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    $successCount++;
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
        //}

        return array("success" => true);

        // if($successCount == count($files)){
        //     return response()->json(['success']);
        // } else {
        //     return response()->json(['error']);
        // }

        /*
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
                    'patient_id' => session("patient_id") ?? $request->patient_id,
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
            */
    }

    private function getAuthorizationHeader($token)
    {
        // Implement your logic to get the authorization header based on the token
        return [
            'Authorization' => 'Bearer ' . $token
        ];
    }

    public function checkInternetConnection()
    {
        $connected = @fsockopen("www.google.com", 80);
        if ($connected) {
            fclose($connected);
            return true;
        } else {
            return false;
        }
    }

    public function checkShareFileConnection()
    {
        $accessToken = $this->getAccessToken();

        try {
            $response = $this->client->get("https://{$this->subdomain}.sharefile.com/sf/v3/Items", [
                'headers' => [
                    'Authorization' => "Bearer $accessToken",
                    'Accept' => 'application/json',
                ]
            ]);

            return true;
        } catch (RequestException $e) {
            return false;
        }
    }

    public function ensureFolderExistsAndUploadFile($request, $folderName, $files) {
        if(!$this->checkInternetConnection()) {
            return response()->json(['error' => 'No internet connection'], 500);
        }

        $rootFolderId = $this->getPersonalRootFolderId();

        if ($rootFolderId === null) {
            throw new \Exception("Root folder ID not found.");
        }

        $folderId = $this->getFolderId($rootFolderId, $folderName);

        if ($folderId === null) {
            $folderId = $this->createFolder($rootFolderId, $folderName);
        }

        return $this->uploadFile($request, $files, $folderId);
    }

    public function getPersonalRootFolderId() {
        if(!$this->checkInternetConnection()) {
            return response()->json(['error' => 'No internet connection'], 500);
        }
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

    public function getShareFilesByFolderId($folderId) {
        try{
            $accessToken = $this->getAccessToken();
            $uri = "https://{$this->subdomain}.sf-api.com/sf/v3/Items(" . $folderId . ")/Children";

            $headers = $this->getAuthorizationHeader($accessToken);

            $client = new Client();
            $response = $client->request('GET', $uri, [
                'timeout' => 30,
                'verify' => false,
                'headers' => $headers
            ]);

            $http_code = $response->getStatusCode();
            $curl_response = json_decode((string) $response->getBody(), true);       

            return $curl_response;
        }catch (RequestException $e) {
            throw new \Exception("folder ID Not found: " . $e->getMessage());
        }        
    }

    function downloadFileOld($item_id, $local_path) {
        $accessToken = $this->getAccessToken();
        $client = new Client([
            'base_uri' => 'https://' . $this->subdomain . '.sf-api.com/sf/v3/',
            'headers' => $this->getAuthorizationHeader($accessToken),
            'stream' => true,
            'verify' => false, // Disabling SSL verification, you might want to remove this in a production environment
            'allow_redirects' => true, // Enable automatic redirect following
            'http_errors' => false // Disable throwing exceptions for non-successful HTTP responses
        ]);

        try {
            $response = $client->get("Items($item_id)/Download", [
                'sink' => $local_path
            ]);

            // Check if download was successful
            if ($response->getStatusCode() === 200) {
                echo "File downloaded successfully.\n";
            } else {
                echo "Error downloading file. HTTP code: " . $response->getStatusCode() . "\n";
            }
        } catch (RequestException $e) {
            echo "Error downloading file: " . $e->getMessage() . "\n";
        }
    }

    function downloadFile($item_id, $local_path) {
        $accessToken = $this->getAccessToken();
        $uri = "https://{$this->subdomain}.sf-api.com/sf/v3/Items(".$item_id.")/Download";
        
        $headers = $this->getAuthorizationHeader($accessToken);
     
        $client = new Client([
            'verify' => false,
            'timeout' => 300,
            'headers' => $headers,
            'stream' => true,
            'allow_redirects' => true
        ]);

        try {
            $response = $client->get($uri, [
                'sink' => $local_path
            ]);

            $http_code = $response->getStatusCode();

            $redirectUrl = $response->getHeaderLine('Location');

            // Now, download the file from the redirect URL
            //$downloadResponse = $client->get($redirectUrl);

            if ($response->getStatusCode() === 302) {
                $redirectUrl = $response->getHeaderLine('Location');
    
                // Now, download the file from the redirect URL
                $downloadResponse = $client->get($redirectUrl);
    
                // Check if download was successful
                if ($downloadResponse->getStatusCode() === 200) {
                    return $downloadResponse->getBody();
                } else {
                    echo "Error downloading file. HTTP code: " . $downloadResponse->getStatusCode() . "\n";
                }
            } else {
                echo "Unexpected HTTP code: " . $response->getStatusCode() . "\n";
            }
        } catch (RequestException $e) {
            echo "Error downloading file: " . $e->getMessage() . "\n";
        }
    }

    public function download($fileId)
    {
        try {
            $accessToken = $this->getAccessToken();
            $headers = $this->getAuthorizationHeader($accessToken);
            $uri = "https://{$this->subdomain}.sf-api.com/sf/v3/Items($fileId)/Download";


            $client = new Client();
            $response = $client->get($uri, [
                'headers' => $headers,
            ]);

            return redirect($response->getHeaderLine('Location'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
?>