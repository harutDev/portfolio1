<?php

namespace App\Http\Services;

use App\DTO\CreatePostDTO;
use App\DTO\DeletePostDTO;
use App\DTO\UpdatePostDTO;
use App\Interface\ColumnsInterface;
use App\Interface\ViewInterface;
use App\Models\Additional_links;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostService implements ViewInterface, ColumnsInterface
{
  public function createPost(CreatePostDTO $createPostDTO): void
  {
      $imageName = $createPostDTO->image->getClientOriginalName();
      $imagePath = $createPostDTO->image->store('public/assets/images');

      Post::orderBy('id', 'DESC')->query()->create([
          self::IMAGE_NAME => $imageName,
          self::IMAGE_PATE => basename($imagePath),
          self::LINKS => $createPostDTO->links,
          self::IMAGE_FULL_PATH => $imagePath,
          self::USER_ID => auth()->id()
      ]);
  }
  public function updatePost(UpdatePostDTO $updatePostDTO): void
  {
      $postData = [
          self::LINKS => $updatePostDTO->links
      ];
      $oldPost = Post::query()->where('id', $updatePostDTO->id)->first();

      if ($oldPost && Storage::exists($oldPost->image_full_path)) {
          Storage::delete($oldPost->image_full_path);
      }

      $imageName = $updatePostDTO->image->getClientOriginalName();
      $imagePath = $updatePostDTO->image->store('public/assets/images');

      $postData['image_name'] = $imageName;
      $postData['image_pate'] = basename($imagePath);
      $postData['image_full_path'] = $imagePath;

      Post::query()->where('id', $updatePostDTO->id)->update($postData);

  }
  public  function deletePost(DeletePostDTO $deletePostDTO): void
  {

      Additional_links::query()->where('post_id', $deletePostDTO->id)->delete();

      $post = Post::query()->where('id', $deletePostDTO->id)->delete();


      if (Storage::exists($deletePostDTO->path)) {
          Storage::delete($deletePostDTO->path);
      }
  }
}
