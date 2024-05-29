<?php

namespace App\Http\Controllers;

use App\DTO\{CreateAboutMeDTO,
    CreateEducationDTO,
    CreateLinkDTO,
    CreatePostDTO,
    CreateSkillDTO,
    DeleteEducationDTO,
    DeleteLinkDTO,
    DeletePostDTO,
    DeleteSkillsDTO,
    LoginDTO,
    RegisterDTO,
    UpdateAboutMeDTO,
    UpdateEducationDTO,
    UpdateLinkDTO,
    UpdatePostDTO,
    UpdateSkillDTO,
    UserUpdateDTO};
use App\Http\Requests\{CreateAboutMeRequest,
    CreateEducationRequest,
    CreateImageRequest,
    CreateLinkRequest,
    CreatePostRequest,
    CreateSkillRequest,
    LoginRequest,
    StoreRegisterRequest,
    UpdateAboutMeRequest,
    UpdateEducationRequest,
    UpdateUserRequest};
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
use Carbon\Carbon;
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
     * @param LoginRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function login(LoginRequest $request): JsonResponse|RedirectResponse
    {
        $loginDTO = new LoginDTO(
            $request->getEmail(),
            $request->getPassword()
        );
        $this->authService->login($loginDTO);
        $request->session()->regenerate();

        return redirect()->route('admin.adminDashboard');
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
     * @param UpdateUserRequest $request
     * @return RedirectResponse
     */
    public function updateUser(UpdateUserRequest $request): RedirectResponse
    {
        $userDTO = new UserUpdateDTO(
            $request->getId(),
            $request->getName(),
            $request->getSurname(),
            $request->getAddress(),
            $request->getPhone(),
            $request->getAge(),
            $request->input('languages')
        );
        $this->userService->updateUser($userDTO);

        return redirect()->back();
    }

    /**
     * @param UpdateAboutMeRequest $request
     * @return RedirectResponse
     */
    public function updateAboutMe(UpdateAboutMeRequest $request): RedirectResponse
    {
        $updateAboutMeDTO = new UpdateAboutMeDTO(
            $request->getAboutMe(),
            $request->getId()
        );
        $this->informationsService->updateAboutMe($updateAboutMeDTO);

        return redirect()->back();
    }

    /**
     * @param CreateAboutMeRequest $request
     * @return RedirectResponse
     */
    public function createAboutMe(CreateAboutMeRequest $request): RedirectResponse
    {
        $createAboutMeDTO = new CreateAboutMeDTO(
            $request->getAboutMe(),
            $request->getId()
        );
        $this->informationsService->createAboutMe($createAboutMeDTO);

        return redirect()->back();
    }

    /**
     * @param CreatePostRequest $request
     * @return RedirectResponse
     */
    public function createPost(CreatePostRequest $request): RedirectResponse
    {
        $createPostDTO = new CreatePostDTO(
            $request->getImage(),
            $request->getLinks(),
            $request->getId()
        );
        $this->postService->createPost($createPostDTO);

        return redirect()->back();
    }

    /**
     * @param CreatePostRequest $request
     * @return RedirectResponse
     */
    public function updatePost(CreatePostRequest $request): RedirectResponse
    {
        $updatePostDTO = new UpdatePostDTO(
            $request->getImage(),
            $request->getLinks(),
            $request->getId()
        );

        if ($request->has('image')) {
            $this->postService->updatePost($updatePostDTO);
        }

        return redirect()->back();
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
     * @param CreateSkillRequest $request
     * @return RedirectResponse
     */
    public function createSkills(CreateSkillRequest $request): RedirectResponse
    {
        $createSkillDTO = new CreateSkillDTO(
            $request->getName(),
            $request->getId()
        );
        $this->skillsService->createSkills($createSkillDTO);

        return redirect()->back();
    }

    /**
     * @param CreateSkillRequest $request
     * @return RedirectResponse
     */
    public function updateSkills(CreateSkillRequest $request): RedirectResponse
    {
        $updateSkillDTO = new UpdateSkillDTO(
            $request->getId(),
            $request->getName()
        );
        $this->skillsService->updateSkills($updateSkillDTO);

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
     * @param CreateEducationRequest $request
     * @return RedirectResponse
     */
    public function createEducation(CreateEducationRequest $request): RedirectResponse
    {
        $createEducationDTO = new CreateEducationDTO(
            $request->getEducation(),
            $request->getId()
        );
        $this->educationsService->createEducation($createEducationDTO);

        return redirect()->back();
    }

    /**
     * @param UpdateEducationRequest $request
     * @return RedirectResponse
     */
    public function updateEducation(UpdateEducationRequest $request): RedirectResponse
    {
        $updateEducationDTO = new UpdateEducationDTO(
            $request->getId(),
            $request->getName()
        );
        $this->educationsService->updateEducation($updateEducationDTO);

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
     * @param CreateLinkRequest $request
     * @return RedirectResponse
     */
    public function createLinks(CreateLinkRequest $request): RedirectResponse
    {
        $createLinkDTO = new CreateLinkDTO(
            $request->getName(),
            $request->getId(),
            $request->getPostId()
        );
        $this->additionalLinksService->createLinks($createLinkDTO);

        return redirect()->back();
    }

    /**
     * @param CreateLinkRequest $request
     * @return RedirectResponse
     */
    public function updateLinks(CreateLinkRequest $request): RedirectResponse
    {
        $updateLinkDTO = new UpdateLinkDTO(
            $request->getPostId(),
            $request->getName(),
            $request->getId()
        );
        $this->additionalLinksService->updateLinks($updateLinkDTO);

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

    public function createImage(CreateImageRequest $request): RedirectResponse
    {
        $imageName = $request->file('image')->getClientOriginalName();
        $imagePath = $request->file('image')->store('public/assets/images');
        Images::query()->create([
            self::IMAGE_NAME => $imageName,
            self::IMAGE_PATH => basename($imagePath),
            self::IMAGE_FULL_PATH => $imagePath,
            self::USER_ID => auth()->id(),
        ]);

        return redirect()->back();
    }

    /**
     * @param CreateImageRequest $request
     * @return RedirectResponse
     */

    public function updateImage(CreateImageRequest $request): RedirectResponse
    {
        $postData = [
            self::IMAGE_NAME => $request->input('image_name')
        ];

        if ($request->hasFile('image')) {
            $oldPostPath = Images::query()->where('id', $request->input('id'))->first();
            $param = false;

            if (Storage::exists($oldPostPath->image_full_path)) {
                Storage::delete($oldPostPath->image_full_path);
                $param = true;
            }

            if ($param) {
                $imageName = $request->file('image')->getClientOriginalName();
                $imagePath = $request->file('image')->store('public/assets/images');
                $postData['image_name'] = $imageName;
                $postData['image_path'] = basename($imagePath);
                $postData['image_full_path'] = $imagePath;
            }
        }

        Images::query()->where('id', $request->input('id'))->update($postData);

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
    public function createPDF(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|mimes:pdf|max:2048',
        ]);
        $file = $request->file('name')->getClientOriginalName();
        $path =$request->file('name')->store('public/assets/file');
        Files::query()->create([
            'name' => $file,
            'path' => $path,
            self::USER_ID => auth()->id(),
        ]);

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
