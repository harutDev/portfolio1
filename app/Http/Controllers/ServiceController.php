<?php

namespace App\Http\Controllers;

use App\DTO\CreateAboutMeDTO;
use App\DTO\CreateEducationDTO;
use App\DTO\CreateLinkDTO;
use App\DTO\CreatePostDTO;
use App\DTO\CreateSkillDTO;
use App\DTO\LoginDTO;
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
use App\Models\Files;
use App\Models\Images;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends  Controller implements ViewInterface, ColumnsInterface
{
    public function __construct(
        protected UserService $userService, protected InformationsService $informationsService,
        protected PostService $postService, protected SkillsService $skillsService,
        protected EducationsService $educationsService, protected AdditionalLinksService $additionalLinksService,
        protected ReadService $readService, protected AuthService $authService

    ) {}
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


}
