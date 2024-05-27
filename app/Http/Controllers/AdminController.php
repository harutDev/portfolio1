<?php

namespace App\Http\Controllers;

use App\DTO\CreateAboutMeDTO;
use App\DTO\CreateEducationDTO;
use App\DTO\CreateLinkDTO;
use App\DTO\CreatePostDTO;
use App\DTO\CreateSkillDTO;
use App\DTO\DeleteEducationDTO;
use App\DTO\DeleteLinkDTO;
use App\DTO\DeletePostDTO;
use App\DTO\DeleteSkillsDTO;
use App\DTO\LoginDTO;
use App\DTO\RegisterDTO;
use App\DTO\UpdateAboutMeDTO;
use App\DTO\UpdateEducationDTO;
use App\DTO\UpdateLinkDTO;
use App\DTO\UpdatePostDTO;
use App\DTO\UpdateSkillDTO;
use App\DTO\UserUpdateDTO;
use App\Http\Requests\CreateAboutMeRequest;
use App\Http\Requests\CreateEducationRequest;
use App\Http\Requests\CreateImageRequest;
use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\CreateSkillRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreRegisterRequest;
use App\Http\Requests\UpdateAboutMeRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Services\AdditionalLinksService;
use App\Http\Services\AuthService;
use App\Http\Services\EducationsService;
use App\Http\Services\InformationsService;
use App\Http\Services\PostService;
use App\Http\Services\ReadService;
use App\Http\Services\SkillsService;
use App\Http\Services\UserService;
use App\Interface\ColumnsInterface;
use App\Interface\ViewInterface;
use App\Models\{Additional_links, Educations, Images, Informations, PDF, Post, Skills, User, Visitors};
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

class AdminController extends Controller implements ViewInterface, ColumnsInterface
{
    public function __construct(
        protected UserService $userService , protected InformationsService $informationsService ,
        protected PostService $postService, protected SkillsService $skillsService,
        protected EducationsService $educationsService,protected AdditionalLinksService $additionalLinksService,
        protected ReadService $readService , protected AuthService $authService

    ){}

    public function dashboard(): Factory|Application|View
    {
        return view(self::VIEW_ADMIN_REGISTRATION);
    }

    public function welcome(): Factory|Application|View
    {
        $userInfo = User::query()->find(auth()->id());

        if ($userInfo !== null)
        $userInfo->load(['educations','informations','skills','posts.additionalLinks','images']);
        $ip = $this->createVisitors();

        return view(self::VIEW_WELCOME,compact('userInfo','ip'));
    }

    private function  createVisitors(): Model|Builder|null
    {
        $visitor_ip = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $referrer = $_SERVER['HTTP_REFERER'] ?? 'No referrer';
        $timestamp = date("Y-m-d H:i:s");

        $visitor = null;
        if (!is_null(auth()->id())){
            $visitor =  Visitors::query()->firstOrCreate(
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
    public function adminDashboard(): Factory|Application|View
    {
       return $this->readService->adminDashboard();
    }
    private function getDateTimeNow(): string
    {
        $armeniaTime = Carbon::now('Asia/Yerevan');
        $armeniaTime->toDateTimeString();

        return $armeniaTime->format('Y-m-d H:i:s');
    }
    public function registration(StoreRegisterRequest $storeRegisterRequest): JsonResponse|RedirectResponse
    {
        $registerDTO= new RegisterDTO(
          $storeRegisterRequest->getName(),
          $storeRegisterRequest->getEmail(),
          $storeRegisterRequest->getPassword()
        );

      return $this->authService->registration($registerDTO);
    }

    public function getLogin(Request $request): Factory|Application|View
    {
        return view(self::VIEW_ADMIN_LOGIN);
    }

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

    public function logout(Request $request)
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

    public function adminForm(): Factory|Application|View
    {
        return $this->readService->adminForm();
    }

    public function adminTable(): Factory|Application|View
    {
        return $this->readService->adminTable();
    }

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

    public function updateAboutMe(UpdateAboutMeRequest $request): RedirectResponse
    {
        $updateAboutMeDTO = new UpdateAboutMeDTO(
            $request->getAboutMe(),
            $request->getId()
        );
        $this->informationsService->updateAboutMe($updateAboutMeDTO);

        return redirect()->back();
    }
    public function createAboutMe(CreateAboutMeRequest $request): RedirectResponse
    {
        $createAboutMeDTO = new CreateAboutMeDTO(
            $request->getAboutMe(),
            $request->getId()
        );
        $this->informationsService->createAboutMe($createAboutMeDTO);

        return redirect()->back();
    }

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

    public function updatePost(CreatePostRequest $request):RedirectResponse
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

    public function deletePost(Request $request): RedirectResponse
   {
        $deletePostDTO = new DeletePostDTO(
            $request->path,
            $request->id,
        );
       $this->postService->deletePost($deletePostDTO);

        return redirect()->back();
   }

    public function createSkills(CreateSkillRequest $request): RedirectResponse
    {
        $createSkillDTO = new CreateSkillDTO(
            $request->getName(),
            $request->getId()
        );
        $this->skillsService->createSkills($createSkillDTO);

        return redirect()->back();
    }

    public function updateSkills(CreateSkillRequest $request): RedirectResponse
    {
        $updateSkillDTO = new UpdateSkillDTO(
            $request->getId(),
            $request->getName()
        );
        $this->skillsService->updateSkills($updateSkillDTO);

        return redirect()->back();
    }

    public function deleteSkills(Request $request): RedirectResponse
    {
        $deleteSkillDTO = new DeleteSkillsDTO(
            $request->id
        );

        $this->skillsService->deleteSkills($deleteSkillDTO);

        return redirect()->back();
    }

    public function createEducation(CreateEducationRequest $request): RedirectResponse
    {
        $createEducationDTO = new CreateEducationDTO(
            $request->getEducation(),
            $request->getId()
        );

        $this->educationsService->createEducation($createEducationDTO);

        return redirect()->back();
    }

    public function updateEducation(UpdateEducationRequest $request): RedirectResponse
    {
        $updateEducationDTO = new UpdateEducationDTO(
            $request->getId(),
            $request->getName()
        );
        $this->educationsService->updateEducation($updateEducationDTO);

        return redirect()->back();
    }

    public function deleteEducation(Request $request): RedirectResponse
    {
        $deleteEducationDTO = new DeleteEducationDTO(
            $request->id,
        );
        $this->educationsService->deleteEducation($deleteEducationDTO);

        return redirect()->back();
    }

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


    public function deleteLinks(Request $request): RedirectResponse
    {
        $deleteLinkDTO=new DeleteLinkDTO(
            $request->id,
        );
        $this->additionalLinksService->deleteLinks($deleteLinkDTO);

        return redirect()->back();
    }

    public  function createImage(CreateImageRequest $request): RedirectResponse
    {

        $imageName = $request->file('image')->getClientOriginalName();
        $imagePath = $request->file('image')->store('public/assets/images');


        Images::query()->create([
            self::IMAGE_NAME => $imageName,
            self::IMAGE_PATH =>  basename($imagePath),
            self::IMAGE_FULL_PATH =>  $imagePath,
            self::USER_ID=>auth()->id(),
        ]);

        return redirect()->back();
    }

    public function updateImage(CreateImageRequest $request):RedirectResponse
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

    public function deleteImage(Request $request): RedirectResponse
    {
        Images::query()->where('id',$request->id)->delete();

        if (Storage::exists($request->path) ) {
            Storage::delete($request->path);
        }

        return redirect()->back();
    }
    public function createPDF(Request$request): RedirectResponse
    {
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:2048',
        ]);
        $file = $request->file('pdf')->getClientOriginalName();

        pdf::query()->create([
            'pdf' => $file,
        ]);

        return redirect()->back();

    }
    public function deletePDF(Request $request): RedirectResponse
    {

        pdf::query()->where('id',$request->id)->delete();

        return redirect()->back();
    }

}
