<?php

namespace App\Http\Services;

use App\DTO\CreateEducationDTO;
use App\DTO\DeleteEducationDTO;
use App\DTO\UpdateEducationDTO;
use App\Interface\ColumnsInterface;
use App\Interface\ViewInterface;
use App\Models\Educations;

class EducationsService implements ViewInterface, ColumnsInterface
{
    public function createEducation (CreateEducationDTO $createEducationDTO): void
    {
      $education = new Educations();
      $education->name = $createEducationDTO->education;
      $education->id = $createEducationDTO->id;
      $education->user_id = auth()->id();
      $education->save();

  }
   public function updateEducation (UpdateEducationDTO $updateEducationDTO): void
  {
      Educations::query()->where('id', $updateEducationDTO->id)->update([
          self::NAME => $updateEducationDTO->name
      ]);
  }
   public function deleteEducation(DeleteEducationDTO $deleteEducationDTO): void
   {
      Educations::query()->where('id', $deleteEducationDTO->id)->delete();

  }
}
