<?php

namespace App\Http\Services;

use App\DTO\CreateSkillDTO;
use App\DTO\DeleteSkillsDTO;
use App\DTO\UpdateSkillDTO;
use App\Interface\ColumnsInterface;
use App\Interface\ViewInterface;
use App\Models\Skills;

class SkillsService implements ViewInterface, ColumnsInterface
{
  public function createSkills(CreateSkillDTO $createSkillDTO): void
  {
      $skill = new Skills();
      $skill->name = $createSkillDTO->name;
      $skill->id = $createSkillDTO->id;
      $skill->user_id=auth()->id();
      $skill->save();

  }
  public function updateSkills(UpdateSkillDTO $updateSkillDTO): void
  {
      Skills::query()->where('id', $updateSkillDTO->id)->update([
          self::NAME => $updateSkillDTO->name
      ]);

  }
  public function deleteSkills(DeleteSkillsDTO $deleteSkillDTO): void
  {
      Skills::query()->where('id', $deleteSkillDTO->id)->delete();
  }
}
