<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TaskRequest;
use Tests\TestCase;

class TaskRequestTest extends TestCase
{
    /**
     * @dataProvider dataproviderTaskForm
     */
    public function testTaskFormValidation($item, $data, $expect)
    {
        $dataList = [$item => $data];
        $request = new TaskRequest();

        $rules = $request->rules();
        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();

        $this->assertEquals($expect, $result);
    }

  public function dataproviderTaskForm()
  {
      return [
          '正常' => ['title', str_repeat('a', 50), true],
          '正常' => ['title', str_repeat('a', 50), true],
          '必須エラー' => ['title', '', false],
          '最大文字数エラー' => ['title', str_repeat('a', 21), false],
      ];
  }
}
