<?php


class xui
{
    private string $address;

    private string $port;
    private string $username;
    private string $password;
    private string $cookie_path;
    private mixed $list_all = false;

    public function __construct(string $address, string $port, string $username, string $password, string $server_id)
    {
        $this->address = $address;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->cookie_path = BASE_PATH . 'cookies/' . $server_id . '.txt';

        if (!file_exists($this->cookie_path)) $this->login();
    }

    public function request(string $method, $param = ""): mixed
    {
        $handle = curl_init("$this->address:$this->port/$method");
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_ENCODING, "");
        curl_setopt($handle, CURLOPT_COOKIEFILE, $this->cookie_path);
        curl_setopt($handle, CURLOPT_COOKIEJAR, $this->cookie_path);
        curl_setopt($handle, CURLOPT_MAXREDIRS, 10);
        curl_setopt($handle, CURLOPT_TIMEOUT, 0);
        curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($handle, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "POST");
        if (is_array($param)) {
            $param = json_encode($param);
            curl_setopt($handle, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        }
        curl_setopt($handle, CURLOPT_POSTFIELDS, $param);
        $response = json_decode(curl_exec($handle), true);
        curl_close($handle);
        return $response;
    }

    public function login(): bool
    {
        return (bool)$this->request("login", [
            "username" => $this->username,
            "password" => $this->password
        ]);
    }


    public function getList(): mixed
    {
        $response = $this->request('xui/inbound/list');
        //dd($response);
        if (!isset($response['success'])) {
            return false;
        }
        if (!$response['success']) {
            return false;
        }

        return $this->list_all = $response;

    }

    public function getInbound($inboundID = 0): false|array
    {

        if(!$this->list_all){
            return false;
        }

        $inboundData =  $this->list_all['obj'][$inboundID];
        $clientStats = $inboundData['clientStats'];
        $clients = json_decode($inboundData['settings'], true);

        unset($clients['decryption'], $clients['fallbacks']);
        $client_sort = [];
        foreach ($clients['clients'] as $key => $client) {

            $client_sort[($client['id'])] = [
                'enable' => $clientStats[$key]['enable'],
                'port' => $inboundData['port'],
                'protocol' => $inboundData['protocol'],
                'totalGB' => $client['totalGB'],
                'expiryTime' => $client['expiryTime'],
                'remark' => $client['email'],
                'up' => $clientStats[$key]['up'],
                'down' => $clientStats[$key]['down']
            ];
        }
        return $client_sort;
    }

}
