<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TaskRequest;
use Carbon\Carbon;
use Tests\TestCase;

class TaskRequestTest extends TestCase
{
    /**
     * @dataProvider dataproviderTaskForm
     */
    public function testTaskFormValidation($data, $expect)
    {

        $rules = (new TaskRequest())->rules();
        $validator = Validator::make($data, $rules);
        $result = $validator->passes();

        $this->assertEquals($expect, $result);
    }

    public function dataproviderTaskForm()
    {
        return [
            [
                '正常' => [
                    'title' => str_repeat('a', 50),
                    'limit_at' => Carbon::now()->format('Y/m/d H:i'),
                    'project_id' => ''
                ], true,
            ],
            [
                '必須エラー' => [
                    'title' => ''
                ], false,
            ],
            [
                '最大文字数エラー' => [
                    'title' => str_repeat('a', 51)
                ], false
            ],
            [
                '日付けエラー' => [
                    'limit_at' => Carbon::now()->format('Y/m/d H:i:s'),
                ], false,
            ],
            [
                'プロジェクトエラー' => [
                    'limit_at' => 'test',
                ], false,
            ],
        ];
    }
}
