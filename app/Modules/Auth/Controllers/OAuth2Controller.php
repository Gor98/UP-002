<?php


namespace App\Modules\Auth\Controllers;


use App\Common\Bases\Controller;
use App\Common\Tools\APIResponse;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Auth\Resources\Oauth2Resource;
use App\Modules\Auth\Requests\OAuth2Request;
use Illuminate\Http\JsonResponse;

/**
 * Class OAuth2Controller
 * @package App\Modules\Auth\Controllers
 */
class OAuth2Controller extends Controller
{
    /**
     * @param OAuth2Request $request
     * @param AuthService $authService
     * @return JsonResponse
     */
    public function __invoke(OAuth2Request $request, AuthService $authService): JsonResponse
    {
        return APIResponse::successResponse(new Oauth2Resource($authService->getOauthUrl($request)));
    }
}
