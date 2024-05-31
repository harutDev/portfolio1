<?php

namespace App\Http\Controllers;

use App\DTO\{DeleteEducationDTO,
    DeleteLinkDTO,
    DeletePostDTO,
    DeleteSkillsDTO,
    RegisterDTO,};
use App\Http\Requests\{StoreRegisterRequest,};
use App\Http\Services\{AdditionalLinksService,
    AuthService,
    EducationsService,
    InformationsService,
    PostService,
    ReadService,
    SkillsService,
    UserService};
use App\Interface\ColumnsInterface;
use App\Interface\ViewInterface;
use App\Models\{ Files, Images, User, Visitors};
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AdminController extends Controller implements ViewInterface, ColumnsInterface
{
    /**
     * @param UserService $userService
     * @param InformationsService $informationsService
     * @param PostService $postService
     * @param SkillsService $skillsService
     * @param EducationsService $educationsService
     * @param AdditionalLinksService $additionalLinksService
     * @param ReadService $readService
     * @param AuthService $authService
     */
    public function __construct(
        protected UserService $userService, protected InformationsService $informationsService,
        protected PostService $postService, protected SkillsService $skillsService,
        protected EducationsService $educationsService, protected AdditionalLinksService $additionalLinksService,
        protected ReadService $readService, protected AuthService $authService

    ) {}

    /**
     * @return Factory|Application|View
     */
    public function dashboard(): Factory|Application|View
    {
        return view(self::VIEW_ADMIN_REGISTRATION);
    }

    /**
     * @return Factory|Application|View
     */
    public function welcome(): Factory|Application|View
    {
        $userInfo = null;

        if (!is_null(auth()->id())) {
            $userInfo = User::query()->find(auth()->id());

            if ($userInfo !== null)
                $userInfo->load(['educations', 'informations', 'skills', 'posts.additionalLinks', 'images', 'files']);

        }

        $ip = $this->createVisitors();

        return view(self::VIEW_WELCOME, compact('userInfo', 'ip'));
    }

    /**
     * @return Model|Builder|null
     */
    private function createVisitors(): Model|Builder|null
    {
        $visitor_ip = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $referrer = $_SERVER['HTTP_REFERER'] ?? 'No referrer';
        $timestamp = date("Y-m-d H:i:s");
        $visitor = null;

        if (!is_null(auth()->id()) && User::query()->where('id', auth()->id())->exists()) {
            $visitor = Visitors::query()->firstOrCreate(
                [self::IP_ADDRESS => $visitor_ip],
                [
                    self::USER_AGENT => $user_agent,
                    self::REFERRER => $referrer,
                    self::VISIT_TIME => $timestamp,
                    self::USER_ID => auth()->id()
                ]
            );
        }

        return $visitor;
    }

    /**
     * @return Factory|Application|View
     */
    public function adminDashboard(): Factory|Application|View
    {
        return $this->readService->adminDashboard();
    }

    /**
     * @param StoreRegisterRequest $storeRegisterRequest
     * @return JsonResponse|RedirectResponse
     */
    public function registration(StoreRegisterRequest $storeRegisterRequest): JsonResponse|RedirectResponse
    {
        $registerDTO = new RegisterDTO(
            $storeRegisterRequest->getName(),
            $storeRegisterRequest->getEmail(),
            $storeRegisterRequest->getPassword()
        );

        return $this->authService->registration($registerDTO);
    }

    /**
     * @return Factory|Application|View
     */
    public function getLogin(): Factory|Application|View
    {
        return view(self::VIEW_ADMIN_LOGIN);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        $user = auth()->user();

        if ($user) {
            $user->tokens()->delete();
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        } else {
            return redirect()->route(self::VIEW_LOGIN)->with('error', 'User is not authenticated.');
        }

        return redirect()->route(self::VIEW_WELCOME)->with('success', 'Logged out successfully.');
    }

    /**
     * @return Factory|Application|View
     */
    public function adminForm(): Factory|Application|View
    {
        return $this->readService->adminForm();
    }

    /**
     * @return Factory|Application|View
     */
    public function adminTable(): Factory|Application|View
    {
        return $this->readService->adminTable();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function deletePost(Request $request): RedirectResponse
    {
        $deletePostDTO = new DeletePostDTO(
            $request->path,
            $request->id,
        );
        $this->postService->deletePost($deletePostDTO);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteSkills(Request $request): RedirectResponse
    {
        $deleteSkillDTO = new DeleteSkillsDTO(
            $request->id
        );
        $this->skillsService->deleteSkills($deleteSkillDTO);

        return redirect()->back();
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteEducation(Request $request): RedirectResponse
    {
        $deleteEducationDTO = new DeleteEducationDTO(
            $request->id,
        );
        $this->educationsService->deleteEducation($deleteEducationDTO);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteLinks(Request $request): RedirectResponse
    {
        $deleteLinkDTO = new DeleteLinkDTO(
            $request->id,
        );
        $this->additionalLinksService->deleteLinks($deleteLinkDTO);

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteImage(Request $request): RedirectResponse
    {
        Images::query()->where('id', $request->id)->delete();

        if (Storage::exists($request->path)) {
            Storage::delete($request->path);
        }

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function deletePDF(Request $request): RedirectResponse
    {
        Files::query()->where('id', $request->id)->delete();

        return redirect()->back();
    }

    /**
     * @param $file
     * @return BinaryFileResponse
     */
    public function downloadPDF($file): BinaryFileResponse
    {
        return response()->download(storage_path('app/public/assets/file/'.$file));
    }
}
