<?php


namespace App\Services\Auth;


use App\Services\Base\Auth\BaseAuthService;
use App\Services\User\Resources\User as UserResource;
use Illuminate\Http\Request;

class AuthService extends BaseAuthService
{
    /**
     * @param Request $request
     * @return array
     */
    public function index(Request $request): array
    {
        $user = $request->user();

        if ($user->isActive() && $user->isVerified()) {
            return [
                'data' => new UserResource($request->user())
            ];
        }

        $this->logout();
    }

    public function logout()
    {
        $this->auth->invalidate();
    }

    /**
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verifyUser(string $token)
    {
        $user = $this->repository->getUserVerify($token);

        $message = $this->repository->verifyUser($user)
            ? trans('auth.email_verified')
            : trans('auth.email_already_verified');

        return redirect(env('CLIENT_BASE_URL') . '/login?success=' . $message);
    }

    /**
     * @param $user
     */
    public function createEmailVerification($user)
    {
        $this->repository->setVerifyToken($user);
        $this->repository->sendEmailVerificationNotification($user);
    }

    /**
     * @param string $email
     * @return array
     */
    public function getMessageByRegistration(string $email): array
    {
        return ['messages' => [
            'primary' => trans('auth.activation_code_sent', ['email' => $email])
        ]];
    }
}
