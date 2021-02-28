<?php

namespace Tests\Request;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ProjectRequest;
use Tests\TestCase;

class ProjectRequestTest extends TestCase
{

    /**
     * @dataProvider dataproviderProjectForm
     */
    public function testProjectFormValidation($item, $data, $expect)
    {
        $dataList = [$item => $data];
        $request = new ProjectRequest();

        $rules = $request->rules();
        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();

        $this->assertEquals($expect, $result);
    }

  public function dataproviderProjectForm()
  {
      return [
          '正常' => ['title', str_repeat('a', 20), true],
          '必須エラー' => ['title', '', false],
          '最大文字数エラー' => ['title', str_repeat('a', 21), false],
      ];
  }
}
