<?php

namespace App\Services\Salla;

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
    private array $headers = [
        'Accept' => 'application/json',
    ];

    private string $token = "";

    /** @var Salla */
    private Salla $sallaOauthClient;

    /**
     * SallaClient constructor.
     */
    public function __construct()
    {
        $this->sallaOauthClient = new Salla([
            'clientId'     => config('salla.client_id'),
            'clientSecret' => config('salla.client_secret'),
            'redirectUri'  => route('salla.callback'),
        ]);
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders(array $headers = []): self
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @param string $url
     * @param array $params
     * @return mixed
     */
    public function getHttpRequest(string $url, $params = []): mixed
    {
        $response = Http::withHeaders($this->headers)
            ->withToken($this->token)
            ->get($url, $params);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $url
     * @param array $body
     * @return PromiseInterface|Response
     */
    public function postHttpRequest(string $url, $body = []): PromiseInterface|Response
    {
        $response = Http::withHeaders($this->headers)
            ->withToken($this->token)->post($url, $body);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $url
     * @param array $body
     * @return PromiseInterface|Response
     */
    public function putHttpRequest(string $url, array $body = []): PromiseInterface|Response
    {
        $response = Http::withHeaders($this->headers)
            ->withToken($this->token)->put($url, $body);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $url
     * @param array $body
     * @return PromiseInterface|Response
     */
    public function deleteHttpRequest(string $url, array $body = []): PromiseInterface|Response
    {
        $response = Http::withHeaders($this->headers)
            ->withToken($this->token)->delete($url, $body);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return RedirectResponse
     */
    public function redirectAway(): RedirectResponse
    {
        return redirect()->away($this->sallaOauthClient->getAuthorizationUrl([
            'scope' => 'offline_access',
        ]));
    }

    /**
     * @throws IdentityProviderException
     * @throws Exception
     */
    public function handleCallback(Request $request): RedirectResponse
    {
        // Redirect back if no code
        if (!$request->has('code')) {
            throw new Exception('Something wrong, try again later!');
        }

        /** @var  $token */
        $token = $this->sallaOauthClient->getAccessToken('authorization_code', ['code' => $request->get('code')]);

        $response = $this->setToken($token->getToken())
            ->getHttpRequest(config('salla.urls.merchant_info_url'));

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
