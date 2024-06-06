<?php
// app/Services/ShareFileService.php
namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\FacadesLog;
use Illuminate\Support\Facades\Log;

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
        $this->clientId = env('SHAREFILE_CLIENT_ID');
        $this->clientSecret = env('SHAREFILE_CLIENT_SECRET');
        $this->username = env('SHAREFILE_USERNAME');
        $this->password = env('SHAREFILE_PASSWORD');
        $this->subdomain = env('SHAREFILE_SUBDOMAIN');
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

    /*
    public function uploadFile($file, $folderId) {
        $accessToken = $this->getAccessToken();
        try {
            // Initiate the upload
            $uploadResponse = $this->client->post("https://{$this->subdomain}.sf-api.com/sf/v3/Items($folderId)/Upload", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'json' => [
                    'method' => 'standard',
                    'raw' => true,
                ],
            ]);

            $uploadInfo = json_decode($uploadResponse->getBody(), true);
            $uploadUrl = $uploadInfo['ChunkUri'];

            // Perform the file upload
            $response = $this->client->post($uploadUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'multipart' => [
                    [
                        'name' => 'File1',
                        'contents' => fopen($file->getPathname(), 'r'),
                        'filename' => $file->getClientOriginalName(),
                    ],
                ],
            ]);

            // Confirm the upload
            $finalizeResponse = $this->client->post($uploadUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'json' => [
                    'method' => 'standard',
                ],
            ]);

            return ['message' => 'File uploaded successfully'];
        } catch (RequestException $e) {
            throw new \Exception('Upload failed: ' . $e->getMessage());
        }
    }
    */

    // public function uploadFile($file, $folderId) {
    //     $accessToken = $this->getAccessToken();
    //     try {
    //         // Validate file
    //         if (!$file->isValid()) {
    //             throw new \Exception('Invalid file upload');
    //         }

    //         // Initiate the upload
    //         $uploadResponse = $this->client->post("https://{$this->subdomain}.sf-api.com/sf/v3/Items($folderId)/Upload", [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . $accessToken,
    //             ],
    //             'json' => [
    //                 'method' => 'standard',
    //                 'raw' => true,
    //             ],
    //         ]);

    //         $uploadInfo = json_decode($uploadResponse->getBody(), true);
    //         $uploadUrl = $uploadInfo['ChunkUri'];

    //         // Perform the file upload
    //         $fileStream = fopen($file->getPathname(), 'rb');
    //         if (!$fileStream) {
    //             throw new \Exception('Could not open file stream');
    //         }

    //         try {
    //             $response = $this->client->post($uploadUrl, [
    //                 'headers' => [
    //                     'Authorization' => 'Bearer ' . $accessToken,
    //                 ],
    //                 'multipart' => [
    //                     [
    //                         'name' => 'file',
    //                         'contents' => $fileStream,
    //                         'filename' => $file->getClientOriginalName(),
    //                     ],
    //                 ],
    //             ]);
    //         } finally {
    //             if (is_resource($fileStream)) {
    //                 fclose($fileStream); // Close the file stream only if it's a valid resource
    //             }
    //         }

    //         // Confirm the upload
    //         $finalizeResponse = $this->client->post($uploadUrl, [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . $accessToken,
    //             ],
    //             'json' => [
    //                 'method' => 'standard',
    //             ],
    //         ]);

    //         return ['message' => 'File uploaded successfully'];
    //     } catch (RequestException $e) {
    //         throw new \Exception('Upload failed: ' . $e->getMessage());
    //     }
    // }
    public function uploadFile($file, $folderId) {
        $accessToken = $this->getAccessToken();
        try {
            // Validate file
            if (!$file->isValid()) {
                throw new \Exception('Invalid file upload');
            }
    
            // Initiate the upload
            $uploadResponse = $this->client->post("https://{$this->subdomain}.sf-api.com/sf/v3/Items($folderId)/Upload", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'json' => [
                    'method' => 'standard',
                    'raw' => true,
                ],
            ]);
    
            $uploadInfo = json_decode($uploadResponse->getBody(), true);
            $uploadUrl = $uploadInfo['ChunkUri'];
    
            // Perform the file upload
            $fileStream = fopen($file->getPathname(), 'rb');
            if (!$fileStream) {
                throw new \Exception('Could not open file stream');
            }
    
            try {
                $response = $this->client->post($uploadUrl, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $accessToken,
                    ],
                    'multipart' => [
                        [
                            'name' => 'file',
                            'contents' => $fileStream,
                            'filename' => $file->getClientOriginalName(),
                        ],
                    ],
                ]);
            } finally {
                if (is_resource($fileStream)) {
                    fclose($fileStream); // Close the file stream only if it's a valid resource
                }
            }
    
            // Confirm the upload
            $finalizeResponse = $this->client->post($uploadUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
                'json' => [
                    'method' => 'standard',
                ],
            ]);
    
            // Log upload URL for debugging
            Log::info('Upload URL: ' . $uploadUrl);
    
            return ['message' => 'File uploaded successfully'];
        } catch (RequestException $e) {
            throw new \Exception('Upload failed: ' . $e->getMessage());
        }
    }
    


    public function ensureFolderExistsAndUploadFile($folderName, $filePath) {
        $rootFolderId = $this->getPersonalRootFolderId();

        if ($rootFolderId === null) {
            throw new \Exception("Root folder ID not found.");
        }

        $folderId = $this->getFolderId($rootFolderId, $folderName);

        if ($folderId === null) {
            $folderId = $this->createFolder($rootFolderId, $folderName);
        }

        return $this->uploadFile($filePath, $folderId);
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