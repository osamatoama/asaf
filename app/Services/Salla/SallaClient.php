<?php


namespace App\Services\Salla;

use App\Models\User;
use App\Services\Salla\Registration\RegisterService;
use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Salla\OAuth2\Client\Provider\Salla;

/**
 * Class SallaClient
 */
class SallaClient implements ClientInterface
{

    /** @var array */
    private $headers = [
        'Accept' => 'application/json',
    ];

    private $token = "";

    /** @var Salla */
    private $sallaOauthClient;

    /**
     * SallaClient constructor.
     */
    public function __construct()
    {
        $this->sallaOauthClient = new Salla([
            'clientId'     => config('services.salla.client_id'),
            'clientSecret' => config('services.salla.client_secret'),
            'redirectUri'  => route('salla.callback'),
        ]);
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders($headers = [])
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }


    /**
     * @param $url
     * @param array $params
     * @return mixed
     */
    public function getHttpRequest($url, $params = [])
    {
        $response = Http::withHeaders($this->headers)
            ->withToken($this->token)
            ->get($url, $params);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param $url
     * @param array $body
     * @return PromiseInterface|Response
     */
    public function postHttpRequest($url, $body = [])
    {
        $response = Http::withHeaders($this->headers)
            ->withToken($this->token)->post($url, $body);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param $url
     * @param array $body
     * @return PromiseInterface|Response
     */
    public function putHttpRequest($url, $body = [])
    {
        $response = Http::withHeaders($this->headers)
            ->withToken($this->token)->put($url, $body);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param $url
     * @param array $body
     * @return PromiseInterface|Response
     */
    public function deleteHttpRequest($url, $body = [])
    {
        $response = Http::withHeaders($this->headers)
            ->withToken($this->token)->delete($url, $body);

        return json_decode($response->getBody()->getContents(), true);
    }


    /**
     * @return RedirectResponse
     */
    public function redirectAway()
    {
        return redirect()->away($this->sallaOauthClient->getAuthorizationUrl([
            'scope' => 'offline_access',
        ]));
    }

    /**
     * @throws IdentityProviderException
     */
    public function handleCallback(Request $request)
    {
        // Redirect back if no code
        if (!$request->has('code')) {
            throw new Exception('Something wrong, try again later!');
        }

        /** @var  $token */
        $token = $this->sallaOauthClient->getAccessToken('authorization_code', ['code' => $request->code]);

        $response = $this->setToken($token->getToken())
            ->getHttpRequest(config('services.salla.urls.merchant_info_url'));

        if ($response['success']) {
            $merchantInfo = $response["data"];
        } else {
            throw new Exception("Something wrong, try again later!");
        }

        $registerService = new RegisterService();

        $user = $registerService->handle([
            'token'        => $token,
            'merchantInfo' => $merchantInfo,
        ]);

        auth()->login($user, true);

        //Dashboard Home.
        return redirect()->route('dashboard.home');
    }
}
